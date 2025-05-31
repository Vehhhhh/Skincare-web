@extends('frontend.layouts.master')

@section('content')
    <!--=============================
                                                                                                                                                                BREADCRUMB START
                                                                                                                                                            ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset(config('settings.breadcrumb')) }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Success</h1>
                    {{-- <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">payment</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                                                                                                                                                                                                                                            BREADCRUMB END
                                                                                                                                                                                                                                        ==============================-->
    <!--============================
                                                                                                                                                                        PAYMENT PAGE START
                                                                                                                                                                    ==============================-->
    <section class="fp__payment_page mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <h2>View Your Order</h2>
            <div class="row">
                <div class="col-lg-8">
                    <div class="fp__payment_area">
                        <div class="row">

                            <button class="common_btn" onclick="redirectToDashboard()">View Order</button>


                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt_25 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function redirectToDashboard() {
            // Set a flag in session storage
            sessionStorage.setItem('activeTab', 'v-pills-profile-tab');

            // Redirect to the dashboard route
            window.location.href = '{{ route('dashboard') }}';
        }
    </script>
@endpush
