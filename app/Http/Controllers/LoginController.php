<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function index(): \View
    {
        if (Auth::check()) {
            flash('test message', 'danger');
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Login
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
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

    /**
     * Logout
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login.index');
    }
}
