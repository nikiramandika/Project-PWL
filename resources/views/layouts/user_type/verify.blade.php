@extends('layouts.app')

@section('auth')
    @if(\Request::is('login/forgot-password')) 
        @include('layouts.navbars.guest.nav')
        @yield('content') 
    @else
        <div class="w-full position-sticky z-index-sticky top-0">
            <div class="">
                <div class="">
                    @include('layouts.navbars.guest.nav')
                </div>
            </div>
        </div>
        @yield('content')        
    @endif
@endsection