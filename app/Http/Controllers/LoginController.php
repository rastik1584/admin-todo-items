<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            flash('test message', 'danger');
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            flash('Successfully logged in', 'success');
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login.index');
    }
}
