<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response as HttpCodes;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        // $emailDomain = substr(strrchr($socialiteUser->getEmail(), '@'), 1);

        // Return to the login if the user's email domain is not in our valid domain list.
        // if (! in_array($emailDomain, config('socialite.valid_domains'))) {
        //     return redirect()->route('login')->withErrors([
        //         'email' => 'You must use a valid Prologue email address to login.',
        //     ]);
        // }

        ray($socialiteUser);

        $user = User::updateOrCreate([
            'provider_id' => $socialiteUser->id,
        ], [
            'name' => $socialiteUser->user['name'],
            'email' => $socialiteUser->email,
            'password' => bcrypt(Str::random(32)),
            'provider' => $provider,
            'avatar_url' => $socialiteUser->avatar,
            'provider_token' => $socialiteUser->token,
            'provider_refresh_token' => $socialiteUser->refreshToken,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->flush();

        return response()->json([], HttpCodes::HTTP_NO_CONTENT);
    }
}
