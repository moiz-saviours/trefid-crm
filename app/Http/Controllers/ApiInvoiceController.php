<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ApiInvoiceController extends Controller
{
    /**
     * Fetch the invoice details by the invoice key.
     *
     * @param string $invoice_key
     * @return JsonResponse
     */
    public function fetch_invoice($invoice_key)
    {
        try {
            $this->validateInvoiceKey($invoice_key);
            $invoice = Invoice::where('invoice_key', $invoice_key)->first();
            if (!$invoice) {
                return response()->json(['success' => false, 'message' => 'Invoice not found for the given key.',], 404);
            }
            $invoice->loadMissing('brand', 'team', 'customer_contact', 'agent');
            $brand = $invoice->brand;
            $customer = $invoice->customer_contact;
            $agent = $invoice->agent;
            $data = [
                "id" => $invoice->id,
                "invoice_key" => $invoice->invoice_key,
                "invoice_number" => $invoice->invoice_number,
                "description" => $invoice->description,
                "amount" => $invoice->amount,
                "type" => $invoice->type,
                "created_at" => $invoice->created_at,
                "due_date" => $invoice->created_at,
                "status" => $invoice->status,
                "brand" => [
                    "name" => $brand->name,
                    "url" => $brand->url,
                    "logo" => asset('assets/images/brand-logos/'.$brand->logo),
                    "email" => $brand->email,
                    "description" => $brand->description,
                ],
                'customer' => [
                    "name" => $customer->name,
                    "email" => $customer->email,
                    "phone" => $customer->phone,
                    "address" => $customer->address,
                    "city" => $customer->city,
                    "state" => $customer->state,
                    "zipcode" => $customer->zipcode,
                    "country" => $customer->country,
                ],
                'agent' => [
                    "name" => $agent->name,
                    "email" => $agent->email,
                ],
                'payment_methods' => [
                    "credit_card",
                ],
            ];
            return response()->json(['success' => true, 'invoice' => $data,]);
        } catch (ValidationException $exception) {
            return response()->json(['success' => false, 'error' => 'Invalid invoice id format.', 'message' => $exception->getMessage(),], 422);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Invoice not found.',], 404);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'error' => 'Internal server error.', 'message' => $exception->getMessage(),], 500);
        }
    }

    /**
     * Validate the format of the invoice key (optional customization).
     *
     * @param string $invoice_key
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateInvoiceKey(string $invoice_key)
    {
        $validator = Validator::make(
            ['invoice_key' => $invoice_key],
            ['invoice_key' => 'required|min:6|max:20'],
            ['invoice_key.required' => 'The invoice id field is required.',
                'invoice_key.min' => 'The invoice id must be at least :min characters.',
                'invoice_key.max' => 'The invoice id may not be greater than :max characters.']
        );
        if ($validator->fails()) {
            throw new ValidationException($validator, null, 'Invalid invoice ID format.');
        }
    }
}
