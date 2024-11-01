@extends('layouts.guest')
@section('content')
    <!-- Login -->
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Login</h4>
                                    <p class="mb-0">Enter your email and password to login</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Address -->
                                        <div>
                                            <x-input-label for="email" :value="__('Email')"/>
                                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                                          :value="old('email')" required autofocus
                                                          autocomplete="username"/>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-input-label for="password" :value="__('Password')"/>

                                            <x-text-input id="password" class="block mt-1 w-full"
                                                          type="password"
                                                          name="password"
                                                          required autocomplete="current-password"/>

                                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="block mt-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                                <label class="form-check-label"
                                                       for="rememberMe">{{ __('Remember me') }}</label>
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">
                                                {{ __('Log in') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        @if (Route::has('password.request'))
                                            {{ __('Forgot your password?') }}
                                        @endif
                                        <a href="{{ route('password.request') }}"
                                           class="text-primary text-gradient font-weight-bold">Click Here</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div
                                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('{{asset('assets/img/signin-ill.jpg')}}');
          background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>

                                <h4 class="mt-5 text-white font-weight-bolder position-relative">
                                    " {{ $inspire_author }} "</h4>
                                <p
                                    class="text-white position-relative">{{ $inspire_quote }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
