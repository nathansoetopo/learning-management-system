@extends('dashboard.mentor.app')
@section('title-mentor', 'Absensi')
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
                        <h3>Semua Absensi</h3>
                        <p class="text-subtitle text-muted">Pilih absensi untuk mengelola</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            {{ Breadcrumbs::render('mentor-presence') }}
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('mentor.presence.create')}}" class="btn btn-success ms-0 mt-0 m-3">Buat Absensi</a>
                        <div class="detail-track">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Presensi</th>
                                            <th>Kelas</th>
                                            <th>Dibuka</th>
                                            <th>Ditutup</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presences as $presence)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><a href="{{route('mentor.presence.detail', ['id' => $presence->id])}}">{{$presence->name}}</a></td>
                                                <td>{{$presence->class->name}}</td>
                                                <td>{{$presence->open_clock}}</td>
                                                <td>{{$presence->closed_clock}}</td>
                                                <td>
                                                    <a class="btn btn-warning" href="{{route('mentor.presence.edit', ['id' => $presence->id])}}">Edit</a>
                                                    <button class="btn btn-danger delete" data-title="{{$presence->name}}" data-id="{{$presence->id}}">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@push('mentorscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        var myTable = $('#table1').DataTable();
    </script>

    @include('dashboard.superadmin.component.script.delete')
@endpush
