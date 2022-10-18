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
                <div class="card-header bg-primary d-flex justify-content-between">
                    <h4 class="header-title text-light">Index</h4>
                    <button class="btn btn-info" id="tambah-data" onclick="refreshState('#modal-create-data')"><i
                            class="fas fa-plus"></i>
                        Tambah Data</button>
                </div>
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Image</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade bs-example-modal-md" id="modal-create-data" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="modal-body" id="form-data" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image</label>
                                <input class="form-control required dropify" type="file" placeholder="Masukan nama image"
                                    id="image" name="image" data-allowed-file-extensions="jpg jpeg png">
                                <input type="hidden" id="id" name="id">
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label">Name Category</label>
                                <input class="form-control required" type="text" placeholder="Masukan nama category"
                                    id="name" name="name">
                            </div>
                        </div>
                    </div>
                </form>
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
        var table;
        $(document).ready(function() {
            table = $('#datatable-buttons').DataTable({
                processing: true,
                serverSide: true,
                responsive: {
                    details: {
                        renderer: function(api, rowIdx, columns) {
                            var data = $.map(columns, function(col, i) {
                                return col.hidden ?
                                    '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' +
                                    col.columnIndex + '">' +
                                    '<td>' + col.title + '</td> ' +
                                    '<td>' + col.data + '</td>' +
                                    '</tr>' :
                                    '';
                            }).join('');

                            return data ? $('<table style="width:100%"/>').append(data) : false;
                        }
                    }
                },
                buttons: [
                    'copy',
                    'excel',
                    'pdf',
                    {
                        extend: 'colvis',
                        prefixButtons: [{
                            extend: 'colvisRestore',
                            className: 'custom-html-collection',
                        }],
                        columnText: function(dt, idx, title) {

                            return (idx + 1) + ': ' + title;
                        }
                    }
                ],
                ajax: {
                    url: "{{ route('datatable-category') }}",
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center'
                }, {
                    data: 'aksi',
                    name: 'aksi',
                    class: 'text-center',
                }, {
                    data: 'image',
                    name: 'image',
                    class: 'text-center',
                }, {
                    data: 'name',
                    name: 'name',
                }, {
                    data: 'status',
                    class: 'text-center',
                }, ]
            });



            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        })

        $('#tambah-data').click(function() {
            $('#modal-create-data').modal('toggle')
        })

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        function gantiStatus(param, id) {
            $.ajax({
                url: '{{ route('ganti-status-category') }}',
                data: {
                    id,
                    param
                },
                type: 'get',
                success: function(data) {
                    table.ajax.reload(null, false);
                    alertify.logPosition("top right");
                    alertify.success(data.message);
                },
                error: function(data) {
                    gantiStatus(param, id);
                }
            });
        }

        function edit(id) {
            $.ajax({
                url: '{{ route('edit-category') }}',
                data: {
                    id,
                },
                type: 'get',
                success: function(data) {
                    var temp_key = Object.keys(data.data);
                    var temp_value = data.data;
                    for (var i = 0; i < temp_key.length; i++) {
                        var key = temp_key[i];
                        if (!$('#' + key).hasClass('dropify')) {
                            $('#' + key).val(temp_value[key]);
                        }
                    }

                    var url = data.data.image;
                    var imagenUrl = url;
                    var drEvent = $('.dropify').dropify({
                        defaultFile: imagenUrl,
                    });

                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    drEvent.settings.defaultFile = imagenUrl;
                    drEvent.destroy();
                    drEvent.init();

                    $('.not-editable').prop('readonly', true);
                    $('#modal-create-data .select2').trigger('change.select2');
                    $('#simpan').removeClass('hidden');
                    $('#modal-create-data').modal('toggle')
                },
                error: function(data) {
                    gantiStatus(param, id);
                }
            });
        }

        function store() {
            var validation = 0;
            $('#form-data .required').each(function() {
                var par = $(this).parents('.form-group');
                if ($(this).val() == '' || $(this).val() == null) {
                    console.log($(this));
                    $(this).addClass('is-invalid');
                    validation++
                }
            })

            if (validation != 0) {
                alertify.logPosition("top right");
                alertify.error("Semua data harus diisi");
                return false;
            }

            var formData = new FormData();


            var input = document.getElementById("image");
            if (input != null) {
                file = input.files[0];
                formData.append("image", file);
            }

            var data = $('#form-data').serializeArray();
            data.forEach((d, i) => {
                formData.append(d.name, d.value);
            })

            var previousWindowKeyDown = window.onkeydown;
            Swal.fire({
                title: 'Proses Aksi Ini?',
                text: "Proses ini tidak bisa dikembalikan!",
                allowEnterKey: true,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya lanjutkan!',
                cancelButtonText: 'Tidak!',
                showLoaderOnConfirm: true,
            }).then((result) => {
                // $('.swal2-confirm').focus();
                if (result.isConfirmed) {
                    window.onkeydown = previousWindowKeyDown;
                    overlay(true);
                    $.ajax({
                        url: '{{ route('store-category') }}',
                        data: formData,
                        type: 'post',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: data.message,
                                    icon: "success",
                                }).then(() => {
                                    // location.reload();
                                    $('.dropify-clear').click();
                                })
                            } else if (data.status == 2) {
                                Swal.fire({
                                    title: 'Oops Something Wrong',
                                    html: data.message,
                                    icon: "warning",
                                });
                            } else {
                                Swal.fire({
                                    title: 'Oops Something Wrong',
                                    html: data,
                                    icon: "warning",
                                });
                            }
                            overlay(false);
                            table.ajax.reload(null, false);
                        },
                        error: function(data) {
                            overlay(false);
                            var html = '';
                            if (data.responseJSON == undefined) {
                                html = data.responseText;
                            } else {
                                Object.keys(data.responseJSON).forEach(element => {
                                    html += data.responseJSON[element][0] + '<br>';
                                });
                            }

                            Swal.fire({
                                title: 'Oops Something Wrong!',
                                html: data.responseJSON == undefined ? data.responseText : data
                                    .responseJSON.message,
                                icon: "error",
                            });
                        }
                    });
                }
            })
        }

        function hapus(id) {
            var previousWindowKeyDown = window.onkeydown;
            Swal.fire({
                title: 'Proses Aksi Ini?',
                text: "Proses ini tidak bisa dikembalikan!",
                allowEnterKey: true,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya lanjutkan!',
                cancelButtonText: 'Tidak!',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.onkeydown = previousWindowKeyDown;
                    overlay(true);
                    $.ajax({
                        url: '{{ route('destroy-category') }}',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}',
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    text: data.message,
                                    icon: "success",
                                }).then(() => {
                                    // location.reload();
                                })
                            } else if (data.status == 2) {
                                Swal.fire({
                                    title: 'Oops Something Wrong',
                                    html: data.message,
                                    icon: "warning",
                                });
                            } else {
                                Swal.fire({
                                    title: 'Oops Something Wrong',
                                    html: data,
                                    icon: "warning",
                                });
                            }
                            overlay(false);
                            table.ajax.reload(null, false);
                        },
                        error: function(data) {
                            overlay(false);
                            var html = '';
                            if (data.responseJSON == undefined) {
                                html = data.responseText;
                            } else {
                                Object.keys(data.responseJSON).forEach(element => {
                                    html += data.responseJSON[element][0] + '<br>';
                                });
                            }

                            Swal.fire({
                                title: 'Oops Something Wrong!',
                                html: data.responseJSON == undefined ? data.responseText : data
                                    .responseJSON.message,
                                icon: "error",
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
