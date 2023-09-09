<?php

use App\Http\Controllers\CaddyController;
use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;

Route::get('/login/{user}', [DeveloperController::class, 'login'])->name('login');

Route::get('/caddy-check', [CaddyController::class, 'check']);
