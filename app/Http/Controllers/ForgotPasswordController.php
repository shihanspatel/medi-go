<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\PasswordReset;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('forgot_password_form');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
                'otp_verified' => false,
            ]
        );

        Mail::send(new SendOtpMail($otp, $request->email));

        return redirect()->route('forgot.otp')->with('email', $request->email)->with('success', 'OTP sent to your email');
    }

    public function showOtpForm()
    {
        return view('forgot_password_otp_page');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $reset = PasswordReset::where('email', $request->email)->first();

        if (!$reset || $reset->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        if ($reset->otp_expires_at < now()) {
            return back()->withErrors(['otp' => 'OTP expired']);
        }

        $reset->update(['otp_verified' => true]);

        return redirect()->route('forgot.reset')->with('email', $request->email)->with('success', 'OTP verified');
    }

    public function showResetForm()
    {
        return view('forgot_password_set_new_pass');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $reset = PasswordReset::where('email', $request->email)->first();

        if (!$reset || !$reset->otp_verified) {
            return back()->withErrors(['email' => 'Invalid request']);
        }

        $user = Register::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        $reset->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully. Please login.');
    }
}
