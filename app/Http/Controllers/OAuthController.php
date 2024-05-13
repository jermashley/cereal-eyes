<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider): RedirectResponse
    {
        $socialiteUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            $provider.'_id' => $socialiteUser->id,
        ], [
            'name' => $socialiteUser->name ?? $socialiteUser->email,
            'email' => $socialiteUser->email,
            'password' => bcrypt(Str::random(32)),
            $provider.'_id' => $socialiteUser->id,
            $provider.'_token' => $socialiteUser->token,
            $provider.'_refresh_token' => $socialiteUser->refreshToken,
            'token_duration' => $socialiteUser->expiresIn,
            'token_expires_at' => Carbon::now()->addSeconds($socialiteUser->expiresIn),
        ]);

        Auth::login($user);

        return redirect()->route('decode.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }
}
