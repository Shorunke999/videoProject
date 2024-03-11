<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request){
        try{
            $data = array(
            "amount" => $request->amount,
            "reference" => Paystack::genTranxRef(),
            "email" => auth()->user()->email,
            "currency" => "NGN",
        );
    
        return Paystack::getAuthorizationUrl($data)->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. 
            Please refresh the page and try again.', 'type'=>'error']);
        } 
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
