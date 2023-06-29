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
                        <h3>Kelola Event {{ getEventName($event_id ?? null) }}</h3>
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
                        <a href="{{ route('superadmin.master-class.create', ['event_id' => $event_id]) }}" class="btn btn-primary">Master Class Baru</a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Master Class</th>
                                    <th>Event</th>
                                    <th>Dashboard</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterClasses as $masterClass)
                                    <tr>
                                        <td><a href="{{route('superadmin.class.index', ['id' => $masterClass->id])}}">{{ $masterClass->name }}</a></td>
                                        <td><a href="{{route('superadmin.master-class.index', ['id' => $masterClass->event->id])}}">{{ $masterClass->event->name }}</a></td>
                                        <td>{{ day($masterClass->created_at) }}</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="{{route('superadmin.master-class.edit', ['id' => $masterClass->id])}}" class="btn btn-warning">Edit</a>
                                            <button type="button"
                                                class="btn {{ $masterClass->status == 'active' ? 'btn-outline-success' : 'btn-outline-danger' }} status"
                                                value="{{ $masterClass->status }}"
                                                data-id="{{ $masterClass->id }}">{{ $masterClass->status == 'active' ? 'Active' : 'Inactive' }}</button>
                                            <a href="#" class="btn btn-danger delete"
                                                data-title="{{ $masterClass->name }}"
                                                data-id="{{ $masterClass->id }}">Hapus</a>
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
