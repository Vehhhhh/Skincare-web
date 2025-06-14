@extends('frontend.layouts.master')

@section('content')
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url(frontend/images/cover.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Promotions</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">Promotions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
   <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=============================
        SEARCH MENU START
    ==============================-->
    <section class="fp__search_menu mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <form class="fp__search_menu_form" method="GET" action="{{ route('menu.index') }}">
                <div class="row">
                    <div class="col-xl-6 col-md-5">
                        <input type="text" placeholder="Search..." name="search" value="{{ @request()->search }}">
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <select class="nice-select" name="category">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-xl-2 col-md-3">
                        <button type="submit" class="common_btn">search</button>
                    </div>
                </div>
            </form>

            <div class="row">

               @foreach ($products as $product)
                @if ($product->offer_price)
                    <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img">
                                <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid w-100">
                                <a class="category" href="#">{{ @$product->category->name }}</a>
                            </div>
                            <div class="fp__menu_item_text">
                                @if ($product->reviews_avg_rating)
                                    <p class="rating">
                                        @for ($i = 1; $i <= $product->reviews_avg_rating; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        <span>{{ $product->reviews_count }}</span>
                                    </p>
                                @endif
                                <a class="title" href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                <h5 class="price">
                                    {{ currencyPosition($product->offer_price) }}
                                    <del>{{ currencyPosition($product->price) }}</del>
                                </h5>
                                <ul class="d-flex flex-wrap justify-content-center">
                                    <li><a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"><i class="fas fa-shopping-basket"></i></a></li>
                                    <li><a href="{{ route('product.show', $product->slug) }}"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
                @if (count($products) === 0)
                <h4 class="text-center mt-5">No Product Found!</h4>
                @endif

            </div>

                <div class="pagination mt_60">
                    <div class="row">
                        <div class="col-12">
                            
                        </div>
                    </div>
                </div>


        </div>
    </section>
@endsection



