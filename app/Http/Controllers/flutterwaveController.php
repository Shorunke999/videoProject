<?php

// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EdwardMuss\Rave\Facades\Rave as Flutterwave;
class flutterwaveController extends Controller
{
    public function process(Request $request)
    {
        try {
                //This generates a payment reference
            $reference = Flutterwave::generateReference();
            $user = auth()->user();
            // Enter the details of the payment
            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $request->Amount,
                'email' => $user->email,
                'tx_ref' => $reference,
                'currency' => "KES",
                'redirect_url' => route('callback'),
                'customer' => [
                    'email' => $user->email,
                    "phone_number" =>null,
                    "name" => null
                ],

                "customizations" => [
                    "title" => 'Buy Me Coffee',
                    "description" => "Let express love of coffee"
                ]
            ];

            //$payment = Flutterwave::initializePayment($data);


            if ($payment['status'] !== 'success') {
                // notify something went wrong
                return redirect()->back()->with('msg','Transaction not successfull, Try again');
            }

            return redirect($payment['data']['link']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback()
    {
        
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {
        
        $transactionID = Flutterwave::getTransactionIDFromCallback();
        $data = Flutterwave::verifyTransaction($transactionID);

        dd($data);
        }
        elseif ($status ==  'cancelled'){
            //Put desired action/code after transaction has been cancelled here
        }
        else{
            //Put desired action/code after transaction has failed here
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
}


