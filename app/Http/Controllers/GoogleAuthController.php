<?php

namespace App\Http\Controllers;
use App\Models\User;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;

class GoogleAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }
    public function callback() {
        $google_account = Socialite::driver('google')->user();
        if (! empty($google_account)) {
            $user = User::updateOrCreate([
                'google_id' => $google_account->id,
            ], [
                'name' => $google_account->name,
                'email' => $google_account->email,
                'password' => Hash::make(Str::random(8))
            ]);
            Auth::login($user);
            systemEmailSend("Зарегистрирован новый пользователь {$user->name}");
            return redirect()->route('dashboard');

        }
        return;
    }
}
