@extends('dashboard.auth.app')
@section('form-title', 'Login Superadmin')
@section('form-caption', 'Masukkan data login anda.')
@section('form-authentication')
    <form action="{{route('superadmin.login.store')}}" method="POST">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl" name="credential" placeholder="Username atau Email">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
    </form>
@endsection
