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
                        <div class="col-xl-2 col-lg-3 col-md-4">
                            <h4 class="m-t-5 m-b-15 font-16">Menu</h4>
                            <select name="category_id" id="category_id" class="form-control select2 required"
                                onchange="getMenu()">
                                <option value="">Semua Category</option>
                                @foreach (\App\Models\Category::where('status', 1)->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div id="add_event_form" class="m-t-5 m-b-20">
                                <input type="text" class="form-control new-event-form" id="search-menu"
                                    placeholder="Cari Berdasarkan Nama" />
                            </div>
                            <div class="w-full">
                                <hr>
                            </div>
                            <div id='external-events'>
                            </div>
                        </div>
                        <div id='calendar' class="col-xl-10 col-lg-9 col-md-8"></div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('script')
    @include('../cms/schedule/calendar', compact('data'))
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
                    url: "{{ route('datatable-schedule') }}",
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
                    data: 'title',
                    name: 'title',
                }, {
                    data: 'slug',
                    name: 'slug',
                }, {
                    data: 'created_at',
                    name: 'created_at',
                }, {
                    data: 'status',
                    class: 'text-center',
                }, ]
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%'
            });

            $('.mask').maskMoney({
                precision: 0,
                thousands: ',',
                allowZero: true,
                defaultZero: true,
            })
            getMenu();
            refreshCalendar();
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

        $('#search-menu').keyup(debounce(function() {
            getMenu();
        }, 500));

        function initDraggable() {
            $('#external-events .fc-event').each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    image: $.trim($(this).find('img').attr(
                        'src')), // use the element's image as the event image
                    master_menu_id: $.trim($(this).find('.master_menu_id')
                        .val()), // get master menu id
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });
        }

        function getMenu() {
            $.ajax({
                url: '{{ route('get-menu-schedule') }}',
                data: {
                    category_id: function() {
                        return $('#category_id').val();
                    },
                    param: function() {
                        return $('#search-menu').val();
                    }
                },
                type: 'get',
                success: function(data) {
                    $('#external-events').html(data);
                    initDraggable();
                },
                error: function(data) {
                    getMenu();
                }
            });
        }

        function refreshCalendar() {
            $.ajax({
                url: '{{ route('refresh-calendar-schedule') }}',
                type: 'get',
                success: function(data) {
                    dataCalendar = [];
                    data.data.forEach(e => {
                        dataCalendar.push({
                            title: e.master_menu.name,
                            image: e.master_menu.image,
                            master_menu_id: e.master_menu.id,
                            schedule_id: e.id,
                            start: e.date,
                        }, )
                    });

                    calendar.fullCalendar('removeEvents');
                    calendar.fullCalendar('addEventSource', dataCalendar);
                    calendar.fullCalendar('refetchEvents');
                },
                error: function(data) {
                    refreshCalendar();
                }
            });
        }

        function gantiStatus(param, id) {
            $.ajax({
                url: '{{ route('ganti-status-schedule') }}',
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
                url: '{{ route('edit-schedule') }}',
                data: {
                    id,
                },
                type: 'get',
                success: function(data) {
                    var temp_key = Object.keys(data.data);
                    var temp_value = data.data;
                    for (var i = 0; i < temp_key.length; i++) {
                        var key = temp_key[i];
                        if ($('#' + key).length != 0) {
                            if (!$('#' + key).hasClass('dropify')) {
                                $('#' + key).val(temp_value[key]);
                            }
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
                    $('.mask').maskMoney('mask');
                },
                error: function(data) {
                    gantiStatus(param, id);
                }
            });
        }

        function convertToSlug(str) {

            //replace all special characters | symbols with a space
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                .toLowerCase();

            // trim spaces at start and end of string
            str = str.replace(/^\s+|\s+$/gm, '');

            // replace space with dash/hyphen
            str = str.replace(/\s+/g, '-');

            return str;
        }

        function store(event, date) {

            var formData = new FormData();



            var data = $('#form-data').serializeArray();

            formData.append('master_menu_id', event.master_menu_id);
            formData.append('date', date);
            formData.append('_token', '{{ csrf_token() }}');

            overlay(true);
            $.ajax({
                url: '{{ route('store-schedule') }}',
                data: formData,
                type: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 1) {
                        alertify.success(data.message);
                        refreshCalendar();
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

        function hapus(id) {

            console.log(id);
            overlay(true);
            $.ajax({
                url: '{{ route('destroy-schedule') }}',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                },
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 1) {
                        alertify.success(data.message);
                        refreshCalendar();
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
    </script>
@endsection
