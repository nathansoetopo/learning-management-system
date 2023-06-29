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
                        <h3>Kelola Events</h3>
                        <p class="text-subtitle text-muted">Buat, Edit dan Hapus Event</p>
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
                        <a href="{{ route('superadmin.events.create') }}" class="btn btn-primary">Buat Event Baru</a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Events</th>
                                    <th>Deskripsi</th>
                                    <th>Dibuat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td><a href="{{ route('superadmin.master-class.index', ['id' => $event->id]) }}">{{ $event->name }}</a>
                                        </td>
                                        <td style="width: 30%">{{ descLimit($event->description) }}</td>
                                        <td class="text-center">{{ day($event->created_at) }}</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="{{ route('superadmin.events.edit', ['id' => $event->id]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <button type="button"
                                                class="btn {{ $event->status == 'active' ? 'btn-outline-success' : 'btn-outline-danger' }} status"
                                                value="{{ $event->status }}"
                                                data-id="{{ $event->id }}">{{ $event->status == 'active' ? 'Active' : 'Inactive' }}</button>
                                            <a href="#" class="btn btn-danger delete"
                                                data-title="{{ $event->name }}" data-id="{{ $event->id }}">Hapus</a>
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
@endsection
