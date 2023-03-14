@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Kelola Event')
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
                        <h3>Kelola Kelas</h3>
                        <p class="text-subtitle text-muted">Buat, Edit dan Hapus Master Class</p>
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
                    <div class="card-header">
                        <a href="{{ route('superadmin.class.create') }}" class="btn btn-primary">Kelas Baru</a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Kelas</th>
                                    <th>Nama Master Kelas</th>
                                    <th>Event</th>
                                    <th>Dibuat</th>
                                    <th>Mentor</th>
                                    <th>Kapasitas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $class)
                                    <tr>
                                        <td><a href="{{route('superadmin.students.index', ['class_id' => $class->id])}}">{{ $class->name }}</a></td>
                                        <td>{{ $class->masterClass->name }}</td>
                                        <td>{{ $class->masterClass->event->name }}</td>
                                        <td>{{ day($class->created_at) }}</td>
                                        <td>{{$class->mentor->name}}</td>
                                        <td>{{$class->capacity}}</td>
                                        <td>
                                            <a href="{{route('superadmin.class.edit', ['id' => $class->id])}}" class="btn btn-warning">Edit</a>
                                            <button type="button"
                                                class="btn {{ $class->status == 'active' ? 'btn-outline-success' : 'btn-outline-danger' }} status"
                                                value="{{ $class->status }}"
                                                data-id="{{ $class->id }}">{{ $class->status == 'active' ? 'Active' : 'Inactive' }}</button>
                                            <a href="#" class="btn btn-danger delete"
                                                data-title="{{ $class->name }}"
                                                data-id="{{ $class->id }}">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->
        </div>
    </div>
@endsection
@push('superadminscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        var myTable = $('#table1').DataTable();
    </script>

    @include('dashboard.superadmin.component.script.delete')
    @include('dashboard.superadmin.component.script.status')
@endpush
