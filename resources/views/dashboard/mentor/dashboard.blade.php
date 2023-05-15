@extends('dashboard.mentor.app')
@section('title-mentor', 'Dashboard Mentee')
@section('content-mentor')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Profile Statistics</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <i class="fas fa-certificate"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Sertifikat Diselesaikan</h6>
                                            <h6 class="font-extrabold mb-0">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <i class="fas fa-house-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Kelas Diselesaikan</h6>
                                            <h6 class="font-extrabold mb-0">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon green mb-2">
                                                <i class="fas fa-house-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Jumlah Kelas</h6>
                                            <h6 class="font-extrabold mb-0">{{ $data->userHasClass->count() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <i class="fas fa-certificate"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Sertifikat Tersedia</h6>
                                            <h6 class="font-extrabold mb-0">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <i class="fas fa-house-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Kelas Diampu</h6>
                                            <h6 class="font-extrabold mb-0">{{ $data->mentor->count() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Kelas Diampu</h4>
                            </div>
                            <div class="card-body">
                                <div class="carousel" data-flickity='{ "lazyLoad": true}'>
                                    @foreach ($data->mentor->chunk(2) as $class_chunk)
                                        <div class="carousel-cell">
                                            <div class="row">
                                                @foreach ($class_chunk as $class)
                                                    <div class="col-md-6">
                                                        <div class="card bg-dark text-white">
                                                            <img data-flickity-lazyload="{{ $class->masterClass->image }}"
                                                                class="card-img carousel-cell-image" alt="...">
                                                            <div class="card-img-overlay overflow-auto">
                                                                <h5 class="card-title text-nowrap overflow-hidden">
                                                                    {{ $class->name }} / {{ $class->masterClass->name }}
                                                                </h5>
                                                                <p class="card-text overflow-hidden lh-1">
                                                                    {{ Str::words($class->description, 50, '...') }}</p>
                                                                <small class="card-text">Selesai :
                                                                    {{ $class->end_time->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                                <h4>Kelas Dimiliki (Sebagai Mentee)</h4>
                            </div>
                            <div class="card-body">
                                <div class="carousel" data-flickity='{ "lazyLoad": true}'>
                                    @foreach ($data->userHasClass->chunk(3) as $class_chunk)
                                        <div class="carousel-cell">
                                            <div class="row">
                                                @foreach ($class_chunk as $class)
                                                    <div class="col-md-4">
                                                        <div class="card bg-dark text-white">
                                                            <img src="{{ $class->masterClass->image }}" class="card-img"
                                                                alt="...">
                                                            <div class="card-img-overlay overflow-auto">
                                                                <h5 class="card-title text-nowrap overflow-hidden">
                                                                    {{ $class->name }} /
                                                                    {{ $class->masterClass->name }}</h5>
                                                                <p class="card-text overflow-hidden lh-1">
                                                                    {{ Str::words($class->description, 50, '...') }}
                                                                </p>
                                                                <small class="card-text">Selesai :
                                                                    {{ $class->end_time->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                                <h4>Daftar Presensi</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-lg" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Presensi</th>
                                            <th>Kelas</th>
                                            <th>Ditutup</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Content --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="{{ Auth::user()->avatar }}" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                    <h6 class="text-muted mb-0"><b>@</b>{{ Auth::user()->username }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Mentee</h4>
                        </div>
                        <div class="card-content pb-4">
                            <div class="container" id="mentee-list">
                                
                            </div>
                            <div class="px-4">
                                <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Semua
                                    Mentee</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar" class="container h-100"></div>
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
@push('mentorscript')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script>
        $(document).ready(function() {
            var task_url = '{{ route('mentor.tasks.index') }}'
            loadPresence()
            loadMentee()
            loadTasks(task_url)
        })

        function loadMentee() {
            $.ajax({
                type: "GET",
                url: '{{route('mentor.mentee-management.index')}}',
                success: function(data) {
                    console.log(data)
                    $('#mentee-list').html(data)
                },
            })
        }

        function loadPresence() {
            myTable = $('#table1').DataTable({
                paging: false,
                info: false,
                lengthChange: false,
                searching: false,
                destroy: true,
                ajax: '{{ route('mentor.presence.index') }}',
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'class'
                    },
                    {
                        data: 'closed_at',
                    }
                ],
            });
        }
    </script>
    @include('dashboard.mentee.component.calendar-script')
@endpush
