<?php

use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::post('login', \App\Http\Middleware\Authenticate::class,);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
