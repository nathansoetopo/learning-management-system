@extends('landing_page.app')
@section('app-content')
    <div class="container">
        <div id="gallery" class="row row-cols-md-3 mb-8 mb-md-11">
            @foreach ($data as $galery)
                <div class="col-md mb-6">
                    <!-- Image -->
                    <a class="card-hover-overlay rounded overflow-hidden d-block position-relative"
                        href="{{$galery->asset}}" data-fancybox data-width="1110" data-height="810">
                        <img src="{{$galery->asset}}" class="img-fluid rounded" alt="...">

                        <div class="center position-absolute hover-visible z-index-1">
                            <div class="mb-4 text-white">
                                <!-- Icon -->
                                <svg width="30" height="30" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.3272 10.8975H20.6028V16.5998H14.8105V19.4059H20.6028V25.1982H23.3272V19.4059H29.1113V16.5998H23.3272V10.8975Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M21.9604 0C11.9957 0 3.91267 8.07486 3.91267 18.0478C3.91267 22.4411 5.48346 26.4662 8.09327 29.5996L0.509281 37.11C-0.16976 37.789 -0.16976 38.8117 0.509281 39.4907C1.18832 40.1698 2.21097 40.1698 2.89001 39.4907L10.4413 31.9395C13.5665 34.5329 17.5753 36.0873 21.9522 36.0873C31.917 36.0873 40 28.0125 40 18.0396C40 8.06668 31.9251 0 21.9604 0ZM21.9604 32.7739C13.8283 32.7739 7.23424 26.1799 7.23424 18.0478C7.23424 9.91563 13.8283 3.32157 21.9604 3.32157C30.0926 3.32157 36.6866 9.91563 36.6866 18.0478C36.6866 26.1799 30.0926 32.7739 21.9604 32.7739Z"
                                        fill="currentColor"></path>
                                </svg>

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('app-script')
<script src="{{asset('skola/assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('skola/assets/libs/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
@endpush