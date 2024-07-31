<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/settings',function(){
    $settings=Setting::find(1);

    return  response()->json($settings, 200);
});

//Route::get('https://accept.paymobsolutions.com/api/acceptance/post_pay',[PaymentController::class,'returnPaymob'])->name('returnPaymob');
//Route::get('https://7a3c-197-36-72-69.eu.ngrok.io/returnPaymob',[PaymentController::class,'returnPaymob'])->name('returnPaymob');

// https://ap.gateway.mastercard.com/acs/MastercardACS/96fc8b41-54b3-4c48-9497-4004ecac9dfa
