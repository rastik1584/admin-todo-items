<?php

namespace App\Http\Controllers;

use App\Events\UserRegister;
use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        flash('Registered successfully please sign in','success');

        return redirect()->route('login.index');
    }
}
