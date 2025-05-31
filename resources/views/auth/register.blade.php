@extends('frontend.layouts.master')
@section('content')
    <!--=============================
                            BREADCRUMB START
                        ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ config('settings.breadcrumb') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>sign up</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">sign up</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                            BREADCRUMB END
                        ==============================-->


    <!--=========================
                            SIGN UP START
                        ==========================-->
    <section class="fp__signup" style="background: url({{ asset('frontend/images/login_bg.jpg') }});">
        <div class="fp__signup_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
            <div class=" container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                        <div class="fp__login_area">
                            <h2>Welcome back!</h2>

                            <!-- Display errors or success messages -->
                            @if (session('error') || session('success'))
                                <div>{{ session('error') ?? session('success') }}</div>
                            @endif

                            <!-- Display the appropriate form based on session data -->
                            @if (!session('phone_number'))
                                <!-- Initial registration form -->
                                <p>Sign up to continue</p>
                                <form action="{{ route('register.send') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="fp__login_imput">
                                                <label>name</label>
                                                <input type="text" name="name" placeholder="Enter name"
                                                    value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="fp__login_imput">
                                                <label>email</label>
                                                <input type="email" name="email" placeholder="Enter email"
                                                    value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="fp__login_imput">
                                                <label>phone number</label>
                                                <input type="tel" name="phone_number" placeholder="Enter phone number"
                                                    value="+855">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="fp__login_imput">
                                                <label>password</label>
                                                <input type="password" name="password" placeholder="Enter password">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="fp__login_imput">
                                                <label>confirm password</label>
                                                <input type="password" placeholder="Enter confirm password"
                                                    name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="fp__login_imput">
                                                <button type="submit" class="common_btn">Register</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p class="or"><span>or</span></p>
                                <ul class="d-flex">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google"></i></a></li>
                                </ul>
                                <p class="create_account">already have an account ? <a href="{{ route('login') }}">login</a>
                                </p>
                            @else
                                <!-- Phone number verification form -->
                                <p>Verify phone number to continue</p>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <form action="{{ route('register.verify') }}" method="POST">
                                                @csrf
                                                <div class="col-md-12">
                                                    <label for="verification_code">We've sent a verification code to
                                                        your
                                                        phone number</label>
                                                    <input id="verification_code" type="tel"
                                                        placeholder="Enter verification code" name="verification_code"
                                                        value="" required>
                                                    <input type="hidden" name="phone_number"
                                                        value="{{ session('phone_number') }}">
                                                </div>
                                                <button type="submit" class="common_btn">Submit</button>
                                            </form>

                                            <form action="{{ route('register.resend') }}" method="POST">
                                                @csrf
                                                <p class="create_account">Didn’t receive the code ?</p>
                                                <button type="submit" class="btn btn-link">Resend OTP</button>
                                                <input class="create_account" type="hidden" name="phone_number"
                                                    value="{{ session('phone_number') }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
                            SIGN UP END
                        ==========================-->
@endsection
