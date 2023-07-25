<?php

use App\Http\Controllers\Api\SerializedController;
use App\Http\Controllers\Api\UnserializeController;
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
    Route::post('/decode', [UnserializeController::class, 'decode'])->name('unserialize');

    Route::apiResource('serialized', SerializedController::class);
    Route::delete('/serialized/force-destroy-all', [SerializedController::class, 'forceDestroyAll'])->name('serialized.force-destroy-all');
});
