<?php

use App\Http\Controllers\Api\DecodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])
    ->as('api.')
    ->group(function () {
        Route::apiResource('decode', DecodeController::class);
    });
