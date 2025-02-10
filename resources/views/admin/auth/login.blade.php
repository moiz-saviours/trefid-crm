<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="7199">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="./style.css/">
    <link rel="stylesheet" href="{{asset('build/toaster/css/toastr.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    @include('admin.auth.style')

</head>

<body>

<section class="login-section">
    <div class="container">
        <div class="main-login-row">
            <div class="row justify-content-end">
                <div class="col-lg-4">
                    <div class="text-center">
                        <img src="../assets/images/aim-logo.png" class="img-fluid logo-h" >
{{--                        <h1 class="main-logo-heading">CRM</h1>--}}

                    </div>
                    <div class="left-side-box">

                        <h4> Admin Login </h4>
                        <p>Enter your email and password to login</p>
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <x-input-label for="email" class="login-labels" :value="__('Email')"/>
                            <x-text-input id="email" class="login-inputs" type="email" name="email"
                                          :value="old('email')" required autofocus
                                          autocomplete="username"/>
{{--                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>--}}
                            <x-input-label for="password" class="login-labels" :value="__('Password')"/>

                            <x-text-input id="password" class="login-inputs"
                                          type="password"
                                          name="password"
                                          required autocomplete="current-password"/>

                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                            <div class="forgot-password-div">
                                <div class="save-password-div">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>

                                </div>
                                <a href="{{ route('password.request') }}" class="password-link">
                                    @if (Route::has('password.request'))
                                        {{ __('Forgot your password?') }}
                                    @endif

                                </a>
                            </div>
                            <button type="submit" class="login-btn">
                                {{ __('Log in') }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<!-- Toaster1 -->
<script src="{{asset('build/toaster/js/toastr.min.js')}}"></script>
<script>
    // Toastr options
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "3000", // 5 seconds
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if(session('errors') && session('errors')->any())
    let errorMessages = {!! json_encode(session('errors')->all()) !!};
    let displayedCount = 0;

    setTimeout(function () {
        errorMessages.forEach((message, index) => {
            if (displayedCount < 5) {
                toastr.error(message);
                displayedCount++;
            } else {
                setTimeout(() => toastr.error(message), index * 1000);
            }
        });
    }, 1500);

    @php session()->forget('errors'); @endphp
    @endif

    @if(session('message'))
    let message = {!! json_encode(session('message')) !!};
    toastr.error(message);
    @php session()->forget('message'); @endphp
    @endif

</script>
<script>
    let inactivityTimeout;
    // const maxInactivityTime = 2 * 60 * 60 * 1000; // 2 hours in milliseconds
    const maxInactivityTime = 15 * 60 * 1000;
    function refreshPage() {
        location.reload();
    }

    function resetInactivityTimer() {
        clearTimeout(inactivityTimeout);
        inactivityTimeout = setTimeout(refreshPage, maxInactivityTime);
    }
    window.addEventListener('mousemove', resetInactivityTimer);
    window.addEventListener('keypress', resetInactivityTimer);
    resetInactivityTimer();
</script>

@stack('script')

</body>

</html>
