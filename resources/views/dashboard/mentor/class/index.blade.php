@extends('dashboard.mentor.app')
@section('title-mentor', 'Daftar Kelas')
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
                        <h3>Daftar Kelas Diampu</h3>
                        <p class="text-subtitle text-muted">Pilih atau cari kelas yang anda ampu</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Layout Default</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cari Kelas</h4>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder=""
                                aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="btn btn-primary" type="button" id="button-addon1">cari</button>
                        </div>
                        <div class="container mt-5">
                            <div class="row">
                                @foreach ($classes as $class)
                                    <div class="col-md-4">
                                        <a href="{{route('mentor.class.show', ['id' => $class->id])}}">
                                            <div class="card mb-3 border border-primary" style="max-width: 540px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4 p-2 d-flex align-items-center justify-content-center">
                                                        <img src="{{$class->masterClass->image}}"
                                                            width="100%" height="100%" class="img-fluid rounded-start"
                                                            alt="{{$class->masterClass->slug}}">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-nowrap text-truncate">{{$class->name}}</h5>
                                                            <p class="card-text text-nowrap text-truncate">{{$class->masterClass->name}}</p>
                                                            <p class="card-text"><small class="text-muted">{{$class->mentee_count}} peserta</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
