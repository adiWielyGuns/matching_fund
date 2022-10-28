{{-- @extends('../layouts/cms/main_cms') --}}
@include('../layouts/cms/css_cms')
@extends('../layouts/base')

<form id="form-data" onkeydown="return event.key != 'Enter';">
    @csrf

    <input type="hidden" class="method_payment" name="method_payment">

    <body class="fixed-left " style="overflow:scroll">
        <div class="loading style-2" id="loading">
            <div class="spinner spinner-loading"></div>
        </div>
        <div id="preloader">
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>
        <div id="wrapper" style="overflow:auto">
            <div style="padding: 20px">
                <div class="content">
                    <div class="page-content-wrapper ">
                        <div class="container-fluid">

                            {{-- @section('body_main') --}}
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a
                                                        href="#">{{ convertSlug(Request::segment(1)) }}</a></li>
                                                <li class="breadcrumb-item"><a
                                                        href="#">{{ convertSlug(Request::segment(2)) }}</a></li>
                                                <li class="breadcrumb-item active">
                                                    {{ convertSlug(Request::segment(3)) }}
                                                </li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">{{ convertSlug(Request::segment(3)) }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-lg mt-2">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn btn-primary"><i
                                                    class="fas fa-search"></i></button>
                                        </span>
                                        <input type="text" id="example-input1-group2" name="example-input1-group2"
                                            class="form-control" placeholder="Cari Bedasarkan Nama.."
                                            onkeyup="filterOrder()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            <br>

                            <div class="page-content-wrapper dropHereResult">
                                <div class="row">
                                    @foreach ($data as $item)
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                            <div class="card" {{-- @if ($item->belumBayarTotal > 0)
                                                style="border:2px solid #f96e5b"
                                            @else
                                                style="border:2px solid #775fd5"
                                            @endif --}}>
                                                <div class="card-body col-12">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <button type="button"
                                                                class="btn btn-danger btn-circle btn-xl">
                                                                {{ $item->order->table->name }}
                                                            </button>
                                                        </div>
                                                        <div class="col-10">
                                                            <div class="row">
                                                                <div class="col-7">

                                                                    <div style="padding-left: 45px">
                                                                        <input type="text"
                                                                            value="{{ $item->master_menu->name }}"
                                                                            disabled
                                                                            style="border: none;font-size:20px;font-weight:bold;background-color:transparent">
                                                                        {{-- <b
                                                                            style="font-size: 20px"></b> --}}
                                                                        <br>
                                                                        <input type="text" disabled
                                                                            value="{{ $item->order->name }}"
                                                                            style="border: none;font-size:15px;background-color:transparent">

                                                                        <b style="font-size: 18px">
                                                                            {{ date('H:i', strtotime($item->created_at)) }}</b>

                                                                    </div>
                                                                </div>
                                                                <div class="col-5">

                                                                    <h5 class="float-right"
                                                                        style="
                                                                    margin-top: 58px;">
                                                                        {{ $item->qty }}</h5>
                                                                    <h3 class="card-title mt-0 mb-0">
                                                                        {{-- <br> --}}
                                                                        {{-- <span class="float-right" style="padding-top: 15px">
                                                                        @if ($item->status == 'Not Paid')
                                                                            Belum Bayar
                                                                        @else
                                                                            Terbayar
                                                                        @endif
                                                                    </span> --}}
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer bg-white">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <b style="padding-top: 3px" onclick="openDetail()">REF
                                                                #{{ $item->order->kode }} </b>
                                                        </div>
                                                        <div class="col-6 ">
                                                            <button type="button"
                                                                class="btn
                                                                {{-- @if ($item->belumBayarTotal > 0) --}}
                                                                    btn-outline-danger
                                                                {{-- @else --}}
                                                                    btn-outline-purple
                                                                {{-- @endif --}}
                                                                btn-round
                                                                waves-effect waves-light float-right detail-data"
                                                                onclick="checkDetail('{{ $item->id }}','{{ $item->order->id }}')">Selesai</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            {{-- @endsection --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('../layouts/cms/script_cms')
    </body>
</form>

@section('script')
    <style>
        .btn-circle.btn-xl {
            width: 80px;
            height: 80px;
            border-radius: 100px;
            font-size: 20px;
            line-height: 1.33;
        }

        .btn-circle {
            width: 70px;
            height: 70px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 40px !important;
            line-height: 1.42857;
        }
    </style>
    <script>
        $('.mask').maskMoney({
            precision: 0,
            thousands: ',',
            allowZero: true,
            defaultZero: true,
        })

        function checkDetail(params, params2) {
            var id = params;
            var dt = params2;
            $.ajax({
                url: '{{ route('store-update-status-menu') }}',
                data: {
                    id,
                    dt
                },
                type: 'get',
                success: function(data) {
                    filterOrder();
                    alert(data.message);
                }
            });
        }

        channel.bind('cashier', function(data) {
            console.log('teasdad')
            filterOrder();
        });


        function filterOrder() {
            var param = $('#example-input1-group2').val();
            console.log(param)
            $.ajax({
                url: '{{ route('update-status-menu-load-data') }}',
                data: {
                    id: param,
                },
                type: 'get',
                success: function(data) {
                    $('.dropHereResult').html(data);
                }
            });
        }
    </script>
@endsection
