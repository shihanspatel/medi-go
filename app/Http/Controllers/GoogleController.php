<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = Register::where('email', $googleUser->email)->first();

        if ($user) {
            if (!$user->email_verified_at) {
                $user->update([
                    'email_verified_at' => now(),
                    'status' => 'active',
                ]);
            }
            Auth::login($user);
            return redirect()->route('home.index')->with('success', 'Welcome back!');
        } else {
            $newUser = Register::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make(uniqid()),
                'user_image' => $this->downloadGoogleAvatar($googleUser->getAvatar()),
                'email_verified_at' => now(),
                'status' => 'active',
            ]);

            Auth::login($newUser);
            return redirect()->route('home.index')->with('success', 'Welcome! Account created with Google');
        }
    }

    private function downloadGoogleAvatar($avatarUrl)
    {
        try {
            $contents = file_get_contents($avatarUrl);
            $filename = 'google_' . time() . '_' . uniqid() . '.jpg';
            file_put_contents(public_path('images/users/' . $filename), $contents);
            return $filename;
        } catch (\Exception $e) {
            return null;
        }
    }
}
