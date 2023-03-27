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
                        <h3>Buat Master Class Baru</h3>
                        <p class="text-subtitle text-muted">Masukkan nama kelas, deskripsi dan thumbnail</p>
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
                        <h4 class="card-title">Buat Kelas</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('superadmin.master-class.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Kelas</label>
                                        <input type="text" name="name" class="form-control" id="basicInput" required
                                            placeholder="Masukkan nama event" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail Event</label>
                                        <input type="file" id="thumbnail" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-md-4">
                                    <label for="">Harga</label>
                                    <div class="form-group mt-2">
                                        <input type="number" name="price" class="form-control" min="0" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Pilih Event</label>
                                    <div class="form-group mt-2">
                                        <select class="choices form-select" name="event_id">
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check form-switch mt-4">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                            name="dashboard" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Gunakan
                                            Dashboard?</label>
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
    @push('superadminscript')
        <script src="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/form-element-select.js"></script>
    @endpush
@endsection
