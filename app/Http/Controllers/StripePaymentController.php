<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Stripe;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws ApiErrorException
     */
    public function stripePost(Request $request)
    {
        dd($request);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
            "address" => [
                "line1" => "Virani Chowk",
                "postal_code" => "360001",
                "city" => "Rajkot",
                "state" => "GJ",
                "country" => "IN",
            ],
            "email" => "demo@gmail.com",
            "name" => "Hardik Savani",
            "source" => $request->stripeToken
        ));
        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "customer" => $customer->id,
            "description" => "Test payment.",
//            "shipping" => [
//                "name" => "Jenny Rosen",
//                "address" => [
//                    "line1" => "510 Townsend St",
//                    "postal_code" => "98140",
//                    "city" => "San Francisco",
//                    "state" => "CA",
//                    "country" => "US",
//                ],
//            ]
        ]);
        Session::flash('success', 'Payment successful!');
        return back();
    }
    public function createPaymentIntent()
    {
        return view('stripe');
    }

    public function handlePayment(Request $request)
    {
        dd($request);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => 10000, // Amount in cents (e.g., $100.00)
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function submitPayment(Request $request)
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Stripe\Charge::create([
                'amount' => 5000, // Amount in cents (e.g., $50.00)
                'currency' => 'usd',
                'source' => $request->token,
                'description' => 'Custom payment',
            ]);

            return response()->json(['success' => true, 'message' => 'Payment successful!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
