<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request)
    {
        try {
            $data = array(
                "amount" => $request->Amount,
                "reference" => Paystack::genTranxRef(),
                "email" => auth()->user()->email,
                "currency" => "NGN",
            );
            $authorizationUrl = Paystack::getAuthorizationUrl($data)->url;
            return Inertia::location($authorizationUrl);
        } catch(\Exception $e) {
            return Redirect::back()->with(['msg' => $e->getMessage()]);
        }
    }
    public function anotherRedirectToGateway()
    {
        try {   
            return Paystack::getAuthorizationUrl()->redirectNow();
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
