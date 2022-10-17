@extends('../layouts/front_end/main_front_end')
@section('body_main')
    <!-- Page Banner Start -->
    <section class="page-banner text-white py-165 rpy-130"
        style="background-image: url({{ cms('faq-banner') ? cms('contact-banner') : 'assets/images/banner/banner.jpg' }});">
        <div class="container">
            <div class="banner-inner">
                <h1 class="page-title wow fadeInUp delay-0-2s">Contact Us</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->

    <!-- Contact From Start -->
    <section class="contact-form-area rel z-1 pt-100 rpt-70 pb-130 rpb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <form id="contactForm" class="contact-form rmb-65 wow fadeInLeft delay-0-2s" name="contactForm"
                        action="{{ route('contact-store-front-end') }}" method="post">
                        @csrf
                        <div class="section-title contact-title mb-55">
                            <span class="sub-title mb-15">Contact With Us</span>
                            <h3>Send Us Message</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="h4 text-left text-danger">
                                        @foreach ($errors->messages() as $item)
                                            {{ $item[0] }} <br>
                                        @endforeach
                                    </div>
                                @endif
                                @if (Session::has('message'))
                                    <div class="h4 text-left text-primary">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="name" name="name" class="form-control" value=""
                                        placeholder="Full Name" required="" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="phone" name="phone" class="form-control" value=""
                                        placeholder="Phone Number" required="" required
                                        data-error="Please enter your Phone Number">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="email" name="email" class="form-control" value=""
                                        placeholder="Email" required="" required data-error="Please enter your Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="subject" id="subject" name="subject" class="form-control" value=""
                                        placeholder="Subject" required="" required
                                        data-error="Please enter your subject">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Write Message" required=""
                                        required data-error="Please enter your Message"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <button type="submit" class="theme-btn style-two">Send Message<i
                                            class="fas fa-angle-double-right"></i></button>
                                    <div id="msgSubmit" class="hidden"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="contact-right-image wow fadeInRight delay-0-4s">
                        <img class="bg" src="{{ cms('contact-img') }}" alt="Contact From BG">
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-shapes">
            <img class="leaf" src="assets/images/shapes/leaf-1.png" alt="Leaf">
            <img class="shape" src="assets/images/shapes/contact-shape.png" alt="Shape">
            <img class="two-leaf" src="assets/images/shapes/two-lear.png" alt="Leaf">
        </div>
    </section>
    <!-- Contact From End -->
@endsection
@section('script')
    <script>
        function search() {
            location.href = "{{ route('menu-front-end') }}?param=" + $('#filter-search').val();
        }
    </script>
@endsection
