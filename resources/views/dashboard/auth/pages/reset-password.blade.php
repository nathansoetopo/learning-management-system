@extends('dashboard.auth.app')
@section('form-title', 'Reset Password')
@section('form-caption', 'Masukkan password baru anda')
@section('form-authentication')
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl" value="{{ $email }}" name="email" readonly>
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" name="password_confirmation"
                placeholder="Konfirmasi Password">
            <input type="hidden" name="token" value="{{ $resetToken }}">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send</button>
    </form>
@endsection
