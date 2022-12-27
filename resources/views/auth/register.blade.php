<?php 

$nonav='';
$nosidebar='';
?>



  
  @extends('admin.layouts.master')
    @section('content')

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden m-0">
                            <div class="row justify-content-center g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Register Account</h5>
                                            <p class="text-muted">Get your Free Velzon account now.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form class="needs-validation" method="post" action="{{route('register')}}">
                                                @csrf
                                                <div class="mb-3 row">
                                                    <div class="col-6">
                                                   <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                    <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" id="name" >
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                    </div>
                                                    <div class="col-6">
                                                    <label for="userphone" class="form-label @error('phone') is-invalid @enderror"  >Phone  <span class="text-danger">*</span></label>
                                                    <input type="text" name="phone" class="form-control" id="userphone" value="{{ old('phone') }}"  required>
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input  type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" id="email"  autocomplete="new-password">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input autocomplete="new-password" type="password" name="password" class="form-control pe-5 @error('password') is-invalid @enderror"  value="{{ old('password') }}"  id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password-confirmation">Confirm Password </label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password_confirmation" class="form-control pe-5"  id="password-confirmation">                                               
                                            </div>
                                        </div>

                                                <div class="form-check">
                                                    <input  required  class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check"> Agree to privacy policy  </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_provider"  id="is-prvider">
                                                    <label class="form-check-label" for="is-prvider"> {{trans('lang.are_you_provider')}}  </label>
                                                </div>

                                 

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <div class="signin-other-title">
                                                        <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                                    </div>

                                                    <div>
                                                        <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                                        <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                                        <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                                                        <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0">Already have an account ? <a href="{{route('login')}}" class="fw-semibold text-primary text-decoration-underline"> Signin</a> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->




        
    </div>
    <!-- end auth-page-wrapper -->



                @push('js')
                <!-- particles js -->
                <script src="/assets/libs/particles.js/particles.js"></script>
                <!-- particles app js -->
                <script src="/assets/js/pages/particles.app.js"></script>
                <!-- password-addon init -->
                <script src="/assets/js/pages/password-addon.init.js"></script>
                @endpush

    @endsection