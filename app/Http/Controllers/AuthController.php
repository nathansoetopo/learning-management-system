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

    public function superadminLogin(){
        return view('dashboard.auth.pages.superadmin_login');
    }

    public function register(){
        return view('dashboard.auth.pages.register');
    }

    public function storeLoginSuperadmin(LoginRequest $request){
        $data = User::where('username', $request->credential)->orWhere('email', $request->credential)->firstOrFail();

        if(!$data->hasRole('superadmin')){
            return redirect()->back()->withErrors('Anda bukan superadmin');
        }

        if(Auth::attempt(['username' => $data->username, 'email' => $data->email, 'password' => $request->password])){
            return redirect()->route('superadmin.dashboard');
        }

        return redirect()->back()->withErrors('Email, Username atau Password Salah');
    }

    public function storeLogin(LoginRequest $request){
        $data = User::where('username', $request->credential)->orWhere('email', $request->credential)->firstOrFail();

        if(Auth::attempt(['username' => $data->username, 'email' => $data->email, 'password' => $request->password])){
            if($data->hasRole('mentee')){
                return redirect()->route('mentee.dashboard'); 
            }else if($data->hasRole('mentor')){
                return redirect()->route('mentor.dashboard');
            }

            return redirect()->back()->withErrors('Anda Tidak Memiliki Akses');
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
