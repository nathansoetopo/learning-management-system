@extends('dashboard.auth.app')
@section('form-title', 'Register')
@section('form-caption', 'Masukkan data anda.')
@section('form-authentication')
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl" name="name" placeholder="Nama Lengkap" required>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl" name="email" placeholder="Email" required>
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" required>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01"><span class="fa-fw select-all fas"></span></label>
                <select class="form-select" name="gender" id="inputGroupSelect01" required>
                    <option selected>Jenis Kelamin</option>
                    <option value="male">Pria</option>
                    <option value="female">Wanita</option>
                </select>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" name="password_confirmation"
                placeholder="Konfirmasi Password" required>
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class='text-gray-600'>Already have an account? <a href="auth-login.html" class="font-bold">Log
                in</a>.</p>
    </div>
@endsection
