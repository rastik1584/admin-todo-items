<?php

namespace App\Http\Controllers;

use App\Events\UserRegister;
use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Register frontend page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): \View
    {
        return view('auth.register');
    }

    /**
     * Register user and redirect into login page
     * @param RegisterStoreRequest $request
     * @return RedirectResponse
     */
    public function store(RegisterStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        flash('Registered successfully please sign in','success');

        return redirect()->route('login.index');
    }
}
