@extends('../layouts/base')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/cms/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/cms/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/cms/css/style.css') }}">
@endsection
@section('body')

    <body class="fixed-left">

        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <div class="text-center m-b-15">
                        <a href="index.html" class="logo logo-admin"><img src="{{ cms('logo') }}"
                                height="50" alt="logo"></a>
                    </div>

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                            @csrf
                            @if ($errors->has('email'))
                                <div class="form-group row">
                                    <div class="col-12">
                                        <h5 class="text-danger">Email atau password yang anda masukkan salah</h5>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="text" required="" value="{{ old('email') }}"
                                        placeholder="Email" name="email" id="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" required="" value=""
                                        placeholder="Password" name="password">
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-danger btn-block waves-effect waves-light"
                                        type="submit">{{ _('Login') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- jQuery  -->
        <script src="{{ asset('assets/cms/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/cms/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/cms/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/cms/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/cms/js/detect.js') }}"></script>
        <script src="{{ asset('assets/cms/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/cms/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/cms/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/cms/js/waves.js') }}"></script>
        <script src="{{ asset('assets/cms/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('assets/cms/js/jquery.scrollTo.min.js') }}"></script>


        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
@endsection
