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
                <div class="col-12 col-lg-9">
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
                                            <h6 class="font-extrabold mb-0">{{$data->userHasClass->count()}}</h6>
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
                                            <h6 class="font-extrabold mb-0">{{$data->mentor->count()}}</h6>
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
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($data->mentor->chunk(2) as $class_chunk)
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                <div class="row">
                                                    @foreach ($class_chunk as $class)
                                                        <div class="col-md-6">
                                                            <div class="card bg-dark text-white">
                                                                <img src="{{$class->masterClass->image}}"
                                                                    class="card-img" alt="...">
                                                                <div class="card-img-overlay overflow-auto">
                                                                    <h5 class="card-title text-nowrap overflow-hidden">{{$class->name}} / {{$class->masterClass->name}}</h5>
                                                                    <p class="card-text overflow-hidden lh-1">{{ Str::words($class->description, 50, '...') }}</p>
                                                                    <small class="card-text">Selesai : {{$class->end_time->diffForHumans()}}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach 
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
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
                                <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($data->userHasClass->chunk(2) as $class_chunk)
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                <div class="row">
                                                    @foreach ($class_chunk as $class)
                                                        <div class="col-md-6">
                                                            <div class="card bg-dark text-white">
                                                                <img src="{{$class->masterClass->image}}"
                                                                    class="card-img" alt="...">
                                                                <div class="card-img-overlay overflow-auto">
                                                                    <h5 class="card-title text-nowrap overflow-hidden">{{$class->name}} / {{$class->masterClass->name}}</h5>
                                                                    <p class="card-text overflow-hidden lh-1">{{ Str::words($class->description, 50, '...') }}</p>
                                                                    <small class="card-text">Selesai : {{$class->end_time->diffForHumans()}}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach 
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls1" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls1" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Presensi Tersedia</h4>
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
                                    <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                    <h6 class="text-muted mb-0"><b>@</b>{{ Auth::user()->username }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Messages</h4>
                        </div>
                        <div class="card-content pb-4">
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('dashboard') }}/assets/images/faces/4.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">Hank Schrader</h5>
                                    <h6 class="text-muted mb-0">@johnducky</h6>
                                </div>
                            </div>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('dashboard') }}/assets/images/faces/5.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">Dean Winchester</h5>
                                    <h6 class="text-muted mb-0">@imdean</h6>
                                </div>
                            </div>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('dashboard') }}/assets/images/faces/1.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">John Dodol</h5>
                                    <h6 class="text-muted mb-0">@dodoljohn</h6>
                                </div>
                            </div>
                            <div class="px-4">
                                <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Start
                                    Conversation</button>
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
@push('mentorscript')
    <script>
        $(document).ready(function() {
            console.log('Ready')
        })
    </script>
@endpush
