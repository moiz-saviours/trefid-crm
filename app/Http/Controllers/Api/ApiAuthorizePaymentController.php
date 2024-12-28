<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
                'card_number' => 'required|numeric',
                'expiration_date' => 'required|date_format:m/Y',
                'cvv' => 'required|numeric',
                'invoice_number' => 'required|numeric|exists:invoices,invoice_key',
            ], [
                'card_number.numeric' => 'Card number must be numeric.',
                'card_number.required' => 'Card number is required.',
                'expiration_date.required' => 'Expiration date is required.',
                'expiration_date.date_format' => 'Expiration date format is invalid.',
                'cvv.required' => 'Card number is required.',
                'cvv.numeric' => 'Card number must be numeric.',
                'invoice_number.required' => 'Invoice number is required.',
                'invoice_number.numeric' => 'Invalid invoice number.',
                'invoice_number.exists' => 'Invoice not found.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $cardNumber = $request->input('card_number');
            $expirationDate = $request->input('expiration_date');
            $cvv = $request->input('cvv');
            $invoice = Invoice::where('invoice_key', $request->input('invoice_number'))->first();
            $payment = Payment::where('invoice_key', $request->input('invoice_number'))->first();

            if ($invoice->status == 1 || $payment) {
                return response()->json(['errors' => 'Invoice already paid.'], 422);
            }
            $amount = $invoice->amount;

            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(env('AUTHORIZE_NET_API_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($cardNumber);
            $creditCard->setExpirationDate($expirationDate);
            $creditCard->setCardCode($cvv);

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
                        Payment::create([
                            'invoice_key' => $invoice->invoice_key,
                            'brand_key' => $invoice->brand_key,
                            'team_key' => $invoice->team_key,
                            'client_key' => $invoice->client_key,
                            'agent_id' => $invoice->agent_id,
                            'merchant_id' => null,
                            'transaction_id' => $transactionResponse->getTransId(),
                            'response' => json_encode($response),
                            'transaction_response' => json_encode($transactionResponse),
                            'amount' => $amount,
                            'payment_type' => $invoice->type,
                            'status' => 1,/** paid */
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
