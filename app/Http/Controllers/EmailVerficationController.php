<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerficationController extends Controller
{
    public function sendVerificationEmail(){
        return view('dashboard.auth.pages.resend-email-verification');
    }

    public function emailVerification(EmailVerificationRequest $request){
        $request->fulfill();

        return redirect()->route('login')->with('success', 'Email anda berhasil diverifikasi');
    }

    public function resendEmail(Request $request){
        $request->user()->sendEmailVerificationNotification();
 
        return redirect()->route('login')->with('success', 'Link verifikasi dikirim ulang');
    }
}
