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
                            {{ Breadcrumbs::render('certificate') }}
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('superadmin.certificate.create') }}" class="btn btn-success mb-3 mt-2">Buat
                            Sertifikat</a>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="table1">
                                <thead>
                                    <tr>
                                        <th>Kode Sertifikat</th>
                                        <th>Tanggal Sertifikat</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($certificates as $certificate)
                                        <tr>
                                            <td>{{$certificate->certificate_number}}</td>
                                            <td>{{$certificate->realese_date}}</td>
                                            <td>{{$certificate->created_at}}</td>
                                            <td>
                                                <a class="btn btn-warning" href="{{route('superadmin.certificate.edit', ['id' => $certificate->id])}}">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
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
        var myTable;
        var token = $('meta[name=csrf-token]').attr('content')

        $(document).ready(function() {
            getCertificate()
        })

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id')

            Swal.fire({
                title: 'Yakin, Hapus Sertifikat Ini',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result['isConfirmed']) {
                    deleteCertificate(id)
                }
            })
        })

        function deleteCertificate(id) {
            $.ajax({
                type: "DELETE",
                url: '{{url('superadmin/certificate')}}/'+id+'/delete',
                data: {
                    '_token': token,
                },
                success: function(data) {
                    console.log(data)
                    myTable.ajax.reload();
                    Swal.fire(
                        'Status !',
                        'Sertifikat Berhasil Dihapus',
                        'success'
                    )
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

        function getCertificate() {
            myTable = $('#table1').DataTable({
                destroy: true,
                ajax: '{{ route('superadmin.certificate.index') }}',
                columns: [{
                        data: 'certificate_number'
                    },
                    {
                        data: 'realese_date'
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'id',
                        render: function(data, type) {
                            return '<a class="btn btn-warning" href="{{ url('superadmin/certificate') }}/' +
                                data + '/edit">Edit</a>' +
                                '<button class="btn btn-danger ms-2 delete" data-id=' + data +
                                ' type="button">Hapus</button>'
                        }
                    }
                ],
            });
        }
    </script>
@endpush
