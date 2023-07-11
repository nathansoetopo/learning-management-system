@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Dashboard Superadmin')
@section('content')
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
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <i class="iconly-boldShow"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Event</h6>
                                            <h6 class="font-extrabold mb-0">{{ $event_count->event_count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Master Class</h6>
                                            <h6 class="font-extrabold mb-0">{{ $master_class_count->master_class_count }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon green mb-2">
                                                <i class="iconly-boldAdd-User"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Mentor</h6>
                                            <h6 class="font-extrabold mb-0">{{ $mentor_count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon red mb-2">
                                                <i class="iconly-boldBookmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Mentee</h6>
                                            <h6 class="font-extrabold mb-0">{{ $mentee_count }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Pemasukan</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-profile-visit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Baru Bergabung</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Master Class</th>
                                            <th>Class</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recently as $recent)
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="{{$recent->user_avatar}}">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">{{$recent->user_name}}</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">{{$recent->user_email}}</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">{{$recent->master_class_name}}</p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">{{$recent->class_name}}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                            <h4>Sertifikat Terbaru</h4>
                        </div>
                        <div class="card-content pb-4">
                            @foreach ($certificates as $certificate)
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="name ms-4">
                                        <h5 class="mb-1">{{ $certificate->certificate_number }}</h5>
                                        <h6 class="text-muted mb-0">{{ $certificate->user_count }} Mentee</h6>
                                    </div>
                                </div>
                            @endforeach
                            <div class="px-4">
                                <a href="{{ route('superadmin.certificate.index') }}"
                                    class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Pemasukan</h4>
                        </div>
                        <div class="card-body">
                            <h5>Rp {{rupiah($total_income)}}</h5>
                            {{-- <div id="chart-visitors-profile"></div> --}}
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
@push('superadminscript')
    <script>
        var month = {{ Js::from($transactions_month) }}

        console.log(month)

        var optionsProfileVisit = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled: false
            },
            chart: {
                type: 'bar',
                height: 300
            },
            fill: {
                opacity: 1
            },
            plotOptions: {},
            series: [{
                name: 'sales',
                data: {{ Js::from($transactions_values) }}
            }],
            colors: '#435ebe',
            xaxis: {
                categories: month,
            },
        }

        var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);

        chartProfileVisit.render();
    </script>
@endpush
