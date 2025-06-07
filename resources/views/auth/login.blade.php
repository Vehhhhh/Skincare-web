@extends('frontend.layouts.master')

@section('content')
    <!--=============================
                                                                                                                BREADCRUMB START
                                                                                                            ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ config('settings.breadcrumb') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>sign in</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">sign in</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                        BREADCRUMB END
                                    ==============================-->


    <!--=========================
                                        SIGNIN START
                                    ==========================-->
    <section class="fp__signin" style="background: url(images/login_bg.jpg);">
        <div class="fp__signin_overlay pt_125 xs_pt_95 pb_100 xs_pb_70">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xxl-5 col-xl-6 col-md-9 col-lg-7 m-auto">
                        <div class="fp__login_area">
                            <h2>Welcome back!</h2>
                            <p>sign in to continue</p>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <label for="login">email / phone number</label> (e.g. +855 23 XXX XXXX)
                                            <input name="login" placeholder="Enter email or phone number"
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
                                        <div class="fp__login_imput fp__login_check_area">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" name="remember">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Remember Me
                                                </label>
                                            </div>
                                            <a href="{{ route('password.request') }}">Forgot Password ?</a>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="fp__login_imput">
                                            <button type="submit" class="common_btn">login</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="or"><span>or</span></p>
                            <ul class="d-flex">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                              {{--  <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                             --}}
                            </ul>
                            <p class="create_account">Don’t have an account ? <a href="{{ route('register.index') }}">Create
                                    Account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================
                                        SIGNIN END
                                    ==========================-->
@endsection
