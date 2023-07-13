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
                <a href="{{ route('landing-page.blog.show', ['id' => $blog->id]) }}" class="d-inline-block">
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
