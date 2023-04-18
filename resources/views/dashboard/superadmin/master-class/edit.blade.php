@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Buat Event Baru')
@push('superadminheadscript')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/styles/choices.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ asset('dashboard') }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/pages/filepond.css">
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
                        <h3>Buat Master Class Baru</h3>
                        <p class="text-subtitle text-muted">Masukkan nama kelas, deskripsi dan thumbnail</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Input</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Buat Kelas</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('superadmin.master-class.update', ['id' => $masterClass->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Kelas</label>
                                        <input type="text" name="name" class="form-control" id="basicInput" required
                                            placeholder="Masukkan nama event" value="{{ $masterClass->name }}" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail Event</label>
                                        <input type="file" id="thumbnail" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-md-4">
                                    <label for="">Harga</label>
                                    <div class="form-group mt-2">
                                        <input type="number" name="price" class="form-control" min="0"
                                            value="{{ $masterClass->price ?? 0 }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Pilih Event</label>
                                    <div class="form-group mt-2">
                                        <select class="choices form-select" name="event_id">
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}"
                                                    {{ $event->id == $masterClass->event_id ? 'selected' : '' }}>
                                                    {{ $event->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check form-switch mt-4">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                            name="dashboard" {{ $masterClass->active_dashboard ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Gunakan
                                            Dashboard?</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success float-end" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
            {{-- Materi --}}
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Buat Materi</h4>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Materi</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <button class="btn btn-success float-end mt-3" id="materi" data-bs-toggle="modal"
                            data-bs-target="#inlineForm" type="button">Tambah Materi</button>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Modal Create --}}
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Materi</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" id="createmateri">
                    <div class="modal-body">
                        <label>Nama Materi: </label>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Masukkan nama kompotensi"
                                class="form-control" required>
                        </div>
                        <label>Deskripsi Materi: </label>
                        <div class="form-group">
                            <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Deskripsi Materi"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" form="createmateri" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Create --}}

    {{-- Modal Edit --}}
    <div class="modal fade text-left" id="formeditmateri" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel34" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Materi</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" id="updatemateri">
                    <div class="modal-body">
                        <label>Nama Materi: </label>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Masukkan nama kompotensi"
                                class="form-control" required>
                        </div>
                        <label>Deskripsi Materi: </label>
                        <div class="form-group">
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                                placeholder="Deskripsi Materi" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" form="updatemateri" class="btn btn-warning ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    @push('superadminscript')
        <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
        <script src="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/form-element-select.js"></script>
        <script>
            var token = $('meta[name=csrf-token]').attr('content')
            var myTable
            var materialId = null

            $(document).ready(function() {
                myTable = $('#table1').DataTable({
                    destroy: true,
                    ajax: '{{ route('superadmin.materials.index') }}',
                    columns: [{
                            data: 'name'
                        },
                        {
                            data: 'description'
                        },
                        {
                            data: 'id',
                            render: function(data, type, row) {
                                return '<button type="button" id="editmateri" class="btn btn-outline-warning m-1" data-id=' +
                                    data + '>Edit</button>' +
                                    '<button type="button" class="btn btn-outline-danger delete status m-1" data-id=' +
                                    data + ' data-title="Materi Kelas">Hapus</button>'
                            }
                        },
                    ],
                });
            })

            $(document).on('submit', '#createmateri', function(e) {
                e.preventDefault();

                var value = $('#createmateri').serialize();

                $.ajax({
                    type: "POST",
                    url: '{{ route('superadmin.materials.create') }}',
                    data: {
                        '_token': token,
                        'form': value,
                        'master_class_id': "{{ $masterClass->id }}"
                    },
                    success: function(data) {
                        myTable.ajax.reload();
                    }
                })
            })

            $(document).on('click', '#editmateri', function() {
                materialId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('superadmin.materials.show') }}',
                    data: {
                        'id': materialId
                    },
                    success: function(data) {
                        $('input[name=name]').val(data.name);
                        $('#description').text(data.description);
                        $('#formeditmateri').modal('show')
                    }
                })
            })

            $(document).on('submit', '#updatemateri', function(e) {
                e.preventDefault();

                var editValue = $('#updatemateri').serialize();

                update(editValue)
            })

            function update(editValue) {
                $.ajax({
                    type: 'PUT',
                    url: '{{ url('superadmin/materials') }}/' + materialId + '/update',
                    data: {
                        '_token': token,
                        'form': editValue
                    },
                    success: function(data) {
                        materialId = null
                        myTable.ajax.reload();
                    }
                })
            }

            $(document).on('click', '.delete', function() {
                var id = $(this).data('id')
                var row = $(this).parents('tr')

                deleteMateri(id, row)
            })

            function deleteMateri(id, row) {
                Swal.fire({
                    title: 'Yakin, Hapus Materi Ini ?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result['isConfirmed']) {
                        $.ajax({
                            type: "DELETE",
                            url: '{{ url('superadmin/materials') }}/' + id + '/delete',
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
            }
        </script>
    @endpush
@endsection
