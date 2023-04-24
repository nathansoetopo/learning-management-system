@extends('dashboard.mentor.app')
@section('title-mentor', 'Buat Materi')
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
                        <h4 class="card-title">Basic Inputs</h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="{{route('mentor.tasks.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basicInput">Nama Tugas</label>
                                            <input type="text" class="form-control" name="name" id="basicInput"
                                                placeholder="Masukkan Nama Materi">
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
                                            <select class="form-control" id="class" name="class_id">
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="material">Pilih Materi</label>
                                            <select class="form-control" id="material" name="master_material_id">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="start">Waktu Mulai</label>
                                            <input type="datetime-local" name="start_date" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="start">Waktu Selesai</label>
                                            <input type="datetime-local" name="end_date" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                name="closed" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Tertutup ?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Deskripsi</label>
                                            <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="Deskripsi Tugas"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success float-end mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('mentorscript')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#class').select2();
            $('#material').select2();
        })

        $('#class').on('change', function() {
            var value = $(this).val()

            var url = '{{ route('mentor.materials.list', ':classId') }}'

            url = url.replace(':classId', value);

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
        })
    </script>
@endpush
