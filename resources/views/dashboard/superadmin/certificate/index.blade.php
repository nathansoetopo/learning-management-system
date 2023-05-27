@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Sertifikat')
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
                        <h3>Daftar Sertifikat</h3>
                        <p class="text-subtitle text-muted">Menampilkan data sertifikat</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">DataTable Jquery</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('superadmin.certificate.create')}}" class="btn btn-success mb-3 mt-2">Buat Sertifikat</a>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        {{-- <th>Kelas</th>
                                        <th>Master Kelas</th> --}}
                                        <th>Kode Sertifikat</th>
                                        <th>Tanggal Sertifikat</th>
                                        <th>Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($certificates as $certificate)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$certificate->certificate_number}}</td>
                                            <td>{{$certificate->realese_date}}</td>
                                            <td>{{$certificate->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@push('superadminscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <script>
        $('#table1').DataTable();
    </script>
@endpush
