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
                                            class="form-control" placeholder="Cari Bedasarkan Nama.." onkeyup="filterOrder()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            <br>

                            <div class="page-content-wrapper dropHereResult">
                                <div class="row">
                                    @foreach ($data as $item)
                                        <div class="col-md-6 col-lg-6 col-xl-3">
                                            <div class="card" 
                                            @if ($item->belumBayarTotal > 0)
                                                style="border:2px solid #f96e5b"
                                            @else
                                                style="border:2px solid #775fd5"
                                            @endif
                                            >
                                                <div class="card-body col-12">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <button type="button"
                                                                class="btn btn-danger btn-circle btn-xl">
                                                                {{ $item->table->name }}
                                                            </button>
                                                        </div>
                                                        <div class="col-10">
                                                            <div class="row">
                                                                <div class="col-7">

                                                                    <div style="padding-left: 35px">

                                                                        <b
                                                                            style="font-size: 20px">{{ $item->name }}</b>
                                                                        <br>
                                                                        <p style="font-size: 15px;margin-bottom:5px">
                                                                            {{ $item->telpon }}</p>
                                                                        <b style="font-size: 15px">Jam :
                                                                            {{ date('H:i', strtotime($item->created_at)) }}</b>

                                                                    </div>
                                                                </div>
                                                                <div class="col-5">

                                                                    <h5 class="float-right">Rp.
                                                                        {{ number_format($item->total_price) }}</h5>
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
                                                            <h6 style="padding-top: 3px" onclick="openDetail()">REF
                                                                #{{ $item->kode }} </h6>
                                                        </div>
                                                        <div class="col-6 ">
                                                            <button type="button"
                                                                class="btn 
                                                                @if ($item->belumBayarTotal > 0)
                                                                    btn-outline-danger
                                                                @else
                                                                    btn-outline-purple
                                                                @endif
                                                                btn-round 
                                                                waves-effect waves-light float-right detail-data"
                                                                onclick="checkDetail('{{ $item->id }}','{{ $item->belumBayarTotal }}')">Detail
                                                                Pesanan</button>
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
    @include('transaction.cashier.modalDetail')
    @include('transaction.cashier.modalMethodPayment')
    @include('transaction.cashier.modalMethodPaymentCash')
    @include('transaction.cashier.modalMethodPaymentTransfer')
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

        function checkDetail(params,params2) {
            console.log(params,params2);
            if (params2 > 0) {
                $('.btnMethodPayment').css('display','block');
            } else {
                $('.btnMethodPayment').css('display','none');
            }
            var id = params;
            $.ajax({
                url: '{{ route('get-data-detail') }}',
                data: {
                    id,
                },
                type: 'get',
                success: function(data) {
                    $('.dropTable').empty();
                    $('.dropTablePaid').empty();
                    $('.dropRef').html('#' + data.data.kode);
                    $('.dropNama').html(data.data.name);
                    $('.dropTlp').html(data.data.telpon);
                    $('.dropJumlah').html(data.data.pax);
                    $('.dropMeja').html(data.data.table.name);
                    $('.dropHarga').html('Rp. ' + parseInt(data.data.total_price).toLocaleString(
                        'en-US'));

                    $('#id').val(data.data.id);
                    $('#ref').val(data.data.kode);

                    var index1 = 1;
                    var totalPembayaran = 0;
                    $.each(data.data.order_detail, function(index, value) {
                        if (value.status == 'Menunggu Pembayaran') {
                            totalPembayaran += value.sub_total;
                            $('.dropTable').append(
                                '<tr>' +
                                '<td>' + (index1++) + '</td>' +
                                '<td>' + 'Rp. ' + parseInt(value.price).toLocaleString(
                                    'en-US') + '</td>' +
                                '<td>' + value.qty + '</td>' +
                                '<td>' + 'Rp. ' + parseInt(value.sub_total).toLocaleString(
                                    'en-US') + '</td>' +
                                '<td>' + value.master_menu.name + '</td>' +
                                '<td>' + value.status + '</td>' +
                                '</tr>'
                            );
                            $('.dropInputHidden').append(
                                '<input type="hidden"  name="product_id[]" value="' + value
                                .master_menu_id +
                                '"><input type="hidden"  name="product_price[]" value="' + value
                                .sub_total + '">')
                        }
                    });
                    $('.total_price_cash').val(parseInt(totalPembayaran).toLocaleString('en-US'));
                    $('.total_price_transfer').val(parseInt(totalPembayaran).toLocaleString('en-US'));

                    var index2 = 1;
                    $.each(data.data.order_detail, function(index22, value) {
                        if (value.status != 'Menunggu Pembayaran') {
                            $('.dropTablePaid').append(
                                '<tr>' +
                                '<td>' + (index2++) + '</td>' +
                                '<td>' + 'Rp. ' + parseInt(value.price).toLocaleString(
                                    'en-US') + '</td>' +
                                '<td>' + value.qty + '</td>' +
                                '<td>' + 'Rp. ' + parseInt(value.sub_total).toLocaleString(
                                    'en-US') + '</td>' +
                                '<td>' + value.master_menu.name + '</td>' +
                                '<td>' + value.status + '</td>' +
                                '</tr>'
                            );
                        }
                    });
                    $('.bs-example-modal-md').modal('toggle');
                }
            });
        }

        function filterOrder() {
            var param = $('#example-input1-group2').val();
            console.log(param)
            $.ajax({
                url: '{{ route('load-data') }}',
                data: {
                    id: param,
                },
                type: 'get',
                success: function(data) {
                    $('.dropHereResult').html(data);
                }
            });
        }

        function methodPayment() {
            $('#modal-method-payment').modal('toggle');
            $('#modal-create-data').css('z-index', '2');
        }
        $('#modal-method-payment').on('hidden.bs.modal', function() {
            $('#modal-create-data').css('z-index', '4000');
        })

        function methodPaymentCash() {
            $('#modal-method-cash').modal('toggle');
            $('#modal-method-payment').css('z-index', '4');
            $('.method_payment').val('Cash');
        }
        $('#modal-method-cash').on('hidden.bs.modal', function() {
            $('#modal-method-payment').css('z-index', '4000');
        })

        function methodPaymentTransfer() {
            $('#modal-method-transfer').modal('toggle');
            $('#modal-method-payment').css('z-index', '4');
            $('.method_payment').val('Transfer');
        }
        $('#modal-method-transfer').on('hidden.bs.modal', function() {
            $('#modal-method-payment').css('z-index', '4000');
        })

        function calcCash(params) {
            var totalPrice = $('.total_price_cash').val().replace(/,/g, "");
            var totalPayment = $('.total_payment_cash').val().replace(/,/g, "");
            var calc = totalPayment - totalPrice < 0 ? 0 : totalPayment - totalPrice;
            $('.total_change_cash').val(parseInt(calc).toLocaleString('en-US'));
        }

        function calcTransfer(params) {
            var totalPrice = $('.total_price_transfer').val().replace(/,/g, "");
            var totalPayment = $('.total_payment_transfer').val().replace(/,/g, "");
            var calc = totalPayment - totalPrice < 0 ? 0 : totalPayment - totalPrice;
            $('.total_change_transfer').val(parseInt(calc).toLocaleString('en-US'));
        }

        function savePayment(params) {

            $.ajax({
                url: '{{ route('store-cashier') }}',
                data: $('#form-data').serialize(),
                type: 'post',
                dataType: 'json',
                success: function(data) {

                    $('.bs-example-modal-md').modal('hide');
                    $('#modal-method-payment').modal('hide');
                    $('#modal-method-cash').modal('hide');
                    $('#modal-method-transfer').modal('hide');
                    filterOrder();
                    
                }
            });
        }
    </script>
@endsection
