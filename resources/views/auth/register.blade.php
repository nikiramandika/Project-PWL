@extends('layouts.user_type.guest')

@section('title', 'Register')
@section('content')

  <section class="min-vh-100 mb-2">
    <div class="page-header align-items-start min-vh-50 pt-1 pb-11 mx-3" style="background-image: url('../assets/img/curved-images/curved6.jpg'); border-radius: 1.5rem;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <p class="text-lead text-white"></p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto" style="border-radius: 1.5rem;">
          <div class="card z-index-0" style="border-radius: 1.5rem;">
            <div class="card-header text-center pt-4">
              <h5>Register</h5>
            </div>
            <div class="card-body montserrat" style=" padding-top:0px!important;">
              <form role="form text-left" method="POST" action="/register">
                @csrf
                <div class="mb-3">
                  <input type="text" class="form-control montserrat" placeholder="Name" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                  @error('name')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control montserrat" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                  @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control montserrat" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                    @error('password')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control montserrat" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" aria-label="Confirm Password" aria-describedby="password-confirmation-addon" required autocomplete="new-password">
                    @error('password_confirmation')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                  <label class="form-check-label montserrat" for="flexCheckDefault ">
                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder montserrat">Terms and Conditions</a>
                  </label>
                  @error('agreement')
                    <p class="text-danger text-xs mt-2 montserrat">First, agree to the Terms and Conditions, then try register again.</p>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 mt-2 mb-2 montserrat" style="border-radius: 2rem;">Register</button>
                </div>
                <p class="text-sm mt-3 mb-0 montserrat">Already have an account? <a href="login" class="text-dark font-weight-bolder">Log In</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

