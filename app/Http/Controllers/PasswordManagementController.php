<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetPasswordRequest;

class PasswordManagementController extends Controller
{
    public function requestForm()
    {
        return view('dashboard.auth.pages.forgot-password');
    }

    public function storeRequest(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ? back()->with('success', 'Verifikasi email dikirim') : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordForm($token){
        $resetToken = $token;
        $email = request('email');
        return view('dashboard.auth.pages.reset-password', compact('resetToken', 'email'));
    }

    public function resetPasswordStore(ResetPasswordRequest $request){
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('success', 'Password diperbaharui') : back()->withErrors(['email' => [__($status)]]);
    }
}
