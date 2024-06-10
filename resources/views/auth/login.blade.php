@extends('layouts.user_type.guest')

@section('title', 'Login')
@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-6">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-gray-900">Welcome back</h3>
                                    <p class="mb-0">We're delighted to have you back!</p>
                                    <p class="mb-0">Please log in or register to access your account.</p>
                                </div>
                                <div class="card-body montserrat">
                                    <style>
                                        .alert {
                                            transition: opacity 0.5s ease;
                                        }
                                    </style>
                                    @if (session('success'))
                                        <div id="success-alert"
                                            class="alert alert-success mt-2 bg-teal-500 text-sm text-white rounded-lg p-4"
                                            role="alert">
                                            {{ session('success') }}
                                        </div>

                                        <script>
                                            // Ambil elemen alert
                                            var alert = document.getElementById('success-alert');

                                            // Set opacity menjadi 0
                                            alert.style.opacity = '0';

                                            // Hapus elemen alert setelah 4 detik
                                            setTimeout(function() {
                                                alert.style.opacity = '1'; // Ubah opacity menjadi 1
                                                setTimeout(function() {
                                                    alert.style.opacity = '0'; // Kembali ubah opacity menjadi 0
                                                    setTimeout(function() {
                                                        alert.remove(); // Hapus elemen alert
                                                    }, 500); // Waktu transisi (500ms = 0.5 detik)
                                                }, 4000); // Waktu alert ditampilkan (4000ms = 4 detik)
                                            }, 100); // Tunda sebentar sebelum memulai transisi (100ms = 0.1 detik)
                                        </script>
                                    @endif
                                    @if ($errors->any())
                                        <div id="error-alert"
                                            class="alert alert-danger mt-2 bg-red-500 text-sm text-white rounded-lg p-4"
                                            role="alert">
                                                @foreach ($errors->all() as $error)
                                                    {{ $error }}
                                                @endforeach
                                        </div>

                                        <script>
                                            var errorAlert = document.getElementById('error-alert');

                                            errorAlert.style.opacity = '0';

                                            setTimeout(function() {
                                                errorAlert.style.opacity = '1';
                                                setTimeout(function() {
                                                    errorAlert.style.opacity = '0';
                                                    setTimeout(function() {
                                                        errorAlert.remove();
                                                    }, 500);
                                                }, 4000);
                                            }, 100);
                                        </script>
                                    @endif
                                    <form role="form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" aria-label="Email" aria-describedby="email-addon" style="border-radius: 0.75rem;">
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon" style="border-radius: 0.75rem;">
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0" style="border-radius: 1.5rem;">Sign
                                                in</button>
                                        </div>
                                    </form>
                                    <div class="card-footer text-left pt-2 px-lg-0 px-0">
                                        <small class="text-muted">Forgot you password? Reset you password
                                            <a href="/forgot-password" class="text-info font-weight-bold text-blue-500" style=" color: rgb(59 130 246 / var(--tw-text-opacity));" >here</a>
                                        </small>
                                        <p class="mb-4 text-sm mx-auto">
                                            Don't have an account?
                                            <a href="register" class="text-info font-weight-bold" tyle=" color: rgb(59 130 246 / var(--tw-text-opacity));">Register</a>
                                        </p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
