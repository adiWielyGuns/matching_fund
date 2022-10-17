@extends('../layouts/front_end/main_front_end')
@section('body_main')
    <!-- Page Banner Start -->
    <section class="page-banner text-white py-165 rpy-130"
        style="background-image: url({{ cms('blog-banner') ? cms('blog-banner') : 'assets/images/banner/banner.jpg' }});">
        <div class="container">
            <div class="banner-inner">
                <h1 class="page-title wow fadeInUp delay-0-2s">Blog</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->
    <!-- News Section Start -->
    <section class="news-page-section rel z-1 py-130 rpy-100">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($blog as $item)
                    <div class="col-xl-4 col-md-6">
                        <div class="news-item wow fadeInUp delay-0-2s">
                            <div class="image">
                                <img src="{{ $item->image }}" style="object-fit: cover;border-radius: 5%" height="300"
                                    alt="News">
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
            <ul class="pagination flex-wrap justify-content-center pt-10">
                @if ($blog->previousPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $blog->previousPageUrl() }}" style="border-radius: 100%">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                    </li>
                @endif

                @for ($i = 0; $i < $blog->lastPage(); $i++)
                    @if ($i + 1 == $blog->currentPage())
                        <li class="page-item {{ $i + 1 == $blog->currentPage() ? 'active' : '' }}">
                            <span class="page-link">
                                {{ $i + 1 }}
                                @if ($i + 1 == $blog->currentPage())
                                    <span class="sr-only">(current)</span>
                                @endif
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $blog->url($i + 1) }}">{{ $i + 1 }}</a>
                        </li>
                    @endif
                @endfor
                @if ($blog->nextPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $blog->nextPageUrl() }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                    </li>
                @endif
            </ul>
        </div>
        <div class="news-shapes">
            <img class="onion" src="assets/images/shapes/onion.png" alt="Onion">
            <img class="two-leaf" src="assets/images/slider/two-lear.png" alt="Leaf">
            <img class="leaf-left" src="assets/images/shapes/leaf-three.png" alt="Leaf">
            <img class="leaf-two" src="assets/images/shapes/leaf-three.png" alt="Leaf">
            <img class="leaf-three" src="assets/images/shapes/leaf-1.png" alt="Leaf">
            <img class="litchi" src="assets/images/shapes/litchi.png" alt="Litchi">
        </div>
    </section>
    <!-- News Section End -->
@endsection
@section('script')
    <script>
        function search() {
            location.href = "{{ route('menu-front-end') }}?param=" + $('#filter-search').val();
        }
    </script>
@endsection
