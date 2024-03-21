<?php

// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flutterwave\Controller\PaymentController as BasePaymentController;
use Flutterwave\EventHandlers\ModalEventHandler as PaymentHandler;
use Flutterwave\Flutterwave;
use Flutterwave\Library\Modal;

class flutterwaveController extends Controller
{
    public function process(Request $request)
    {
        try {
            Flutterwave::bootstrap();
            $customHandler = new PaymentHandler();
            $client = new Flutterwave();
            $modalType = Modal::POPUP; // Modal::POPUP or Modal::STANDARD
            $controller = new PaymentController($client, $customHandler, $modalType);
            $request->merge(['redirect_url' => $request->root().$request->getPathInfo()]);
            return response()->json([
                $request
            ]);
            $controller->process($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $controller = new BasePaymentController();
            $controller->callback($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

