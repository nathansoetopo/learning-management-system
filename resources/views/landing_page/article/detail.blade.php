@extends('landing_page.app')
@section('app-content')
    <div class="container py-8 pt-lg-11">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <h1 class="text-capitalize">{{$blog->title}}</h1>

                <p class="me-xl-12">{{$blog->categories->first()->title}}</p>

                <div class="d-md-flex align-items-center">
                    <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-4">
                        <div class="p-1">
                            <img src="{{$blog->user->avatar}}" alt="..." class="rounded-circle" width="52"
                                height="52">
                        </div>
                    </div>

                    <div class="mb-4 mb-md-0">
                        <a href="#" class="d-block">
                            <h6 class="mb-0">{{$blog->user->name}}</h6>
                        </a>
                        <span class="font-size-sm">{{day($blog->created_at)}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8 sk-thumbnail img-ratio-7">
        <img src="{{$blog->image}}" alt="..." class="img-fluid">
    </div>

    <div class="container">
        <div class="row mb-8 mb-md-12">
            <div class="col-xl-8 mx-auto">
                {!! $blog->content !!}
            </div>
        </div>
    </div>
@endsection
