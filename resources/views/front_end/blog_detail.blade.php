@extends('../layouts/front_end/main_front_end')
@section('body_main')
    <!-- Page Banner Start -->
    <section class="page-banner text-white py-165 rpy-130"
        style="background-image: url({{ cms('blog-banner') ? cms('blog-banner') : asset('assets/images/banner/banner.jpg') }});">
        <div class="container">
            <div class="banner-inner">
                <h1 class="page-title wow fadeInUp delay-0-2s">{{ $blog->title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="index.html">Blog</a></li>
                        <li class="breadcrumb-item active">{{ $blog->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->
    <!-- News Section Start -->
    <section class="news-details-page rel z-1 pt-65 rpt-35 pb-130 rpb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mt-65">
                    <div class="blog-details-content">
                        <ul class="blog-meta">
                            <li>
                                <i class="far fa-calendar-alt"></i>
                                <a href="#">{{ CarbonParse($blog->created_at,'l, F Y') }}</a>
                            </li>
                        </ul>
                        <h3 class="title">{{ $blog->title }}</h3>
                        <div class="image my-35">
                            <img src="{{ $blog->image }}" alt="Blog">
                        </div>
                        {!! $blog->content !!}
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-8">
                    <div class="blog-sidebar mt-65">
                        <div class="widget widget-news wow fadeInUp delay-0-2s">
                            <h4 class="widget-title"><i class="flaticon-leaf-1"></i>Recent News</h4>
                            <ul>
                                @foreach ($new as $item)
                                    <li class="d-flex">
                                        <div class="image">
                                            <img src="{{ $item->image }}" alt="News">
                                        </div>
                                        <div class="content">
                                            <h6><a
                                                    href="{{ route('blog-front-end') }}/{{ $item->slug }}">{{ $item->title }}</a>
                                            </h6>
                                            <span class="name">By {{ $item->created_by }}</span>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News Section End -->
@endsection
@section('script')
    <script>
        function search() {
            location.href = "{{ route('blog-front-end') }}?param=" + $('#filter-search').val();
        }
    </script>
@endsection
