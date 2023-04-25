@extends('dashboard.mentee.app')
@section('title-mentee', 'Dashboard Mentee')
@section('content-mentee')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>{{ $class->name }}</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Materi dan Tugas</h4>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    @foreach ($class->masterClass->materials as $material)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                <button class="accordion-button fw-bold" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-{{ $loop->iteration }}"
                                                    aria-expanded="true"
                                                    aria-controls="panelsStayOpen-{{ $loop->iteration }}">
                                                    {{ $material->name }}
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-{{ $loop->iteration }}"
                                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="panelsStayOpen-headingOne">
                                                <div class="accordion-body">
                                                    <p class="text-secondary">{{ $material->description }}</p>
                                                    <div class="container">
                                                        @if (!empty($material->sub_materials))
                                                            <p class="text-primary fw-bold">Bahan Ajaran</p>
                                                            <div class="list-group">
                                                                @foreach ($material->sub_materials as $sub_material)
                                                                    <a href="{{ $sub_material->asset }}" target=”_blank”
                                                                        class="list-group-item list-group-item-action"
                                                                        aria-current="true">
                                                                        {{ $sub_material->name }}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        @if (!empty($material->tasks))
                                                            <p class="text-primary fw-bold mt-4">Tugas</p>
                                                            <div class="list-group">
                                                                @foreach ($material->tasks as $task)
                                                                    <a href="{{route('mentee.tasks.show', ['id' => $task->id])}}"
                                                                        class="list-group-item list-group-item-action"
                                                                        aria-current="true">
                                                                        {{ $task->name }} / {{$task->start_date}} - {{$task->end_date}}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tugas Terbaru</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>Presensi</th>
                                                <th>Kelas</th>
                                                <th>Ditutup</th>
                                                <th>Pengampu</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-bold-500">Pertemuan 1</td>
                                                <td>Junior Web Developer</td>
                                                <td>13.00</td>
                                                <td class="text-bold-500">Nathan AS</td>
                                                <td><button class="btn btn-success">Absen Masuk</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="{{ Auth::user()->avatar }}" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <p class="fw-bold">Mentor</p>
                                    <h5 class="font-bold">{{ $class->mentor->name }}</h5>
                                    <h6 class="text-muted mb-0"><b></b>{{ $class->mentor->email }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Tugas Tersedia</h4>
                        </div>
                        <div class="card-content pb-4">
                            @foreach ($class->tasks as $task)
                                <div class="recent-message d-flex px-4 py-3">
                                    <a href="{{route('mentee.tasks.show', ['id' => $task->id])}}">
                                        <div class="name ms-4">
                                            <h5 class="mb-1">{{ $task->name }}</h5>
                                            <h6 class="text-muted mb-0">Pengumpulan {{ $task->end_date->diffForHumans() }}
                                            </h6>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            <div class="px-4">
                                <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Lihat Semua</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Visitors Profile</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-visitors-profile"></div>
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
@push('menteescript')
    <script>
        $(document).ready(function() {
            console.log('Ready')
        })
    </script>
@endpush
