@extends('../layouts/base')

@section('css')
    @include('../layouts/front_end/css_front_end')
@endsection

@section('body')

    <body>
        <div class="page-wrapper">
            @include('../layouts/front_end/header_front_end')
            @yield('body_main')
            <!-- Footer Area Start -->
            @include('../layouts/front_end/footer_front_end')
            <!-- Footer Area End -->
        </div>
        @include('../layouts/front_end/script_front_end')
    </body>
@endsection
