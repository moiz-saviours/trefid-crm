<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CcInfo;
use App\Models\CustomerCompany;
use App\Models\CustomerContact;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class ApiAuthorizePaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'card_name' => 'required|string',
                'card_number' => 'required|numeric',
                'expiration_month' => 'required|date_format:m',
                'expiration_year' => 'required|date_format:Y',
                'cvv' => 'required|numeric',
                'invoice_number' => 'required|numeric|exists:invoices,invoice_key',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'country' => 'required|string|max:100',
                'zipcode' => 'required|string|regex:/^\d{5}(-\d{4})?$/',
            ], [
                'card_number.numeric' => 'Card number must be numeric.',
                'card_number.required' => 'Card number is required.',
                'expiration_month.required' => 'Expiration month is required.',
                'expiration_month.date_format' => 'Expiration month format is invalid.',
                'expiration_year.required' => 'Expiration year is required.',
                'expiration_year.date_format' => 'Expiration year format is invalid.',
                'cvv.required' => 'Card number is required.',
                'cvv.numeric' => 'Card number must be numeric.',
                'invoice_number.required' => 'Invoice number is required.',
                'invoice_number.numeric' => 'Invalid invoice number.',
                'invoice_number.exists' => 'Invoice not found.',


                'address.required' => 'The address field is required.',
                'address.string' => 'The address must be a valid string.',
                'address.max' => 'The address must not exceed 255 characters.',

                'city.required' => 'The city field is required.',
                'city.string' => 'The city must be a valid string.',
                'city.max' => 'The city must not exceed 100 characters.',

                'state.required' => 'The state field is required.',
                'state.string' => 'The state must be a valid string.',
                'state.max' => 'The state must not exceed 100 characters.',

                'country.required' => 'The country field is required.',
                'country.string' => 'The country must be a valid string.',
                'country.max' => 'The country must not exceed 100 characters.',

                'zipcode.required' => 'The zipcode field is required.',
                'zipcode.string' => 'The zipcode must be a valid string.',
                'zipcode.regex' => 'The zipcode format is invalid. It must be 5 digits or 5+4 digits (e.g., 12345 or 12345-6789).',

            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $card_number = $request->input('card_number');
            $card_type = $this->getCardType($card_number);
            $expiration_month = $request->input('expiration_month');
            $expiration_year = $request->input('expiration_year');
            $expiration_date = $expiration_year . '-' . $expiration_month;
            $card_cvv = $request->input('cvv');
            $invoice = Invoice::where('invoice_key', $request->input('invoice_number'))->first();
            $payment = Payment::where('invoice_key', $request->input('invoice_number'))->first();

            if ($invoice->status == 1 || $payment) {
                return response()->json(['errors' => 'Oops! Invoice already paid.'], 422);
            }

            $customer_contact = CustomerContact::where('special_key', $invoice->cus_contact_key)->first();
            if (!$customer_contact) {
                return response()->json(['errors' => 'Oops! Customer not found.'], 422);
            }

            $pkey = config('app.pkey');

            $enc_card_number = $this->encrypt($card_number, $pkey);
            $enc_card_cvv = $this->encrypt($card_cvv, $pkey);
            $cc_info = CcInfo::firstOrCreate(
                [
                    'invoice_key' => $invoice->invoice_key,
                    'cus_contact_key' => $invoice->cus_contact_key,
                    'card_type' => $card_type,
                    'card_name' => $request->input('card_name'),
                    'card_number' => $enc_card_number,
                    'card_cvv' => $enc_card_cvv,
                    'card_month_expiry' => $expiration_month,
                    'card_year_expiry' => $expiration_year,
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'country' => $request->input('country'),
                    'zipcode' => $request->input('zipcode'),
                    'status' => 0,
                ],
                [
                    'card_type' => $card_type,
                    'card_name' => $request->input('card_name'),
                    'card_number' => $enc_card_number,
                    'card_cvv' => $enc_card_cvv,
                    'card_month_expiry' => $expiration_month,
                    'card_year_expiry' => $expiration_year,
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'country' => $request->input('country'),
                    'zipcode' => $request->input('zipcode'),
                    'status' => 0,
                ]
            );

            $amount = $invoice->amount;

            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(env('AUTHORIZE_NET_API_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($card_number);
            $creditCard->setExpirationDate($expiration_date);
            $creditCard->setCardCode($card_cvv);

            $payment = new AnetAPI\PaymentType();
            $payment->setCreditCard($creditCard);

            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction");
            $transactionRequestType->setAmount($amount);
            $transactionRequestType->setPayment($payment);

            $transactionRequest = new AnetAPI\CreateTransactionRequest();
            $transactionRequest->setMerchantAuthentication($merchantAuthentication);
            $transactionRequest->setRefId("ref" . time());
            $transactionRequest->setTransactionRequest($transactionRequestType);

            $controller = new AnetController\CreateTransactionController($transactionRequest);
            $response = $controller->executeWithApiResponse(env('AUTHORIZE_NET_TEST_MODE') == 'true' ? \net\authorize\api\constants\ANetEnvironment::SANDBOX : \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            if ($response != null) {
                $transactionResponse = $response->getTransactionResponse();

                if ($transactionResponse != null) {
                    if ($transactionResponse->getResponseCode() == "1") {

                        $invoice->update(['status' => 1]);
                        $cc_info->update(['status' => 1]);

                        Payment::create([
                            'invoice_key' => $invoice->invoice_key,
                            'brand_key' => $invoice->brand_key,
                            'team_key' => $invoice->team_key,
                            'cus_contact_key' => $invoice->cus_contact_key,
                            'cc_info_key' => $cc_info->special_key,
                            'agent_id' => $invoice->agent_id,
                            'merchant_id' => null,
                            'transaction_id' => $transactionResponse->getTransId(),
                            'response' => json_encode($response),
                            'transaction_response' => json_encode($transactionResponse),
                            'amount' => $amount,
                            'payment_type' => $invoice->type,
                            'status' => 1, /** paid */

                            'card_type' => $card_type,
                            'card_name' => $request->input('card_name'),
                            'card_number' => substr($card_number, -4),
                            'card_cvv' => $enc_card_cvv,
                            'card_month_expiry' => $expiration_month,
                            'card_year_expiry' => $expiration_year,
                        ]);
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Payment successful!',
                            'transaction_id' => $transactionResponse->getTransId(),
                            'response' => $response,
                            'transactionResponse' => $transactionResponse,
                        ]);
                    } else {
                        $errorMessages = $transactionResponse->getErrors();
                        return response()->json([
                            'status' => 'error',
                            'message' => $errorMessages ? $errorMessages[0]->getErrorText() : 'Payment failed',
                            'response' => $response,
                            'transactionResponse' => $transactionResponse,
                        ], 400);
                    }
                } else {
                    $errorMessages = $transactionResponse->getErrors();
                    return response()->json([
                        'status' => 'error',
                        'message' => $errorMessages ? $errorMessages[0]->getErrorText() : 'Payment failed',
                        'response' => $response,
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $response->getMessages()->getMessage()[0]->getText(),
                ], 500);
            }
        } catch
        (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
