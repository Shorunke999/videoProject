<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request)
    {
        try {
            $data = [
                "amount" => $request->Amount,
                "reference" => Paystack::genTranxRef(),
                "email" => auth()->user()->email,
                "currency" => "NGN",
            ];
            //$redirectUrl = Paystack::getAuthorizationUrl($data)->redirectUrl();
            // Return the redirect URL to the frontend
            //return Inertia::location($redirectUrl);
            $url = Paystack::getAuthorizationUrl($data)->url;
            return Redirect::away($url);//->redirectNow();
        } catch(\Exception $e) {
            return Redirect::back()->with(['msg' => $e->getMessage()]);
        }
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        //save info to DB
        return inertia('');
    }
}
