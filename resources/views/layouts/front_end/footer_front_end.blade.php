<footer class="main-footer bg-green text-white">
    <div class="container">
        <div class="row justify-content-center py-40 ">
            <div class="col-lg-4 col-md-6 order-md-2">
                <div class="footer-widget about-widget text-center">
                    <div class="footer-logo mb-30">
                        <a href="index.html">
                            <img src="{{ cms('logo') }}" alt="Logo">
                        </a>
                    </div>
                    <p>{!! cms('footer-description') !!}</p>
                    <div class="social-style-two pt-10">
                        <a href="{{ cms('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ cms('twitter') }}"><i class="fab fa-twitter"></i></a>
                        <a href="{{ cms('instagram') }}"><i class="fab fa-linkedin-in"></i></a>
                        <a href="{{ cms('youtube') }}"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 order-md-1">
                <div class="footer-widget menu-widget two-column">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul>
                        <li><a href="{{ route('blog-front-end') }}">Blog</a></li>
                        <li><a href="{{ route('menu-front-end') }}">Menu</a></li>
                        <li><a href="{{ route('schedule-front-end') }}">Schedule</a></li>
                        <li><a href="{{ route('contact-front-end') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 order-md-3">
                <div class="footer-widget contact-widget">
                    <h4 class="footer-title">Contact Us</h4>
                    <p>Lebih dekat dengan kita </p>
                    <ul>
                        <li>
                            <i class="fal fa-map-marker-alt"></i>
                            {!! cms('address') !!}
                        </li>
                        <li>
                            <i class="far fa-envelope"></i>
                            <a href="mailto:pravarahealthycatering@gmail.com">{{ cms('email') }}</a>
                        </li>
                        <li>
                            <i class="far fa-phone"></i>
                            <a href="calto:+012(345)67899">{{ cms('telphone') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright-area pt-25 pb-10">
            <p>Copyright © 2022 Pravara Healthy Catering All Rights Reserved.</p>
            <ul class="footer-menu">
                <li><a href="faqs.html">Faqs</a></li>
            </ul>

            <!-- Scroll Top Button -->
            <button class="scroll-top scroll-to-target" data-target="html"><span
                    class="fas fa-angle-double-up"></span></button>
        </div>
    </div>
    <div class="footer-shapes">
        <img class="footer-bg" src="{{ asset('assets/images/background/footer-bg-shape.png') }}" alt="Shape">
        <img class="shape-one" src="{{ asset('assets/images/shapes/footer1.png') }}" alt="Shape">
        <img class="shape-two" src="{{ asset('assets/images/shapes/footer2.png') }}" alt="Shape">
        <img class="shape-three" src="{{ asset('assets/images/shapes/footer3.png') }}" alt="Shape">
        <img class="shape-four" src="{{ asset('assets/images/shapes/footer4.png') }}" alt="Shape">
    </div>
</footer>
