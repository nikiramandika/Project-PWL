@extends('layouts.user_type.guest')

@section('content')

<div class="page-header section-height-75"  style="height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left bg-transparent">
                        <h4 class="mb-0">Forgot your password?</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 montserrat">
                            {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="montserrat">Email</label>
                                <div>
                                    <input id="email" class="form-control block mt-1 w-full montserrat" type="email" name="email" :value="old('email')" required autofocus>
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-2">
                                <button type="submit" class="btn bg-gradient-info w-full mt-4 mb-0 montserrat">{{ __('Email Password Reset Link') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                    <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
