@extends('layouts.user_type.verify')

@section('content')
<div class="page-header section-height-100 montserrat" style="height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left bg-transparent">
                        <h4 class="mb-0">{{ __('Verify Your Email Address') }}</h4>
                    </div>
                    <div class="card-body montserrat">
                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-0 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}" class="w-100">
                                @csrf

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mt-0 mb-0" style="border-radius: 2rem;">
                                        {{ __('Resend Verification Email') }}
                                    </button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}" class="w-100 mt-2">
                                @csrf

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-danger w-100 mt-2 mb-0" style="border-radius: 2rem;">
                                        {{ __('Log Out') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                    <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{ asset('assets/img/curved-images/curved6.jpg') }}')"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
