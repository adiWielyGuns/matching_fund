@extends('../layouts/base')

@section('css')
    @include('../layouts/cms/css_cms')
@endsection

@section('body')

    <body class="fixed-left">
        <div class="loading style-2" id="loading">
            <div class="spinner spinner-loading"></div>
        </div>
        <div id="preloader">
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>
        <div id="wrapper">
            @include('../layouts/cms/side_menu_cms')
            <div class="content-page">
                <div class="content">
                    @include('../layouts/cms/top_bar_cms')
                    <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            @yield('body_main')
                        </div>
                    </div>
                </div>
                @include('../layouts/cms/footer_cms')
            </div>
        </div>
        @include('../layouts/cms/script_cms')
    </body>
@endsection
