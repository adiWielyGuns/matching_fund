@extends('../layouts/front_end/main_front_end')
@section('body_main')
    <!-- Page Banner Start -->
    <section class="page-banner text-white py-165 rpy-130"
        style="background-image: url({{ cms('faq-banner') ? cms('faq-banner') : 'assets/images/banner/banner.jpg' }});">
        <div class="container">
            <div class="banner-inner">
                <h1 class="page-title wow fadeInUp delay-0-2s">FAQs</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">FAQs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->
    <!-- FAQs Section Start -->
    <section class="faq-section rel z-1 pt-130 rpt-100">
        <div class="container">
            <div class="section-title text-center mb-60">
                <span class="sub-title mb-20">Asked Questions</span>
                <h2>Have any Questions</h2>
            </div>
            <div class="faqs wow fadeInUp delay-0-2s" id="faqs">
                @foreach ($faq as $key => $item)
                    <div class="card">
                        <h5 class="collapsed card-header" data-toggle="collapse" data-target="#collapse{{ $key }}"
                            aria-expanded="false" aria-controls="collapse{{ $key }}">{{ $item->title }}<i
                                class="fas fa-chevron-right"></i>
                        </h5>
                        <div id="collapse{{ $key }}" class="collapse content {{ $key == 0 ? 'show' : '' }}"
                            data-parent="#faqs">
                            <div class="card-body">
                                <p>
                                    {!! $item->content !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="faq-shapes">
            <img class="shape-one" src="assets/images/shapes/faq-shape1.png" alt="Shape">
            <img class="shape-two" src="assets/images/shapes/faq-shape2.png" alt="Shape">
            <img class="shape-three" src="assets/images/shapes/faq-shape3.png" alt="Shape">
            <img class="shape-four" src="assets/images/shapes/faq-shape4.png" alt="Shape">
        </div>
    </section>
    <!-- FAQs Section End -->
@endsection
@section('script')
    <script>
        function search() {
            location.href = "{{ route('menu-front-end') }}?param=" + $('#filter-search').val();
        }
    </script>
@endsection
