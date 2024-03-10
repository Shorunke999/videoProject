<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\authController;
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

Route::get('/', [controller::class,'view']);
Route::post('/authUser', [authcontroller::class,'authMethod']);
Route::middleware(['auth'])->group(function(){
        
    Route::get('/authUser', [authcontroller::class,'viewDashboard']);
});
