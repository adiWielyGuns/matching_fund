<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
id="modal-method-transfer" style="display: none;" aria-hidden="true">
<div class="modal-dialog  modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">Pembayaran Non tunai</h5><button
                type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row"><label class="col-md-3 my-1 control-label">Metode
                            Pembayaran</label>
                        <div class="col-md-9">
                            @foreach ($paymentMethod as $i => $el)
                                @if ($el->jenis == 'NON TUNAI')
                                    <div class="form-check-inline my-1">
                                        <div class="custom-control custom-radio"><input type="radio"
                                                id="customRadio{{ $i }}" name="payment_method_id"
                                                class="custom-control-input" value="{{ $el->id }}">
                                            <label class="custom-control-label"
                                                for="customRadio{{ $i }}">{{ $el->name }} (
                                                {{ $el->no_ref }} )</label>
                                        </div>
                                    </div>
                                    <br>
                                @endif
                            @endforeach



                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h6 class="input-title mt-0">Total Harga</h6>
                    <div class="input-group input-group-lg">
                        <input type="text" style="text-align: right" readonly
                            class="form-control total_price_transfer mask " name="total_price_transfer">
                    </div>

                    <div class="mt-3">
                        <h6 class="input-title mt-lg-3">Total Pembayaran</h6>
                        <div class="input-group input-group-lg">
                            <input type="text" style="text-align: right" name="total_payment_transfer"
                                class="form-control total_payment_transfer mask " onkeyup="calcTransfer()">
                        </div>
                    </div>
                    <div class="mt-3" style="display: none">
                        <h6 class="input-title">Kembalian</h6>
                        <div class="input-group input-group-lg">
                            <input type="text" style="text-align: right"
                                class="form-control total_change_transfer mask " readonly
                                name="total_change_transfer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary waves-effect waves-light"
                onclick="savePayment()">simpan pembayaran</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>