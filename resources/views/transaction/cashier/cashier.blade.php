{{-- @extends('../layouts/cms/main_cms') --}}
@include('../layouts/cms/css_cms')
@extends('../layouts/base')

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
        <div class="">
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
                                            <li class="breadcrumb-item active">{{ convertSlug(Request::segment(3)) }}
                                            </li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">{{ convertSlug(Request::segment(3)) }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="page-content-wrapper">
                            <div class="container-fluid">
                                @foreach ($data as $item)
                                    <div class="col-md-6 col-lg-6 col-xl-3">
                                        <div class="card">
                                            <div class="card-body col-12">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-danger btn-circle btn-xl">
                                                            {{ $item->table->name }}
                                                        </button>
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-7">

                                                                <div style="padding-left: 35px">

                                                                    <b style="font-size: 20px">{{ $item->name }}</b>
                                                                    <br>
                                                                    <p style="font-size: 15px;margin-bottom:5px">
                                                                        {{ $item->telpon }}</p>
                                                                    <b style="font-size: 15px">Jam Pesanan :
                                                                        {{ date('H:i', strtotime($item->created_at)) }}</b>

                                                                </div>
                                                            </div>
                                                            <div class="col-5">

                                                                <h5 class="float-right">Rp.
                                                                    {{ number_format($item->total_price) }}</h5>
                                                                <h3 class="card-title mt-0 mb-0">
                                                                    <br>
                                                                    <span class="float-right" style="padding-top: 15px">
                                                                        @if ($item->status == 'Not Paid')
                                                                            Belum Bayar
                                                                        @else
                                                                            Terbayar
                                                                        @endif
                                                                    </span>
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
                                                            class="btn btn-outline-purple btn-round waves-effect waves-light float-right"
                                                            id="detail-data"
                                                            value="{{ $item->id }}">Detail Pesanan</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="modal fade bs-example-modal-md" id="modal-create-data" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title mt-0 float-center" id="myLargeModalLabel"> <b>REF </b> <b
                                                id="dropRef"></b></h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                    </div>
                                    <form class="modal-body" id="form-data" onkeydown="return event.key != 'Enter';">
                                        @csrf
                                        <input type="hidden" id="id" name="id">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Nama Pemesan</label>
                                                    <h4 class="dropNama">-</h4>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Nama Telpon</label>
                                                    <h4 class="dropTlp">-</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="">Jumlah Cust</label>
                                                    <h4 class="dropJumlah">-</h4>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="">No Meja</label>
                                                    <h4 class="dropMeja">-</h4>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group ">
                                                    <label for="">Harga</label>
                                                    <h4 class="dropHarga">-</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5>Detail Pemesanan</h5>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-md">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Total Harga</th>
                                                        <th>Menu</th>
                                                        <th>Status Bayar</th>
                                                        <th>Status Pesanan</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="dropTable">

                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                            onclick="store()">Simpan
                                            Data</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        {{-- @endsection --}}
                    </div>
                </div>
            </div>
            @include('../layouts/cms/footer_cms')
        </div>
    </div>
    @include('../layouts/cms/script_cms')
</body>

@section('script')
    <style>
        /* .side-menu {
                            bottom: 0;
                            top: 0;
                            width: 240px;
                            -webkit-transition: all .4s ease-in-out;
                            transition: all .4s ease-in-out;
                            background: #fff;
                            position: absolute;
                            z-index: 99;
                            -webkit-box-shadow: 2px 0 3px rgb(96 93 175 / 5%);
                            box-shadow: 2px 0 3px rgb(96 93 175 / 5%);
                            margin-left: -100% !important;
                        } */
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
        $('#detail-data').click(function() {

            // console.log($(this).val());
            $('#modal-create-data').modal('toggle');
            var id = $(this).val();
            $.ajax({
                url: '{{ route('get-data-detail') }}',
                data: {
                    id,
                },
                type: 'get',
                success: function(data) {
                    $('.dropTable').empty();
                    $('#dropRef').html('#' + data.data.kode);
                    $('.dropNama').html(data.data.name);
                    $('.dropTlp').html(data.data.telpon);
                    $('.dropJumlah').html(data.data.pax);
                    $('.dropMeja').html(data.data.table.name);
                    $('.dropHarga').html('Rp. ' + parseInt(data.data.total_price).toLocaleString(
                        'en-US'));
                    // dropTable 

                    $.each(data.data.order_detail, function(index, value) {
                        $('.dropTable').append(
                            '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + 'Rp. ' + parseInt(value.price).toLocaleString(
                                'en-US') + '</td>' +
                            '<td>' + value.qty + '</td>' +
                            '<td>' + 'Rp. ' + parseInt(value.sub_total).toLocaleString(
                                'en-US') + '</td>' +
                            '<td>' + value.master_menu.name + '</td>' +
                            '<td>' + value.status + '</td>' +
                            '<td>' + value.price + '</td>' +
                            '</tr>'
                        );
                    });
                }
            });

        });
    </script>
@endsection
