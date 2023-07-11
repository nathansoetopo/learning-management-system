@extends('dashboard.mentor.app')
@section('title-mentor', 'Edit Materi')
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
                        <h3>Buat Materi</h3>
                        <p class="text-subtitle text-muted">Give textual form controls like input upgrade with
                            custom styles,
                            sizing, focus states, and more.</p>
                    </div>
                    @include('dashboard.mentor.component.breadcumb')
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Inputs</h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="{{route('mentor.tasks.update', ['id' => $task->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basicInput">Nama Tugas</label>
                                            <input type="text" class="form-control" name="name" id="basicInput"
                                                placeholder="Masukkan Nama Materi" value="{{ $task->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="helpInputTop">Pembuat Tugas</label>
                                            <small class="text-muted">Nama Mentor</small>
                                            <input type="text" disabled value="{{ Auth::user()->name }}"
                                                class="form-control" id="helpInputTop">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="class">Pilih Kelas</label>
                                            <select class="form-control" id="class" name="class_id" disabled>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $class->id == $task->class_id ? 'selected' : '' }}>
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="material">Pilih Materi</label>
                                            <select class="form-control" id="material" name="master_material_id" disabled>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="start">Waktu Mulai</label>
                                            <input type="datetime-local" name="start_date" value="{{ $task->start_date }}"
                                                required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="start">Waktu Selesai</label>
                                            <input type="datetime-local" name="end_date" value="{{ $task->end_date }}"
                                                required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                name="closed" {{ $task->closed ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Tertutup ?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Deskripsi</label>
                                            <textarea name="description" class="form-control" id="" cols="30" rows="10"
                                                placeholder="Deskripsi Tugas">{{ $task->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success float-end mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Buat Materi</h4>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Asset</th>
                                    <th>Tipe</th>
                                    <th>URL</th>
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
                    <h4 class="modal-title" id="myModalLabel33">Tambah Asset Soal</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{route('mentor.tasks.store.asset', ['id' => $task->id])}}" method="POST" id="createmateri" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label>Nama Asset: </label>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Masukkan nama kompotensi"
                                class="form-control" required>
                        </div>
                        <label>Asset Soal: </label>
                        <div class="form-group">
                            <input type="file" name="asset" class="form-control">
                            <input type="url" name="url" placeholder="Isi dengan url" class="form-control mt-3">
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
@endsection
@push('mentorscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        $(document).ready(function() {
            $('#class').select2();
            $('#material').select2();

            var url = '{{ route('mentor.materials.list', ['classId' => $task->class_id]) }}'

            getMaterial(url)

            myTable = $('#table1').DataTable({
                destroy: true,
                ajax: '{{ route('mentor.tasks.asset', ['id' => $task->id]) }}',
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'url',
                        render: function(data, type, row) {
                            return '<a href=' + data + '>' + data + '</a>'
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return '<button class="btn btn-danger delete" data-id=' + data +
                                '>Hapus</button>'
                        }
                    }
                ],
            });
        })

        $('#class').on('change', function() {
            var value = $(this).val()

            var url = '{{ route('mentor.materials.list', ':classId') }}'

            url = url.replace(':classId', value);

            getMaterial(url)
        })

        $(document).on('click', '.delete', function(){
            var asset = $(this).data('id')
            var urlDelAsset = '{{route('mentor.tasks.delete.asset', ['asset_id' => ':assetId'])}}';
            urlDelAsset = urlDelAsset.replace(':assetId', asset);
            deleteAsset(urlDelAsset);
        })

        function deleteAsset(urlDelAsset) {
            Swal.fire({
                title: 'Yakin, Hapus Asset Tugas Ini ?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result['isConfirmed']) {
                    $.ajax({
                        type: "DELETE",
                        url: urlDelAsset,
                        data: {
                            '_token': token,
                        },
                        success: function(data) {
                            Swal.fire(
                                'Status',
                                data['msg'],
                                data['status']
                            )
                            myTable.ajax.reload();
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

        function getMaterial(url) {
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $.each(response, function(i, master) {
                        $('#material').append($('<option>', {
                            value: master.id,
                            text: master.name
                        }));
                    });
                },
            })
        }
    </script>
@endpush
