<div class="modal fade bs-example-modal-md" id="modal-create-data" tabindex="-1" role="dialog"
aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title mt-0 float-center" id="myLargeModalLabel"> <b>REF </b> <b
                    class="dropRef"></b>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">

            <input type="hidden" id="id" name="id">
            <input type="hidden" id="ref" name="ref">

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
                    <h5>Detail Pemesanan Belum Terbayar</h5>
                </div>
            </div>
            <div class="dropInputHidden">

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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="dropTable">

                    </tbody>
                </table>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <h5>Detail Pemesanan Terbayar / Proses</h5>
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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="dropTablePaid">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            <button type="button" class="btnMethodPayment btn btn-primary waves-effect waves-light"
                onclick="methodPayment()">Lakukan Pembayaran Data</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->