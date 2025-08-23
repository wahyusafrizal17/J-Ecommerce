<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('client_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user, true);
            } else {
                $user = User::create([
                    'name'      => $googleUser->name,
                    'email'     => $googleUser->email,
                    'client_id' => $googleUser->id,
                    'password'  => Hash::make('user12345'),
                ]);

                Auth::login($user, true);
            }

            return redirect('/dashboard')->with([
                'message'    => 'Anda Berhasil Login',
                'alert-type' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect('/login')->withErrors(['msg' => 'Login dengan Google gagal.']);
        }
    }
}
