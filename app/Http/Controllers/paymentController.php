<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;
use App\Models\suscribtion;
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
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        dd($paymentDetails);
        if($paymentDetails->status)
        {
            suscribtion::updateOrCreate(
                ['email'=>$paymentDetails->data->customer->email],
                [
                'email'=>$paymentDetails->data->customer->email,
                'bank' => $paymentDetails->data->authorization->bank,
                'amount'=> $paymentDetails->data->amount,
                'subscription'=> true,
                'authorizationCode' => $paymentDetails->data->authorization->authorization_code,
                'cardType' => $paymentDetails->data->authorization->card_type,
                'paidAt'=> $paymentDetails->data->paidAt,
                ]);  
            return inertia('Dashboard');
        }
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        //save info to DB
    }
}
