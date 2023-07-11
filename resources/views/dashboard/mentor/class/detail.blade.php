@extends('dashboard.mentor.app')
@section('title-mentor', 'Detail Kelas')
@section('content-mentor')
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
                        <h3>Detail Kelas</h3>
                        <p class="text-subtitle text-muted">Menampilkan jumlah presensi, data mentee, materi</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Layout Default</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $class->name }}</h4>
                    </div>
                    <div class="card-body">
                        {{ $class->masterClass->description }}
                        <div class="row mt-4">
                            <div class="col-auto">
                                Mulai : {{ day($class->start_time) }}
                            </div>
                            <div class="col-auto">
                                Selesai : {{ day($class->start_time) }}
                            </div>
                            <div class="col-auto">
                                Status : <span
                                    class="badge {{ $class->status == 'active' ? 'bg-success' : 'bg-danger' }}">{{ $class->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="card border border-primary">
                                    <div class="card-body text-center px-4 py-4-5">
                                        <h6 class="text-secondary font-semibold mb-3">Tugas</h6>
                                        <p class="fw-bold">{{ $class->tasks->count() }}</p>
                                        <a href="{{ route('mentor.tasks.index', ['class_id' => $class->id]) }}"
                                            class="btn btn-sm btn-primary">Lihat</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border border-primary">
                                    <div class="card-body text-center px-4 py-4-5">
                                        <h6 class="text-secondary font-semibold mb-3">Materi</h6>
                                        <p class="fw-bold">{{ $class->masterClass->materials->count() }}</p>
                                        <a href="{{ route('mentor.materials.list', ['classId' => $class->id]) }}"
                                            class="btn btn-sm btn-primary">Lihat</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border border-primary">
                                    <div class="card-body text-center px-4 py-4-5">
                                        <h6 class="text-secondary font-semibold mb-3">Presensi</h6>
                                        <p class="fw-bold">{{ $class->presence->count() }}</p>
                                        <a href="{{ route('mentor.presence.index', ['class_id' => $class->id]) }}"
                                            class="btn btn-sm btn-primary">Lihat</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border border-primary">
                                    <div class="card-body text-center px-4 py-4-5">
                                        <h6 class="text-secondary font-semibold mb-3">Mentee</h6>
                                        <p class="fw-bold">{{ $class->mentee->count() }}</p>
                                        <a href="{{route('mentor.mentee-management.index', ['class' => $class->id])}}" class="btn btn-sm btn-primary">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="https://saugi.me">Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>

@endsection
