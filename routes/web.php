<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\authController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\videoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [controller::class,'view'])->name('login');
Route::post('/authUser', [authcontroller::class,'authMethod']);
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);

Route::get('/authUser', [authcontroller::class,'viewDashboard']);
Route::middleware(['auth'])->group(function(){
    //Route::get('/authUser', [authcontroller::class,'viewDashboard']);
    Route::post('/pay', [PaymentController::class, 'redirectToGateway']);
    Route::post('/videoUpload',[videoController::class , 'upload']);
    Route::get('/videoPage',[videoController::class, 'view']);
    Route::get('/videoPlayer/{url}',[videoController::class, 'play']);
    Route::get('/Dashing', [authcontroller::class,'Dashing']);
});
//https://8f3d-102-89-22-143.ngrok-free.app/payment/callback  callback url