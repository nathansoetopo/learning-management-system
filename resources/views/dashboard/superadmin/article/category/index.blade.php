@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Kelola Blog')
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
                        <h3>Kelola Blog</h3>
                        <p class="text-subtitle text-muted">Buat, Edit dan Hapus Kategori Blog</p>
                    </div>
                    @include('dashboard.mentor.component.breadcumb')
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createModal">Tambah Kategori</a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <button class="btn btn-warning text-white">Edit</button>
                                            <button class="btn btn-danger text-white">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <!-- Basic Tables end -->
        </div>
    </div>
    {{-- Modal Create --}}
    <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="#" method="POST" id="create_form">
                            <input type="text" name="name" id="name" placeholder="Masukkan Nama Kategori"
                                required class="form-control">
                            <button class="btn btn-success float-end mt-3" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Create --}}
    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="#" method="POST" id="edit_form">
                            <input type="text" name="name" id="name_edit" placeholder="Masukkan Nama Kategori"
                                required class="form-control">
                            <button class="btn btn-success float-end mt-3" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    @push('superadminscript')
        <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

        <script>
            var token = $('meta[name=csrf-token]').attr('content')
            var id = 0;

            $(document).ready(function() {
                myTable = $('#table1').DataTable({
                    destroy: true,
                    ajax: '{{ route('superadmin.blog.category.index') }}',
                    columns: [{
                            data: 'title'
                        },
                        {
                            data: 'created_at'
                        },
                        {
                            data: 'id',
                            render: function(data, type, row) {
                                return '<button class="btn btn-warning text-white" data-id="' + data +
                                    '" id="edit">Edit</button>' +
                                    '<button class="btn btn-danger text-white ms-3" data-id="' + data +
                                    '" id="delete">Hapus</button>'
                            }
                        }
                    ],
                });
            })

            $('#create_form').on('submit', function(e) {
                e.preventDefault();

                var data = $('#name').val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('superadmin.blog.category.create') }}',
                    data: {
                        '_token': token,
                        'title': data
                    },
                    success: function(data) {
                        $('#name').val('');
                        $('#createModal').modal('hide')
                        myTable.ajax.reload();
                    }
                })
            })

            $('#edit_form').on('submit', function(e) {
                e.preventDefault();
                var data = $('#name_edit').val();

                $.ajax({
                    type: 'POST',
                    url: '{{ url('superadmin/blog/category') }}/' + id + '/edit',
                    data: {
                        '_token': token,
                        '_method': 'PUT',
                        'title': data
                    },
                    success: function(data) {
                        console.log(data)
                        $('#name_edit').val('');
                        $('#editModal').modal('hide')
                        myTable.ajax.reload();
                    }
                })
            })

            $(document).on('click', '#edit', function() {
                id = $(this).data('id')

                $.ajax({
                    type: 'GET',
                    url: '{{ url('superadmin/blog/category') }}/' + id + '/edit',
                    success: function(data) {
                        $('#name_edit').val(data.title);
                        $('#editModal').modal('show')
                    }
                })
            })

            $(document).on('click', '#delete', function() {
                deleteCategory($(this).data('id'))
            })

            function deleteCategory(req) {
                Swal.fire({
                    title: 'Yakin, Hapus Kategori Ini ?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result['isConfirmed']) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ url('superadmin/blog/category') }}/' + req + '/delete',
                            data:{
                                '_token': token
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Status',
                                    'Berhasil Dihapus',
                                    'success'
                                )
                                myTable.ajax.reload();
                            }
                        })
                    }
                })
            }
        </script>
    @endpush
@endsection
