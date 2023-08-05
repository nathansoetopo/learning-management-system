@extends('dashboard.mentee.app')
@section('title-mentee', 'List Kelas')
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
                        <h3>Semua Kelas</h3>
                        <p class="text-subtitle text-muted">Hi, {{ Auth::user()->name }}</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            {{ Breadcrumbs::render('mentee-class') }}
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row">
                    @foreach ($classes as $class)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$class->masterClass->name}}</h4>
                                    </div>
                                    <img class="img-fluid w-100"
                                        src="{{$class->masterClass->image}}"
                                        alt="Card image cap">
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <span>{{$class->name}}</span>
                                    <a href="{{route('mentee.class.show', ['id' => $class->id])}}" class="btn btn-sm btn-light-primary">Kunjungi</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
