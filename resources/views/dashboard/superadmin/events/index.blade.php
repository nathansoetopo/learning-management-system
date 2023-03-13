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
                                        <td><a href="{{route('superadmin.events.masterclass', ['id' => $event->id])}}">{{ $event->name }}</a></td>
                                        <td style="width: 30%">{{ descLimit($event->description) }}</td>
                                        <td class="text-center">{{ day($event->created_at) }}</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <a href="{{ route('superadmin.events.edit', ['id' => $event->id]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <button type="button" class="btn {{$event->status == 'active' ? 'btn-outline-success' : 'btn-outline-danger'}} status"
                                                value="{{ $event->status }}" data-id="{{$event->id}}">{{$event->status == 'active' ? 'Active' : 'Inactive'}}</button>
                                            <a href="#" class="btn btn-danger delete" data-title="{{ $event->name }}"
                                                data-id="{{ $event->id }}">Hapus</a>
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

            $(document).on('click', '.status', function() {
                var id = $(this).data('id')
                var url = '{{ url('superadmin/events') }}/' + id + '/status';

                if ($(this).val() == 'active') {
                    $(this).removeClass('btn-outline-success').addClass('btn-outline-danger').text('Inactive').val('inactive');
                } else if ($(this).val() == 'inactive') {
                    $(this).removeClass('btn-outline-danger').addClass('btn-outline-success').text('Active').val('active');
                }

                changeStatus(url)
            });

            function changeStatus(url) {
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: {
                        '_token': token,
                    },
                })
            }

            $(document).on('click', '.delete', function() {
                var title = $(this).data('title')
                var id = $(this).data('id')
                var row = $(this).parents('tr')

                Swal.fire({
                    title: 'Yakin, Hapus ' + title + ' ?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result['isConfirmed']) {
                        $.ajax({
                            type: "DELETE",
                            url: '{{ url('superadmin/events') }}/' + id + '/delete',
                            data: {
                                '_token': token,
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Status',
                                    data['msg'],
                                    data['status']
                                )
                                row.fadeOut('slow', function($row) {
                                    myTable.row(row).remove().draw();
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
                    }
                })
            })
        </script>
    @endpush
@endsection
