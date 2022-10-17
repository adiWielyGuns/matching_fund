@extends('../layouts/front_end/main_front_end')
@section('body_main')
    <!-- Slider Section Start -->
    <section class="slider-section bg-lighter">
        <div class="main-slider-active">
            <div class="slider-single-item slide-one">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="slider-content">
                                <div class="sub-title mb-20">Welcome to Pravara Healthy Catering</div>
                                <h1>Makanan Catering Sehat</h1>
                                <h6>Weight Loss Healthy Lunch, Free delivery untuk kota malang</h6>
                                <div class="slider-btns mt-30">
                                    <a href="{{ route('menu-front-end') }}" class="theme-btn">Lihat Menu <i
                                            class="fas fa-angle-double-right"></i></a>
                                    {{-- <a href="about.html" class="theme-btn style-two">Learn More <i
                                            class="fas fa-angle-double-right"></i></a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="slider-images">
                                <img class="image" src="{{ asset('assets/images/slider/slider-image1.png') }}"
                                    alt="Slider">
                                <img class="offer" src="{{ asset('assets/images/shapes/organic.png') }}" alt="Organic">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-shapes">
                    <img class="pumpkin-shape" src="{{ asset('assets/images/slider/pumpkin.png') }}" alt="Pumpkin">
                    <img class="two-leaf" src="{{ asset('assets/images/slider/two-lear.png') }}" alt="Leaf">
                    <img class="half-leaf" src="{{ asset('assets/images/slider/half-leaf.png') }}" alt="Leaf">
                    <img class="leaf-one" src="{{ asset('assets/images/slider/leaf-1.png') }}" alt="Leaf">
                    <img class="leaf-two" src="{{ asset('assets/images/slider/leaf-2.png') }}" alt="Leaf">
                </div>
            </div>
            <div class="slider-single-item slide-two">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="slider-images">
                                <img class="image" src="assets/images/slider/slider-image2.png" alt="Slider">
                                <img class="offer" src="assets/images/shapes/organic.png" alt="Organic">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="slider-content">
                                <div class="sub-title mb-20">Welcome to Pravara Healthy Catering</div>
                                <h1>Makanan Catering Sehat</h1>
                                <h6>Weight Loss Healthy Lunch, Free delivery untuk kota malang</h6>
                                <div class="slider-btns mt-30">
                                    <a href="{{ route('menu-front-end') }}" class="theme-btn">Lihat Menu <i
                                            class="fas fa-angle-double-right"></i></a>
                                    {{-- <a href="about.html" class="theme-btn style-two">Learn More <i
                                            class="fas fa-angle-double-right"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-shapes">
                    <img class="pumpkin-shape" src="{{ asset('assets/images/slider/pumpkin.png') }}" alt="Pumpkin">
                    <img class="two-leaf" src="{{ asset('assets/images/slider/two-lear.png') }}" alt="Leaf">
                    <img class="half-leaf" src="{{ asset('assets/images/slider/half-leaf.png') }}" alt="Leaf">
                    <img class="leaf-one" src="{{ asset('assets/images/slider/leaf-1.png') }}" alt="Leaf">
                    <img class="leaf-two" src="{{ asset('assets/images/slider/leaf-2.png') }}" alt="Leaf">
                </div>
            </div>
        </div>
        <img class="bg-leaf" src="{{ asset('assets/images/slider/slider-bg-leaf.png') }}" alt="Shape">
        <img class="bg-shape" src="{{ asset('assets/images/slider/slider-bg-shape.png') }}" alt="Shape">
    </section>
    <!-- Slider Section End -->

    <!-- Category Section Start -->
    <section class="category-section pt-130 rpt-100">
        <div class="container">
            <div class="row align-items-end pb-35">
                <div class="col-lg-7 wow fadeInUp delay-0-2s">
                    <div class="section-title mb-20">
                        <span class="sub-title mb-20">Kategori Makanan Kami</span>
                        <h2>Quality Foods And Beverage</h2>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInUp delay-0-4s">
                    <div class="text mb-20">
                        <p>
                            Kami menyediakan makanan lebih dari 30 makanan sehat sesuai kebutuhan diet anda yang terjadwal
                            setiap minggu.
                        </p>
                    </div>
                </div>
            </div>
            <div class="category-wrap">
                @foreach ($category as $item)
                    <div class="category-item wow fadeInUp delay-0-3s">
                        <div class="icon">
                            <img style="object-fit: cover;border-radius: 100%" width="100" height="100"
                                src="{{ $item->image }}" alt="Icon">
                        </div>
                        <h5><a
                                href="{{ route('menu-front-end') }}?category_id={{ $item->id }}">{{ $item->name }}</a>
                        </h5>
                        <img src="assets/images/category/arrow.png" alt="Arrow">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Favorite food Section -->
    <section class="product-section pt-100 rpt-70 pb-130 rpb-100">
        <div class="container-fluid">
            <div class="section-title text-center mb-60">
                <span class="sub-title mb-20">Makanan Populer Minggu Ini</span>
                <h2>Quality Healthy Food For Your Diet</h2>
            </div>
            <div class="product-active">
                @foreach ($favorite as $item)
                    <div class="product-item wow fadeInUp delay-0-2s">
                        <div class="image">
                            <img src="{{ $item->image }}" style="border-radius: 10%;object-fit: cover" width="200"
                                height="200" alt="Product">
                        </div>
                        <div class="content">
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h5><a href="product-details.html">{{ $item->name }}</a></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->


    <!-- Video Area Start -->
    <div class="video-area">
        <div class="container">
            <div class="video-inner wow fadeInUp delay-0-2s"
                style="background-image: url(assets/images/video/video-bg.jpg);">
                <i class="flaticon-leaf-1"></i>
                <span class="video-text">Watch Videos</span>
                <a href="{{ cms('home-video') }}" class="mfp-iframe video-play"><i class="fas fa-play"></i></a>
            </div>
        </div>
    </div>
    <!-- Video Area End -->


    <!-- Special Offer Start -->
    <section class="special-offer bg-lighter pt-250 pb-80">
        <div class="special-offer-content text-center py-130 rpy-100 wow fadeInUp delay-0-2s">
            <div class="section-title mb-30">
                <span class="sub-title mb-20">Our Offer For You</span>
                <h2>Gratis pengantaran untuk wilayah malang dan sekitarnya</h2>
            </div>
            <p>Kami akan mengantarkan catering anda gratis dengan syarat dan ketentuan berlaku</p>
            {{-- <ul class="count-down mt-35" data-date="Jul 31, 2022 00:00:00">
                <li><span id="days">09</span>days</li>
                <li><span id="hours">45</span>Hours</li>
                <li><span id="minutes">36</span>Minutes</li>
                <li><span id="seconds">28</span>Seconds</li>
            </ul> --}}
            <div class="count-down-btns mt-10">
                <a href="{{ route('menu-front-end') }}" class="theme-btn">Lihat Menu <i
                        class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
        <img class="offer-bg" src="assets/images/offers/special-offer-bg.png" alt="Offer BG">
        <img class="munakoiso" src="assets/images/shapes/munakoiso.png" alt="Munakoiso">
        <img class="litchi" src="assets/images/shapes/litchi.png" alt="Litchi">
        <img class="special-offer-left" src="assets/images/offers/offer-left.png" alt="Offer">
        <img class="special-offer-right" src="assets/images/offers/offer-right.png" alt="Offer">
    </section>
    <!-- Special Offer End -->


    <!-- Call To Action Area Start -->
    <section class="cta-area">
        <div class="container">
            <div class="cta-inner overlay text-white wow fadeInUp delay-0-2s"
                style="background-image: url(assets/images/background/cta-bg.jpg);">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="section-title mt-20 mb-15">
                            <span class="sub-title mb-15">Butuh Bantuan</span>
                            <h3>Untuk Pemesanan Catering</h3>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-right">
                        <a href="{{ route('contact-front-end') }}" class="theme-btn btn-white my-15">Get In Touch <i
                                class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Area End -->


    <!-- Gallery Area Start -->
    <section class="gallery-area pt-130 rpt-100">
        <div class="container">
            <div class="gallery-header mb-35">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="section-title mb-25">
                            <span class="sub-title mb-15">Photo Gallery</span>
                            <h2>Insite Photo Gallery</h2>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-right">
                        <div class="slider-arrows mb-25">
                            <button class="gallery-prev"><i class="fas fa-arrow-left"></i></button>
                            <button class="gallery-next"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="gallery-active">
                @foreach ($gallery as $key => $item)
                    <div class="gallery-item wow fadeInUp delay-0-{{ 2 + $key * 2 }}s">
                        <img src="{{ $item->image }}" height="436" alt="Gallery">
                        <div class="gallery-over">
                            <div class="content">
                                <h4>{{ $item->title }}</h4>
                                <p>Fresh Food</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Gallery Area End -->

    <!-- News Section Start -->
    <section class="news-section pt-130 rpt-100 pb-70 rpb-40">
        <div class="container">
            <div class="section-title text-center mb-60">
                <span class="sub-title mb-20">Read Article Tips</span>
                <h2>Latest News & Blog</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($blog as $item)
                    <div class="col-xl-4 col-md-6">
                        <div class="news-item wow fadeInUp delay-0-2s">
                            <div class="image">
                                <img src="{{ $item->image }}" style="object-fit: cover;border-radius: 5%"
                                    height="300" alt="News">
                                <span class="date"><b>{{ CarbonParse($item->created_at, 'd') }}</b>
                                    {{ CarbonParse($item->created_at, 'F') }}</span>
                            </div>
                            <div class="content">
                                <span class="sub-title"></span>
                                <h4><a href="{{ route('blog-front-end') }}/{{ $item->slug }}">{{ $item->title }}</a></h4>
                                <a href="{{ route('blog-front-end') }}/{{ $item->slug }}" class="read-more">Read More <i
                                        class="fas fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="news-shapes">
            <img class="onion" src="assets/images/shapes/onion.png" alt="Onion">
            <img class="two-leaf" src="assets/images/slider/two-lear.png" alt="Leaf">
            <img class="half-leaf" src="assets/images/slider/half-leaf.png" alt="Leaf">
            <img class="leaf-two" src="assets/images/shapes/leaf-three.png" alt="Leaf">
            <img class="leaf-three" src="assets/images/shapes/leaf-four.png" alt="Leaf">
        </div>
    </section>
    <!-- News Section End -->


    <!-- Client Logo Section Start -->
    <div class="client-logo-section text-center bg-light-green py-60">
        <div class="container">
            <div class="client-logo-wrap">
                <div class="client-logo-item">
                    <a href="#"><img src="assets/images/client-logo/client-logo1.png" alt="Client Logo"></a>
                </div>
            </div>
        </div>
        <div class="client-logo-shapes">
            <img class="shape-one" src="assets/images/shapes/cl-shape1.png" alt="Shape">
            <img class="shape-two" src="assets/images/shapes/cl-shape2.png" alt="Shape">
            <img class="shape-three" src="assets/images/shapes/cl-shape3.png" alt="Shape">
            <img class="shape-four" src="assets/images/shapes/cl-shape4.png" alt="Shape">
            <img class="shape-five" src="assets/images/shapes/cl-shape5.png" alt="Shape">
            <img class="shape-six" src="assets/images/shapes/cl-shape6.png" alt="Shape">
        </div>
    </div>
    <!-- Client Logo Section End -->
@endsection
