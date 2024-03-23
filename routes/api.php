<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\flutterwaveController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('authApi')->group(
    function(){
        Route::get('/getVideo',[apiController::class,'paginate']);
    }
);
Route::post('/flutter',[flutterwaveController::class,'process']);
https://0752-102-88-82-126.ngrok-free.app/callback

Route::get('/callback',[flutterwaveController::class,'callback'])->name('callback');