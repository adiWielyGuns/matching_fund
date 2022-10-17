@extends('../layouts/front_end/main_front_end')
@section('body_main')
    <!-- Page Banner Start -->
    <section class="page-banner text-white py-165 rpy-130"
        style="background-image: url({{ cms('prduct-banner') ? cms('prduct-banner') : asset('assets/images/banner/banner.jpg') }});">
        <div class="container">
            <div class="banner-inner">
                <h1 class="page-title wow fadeInUp delay-0-2s">{{ $menu->name }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                        <li class="breadcrumb-item active">{{ $menu->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->
    <!-- Product Details Start -->
    <section class="product-details-area pt-130 rpt-100">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="rounded rmb-55 wow fadeInLeft delay-0-2s" style="display: flex;justify-content: center">
                        <a href="{{ $menu->image }}">
                            <img src="{{ $menu->image }}" alt="Preview" height="400"
                                style="border-radius: 10%;object-fit: cover">
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="product-details-content mb-30 wow fadeInRight delay-0-2s">
                        <div class="off-ratting mb-15">
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="section-title mb-20">
                            <h2>{{ $menu->name }}</h2>
                        </div>
                        <div class="shoping-cart-total mt-45">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Bento Mealbox</td>
                                        <th>Rp. {{ number_format($menu->price_bento_mealbox) }}</th>
                                    </tr>
                                    <tr>
                                        <td>Value Box</td>
                                        <th>Rp. {{ number_format($menu->price_value_box) }}</th>
                                    </tr>
                                    <tr>
                                        <td>Family Pack</td>
                                        <th>Rp. {{ number_format($menu->price_family_pack) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="menu-widget one-column">
                            <ul>
                                <li><a href="javascript:;">Lauk pendamping dapat berbeda pada setiap pesanan</a></li>
                                <li><a href="javascript:;">Minimum pemesanan 5 box untuk bento mealbox atau valuebox</a>
                                </li>
                                <li><a href="javascript:;">Maksimal pemesanan H-1</a></li>
                            </ul>

                        </div>
                        <hr>
                        <p>
                            Pastikan menu yang Anda ingin pesan sesuai jadwal yang telah kami tetapkan. Lihat jadwal
                            menu <a href="{{ route('schedule-front-end') }}">disini</a>.

                        </p>
                        <hr>
                        <p>
                            Untuk pertanyaan dan pemesanan silahkan hubungi Whatsapp Customer Care kami di
                            <i class="fab fa-whatsapp" style="color: green"></i>
                            <a class="qlwapp-toggle" data-action="open" data-phone="{{ cms('telphone') }}"
                                data-message="Halo Homade catering,"
                                href="https://web.whatsapp.com/send?phone={{ cms('telphone') }}&amp;text=Halo Pravara healthy catering,"
                                target="_blank">
                                {{ cms('telphone') }}
                            </a>,
                            Senin-Jumat 9:00-17:00 WIB
                        </p>
                        <hr>
                        <ul class="category-tags">
                            <li>
                                <b>Category</b>
                                <span>:</span>
                                <a href="#">{{ $menu->category->name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details End -->
@endsection
@section('script')
    <script>
        function search() {
            location.href = "{{ route('menu-front-end') }}?param=" + $('#filter-search').val();
        }
    </script>
@endsection
