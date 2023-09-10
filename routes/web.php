<?php

use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (! auth()->check()) {
        return redirect()->route('login');
    }

    return redirect()->route('dashboard');
});

Route::get('/login', function () {
    return Inertia::render('public/auth/login');
})->middleware('guest')->name('login');

Route::get('/dashboard', function () {
    return Inertia::render('home/index');
})->middleware('auth')->name('dashboard');

Route::prefix('/auth')->as('auth.')->group(function () {
    Route::get('/redirect/{provider}', [SocialAuthController::class, 'redirect'])->middleware('guest')->name('redirect');
    Route::get('/callback/{provider}', [SocialAuthController::class, 'callback'])->middleware('guest')->name('callback');
    Route::post('/logout', [SocialAuthController::class, 'logout'])->middleware('web')->name('logout');
});

require __DIR__.'/auth.php';
