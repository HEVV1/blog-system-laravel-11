<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->back()
                ->with('info', 'You are already logged in.');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('blog.index')
            ->with('success', 'Account successfully created');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->back()
                ->with('info', 'You are already logged in.');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('blog.index')
                ->with('success', 'Login successfully');
        }

        return back()->withErrors([
            'email' => 'Incorrect email or password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('blog.index')
            ->with('success', 'You have been logged out');
    }
}
