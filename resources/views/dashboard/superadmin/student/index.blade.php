@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Kelola Event')
@push('superadminheadscript')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/styles/choices.css">
@endpush
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 p-2 border">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Bergabung</th>
                                            <th>Gender</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td><a href="#">{{ $student->name }}</a></td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ day($student->userHasClass->first()->pivot->created_at) }}</td>
                                                <td>{{ $student->gender }}</td>
                                                <td>
                                                    <button type="button" class="btn {{ $student->userHasClass->first()->pivot->status == 'active' ? 'btn-outline-success' : 'btn-outline-danger' }} status"
                                                        value="{{ $student->userHasClass->first()->pivot->status }}"
                                                        data-id="{{ $student->id }}">{{ $student->userHasClass->first()->pivot->status == 'active' ? 'Active' : 'Inactive' }}</button>
                                                    <a href="#" class="btn btn-danger delete"
                                                        data-title="{{ $student->name }}"
                                                        data-id="{{ $student->id }}">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="container-fluid">
                                    <form action="#" method="POST" id="edit">
                                        <div class="form-group">
                                            <label for="">Mentor Kelas</label>
                                            <select name="mentor" class="choices form-select" required>
                                                @foreach ($mentors as $mentor)
                                                    <option value="{{ $mentor->id }}"
                                                        {{ $mentor->id == $class->responsible_id ? 'selected' : '' }}>
                                                        {{ $mentor->name }} / {{ $mentor->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">Tambah Mentee</label>
                                            <select name="mentee[]" class="choices form-select" multiple="multiple">
                                                <option value="">Tambah Mentee</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} /
                                                        {{ $user->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-outline-success float-end" type="submit">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    <script src="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/form-element-select.js"></script>

    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        var myTable = $('#table1').DataTable();

        $(document).on('submit', '#edit', function(e) {
            e.preventDefault()

            $.ajax({
                type: "POST",
                url: '{{ route('superadmin.students.store') }}',
                data: {
                    '_token': token,
                    'data': $('#edit').serialize()
                },
                success: function(data) {
                    $.each(data, function(i, val) {
                        console.log(data[i].name)
                        var button = '<button type="button" class="btn btn-outline-success status">active</button>'
                        button += '<a href="#" class="btn btn-danger delete">Hapus</a>'
                        myTable.row.add([
                            data[i].name,
                            data[i].email,
                            data[i].date,
                            data[i].gender,
                            button
                        ]).draw()
                    });
                },
                errors: function() {
                    Swal.fire(
                        'Whoops !',
                        'Kesalahan Sistem',
                        'error'
                    )
                }
            })

            // myTable.rows.add([
            //     {
            //         name : '1',
            //         email: '1',
            //         date: '1',
            //         gender: '1',
            //         action: '1'
            //     },
            //     {
            //         name : '1',
            //         email: '1',
            //         date: '1',
            //         gender: '1',
            //         action: '1'
            //     },
            // ]).draw()
        })
    </script>

    @include('dashboard.superadmin.component.script.delete')
    @include('dashboard.superadmin.component.script.status')
@endpush
