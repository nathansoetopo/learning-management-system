@extends('dashboard.mentee.app')
@section('title-mentee', 'Pengumpulan Tugas')
@push('menteeheadscript')
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
@endpush
@section('content-mentee')
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
                        <h3>{{ $task->name }}</h3>
                        <p class="text-subtitle text-muted">{{ $task->has_class->name }}</p>
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
                        <h4 class="card-title">Hi, {{ Auth::user()->name }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="fw-bold">Pengumpulan</p>
                        {{$task->end_date}}
                        <p class="fw-bold mt-3">Detail Tugas</p>
                        <h6>{{ $task->description }}</h6>
                        <div class="p-3">
                            <p>File</p>
                            @foreach ($task->assets as $asset)
                                <a href="{{ $asset->url }}" class="text-primary fw-bold">
                                    <h5><i class="bi bi-book"></i>&nbsp;&nbsp;&nbsp;{{ $asset->name }}</i></h5>
                                </a>
                            @endforeach
                        </div>
                        <div class="container-fluid mt-5">
                            <input id="input-id" type="file" class="file" data-browse-on-zone-click="true"
                                data-allowed-file-extensions='["zip", "jpg", "jpeg", "pdf", "docx", "doc"]'
                                data-max-file-size=2000 data-show-upload="false" data-msg-placeholder="Upload Tugas">
                            <button class="btn btn-block btn-success mt-4">Submit</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('menteescript')
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js"
        type="text/javascript"></script>
    <!-- the main fileinput plugin script JS file -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fa5`). Uncomment if needed. -->
    <!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/themes/fa5/theme.min.js"></script -->

    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/LANG.js"></script>

    <script>
        $(document).ready(function() {
            $("#input-id").fileinput();
        })
    </script>
@endpush
