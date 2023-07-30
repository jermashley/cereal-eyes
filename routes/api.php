<?php

use App\Http\Controllers\Api\DecodeController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->as('api.')->group(function () {
    Route::apiResource('decode', DecodeController::class);
    Route::delete('/decode/force-destroy-all', [DecodeController::class, 'forceDestroyAll'])->name('decode.force-destroy-all');
});
