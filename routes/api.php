<?php

use App\Http\Controllers\Api\ApiAuthorizePaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('process-payment', [ApiAuthorizePaymentController::class, 'processPayment'])->name('process-payment');
