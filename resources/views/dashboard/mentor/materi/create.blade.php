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
                            <form action="{{route('mentor.materials.store', ['id' => $id, 'classId' => $classId])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basicInput">Nama Materi</label>
                                            <input type="text" class="form-control" name="name" id="basicInput"
                                                placeholder="Masukkan Nama Materi">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="helpInputTop">Pembuat Materi</label>
                                            <small class="text-muted">Nama Mentor</small>
                                            <input type="text" disabled value="{{ Auth::user()->name }}"
                                                class="form-control" id="helpInputTop">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="helperText">Upload Materi (pdf, doc, jpg, jpeg, png, zip)</label>
                                            <input type="file" name="asset" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">URL (Optional)</label>
                                        <input type="url" name="url" class="form-control">
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
