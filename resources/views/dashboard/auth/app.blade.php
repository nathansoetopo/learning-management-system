<!DOCTYPE html>
<html lang="en">

@include('dashboard.auth.component.head')

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTG-y6AdTXi-HRqhg5xbQY3QDThyJBnEtAerg&usqp=CAU"
                                alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">@yield('form-title')</h1>
                    <p class="auth-subtitle mb-3">@yield('form-caption')</p>

                    @yield('form-authentication')

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dashboard') }}/assets/extensions/toastify-js/src/toastify.js"></script>
    @include('dashboard.parts.toast-danger')
    @include('dashboard.parts.toast-success')
</body>

</html>
