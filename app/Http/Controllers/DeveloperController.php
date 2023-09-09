<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    public function login(User $user)
    {
        Auth::login($user, $remember = true);

        return redirect(RouteServiceProvider::HOME);
    }
}
