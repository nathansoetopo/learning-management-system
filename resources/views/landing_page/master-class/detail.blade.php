@extends('landing_page.app')
@section('app-content')
    <div class="container mt-5">
        <div class="row mb-8">
            <div class="col-lg-8 mb-6 mb-lg-0 position-relative">
                <h1 class="me-xl-14">
                    {{ $masterClass->name }}
                </h1>
                <p class="me-xl-13 mb-5">
                    {{ $masterClass->active_dashboard ? 'Course ini menggunakan dashboard' : 'Course ini tanpa dashboard' }}
                </p>

                <a href="#" id="wishlist"
                    class="badge badge-lg badge-rounded-circle {{ $masterClass->wishlist_count == 0 ? 'badge-secondary' : 'badge-danger' }} font-size-base badge-float badge-float-inside top-0 text-white">
                    <i class="far fa-heart"></i>
                </a>

                <!-- COURSE META
                                                        ================================================== -->
                <div class="d-md-flex align-items-center mb-5">
                    <div class="mb-4 mb-md-0 me-md-8 me-lg-4 me-xl-8">
                        <h6 class="mb-0">Event</h6>
                        <a href="#" class="font-size-sm text-gray-800">{{ $masterClass->event->name }}</a>
                    </div>
                </div>

                <div class="d-block sk-thumbnail rounded mb-6">
                    <img class="rounded shadow-light-lg" src="{{ $masterClass->image }}" alt="...">
                </div>

                <!-- COURSE INFO TAB
                                                        ================================================== -->
                <div class="border rounded shadow p-3 mb-6">
                    <ul id="pills-tab" class="nav nav-pills course-tab-v2 h5 mb-0 flex-nowrap overflow-auto" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-overview-tab" data-bs-toggle="pill" href="#pills-overview"
                                role="tab" aria-controls="pills-overview" aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill" href="#pills-reviews"
                                role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel"
                        aria-labelledby="pills-overview-tab">
                        <h3 class="">Deskripsi Event</h3>
                        <p class="mb-6 line-height-md">{{ $masterClass->event->description }}</p>

                        <h3 class="mb-5">Deskripsi Kelas</h3>
                        <p class="mb-6 line-height-md">{{ $masterClass->description }}</p>
                    </div>

                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                        <h3 class="mb-6">Student feedback</h3>
                        <div class="row align-items-center mb-8">
                            <div class="col-md-auto mb-5 mb-md-0">
                                <div
                                    class="border rounded shadow d-flex align-items-center justify-content-center px-9 py-8">
                                    <div class="m-2 text-center">
                                        <h1 class="display-2 mb-0 fw-medium mb-n1">{{ $avg ? number_format($avg, 2) : 0 }}</h1>
                                        <h5 class="mb-0">Course rating</h5>
                                        <div class="star-rating">
                                            <div class="rating" style="width:{{ getStarRate($avg ?? '-') }};"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-unstyled pt-2" id="users-review">
                            {{-- Content --}}
                        </ul>

                        <div class="border shadow rounded p-6 p-md-9">
                            <h3 class="mb-2">Add Reviews & Rate</h3>
                            <div class="">What is it like to Course?</div>
                            <form id="form-review" method="POST">
                                <div class="clearfix">
                                    <fieldset class="slect-rating mb-3">
                                        <input type="radio" id="star5" name="rate" value="5" required />
                                        <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                        <input type="radio" id="star4half" name="rate" value="4.5" required />
                                        <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                        <input type="radio" id="star4" name="rate" value="4" required />
                                        <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                        <input type="radio" id="star3half" name="rate" value="3.5" required />
                                        <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                        <input type="radio" id="star3" name="rate" value="3" required />
                                        <label class="full" for="star3" title="Meh - 3 stars"></label>

                                        <input type="radio" id="star2half" name="rate" value="2.5" required />
                                        <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                        <input type="radio" id="star2" name="rate" value="2" required />
                                        <label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                        <input type="radio" id="star1half" name="rate" value="1.5" required />
                                        <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                        <input type="radio" id="star1" name="rate" value="1" required />
                                        <label class="full" for="star1" title="Sucks big time - 1 star"></label>

                                        <input type="radio" id="starhalf" name="rate" value="0.5" required />
                                        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                </div>

                                <div class="form-group mb-6">
                                    <label for="exampleFormControlTextarea1">Review Content</label>
                                    <textarea class="form-control placeholder-1" name="description" id="exampleFormControlTextarea1" rows="6"
                                        placeholder="Content" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mw-md-300p">SUBMIT REVIEW</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- SIDEBAR FILTER
                                                        ================================================== -->
                <div class="d-block rounded border p-2 shadow mb-6">
                    <a href="https://www.youtube.com/watch?v=9I-Y6VQ6tyI" class="d-none sk-thumbnail rounded mb-1"
                        data-fancybox>
                        <div
                            class="h-60p w-60p rounded-circle bg-white size-20-all d-inline-flex align-items-center justify-content-center position-absolute center z-index-1">
                            <!-- Icon -->
                            <svg width="14" height="16" viewBox="0 0 14 16" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.8704 6.15374L3.42038 0.328572C2.73669 -0.0923355 1.9101 -0.109836 1.20919 0.281759C0.508282 0.673291 0.0898438 1.38645 0.0898438 2.18929V13.7866C0.0898438 15.0005 1.06797 15.9934 2.27016 16C2.27344 16 2.27672 16 2.27994 16C2.65563 16 3.04713 15.8822 3.41279 15.6591C3.70694 15.4796 3.79991 15.0957 3.62044 14.8016C3.44098 14.5074 3.05697 14.4144 2.76291 14.5939C2.59188 14.6982 2.42485 14.7522 2.27688 14.7522C1.82328 14.7497 1.33763 14.3611 1.33763 13.7866V2.18933C1.33763 1.84492 1.51713 1.53907 1.81775 1.3711C2.11841 1.20314 2.47294 1.21064 2.76585 1.39098L12.2159 7.21615C12.4999 7.39102 12.6625 7.68262 12.6618 8.01618C12.6611 8.34971 12.4974 8.64065 12.2118 8.81493L5.37935 12.9983C5.08548 13.1783 4.9931 13.5623 5.17304 13.8562C5.35295 14.1501 5.73704 14.2424 6.03092 14.0625L12.8625 9.87962C13.5166 9.48059 13.9081 8.78496 13.9096 8.01868C13.9112 7.25249 13.5226 6.55524 12.8704 6.15374Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                        <img class="rounded shadow-light-lg" src="assets/img/products/product-2.jpg" alt="...">
                    </a>

                    <div class="pt-5 pb-4 px-5 px-lg-3 px-xl-5">
                        <div class="d-flex align-items-center mb-2">
                            <ins class="h2 mb-0">Rp. @money($masterClass->price)</ins>
                        </div>

                        <form action="{{ route('landing-page.transaction.checkout', ['id' => $masterClass->id]) }}"
                            method="POST">
                            @csrf
                            <input type="hidden" value="{{ $masterClass->price }}" name="amount">
                            <input type="hidden" value="{{ $masterClass->name }}" name="master_class_name">
                            <input type="hidden" value="{{ $masterClass->id }}" name="master_class_id">
                            <button type="submit"
                                class="btn btn-primary btn-block mb-3 {{ $masterClass->class->count() < 1 ? '' : 'disabled' }}"
                                type="button" name="button">Beli
                            </button>
                            <button class="btn btn-orange btn-block mb-6" id="cart" type="button"
                                name="button">{{ $masterClass->cart_count == 0 ? 'Tambahkan Keranjang' : 'Hapus Keranjang' }}</button>
                        </form>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center py-3 bg-transparent">
                                <div class="text-secondary d-flex icon-uxs">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                            fill="currentColor" />
                                        <path
                                            d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                            fill="currentColor" />
                                    </svg>
                                </div>
                                <h6 class="mb-0 ms-3 me-auto">Jumlah Kelas</h6>
                                <span>{{ $masterClass->class_count }} Kelas</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3 bg-transparent">
                                <div class="text-secondary d-flex icon-uxs">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                            fill="currentColor" />
                                        <path
                                            d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                            fill="currentColor" />
                                    </svg>

                                </div>
                                <h6 class="mb-0 ms-3 me-auto">Durasi</h6>
                                <span>{{ $masterClass->duration }} jam</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3 bg-transparent">
                                <div class="text-secondary d-flex icon-uxs">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                            fill="currentColor" />
                                    </svg>

                                </div>
                                <h6 class="mb-0 ms-3 me-auto">Jumlah Siswa</h6>
                                <span>{{ $masterClass->mentee_count }} Siswa</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3 bg-transparent">
                                <div class="text-secondary d-flex icon-uxs">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.5936 3.78122H7.72003L6.56976 0.320872C6.50607 0.12928 6.32686 0 6.12495 0H1.40624C0.630839 0 0 0.630839 0 1.40624V10.8124C0 11.5878 0.630839 12.2187 1.40624 12.2187H6.57173L7.71263 15.6698C7.77566 15.8719 7.96259 16 8.1604 16C8.1615 16 8.16259 15.9999 8.16369 15.9999H14.5937C15.3691 15.9999 15.9999 15.369 15.9999 14.5936V5.18746C15.9999 4.41206 15.369 3.78122 14.5936 3.78122ZM1.40624 11.2812C1.14777 11.2812 0.937493 11.0709 0.937493 10.8124V1.40624C0.937493 1.14777 1.14777 0.937493 1.40624 0.937493H5.7868L9.22511 11.2812C7.46913 11.2812 3.14004 11.2812 1.40624 11.2812ZM9.14771 12.2187L8.22897 14.2449L7.55913 12.2187H9.14771ZM15.0624 14.5936C15.0624 14.8521 14.8521 15.0624 14.5936 15.0624H8.88768L10.3018 11.9435C10.3525 11.8316 10.3549 11.7077 10.3197 11.6018L8.03166 4.71871H14.5936C14.8521 4.71871 15.0624 4.92899 15.0624 5.18746V14.5936Z"
                                            fill="currentColor" />
                                        <path
                                            d="M6.12497 5.65623H4.71873C4.45986 5.65623 4.24998 5.8661 4.24998 6.12497C4.24998 6.38385 4.45986 6.59372 4.71873 6.59372H5.5756C5.3821 7.13931 4.86107 7.53121 4.24998 7.53121C3.47458 7.53121 2.84374 6.90037 2.84374 6.12497C2.84374 5.34958 3.47458 4.71874 4.24998 4.71874C4.6256 4.71874 4.97873 4.86502 5.24435 5.13061C5.42738 5.31367 5.72419 5.31367 5.90725 5.13061C6.09028 4.94755 6.09028 4.65077 5.90725 4.46771C5.46457 4.02503 4.87601 3.78125 4.24998 3.78125C2.95765 3.78125 1.90625 4.83264 1.90625 6.12497C1.90625 7.4173 2.95765 8.4687 4.24998 8.4687C5.54232 8.4687 6.59371 7.4173 6.59371 6.12497C6.59371 5.8661 6.38384 5.65623 6.12497 5.65623Z"
                                            fill="currentColor" />
                                        <path
                                            d="M13.625 7.53124H12.2187V7.0625C12.2187 6.80362 12.0089 6.59375 11.75 6.59375C11.4911 6.59375 11.2812 6.80362 11.2812 7.0625V7.53124H9.875C9.61612 7.53124 9.40625 7.74112 9.40625 7.99999C9.40625 8.25886 9.61612 8.46874 9.875 8.46874H12.5981C12.449 8.91201 12.1287 9.43735 11.7563 9.94291C11.6761 9.8346 11.5968 9.72376 11.5204 9.61138C11.3748 9.39729 11.0833 9.34176 10.8692 9.48735C10.6551 9.63291 10.5997 9.92447 10.7452 10.1386C10.8767 10.332 11.0146 10.5202 11.152 10.6985C10.9177 10.9702 10.6868 11.2163 10.4842 11.4154C10.2994 11.5967 10.2966 11.8935 10.4779 12.0783C10.6585 12.2623 10.9552 12.2666 11.1408 12.0846C11.157 12.0687 11.4126 11.8169 11.7541 11.4303C12.0873 11.8115 12.3367 12.0621 12.356 12.0814C12.539 12.2644 12.8357 12.2645 13.0188 12.0815C13.2019 11.8985 13.202 11.6017 13.019 11.4186C13.0141 11.4137 12.7271 11.1251 12.3609 10.698C13.0245 9.84029 13.429 9.09314 13.5691 8.46874H13.6249C13.8838 8.46874 14.0937 8.25886 14.0937 7.99999C14.0937 7.74112 13.8839 7.53124 13.625 7.53124Z"
                                            fill="currentColor" />
                                    </svg>

                                </div>
                                <h6 class="mb-0 ms-3 me-auto">Bahasa</h6>
                                <span>Indonesia</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-5 mb-md-8">
            <h1>Kursus/Webinar Lainnya</h1>
            <p class="font-size-lg text-capitalize">Discover your perfect program in our courses.</p>
        </div>

        <div class="mx-n4 mb-12"
            data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
            @foreach ($relatedMasterClasses as $relatedMasterClass)
                <div class="col-md-6 col-lg-4 col-xl-3 pb-4 pb-md-5" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow-dark-hover p-2 sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="./course-single-v5.html" class="card-img sk-thumbnail img-ratio-3 d-block">
                                <img class="rounded shadow-light-lg" src="{{ $relatedMasterClass->image }}"
                                    alt="...">
                            </a>

                            <span class="sk-fade-right badge-float bottom-0 right-0 mb-2 me-2">
                                <ins class="h5 mb-0 text-dark">Rp. @money($relatedMasterClass->price)</ins>
                            </span>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                            <!-- Preheading -->
                            <a href="./course-single-v5.html"><span
                                    class="mb-1 d-inline-block text-gray-800">{{ $relatedMasterClass->event->name }}</span></a>

                            <!-- Heading -->
                            <div class="position-relative">
                                <a href="./course-single-v5.html" class="d-block stretched-link">
                                    <h5 class="line-clamp-2 h-md-48 h-lg-58 me-md-8 me-lg-10 me-xl-4 mb-2">
                                        {{ $relatedMasterClass->name }}</h5>
                                </a>
                                <div class="row mx-n2 align-items-end">
                                    <div class="col px-2">
                                        <ul class="nav mx-n3">
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">{{ $relatedMasterClass->class_count }} kelas
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-auto px-2 text-right">
                                        <div class="star-rating mb-2 mb-lg-0">
                                            <div class="rating" style="width:100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('app-script')
    <script>
        var token = $('meta[name=csrf-token]').attr('content')

        $(document).ready(function() {
            getAllReview()
        })

        function getAllReview() {
            $.ajax({
                type: "GET",
                url: "{{ route('landing-page.reviews.review.class', ['master_class_id' => $masterClass->id]) }}",
                success: function(response) {
                    console.log(response)
                    $('#users-review').html(response)
                }
            })
        }

        $(document).on('submit', '#form-review', function(e) {
            e.preventDefault()
            var formData = new FormData(this);
            formData.append('_token', token);

            $.ajax({
                url: '{{ route('landing-page.reviews.store', ['master_class_id' => $masterClass->id]) }}',
                type: 'POST',
                dataType: "JSON",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data)
                    getAllReview();
                }
            });
        })

        $('#cart').on('click', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('landing-page.master-class.cart', ['id' => $masterClass->id]) }}",
                data: {
                    '_token': token,
                },
                success: function(response) {

                    if (response.status == 200) {

                        if (response.data == 'attached') {
                            $('#cart').text('Hapus Keranjang')
                        } else {
                            $('#cart').text('Tambahkan Keranjang')
                        }

                    } else {
                        console.log(response.data)
                    }
                }
            })
        })

        $('#wishlist').on('click', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('landing-page.master-class.wishlist', ['id' => $masterClass->id]) }}",
                data: {
                    '_token': token,
                },
                success: function(response) {

                    if (response.status == 200) {

                        if (response.data == 'attached') {
                            $('#wishlist').removeClass('badge-secondary').addClass('badge-danger')
                        } else {
                            $('#wishlist').removeClass('badge-danger').addClass('badge-secondary')
                        }

                    } else {
                        console.log(response.data)
                    }
                }
            })
        })
    </script>
@endpush
