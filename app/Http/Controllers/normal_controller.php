<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Coderflex\LaravelTurnstile\Rules\TurnstileCheck;
use Laravel\Socialite\Facades\Socialite;

class normal_controller extends Controller
{

    // ================= REGISTER =================

    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'cf-turnstile-response' => ['required', new TurnstileCheck()],
        ]);

        $user = Register::create([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'status' => 'inactive'
        ]);

        event(new Registered($user));

        return redirect()->route('login')
            ->with('success', 'Verification email sent. Please check your email.');
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verify Your Medi-Go Account')
            ->view('emails.Email_user', [
                'name' => $notifiable->name,
                'actionUrl' => $verificationUrl,
            ]);
    }

    // ================= LOGIN =================

    public function login_index()
    {
        return view('login');
    }



    public function login_Check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'cf-turnstile-response' => ['required', new TurnstileCheck()],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            if (!Auth::user()->email_verified_at) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Please verify your email first.'
                ]);
            }

            // Check Account Status
            if (Auth::user()->status != 'active') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is inactive.'
                ]);
            }

            // Redirect based on role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }


    // ================= LOGOUT =================

    public function login_logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logged out successfully');
    }


    // ================= PROFILE =================

    public function Profile_index()
    {
        $user = Auth::user();

        return view('after_login_user_profile', compact('user'));
    }


    public function Profile_update(Request $request)
    {
        /** @var User $user */          // tell the analyser what the object is
        $user = Auth::user();

        $request->validate([
            'name'    => 'required',
            'address' => 'required',
            'city'    => 'required',
            'state'   => 'required',
            'pincode' => 'required',
        ]);

        // mass‑assignment requires these attributes to be fillable on the model
        $user->update([
            'name'    => $request->name,
            'address' => $request->address,
            'city'    => $request->city,
            'state'   => $request->state,
            'pincode' => $request->pincode,
        ]);

        return back()->with('success', 'Profile updated successfully');
    }

    // ================= CHANGE PASSWORD =================

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Password changed successfully! Please login with your new password.');
    }

    // ================= GOOGLE LOGIN =================

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to login with Google');
        }

        $authUser = Register::where('email', $user->getEmail())->first();

        if ($authUser) {
            Auth::login($authUser, true);
            return redirect()->route('home.index');
        } else {
            $newUser = Register::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make(uniqid()),
                'user_image' => $this->downloadGoogleAvatar($user->getAvatar()),
                'status' => 'active',
                'email_verified_at' => now(),
            ]);

            Auth::login($newUser, true);
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