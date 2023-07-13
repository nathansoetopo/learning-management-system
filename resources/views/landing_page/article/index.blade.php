@extends('landing_page.app')
@section('app-content')
    <div class="container mb-11">
        <div class="row">
            <div class="col-md-7 col-lg-8 mb-5 mb-md-0">
                <div class="row row-cols-md-2" id="card_blog">
                    @foreach ($blogs as $blog)
                        <div class="col-md">
                            <!-- Blog Post -->
                            <div class="card">
                                <!-- Imgae -->
                                <div class="card-zoom">
                                    <a href="{{ route('landing-page.blog.show', ['id' => $blog->id]) }}"
                                        class="card-img d-block sk-thumbnail img-ratio-6 rounded">
                                        <img src="{{ $blog->image }}" alt="..." class="rounded img-fluid">
                                    </a>
                                </div>

                                <!-- Footer -->
                                <div class="card-footer py-4 px-0">
                                    <a href="{{ route('landing-page.blog.show', ['id' => $blog->id]) }}"
                                        class="d-inline-block">
                                        <h5 class="text-blue">{{ $blog->categories->first()->title }}</h5>
                                    </a>

                                    <a href="{{ route('landing-page.blog.show', ['id' => $blog->id]) }}" class="d-block">
                                        <h3 class="">{{ $blog->title }}</h3>
                                    </a>

                                    <ul class="nav mx-n3 mb-3">
                                        <li class="nav-item px-3">
                                            <a href="{{ route('landing-page.blog.show', ['id' => $blog->id]) }}"
                                                class="d-flex align-items-center">
                                                <div class="me-3 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="15" height="15" viewBox="0 0 15 15"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z"
                                                            fill="currentColor" />
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm text-gray-800">{{ day($blog->created_at) }}</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <button class="btn btn-outline-primary mw-300p d-flex mx-auto read-more"
                        value="{{ $blogs->nextPageUrl() }}" role="button" aria-expanded="false"
                        {{ $blogs->nextPageUrl() == null ? 'disabled' : '' }}>
                        <span class="d-inline-flex mx-auto align-items-center more">
                            <span class="ms-2">Lebih Banyak</span>
                        </span>
                    </button>
                </div>

                <!-- PAGINATION
                        ================================================== -->
                {{-- <nav class="mt-8" aria-label="Page navigationa">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav> --}}

            </div>

            <div class="col-md-5 col-lg-4">
                <!-- BLOG SIDEBAR
                        ================================================== -->
                <div class="">
                    <div class="border rounded mb-6">
                        <div class="input-group">
                            <input class="form-control form-control-sm border-0 pe-0" id="input_search" type="search"
                                placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sm my-2 my-sm-0 text-secondary icon-uxs" id="search"
                                    type="button">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z"
                                            fill="currentColor" />
                                        <path
                                            d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded mb-6 p-5 py-md-6 ps-md-6 pe-md-4">
                        <h4 class="mb-5">Category</h4>
                        <div class="nav flex-column nav-vertical">
                            @foreach ($categories as $category)
                                <a href="#" id="category" data-id="{{ $category->id }}"
                                    class="nav-link py-2">{{ $category->title }}
                                    ({{ $category->articles_count }})
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="border rounded mb-6 p-5 py-md-6 ps-md-6 pe-md-4">
                        <h4 class="mb-5">Recent Posts</h4>
                        <ul class="list-unstyled mb-0">
                            @foreach ($blogs as $blog)
                                <li class="media mb-6 d-flex">
                                    <a href="{{ route('landing-page.blog.show', ['id' => $blog->id]) }}" class="mw-70p d-block me-5">
                                        <img src="{{$blog->image}}" alt="..."
                                            class="avatar-img rounded-lg h-70p o-f-c">
                                    </a>
                                    <div class="media-body flex-shrink-1">
                                        <a href="{{ route('landing-page.blog.show', ['id' => $blog->id]) }}" class="d-block">
                                            <h6 class="line-clamp-2 mb-1 fw-normal">{{$blog->title}}</h6>
                                        </a>
                                        <span>{{day($blog->created_at)}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- <div class="border rounded mb-6 p-5 py-md-6 ps-md-6 pe-md-4">
                        <h4 class="mb-5">Tags</h4>
                        <a href="./blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Course</a>
                        <a href="./blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Timeline</a>
                        <a href="./blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Moodle</a>
                        <a href="./blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Best</a>
                        <a href="./blog-grid-v2.html"
                            class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Info</a>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
@endsection
@push('app-script')
    <script>
        var title = ''
        var category_id = ''

        $('#search').on('click', function() {
            title = $('#input_search').val()

            searchArticle()
        })

        $(document).on('click', '#category', function() {
            category_id = $(this).data('id')

            searchArticle()
        })

        $('.read-more').on('click', function() {
            var url = $(this).val()

            loadMore(url)
        })

        function searchArticle() {
            $.ajax({
                type: 'GET',
                url: '{{ route('landing-page.blog.index') }}',
                beforeSend: function() {
                    $('#card_blog').fadeOut(0)
                },
                data: {
                    'title': title,
                    'category': category_id
                },
                success: function(data) {
                    if (!data.next_page_url) {
                        $('.read-more').attr("disabled", true);
                    } else {
                        $('.read-more').attr("disabled", false);
                    }
                    $('.read-more').val(data.next_page_url)
                    $('#card_blog').html(data.view).fadeIn(3000)
                }
            })
        }

        function loadMore(url) {
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    if (!data.next_page_url) {
                        $('.read-more').attr("disabled", true);
                    } else {
                        $('.read-more').attr("disabled", false);
                    }
                    $('.read-more').val(data.next_page_url)
                    $('#card_blog').append(data.view).hide().show('slow')
                },
            })
        }
    </script>
@endpush
