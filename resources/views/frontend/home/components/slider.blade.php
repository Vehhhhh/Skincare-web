<section class="fp__banner" style="background: url({{ asset('frontend/images/banner-1.jpg') }});">
    <div class="fp__banner_overlay">
        <div class="row banner_slider">
            @foreach ($sliders as $slider)
                <div class="col-12">
                    <div class="fp__banner_slider">
                        <div class=" container">
                            <div class="row">
                                <div class="col-xl-5 col-md-5 col-lg-5">
                                    <div class="fp__banner_img wow fadeInLeft" data-wow-duration="1s">
                                        <div class="img">
                                            <img src="{{ asset($slider->image) }}" alt="food item"
                                                class="img-fluid w-100">
                                            @if ($slider->offer)
                                                {{-- if slider->offer doesnt exist, dont show the offer span --}}
                                                <span> {{ $slider->offer }} off </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-md-7 col-lg-6">
                                    <div class="fp__banner_text wow fadeInRight" data-wow-duration="1s">
                                        <h1>{!! $slider->title !!}</h1> {{-- use {!! instead of {{ because {{ does not render when there's an apostrophe ' --}}
                                        <h3>{!! $slider->sub_title !!}</h3>
                                        <p>{!! $slider->short_description !!}</p>
                                        <ul class="d-flex flex-wrap">
                                            @if ($slider->button_link)

                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
