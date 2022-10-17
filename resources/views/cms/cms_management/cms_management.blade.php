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
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table dt-responsive nowrap table-hover"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <tbody>
                            @foreach ($cms as $i => $item)
                                <tr class="cms-item" onclick="edit('{{ $item->id }}',this)">
                                    <td><a href="javascript:;">{{ $item->name }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-8" id="cms-content">

        </div>
    </div> <!-- end row -->
@endsection

@section('script')
    <script>
        var table;
        var mask;
        $(document).ready(function() {

            $('.select2').select2({
                dropdownParent: $("#modal-create-data .modal-content"),
                theme: 'bootstrap4',
                width: '100%'
            });

            $('.mask').maskMoney({
                precision: 0,
                thousands: ',',
                allowZero: true,
                defaultZero: true,
            })

        })

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        function edit(id, child) {
            $.ajax({
                url: '{{ route('edit-cms-management') }}',
                data: {
                    id,
                },
                type: 'get',
                success: function(data) {
                    $('#cms-content').html(data);
                    $('.cms-item').removeClass('active')
                    $(child).addClass('active')
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






            formData.append('type', $("#type").val());
            formData.append('id', $("#id").val());
            formData.append('_token', '{{ csrf_token() }}');

            switch ($("#type").val()) {
                case 'IMAGE':
                    var input = document.getElementById("value");
                    if (input != null) {
                        file = input.files[0];
                        if (file != undefined) formData.append("value", file);
                    }
                    break;

                case 'STRING':
                    formData.append('value', $('#summernote').summernote('code'));
                    break;

                case 'URL':
                    formData.append('value', $("#value").val());
                    break;
                default:
                    break;
            }

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
                        url: '{{ route('store-cms-management') }}',
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
                            var type = '';
                            if (data.responseJSON == undefined) {
                                type = 'text';
                                html = data.responseText;
                            } else {
                                type = 'json';
                                Object.keys(data.responseJSON).forEach(element => {
                                    html += data.responseJSON[element][0] + '<br>';
                                });
                            }

                            Swal.fire({
                                title: 'Oops Something Wrong!',
                                html: type == 'text' ? data.responseText : html,
                                icon: "error",
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
