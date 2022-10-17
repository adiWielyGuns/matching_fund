@extends('../layouts/front_end/main_front_end')
@section('body_main')
    <!-- Page Banner Start -->
    <section class="page-banner text-white py-165 rpy-130"
        style="background-image: url({{ cms('menu-banner') ? cms('faq-banner') : 'assets/images/banner/banner.jpg' }});">
        <div class="container">
            <div class="banner-inner">
                <h1 class="page-title wow fadeInUp delay-0-2s">Menu</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->


    <!-- Shop Page Section Start -->
    <section class="shop-page rel z-1 pt-65 rpt-35 pb-130 rpb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-8">
                    <div class="shop-sidebar mt-65">
                        <div class="widget widget-search wow fadeInUp delay-0-2s">
                            <form action="#" onsubmit="search(); return false;" method="GET">
                                <input type="text" id="filter-search" placeholder="Search keywords" required>
                                <button type="submit" class="searchbutton fa fa-search" onclick="search()"></button>
                            </form>
                        </div>
                        <div class="widget widget-menu wow fadeInUp delay-0-4s">
                            <h4 class="widget-title"><i class="flaticon-leaf-1"></i>Category</h4>
                            <ul>
                                @foreach ($category as $item)
                                    <li>
                                        <a href="{{ route('menu-front-end') }}?category_id={{ $item->id }}">
                                            {{ $item->name }}
                                        </a>
                                        <span>({{ $item->master_menu->where('status', 1)->count() }})</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('menu-front-end') }}" class="theme-btn mt-3" style="width: 100%">
                                Reset Filter
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 mt-55">
                    <div class="row">
                        @foreach ($menu as $item)
                            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                                <div class="product-item wow fadeInUp delay-0-4s">
                                    <div class="image">
                                        <img src="{{ $item->image }}" style="border-radius: 10%;object-fit: cover"
                                            width="200" height="200" alt="Product">
                                    </div>
                                    <div class="content mt-3">
                                        <h5><a href="{{ url('menu') }}/{{ $item->slug }}">{{ $item->name }}</a></h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <ul class="pagination flex-wrap justify-content-center pt-10">
                        @if ($menu->previousPageUrl())
                            <li class="page-item">
                                <a class="page-link" href="{{ $menu->previousPageUrl() }}" style="border-radius: 100%">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                            </li>
                        @endif

                        @for ($i = 0; $i < $menu->lastPage(); $i++)
                            @if ($i + 1 == $menu->currentPage())
                                <li class="page-item {{ $i + 1 == $menu->currentPage() ? 'active' : '' }}">
                                    <span class="page-link">
                                        {{ $i + 1 }}
                                        @if ($i + 1 == $menu->currentPage())
                                            <span class="sr-only">(current)</span>
                                        @endif
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $menu->url($i + 1) }}">{{ $i + 1 }}</a>
                                </li>
                            @endif
                        @endfor
                        @if ($menu->nextPageUrl())
                            <li class="page-item">
                                <a class="page-link" href="{{ $menu->nextPageUrl() }}">
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
            </div>
        </div>
    </section>
    <!-- Shop Page Section End -->
@endsection
@section('script')
    <script>
        function search() {
            location.href = "{{ route('menu-front-end') }}?param=" + $('#filter-search').val();
        }
    </script>
@endsection
