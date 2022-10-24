@foreach ($data as $item)
    <div class="col-md-6 col-lg-6 col-xl-4">
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
                                    <p style="font-size: 15px;margin-bottom:5px">{{ $item->telpon }}</p>
                                    <b style="font-size: 15px">Jam Pesanan :
                                        {{ date('H:i', strtotime($item->created_at)) }}</b>

                                </div>
                            </div>
                            <div class="col-5">
                                <h3 class="card-title mt-0 mb-0">
                                    <button type="button"
                                        class="btn btn-outline-purple btn-round waves-effect waves-light float-right"
                                        id="detail-data" value="{{ $item->id }}">DETAIL</button>
                                    <br>
                                    <span class="float-right" style="padding-top: 15px">
                                        @if ($item->status == 'Not Paid')
                                            BELUM BAYAR
                                        @else
                                            TERBAYAR
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
                        <h6 style="padding-top: 3px" onclick="openDetail()">REF #{{ $item->kode }} </h6>
                    </div>
                    <div class="col-6 ">
                        <h5 class="float-right">Rp. {{ number_format($item->total_price) }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
