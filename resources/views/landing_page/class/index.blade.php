@extends('landing_page.app')
@section('app-content')
    <div class="container pt-4 pb-4 pb-xl-7">
        <div class="row row-cols-md-2 row-cols-lg-3 mb-4">
            @foreach ($classes as $class)
                <div class="col-md mb-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="./event-single.html"
                                class="card-img d-block sk-thumbnail img-ratio-3 card-hover-overlay"><img
                                    class="rounded shadow-light-lg img-fluid" src="{{$class->masterClass->image}}"
                                    alt="..."></a>
                            <a href="./event-single.html"
                                class="text-underline text-white card-text-overlay position-absolute h5 mb-0 center">{{$class->name}}</a>
                            <a href="./event-single.html"
                                class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                <span class="text-white fw-normal font-size-sm">{{day($class->start_time)}}</span>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-2 pt-4">
                            <!-- Heading -->
                            <a href="./event-single.html" class="d-block">
                                <h5 class="line-clamp-2 h-48 h-lg-52 mb-2">{{$class->masterClass->name}}</h5>
                            </a>

                            <ul class="nav mx-n3 d-block d-md-flex">
                                <li class="nav-item px-3 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2 d-flex text-secondary icon-uxs">
                                            <!-- Icon -->
                                            <i class="far fa-calendar-times"></i>

                                        </div>
                                        <div class="font-size-sm">{{day($class->end_time)}}</div>
                                    </div>
                                </li>
                                <li class="nav-item px-3 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <div class="font-size-sm ms-3">{{$class->masterClass->event->name}}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
