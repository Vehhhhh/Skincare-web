<section class="fp__topbar">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-8">
                <ul class="fp__topbar_info d-flex flex-wrap">
                    <li><a href="{{ @$contact->mail }}"><i
                                class="fas fa-envelope"></i>{{ @$contact->mail }}</a>
                    </li>
                    {{-- <li><a href="callto:123456789"><i class="fas fa-phone-alt"></i>+885962671026</a></li> --}}
                </ul>
            </div>
            <div class="col-xl-6 col-md-4 d-none d-md-block">

                <ul class="topbar_icon d-flex flex-wrap">
                    <li><a href="callto:{{ @$contact->phone }}"><i class="fas fa-phone-alt"></i>{{ @$contact->phone }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset(config('settings.logo')) }}" alt="Khmer-Food" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link {{ setSidebarActive(['home']) }}" aria-current="page"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ setSidebarActive(['about.index']) }}"
                        href="{{ route('about.index') }}">Promotions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ setSidebarActive(['menu.index']) }} {{ setSidebarActive(['product.*']) }}"
                        href="{{ route('menu.index') }}">All Products</a>
                </li>
                {{-- <li class="nav-item">
                        <a class="nav-link {{ setSidebarActive(['contact.index']) }}"
                        href="{{ route('contact.index') }}">contact</a>
                </li> --}}

            </ul>
            <ul class="menu_icon d-flex flex-wrap">
                <li>
                    <a href="#" class="menu_search"><i class="far fa-search"></i></a>
                    <div class="fp__search_form">
                        <form action="{{ route('menu.index') }}" method="GET">
                            <span class="close_search"><i class="far fa-times"></i></span>
                            <input type="text" placeholder="Search . . ." name="search">
                            <button type="submit">search</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a class="cart_icon {{ setSidebarActive(['cart.*']) }} {{ setSidebarActive(['checkout.*']) }}"><i class="far fa-shopping-bag"></i><span
                            class="cart_count">{{ count(Cart::content()) }}</span></a>
                </li>
                <li>
                    <a class="{{ setSidebarActive(['dashboard']) }}" href="{{ route('login') }}"><i class="far fa-user"></i></a>
                </li>
               {{-- <li>
                    <a class="common_btn" href="#" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">reservation</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
{{-- {{ Cart::destroy() }} --}}
<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item : <span class="cart_count" style="font-size: 16px">{{ count(Cart::content()) }}</span></h5>
            <span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul class="cart_contents">

            @foreach (Cart::content() as $cartProduct)
                <li>
                    <div class="menu_cart_img">
                        <img src="{{ asset($cartProduct->options->product_info['image']) }}" alt="menu"
                            class="img-fluid w-100">
                    </div>
                    <div class="menu_cart_text">
                        <a class="title"
                            href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}">{!! $cartProduct->name !!}</a>
                        <p class="size">Qty: {{ $cartProduct->qty }}</p>

                        <p class="size">{{ @$cartProduct->options->product_size['name'] }}
                            {{ @$cartProduct->options->product_size['price']
                                ? '(' . currencyPosition(@$cartProduct->options->product_size['price']) . ')'
                                : '' }}
                        </p>

                        @foreach ($cartProduct->options->product_options as $cartProductOption)
                            <span class="extra">{{ $cartProductOption['name'] }}
                                ({{ currencyPosition(@$cartProductOption['price']) }})
                            </span>
                        @endforeach
                        <p class="price">{{ currencyPosition($cartProduct->price) }}</p>
                    </div>
                    <span class="del_icon" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}')"><i
                            class="fal fa-times"></i></span>
                </li>
            @endforeach
        </ul>
        <p class="subtotal">sub total <span class="cart_subtotal">{{ currencyPosition(cartTotal()) }}</span></p>
        {{-- <a class="cart_view" href="{{ route('cart.index') }}"> view cart</a> --}}
        <a class="checkout" href="{{ route('checkout.index') }}">checkout</a>
    </div>
</div>
@php
    $reservationTimes = App\Models\ReservationTime::where('status', 1)->get();
@endphp
{{-- <div class="fp__reservation">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Book a Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="fp__reservation_form" action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <input class="reservation_input" type="text" placeholder="Name" name="name">
                        <input class="reservation_input" type="text" placeholder="Phone" name="phone">
                        <input class="reservation_input" type="date" name="date">
                        <select class="reservation_input nice-select" name="time">
                            <option value="">select time</option>
                            @foreach ($reservationTimes as $time)
                                <option value="{{ $time->start_time }}-{{ $time->end_time }}">
                                    {{ $time->start_time }} to {{ $time->end_time }}</option>
                            @endforeach
                        </select>
                        <input class="reservation_input" type="text" placeholder="Persons" name="persons">
                        <button type="submit" class="btn_submit">book table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.fp__reservation_form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: '{{ route('reservation.store') }}',
                    data: formData,
                    beforeSend: function() {
                        $('.btn_submit').html(
                        '<span class="spinner-border text-light"></span>');
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('.fp__reservation_form').trigger("reset");
                        $('#staticBackdrop').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            toastr.error(value);
                            $('.btn_submit').html('Book Table');
                        })
                    },
                    complete: function() {
                        $('.btn_submit').html('Book Table');
                    }
                })
            })
        })
    </script>
@endpush
--}}
