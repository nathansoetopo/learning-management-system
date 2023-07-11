@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Affiliasi')
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
                        <h3>Daftar {{ $role }}</h3>
                        <p class="text-subtitle text-muted">Pilih {{ $role }} untuk detail</p>
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
                        <div class="detail-track">
                            @if ($role == 'superadmin')
                                <a href="{{ route('superadmin.manage.users.create', ['role_name' => 'superadmin']) }}"
                                    class="btn btn-success mb-4">Tambah Superadmin</a>
                            @elseif ($role == 'mentor')
                                <button class="btn btn-success mb-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#backdrop">Tambah Mentor</button>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="table1">
                                    <thead>
                                        <tr>
                                            {{-- <th>No</th> --}}
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->gender }}</td>
                                                <td>{{ day($user->created_at) }}</td>
                                                <td>
                                                    <button
                                                        class="btn {{ $user->status == 'active' ? 'btn-outline-success' : 'btn-outline-danger' }} status"
                                                        value="{{ $user->status }}"
                                                        data-id="{{ $user->id }}">{{ $user->status == 'active' ? 'Active' : 'Inactive' }}</button>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
        data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Pilih Mentor</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select name="user_id[]" id="select_mentor" class="form-control" style="width: 100%"
                            placeholder="pilih mentor" multiple="multiple">
                            {{-- Content --}}
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block" id="btn_save_mentor">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('superadminscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        var myTable = $('#table1').DataTable();

        $(document).ready(function() {
            getUsers()
            $('#select_mentor').select2();
            getUsersForm();
        })

        $('#btn_save_mentor').on('click', function() {
            var user_id = $('#select_mentor').val()

            $.ajax({
                type: "POST",
                url: '{{ route('superadmin.manage.user.attach', ['role_name' => 'mentor']) }}',
                data: {
                    'user_id': user_id,
                    '_token': token
                },
                success: function(response) {
                    myTable.ajax.reload();
                },
            })
        })

        function getUsers() {
            myTable = $('#table1').DataTable({
                destroy: true,
                ajax: '{{ route('superadmin.manage.users', ['role_name' => $role]) }}',
                columns: [
                    {
                        data: 'name'
                    },
                    {
                        data: 'email',
                        render: function(data, type, row){
                            return '<a href="{{url('superadmin/manage/users')}}/'+data+'/activity">'+data+'</a>'
                        }
                    },
                    {
                        data: 'username',
                    },
                    {
                        data: 'gender',
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'adjust',
                        render: function(data, type, row) {
                            if(data.status == 'active'){
                                var btn = '<button class="btn btn-outline-success status" value="'+data.status+'" data-id="'+data.id_user+'">Active</button>'
                            }else{
                                var btn = '<button class="btn btn-outline-danger status" value="'+data.status+'" data-id="'+data.id_user+'">Inactive</button>'
                            }

                            return btn;
                        }
                    }
                ],
            });
        }

        function getUsersForm() {
            $.ajax({
                type: "GET",
                url: '{{ route('superadmin.manage.users', ['role_name' => 'user']) }}',
                success: function(response) {
                    $.each(response.data, function(i, mentor) {
                        $('#select_mentor').append($('<option>', {
                            value: mentor.id,
                            text: mentor.name + '/' + mentor.email
                        }));
                    });
                },
            })
        }
    </script>
    @include('dashboard.superadmin.component.script.status')
@endpush
