<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.png">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Lora:wght@400;700&family=Montserrat:wght@400;500;600;700&family=Nunito:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('skola/assets/fonts/fontawesome/fontawesome.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('skola/assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('skola/assets/libs/aos/dist/aos.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('skola/assets/libs/choices.js/public/assets/styles/choices.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('skola/assets/libs/flickity-fade/flickity-fade.css') }}">
    <link rel="stylesheet" href="{{ asset('skola/assets/libs/flickity/dist/flickity.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('skola/assets/libs/highlightjs/styles/vs2015.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('skola/assets/libs/jarallax/dist/jarallax.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('skola/assets/libs/quill/dist/quill.core.css') }}" /> --}}
    <link rel="stylesheet" href="{{asset('dashboard')}}/assets/extensions/sweetalert2/sweetalert2.min.css">
    <!-- Map -->
    {{-- <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' /> --}}

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('skola/assets/css/theme.min.css') }}">

    <title>Skola</title>

    @stack('app-css')
</head>

<body class="bg-white">
    <!-- MODALS
    ================================================== -->
    <!-- Modal Sidebar account -->
    <div class="modal fade" id="modalExample" tabindex="-1" role="dialog" aria-labelledby="modalExampleTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <!-- Close -->
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                    <!-- Heading -->
                    <h2 class="fw-bold text-center mb-1" id="modalExampleTitle">
                        Schedule a demo with us
                    </h2>

                    <!-- Text -->
                    <p class="font-size-lg text-center text-muted mb-6 mb-md-8">
                        We can help you solve company communication.
                    </p>

                    <!-- Form -->
                    <form>
                        <div class="row">
                            <div class="col-12 col-md-6">

                                <!-- First name -->
                                <div class="form-label-group">
                                    <input type="text" class="form-control form-control-flush"
                                        id="registrationFirstNameModal" placeholder="First name">
                                    <label for="registrationFirstNameModal">First name</label>
                                </div>

                            </div>
                            <div class="col-12 col-md-6">

                                <!-- Last name -->
                                <div class="form-label-group">
                                    <input type="text" class="form-control form-control-flush"
                                        id="registrationLastNameModal" placeholder="Last name">
                                    <label for="registrationLastNameModal">Last name</label>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">

                                <!-- Email -->
                                <div class="form-label-group">
                                    <input type="email" class="form-control form-control-flush"
                                        id="registrationEmailModal" placeholder="Email">
                                    <label for="registrationEmailModal">Email</label>
                                </div>

                            </div>
                            <div class="col-12 col-md-6">

                                <!-- Password -->
                                <div class="form-label-group">
                                    <input type="password" class="form-control form-control-flush"
                                        id="registrationPasswordModal" placeholder="Password">
                                    <label for="registrationPasswordModal">Password</label>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <!-- Submit -->
                                <button class="btn btn-block btn-primary mt-3 lift">
                                    Request a demo
                                </button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-sidebar left fade-left fade" id="accountModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Signin -->
                <div class="collapse show" id="collapseSignin" data-bs-parent="#accountModal">
                    <div class="modal-header">
                        <h5 class="modal-title">Log In to Your Skola Account!</h5>
                        <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                            <!-- Icon -->
                            <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                                    fill="currentColor"></path>
                                <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                                    fill="currentColor"></path>
                            </svg>

                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Signin -->
                        <form class="mb-5">

                            <!-- Email -->
                            <div class="form-group mb-5">
                                <label for="modalSigninEmail">
                                    Username or Email
                                </label>
                                <input type="email" class="form-control" id="modalSigninEmail"
                                    placeholder="creativelayers">
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-5">
                                <label for="modalSigninPassword">
                                    Password
                                </label>
                                <input type="password" class="form-control" id="modalSigninPassword"
                                    placeholder="**********">
                            </div>

                            <div class="d-flex align-items-center mb-5 font-size-sm">
                                <div class="form-check">
                                    <input class="form-check-input text-gray-800" type="checkbox"
                                        id="autoSizingCheck">
                                    <label class="form-check-label text-gray-800" for="autoSizingCheck">
                                        Remember me
                                    </label>
                                </div>

                                <div class="ms-auto">
                                    <a class="text-gray-800" data-bs-toggle="collapse" href="#collapseForgotPassword"
                                        role="button" aria-expanded="false"
                                        aria-controls="collapseForgotPassword">Forgot Password</a>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-block btn-primary" type="submit">
                                LOGIN
                            </button>
                        </form>

                        <!-- Text -->
                        <p class="mb-0 font-size-sm text-center">
                            Don't have an account? <a class="text-underline" data-bs-toggle="collapse"
                                href="#collapseSignup" role="button" aria-expanded="false"
                                aria-controls="collapseSignup">Sign up</a>
                        </p>
                    </div>
                </div>

                <!-- Signup -->
                <div class="collapse" id="collapseSignup" data-bs-parent="#accountModal">
                    <div class="modal-header">
                        <h5 class="modal-title">Sign Up and Start Learning!</h5>
                        <button type="button" class="close text-primary" data-bs-dismiss="modal"
                            aria-label="Close">
                            <!-- Icon -->
                            <svg width="16" height="17" viewBox="0 0 16 17"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                                    fill="currentColor"></path>
                                <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                                    fill="currentColor"></path>
                            </svg>

                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Signup -->
                        <form class="mb-5">

                            <!-- Username -->
                            <div class="form-group mb-5">
                                <label for="modalSignupUsername">
                                    Username
                                </label>
                                <input type="text" class="form-control" id="modalSignupUsername"
                                    placeholder="John">
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-5">
                                <label for="modalSignupEmail">
                                    Username or Email
                                </label>
                                <input type="email" class="form-control" id="modalSignupEmail"
                                    placeholder="johndoe@creativelayers.com">
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-5">
                                <label for="modalSignupPassword">
                                    Password
                                </label>
                                <input type="password" class="form-control" id="modalSignupPassword"
                                    placeholder="**********">
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-block btn-primary" type="submit">
                                SIGN UP
                            </button>

                        </form>

                        <!-- Text -->
                        <p class="mb-0 font-size-sm text-center">
                            Already have an account? <a class="text-underline" data-bs-toggle="collapse"
                                href="#collapseSignin" role="button" aria-expanded="true"
                                aria-controls="collapseSignin">Log In</a>
                        </p>
                    </div>
                </div>

                <!-- Forgot Password -->
                <div class="collapse" id="collapseForgotPassword" data-bs-parent="#accountModal">
                    <div class="modal-header">
                        <h5 class="modal-title">Recover password!</h5>
                        <button type="button" class="close text-primary" data-bs-dismiss="modal"
                            aria-label="Close">
                            <!-- Icon -->
                            <svg width="16" height="17" viewBox="0 0 16 17"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                                    fill="currentColor"></path>
                                <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                                    fill="currentColor"></path>
                            </svg>

                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Recover Password -->
                        <form class="mb-5">
                            <!-- Email -->
                            <div class="form-group">
                                <label for="modalForgotpasswordEmail">
                                    Email
                                </label>
                                <input type="email" class="form-control" id="modalForgotpasswordEmail"
                                    placeholder="johndoe@creativelayers.com">
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-block btn-primary" type="submit">
                                RECOVER PASSWORD
                            </button>
                        </form>

                        <!-- Text -->
                        <p class="mb-0 font-size-sm text-center">
                            Remember your password? <a class="text-underline" data-bs-toggle="collapse"
                                href="#collapseSignin" role="button" aria-expanded="false"
                                aria-controls="collapseSignin">Log In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sidebar cart -->
    <div class="modal modal-sidebar left fade-left fade" id="cartModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-4">
                    <h5 class="modal-title">Keranjang Anda</h5>
                    <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!-- Icon -->
                        <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                                fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                                fill="currentColor"></path>
                        </svg>

                    </button>
                </div>

                <div class="modal-body">
                    <ul class="list-group list-group-flush mb-5" id="cart-list">
                        {{-- Content --}}
                    </ul>

                    <div class="container-fluid text-center">
                        <a href="{{route('landing-page.master-class.cart.list')}}" class="mb-4 mb-md-0 btn btn-primary btn-sm-wide">Lihat Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR
    ================================================== -->
    @include('landing_page.components.header')

    @yield('app-content')

    <!-- FOOTER ================================================== -->
    @include('landing_page.components.footer')
    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Libs JS -->
    <script src="{{ asset('skola/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/aos/dist/aos.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/countup.js/dist/countUp.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/flickity/dist/flickity.pkgd.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/flickity-fade/flickity-fade.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/highlightjs/highlight.pack.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/isotope-layout/dist/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/jarallax/dist/jarallax.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/jarallax/dist/jarallax-video.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/jarallax/dist/jarallax-element.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/parallax-js/dist/parallax.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/quill/dist/quill.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/smooth-scroll/dist/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('skola/assets/libs/typed.js/lib/typed.min.js') }}"></script>
    <script src="{{asset('dashboard')}}/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('dashboard')}}/assets/js/pages/sweetalert2.js"></script>
    <!-- Map -->
    {{-- <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script> --}}

    <!-- Theme JS -->
    <script src="{{ asset('skola/assets/js/theme.min.js') }}"></script>

    {{-- New Components --}}
    @stack('app-script')

    {{-- Cart --}}
    <script>
        $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "{{route('landing-page.master-class.cart.list')}}",
                success: function(response) {
                    console.log(response)
                    $('#cart-list').html(response.data)
                    $('#cart_count').text(response.cart_count)
                }
            })
        })
    </script>
</body>

</html>
