@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Buat Event Baru')
@push('superadminheadscript')
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
                        <h3>Ubah Galery</h3>
                        <p class="text-subtitle text-muted">Sunting nama galery, deskripsi dan thumbnail</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            {{ Breadcrumbs::render('galery.edit', $galery) }}
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sunting Galery</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('superadmin.galery.update', ['id' => $galery->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Judul Galery</label>
                                        <input type="text" name="title" class="form-control" id="basicInput" required
                                            placeholder="Masukkan judul galery" value="{{$galery->title}}" autofocus>
                                    </div>

                                    <div class="form-group with-title mb-3 mt-3">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{$galery->description}}</textarea>
                                        <label>Deskripsi Galery</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail Galery</label>
                                        <input type="file" id="thumbnail" name="asset" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumbnail">Pilih Event</label>
                                        <select name="event_id" id="event" class="form-control">
                                            <option value="">Pilih Event</option>
                                            @foreach ($events as $event)
                                                <option value="{{$event->id}}" {{$galery->event_id == $event->id ? 'selected' : ''}}>{{$event->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success float-end" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @push('superadminscript')
        <script src="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/filepond.js"></script>
    @endpush
@endsection
