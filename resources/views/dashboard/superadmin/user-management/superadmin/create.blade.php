@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Buat Event Baru')
@push('superadminheadscript')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/styles/choices.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ asset('dashboard') }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/pages/filepond.css">
@endpush
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Tambah Superadmin</h3>
                        <p class="text-subtitle text-muted">Masukkan data superadmin dengan benar</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Input</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Admin</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('superadmin.manage.users.store', ['role_name' => $role])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" id="basicInput" required
                                            placeholder="Masukkan nama lengkap" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-4 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Username</label>
                                        <input type="text" name="username" class="form-control" id="basicInput"
                                            placeholder="Masukkan username unik" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-4 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Email</label>
                                        <input type="email" name="email" class="form-control" id="basicInput"
                                            placeholder="Masukkan email" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">No. Telephone</label>
                                        <input type="number" name="phone" class="form-control" id="basicInput"
                                            required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="male">Laki - laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Password</label>
                                        <input type="password" name="password" class="form-control" id="basicInput" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="basicInput" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success float-end" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    {{-- @push('superadminscript')
        <script src="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/form-element-select.js"></script>
    @endpush --}}
@endsection
