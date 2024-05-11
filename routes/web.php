<?php

use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (Auth::user()) {
        return redirect()->route('decode.index');
    }

    return Inertia::render('Home/Index');
})->name('home.index');

Route::prefix('oauth')
    ->as('oauth.')
    ->group(function () {
        Route::get('/{provider}/redirect', [OAuthController::class, 'redirect'])->name('redirect');
        Route::get('/{provider}/callback', [OAuthController::class, 'callback'])->name('callback');
        Route::post('/logout', [OAuthController::class, 'logout'])->name('logout');
    });

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::get('/decode', function () {
        return Inertia::render('Decode/Index');
    })->name('decode.index');
});

require __DIR__.'/auth.php';
