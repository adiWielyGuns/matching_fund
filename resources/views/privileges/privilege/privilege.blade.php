@extends('../layouts/cms/main_cms')
@section('body_main')
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">{{ convertSlug(Request::segment(1)) }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ convertSlug(Request::segment(2)) }}</a></li>
                        <li class="breadcrumb-item active">{{ convertSlug(Request::segment(3)) }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ convertSlug(Request::segment(3)) }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <select class="form-control select2" id="role_id" style="width: 100%;">
                                <option value="">Pilih Role</option>
                                @foreach (\App\Models\Role::where('status', true)->get() as $i => $d)
                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="append-privilege">

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade bs-example-modal-md" id="modal-create-data" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Create Title Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name Title Menu</label>
                                <input class="form-control required" type="text" placeholder="Masukan nama title menu"
                                    id="name" name="name">
                                <input type="hidden" id="id" name="id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="store()">Simpan
                        Data</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
    <script>
        alertify.logPosition("top right");
        $(document).ready(function() {
            $(document).on('change', '#role_id', function() {
                $.ajax({
                    url: "{{ route('edit-privilege') }}",
                    data: {
                        id() {
                            return $('#role_id').val();
                        }
                    },
                    type: 'get',
                    success: function(data) {
                        $('#append-privilege').html(data);
                    },
                    error: function(data) {
                        Toast.fire({
                            title: data.responseJSON.message,
                            type: 'warning',
                            confirmButtonText: 'Ok!',
                        });
                    }
                });
            })


            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%'
            });
        })

        function changePrivilegeGlobal(column, par, groupItemId, roleId) {
            $('.' + column + '_' + groupItemId).prop('checked', $(par).is(':checked'));
            $.ajax({
                url: "{{ route('store-privilege') }}",
                data: {
                    column,
                    param: $(par).is(':checked') ? 1 : 0,
                    groupItemId,
                    roleId,
                    jenis: 'GLOBAL',
                    _token: '{{ csrf_token() }}',
                },
                type: 'post',
                success: function(data) {
                    if (data.status == 1) {
                        alertify.success(data.message);
                    } else if (data.status == 2) {
                        alertify.warning(data.message);
                    }
                },
                error: function(data) {
                    alertify.success(data.responseJSON.message);
                }
            });
        }

        function changePrivilege(hakAksesId, column, par, roleId, menuId) {
            $.ajax({
                url: "{{ route('store-privilege') }}",
                data: {
                    hakAksesId,
                    column,
                    param: $(par).is(':checked') ? 1 : 0,
                    menuId,
                    roleId,
                    jenis: 'MENU',
                    _token: '{{ csrf_token() }}',
                },
                type: 'post',
                success: function(data) {
                    if (data.status == 1) {
                        alertify.success(data.message);
                    } else if (data.status == 2) {
                        alertify.warning(data.message);
                    }
                },
                error: function(data) {
                    alertify.success(data.responseJSON.message);
                }
            });
        }
    </script>
@endsection
