<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
id="modal-method-cash" style="display: none;" aria-hidden="true">
<div class="modal-dialog  modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">Pembayaran Tunai</h5><button type="button"
                class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="input-title mt-0">Total Harga</h6>
                    <div class="input-group input-group-lg">
                        <input type="text" style="text-align: right" readonly
                            class="form-control total_price_cash mask " name="total_price_cash">
                    </div>

                    <div class="mt-3">
                        <h6 class="input-title mt-lg-3">Total Pembayaran</h6>
                        <div class="input-group input-group-lg">
                            <input type="text" style="text-align: right" name="total_payment_cash"
                                class="form-control total_payment_cash mask " onkeyup="calcCash()">
                        </div>
                    </div>
                    <div class="mt-3">
                        <h6 class="input-title">Kembalian</h6>
                        <div class="input-group input-group-lg">
                            <input type="text" style="text-align: right"
                                class="form-control total_change_cash mask " readonly
                                name="total_change_cash">
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