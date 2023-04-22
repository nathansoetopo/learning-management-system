@extends('dashboard.mentor.app')
@section('title-mentor', 'Management Materi')
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
                        <h3>Daftar Materi "{{ $materials->name }}"</h3>
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
                        <a href="{{ route('mentor.materials.create', ['id' => $materials->id]) }}"
                            class="btn btn-success">Tambah Materi</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Nama Materi</th>
                                        <th>Type</th>
                                        <th>URL</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materials->sub_materials as $material)
                                        <tr>
                                            <td>{{ $material->name }}</td>
                                            <td>{{ $material->type }}</td>
                                            <td>{{ $material->asset }}</td>
                                            <td width="10%">
                                                <a href="{{ route('mentor.materials.edit', ['id' => $materials->id, 'material_id' => $material->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <button class="btn btn-danger delete" data-id="{{$material->id}}" data-title="{{$material->name}}">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->
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

    <script>
        $(document).on('click', '.delete', function() {
            var title = $(this).data('title')
            var id = $(this).data('id')
            var row = $(this).parents('tr')

            Swal.fire({
                title: 'Yakin, Hapus Materi '+title+' ?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result['isConfirmed']) {
                    $.ajax({
                        type: "DELETE",
                        url: '{{url('mentor/materials')}}/{{$materials->id}}/'+id+'/delete',
                        data: {
                            '_token': token,
                        },
                        success: function(data) {
                            Swal.fire(
                                'Status',
                                'Materi '+title+' Berhasil Dihapus',
                                'success'
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
