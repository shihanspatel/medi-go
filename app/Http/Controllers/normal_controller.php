<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            'email' => 'required|email|unique:register,email',
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        $user = Register::create([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode
        ]);

        // Auto login after register (optional)
        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Account created successfully');
    }


    // ================= LOGIN =================

    public function login_index()
    {
        return view('login');
    }

    public function login_check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            return redirect()->route('home')
                ->with('success', 'Login successful');
        }

        return back()->with('error', 'Invalid email or password');
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
}
