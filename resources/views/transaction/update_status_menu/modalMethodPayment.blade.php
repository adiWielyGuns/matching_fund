<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        id="modal-method-payment" style="display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Metode
                        Pembayaran</h5><button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div onclick="methodPaymentCash()"
                                class="waves-effect waves-light alert bg-gradient2 text-white mb-0" role="alert"
                                style="display:grid !important">
                                <h3 class="alert-heading font-50" style="text-align: center;">TUNAI</h3>
                                <h3 class="alert-heading" style="text-align: center;font-size:60px"><i
                                        class="fas fa-money-bill"></i></h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div onclick="methodPaymentTransfer()"
                                class="waves-effect waves-light alert bg-gradient3 text-white mb-0" role="alert"
                                style="display:grid !important">
                                <h3 class="alert-heading font-50" style="text-align: center;">NON TUNAI</h3>
                                <h3 class="alert-heading" style="text-align: center;font-size:60px"><i
                                        class="fas fa-credit-card"></i></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>