<div class="row">
    @foreach ($data as $item)
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
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

                                <div style="padding-left: 45px">
                                    <input type="text" value="{{ $item->name }}"  disabled style="border: none;font-size:20px;font-weight:bold;background-color:transparent">
                                    {{-- <b
                                        style="font-size: 20px"></b> --}}
                                    <br>
                                    <input type="text" disabled value="{{ $item->telpon }}" style="border: none;font-size:15px;background-color:transparent">

                                    <b style="font-size: 18px">
                                        {{ date('H:i', strtotime($item->created_at)) }}</b>

                                </div>
                            </div>
                            <div class="col-5">

                                <h5 class="float-right" style="
                                margin-top: 58px;">
                                    {{ number_format($item->belumBayarPrice) }}</h5>
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
                            #{{ $item->kode }} </b>
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
