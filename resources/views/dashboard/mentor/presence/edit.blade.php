@extends('dashboard.mentor.app')
@section('title-mentor', 'Edit Presensi')
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
                        <h3>Edit Presensi</h3>
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
                        <h4 class="card-title">Ubah Data Presensi</h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="{{route('mentor.presence.update', ['id' => $data->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nama Presensi</label>
                                            <input type="text" name="name" value="{{$data->name}}" id="name" required
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="class">Pilih Kelas</label>
                                        <input type="hidden" name="class_id" value="{{$data->class_id}}">
                                        <select class="form-control" id="class" disabled>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" {{$class->id == $data->class_id ? 'selected' : ''}}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="class">Masukkan Durasi <small class="text-danger">(Max 24 Jam)</small></label>
                                        <input type="hidden" name="old_duration" value="{{$data->duration}}">
                                        <input type="number" name="duration" class="form-control" min="1" value="{{$data->duration}}" max="24" placeholder="Masukkan Durasi Dalam Jam">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="open_clock">Jam Buka</label>
                                        <input type="datetime-local" value="{{$data->open_clock}}" name="open_clock" id="open_clock" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="closed_clock">Jam Tutup</label>
                                        <input type="datetime-local" name="closed_clock" value="{{$data->closed_clock}}" id="closed_clock"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-3 float-end">Simpan</button>
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
        })
    </script>
@endpush
