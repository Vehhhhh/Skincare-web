<section class="fp__topbar">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-8">
                <ul class="fp__topbar_info d-flex flex-wrap">
                    <li><a href="{{ @$contact->mail }}"><i
                                class="fas fa-envelope"></i>{{ @$contact->mail }}</a>
                    </li>
                    {{-- <li><a href="callto:123456789"><i class="fas fa-phone-alt"></i>+88586619515</a></li> --}}
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
                        href="{{ route('about.index') }}">All Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ setSidebarActive(['menu.index']) }} {{ setSidebarActive(['product.*']) }}"
                        href="{{ route('menu.index') }}">Promotions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ setSidebarActive(['contact.index']) }}"
                        href="{{ route('contact.index') }}">Category</a>
                    </li>

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
        <a class="checkout" href="{{ route('checkout.index') }}">checkout</a>
    </div>
</div>
