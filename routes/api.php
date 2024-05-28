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
        Route::delete('decode/all', [DecodeController::class, 'destroyAll'])->name('decode.destroyAll');
        Route::apiResource('decode', DecodeController::class);
    });
