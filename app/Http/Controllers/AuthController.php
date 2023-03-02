<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('dashboard.auth.pages.login');
    }

    public function register(){
        return view('dashboard.auth.pages.register');
    }

    public function storeLogin(LoginRequest $request){
        $data = User::where('username', $request->credential)->orWhere('email', $request->credential)->firstOrFail();

        if(Auth::attempt(['username' => $data->username, 'email' => $data->email, 'password' => $request->password])){
            return redirect()->route('dashboard.index');
        }

        return redirect()->back()->withErrors('Email, Username atau Password Salah');
    }

    public function storeRegister(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'gender' => $request->gender,
            'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRceeoCvxzs1sp0cKRtwCyzr9LvG3ceMP0OGg&usqp=CAU',
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('mentee');

        event(new Registered($user));

        return redirect()->back()->with('success', 'Email verifikasi dikirim ke email anda.');
    }

    public function logout(){
        Session::flush();
        
        Auth::logout();

        return redirect()->route('login');
    }
}
