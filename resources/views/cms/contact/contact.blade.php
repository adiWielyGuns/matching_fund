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
                </div>
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap table-hover"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Data Diri</th>
                            <th>Subject</th>
                            <th>Pesan</th>
                            <th>Created At</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('script')
    <script>
        var table;
        var mask;
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
                    url: "{{ route('datatable-contact') }}",
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
                    class: 'text-center'
                }, {
                    data: 'data_diri',
                    name: 'data_diri',
                }, {
                    data: 'subject',
                    name: 'subject',
                }, {
                    data: 'message',
                    name: 'message',
                }, {
                    data: 'created_at',
                    name: 'created_at',
                }, ]
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

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

            $('#summernote').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
        })

        function reply(email) {
            window.open('https://mail.google.com/mail/?view=cm&fs=1&to=' + email)
        }
    </script>
@endsection
