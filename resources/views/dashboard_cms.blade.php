@extends('../layouts/cms/main_cms')
@section('body_main')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Cms</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon-contain">
                                <div class="row">
                                    <div class="col-2 align-self-center">
                                        <i class="fas fa-tasks text-gradient-success"></i>
                                    </div>
                                    <div class="col-10 text-right">
                                        <h5 class="mt-0 mb-1">{{ \App\Models\Category::count() }}</h5>
                                        <p class="mb-0 font-12 text-muted">Category</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body justify-content-center">
                            <div class="icon-contain">
                                <div class="row">
                                    <div class="col-2 align-self-center">
                                        <i class="far fa-gem text-gradient-danger"></i>
                                    </div>
                                    <div class="col-10 text-right">
                                        <h5 class="mt-0 mb-1">{{ \App\Models\MasterMenu::count() }}</h5>
                                        <p class="mb-0 font-12 text-muted">Menu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id='calendar' class="col-xl-12"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var dataCalendar = [];
        var calendar;
        ! function($) {

            var CalendarPage = function() {};

            CalendarPage.prototype.init = function() {
                    @foreach ($data as $item)
                        dataCalendar.push({
                            title: '{{ $item->master_menu->name }}',
                            slug: '{{ $item->master_menu->slug }}',
                            image: '{{ $item->master_menu->image }}',
                            master_menu_id: '{{ $item->master_menu_id }}',
                            schedule_id: '{{ $item->id }}',
                            start: '{{ $item->date }}',
                        }, )
                    @endforeach
                    //checking if plugin is available
                    if ($.isFunction($.fn.fullCalendar)) {
                        /* initialize the calendar */

                        var date = new Date();
                        var d = date.getDate();
                        var m = date.getMonth();
                        var y = date.getFullYear();

                        calendar = $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,basicWeek,basicDay'
                            },
                            editable: false,
                            eventLimit: true, // allow "more" link when too many events
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            eventDurationEditable: false,
                            eventRender: function(copiedEventObject, element) {
                                var html =
                                    '<img src="' + copiedEventObject.image +
                                    '" alt="Error" class="rounded bg-light mr-2" width="25" height="25">' +
                                    '<span class="my-auto">' + copiedEventObject.title + '</span>' +
                                    '<input type="hidden" class="master_menu_id" value="' + copiedEventObject
                                    .master_menu_id + '">' +
                                    '<input type="hidden" class="schedule_id" value="' + copiedEventObject
                                    .schedule_id + '">';

                                // consoel.log(element);
                                element.find('.fc-title').html(html);
                                element.addClass('d-flex bg-dark py-1');

                                element.find(".fc-title").click(function() {
                                    location.href = '{{ route('menu-front-end') }}/' +
                                        copiedEventObject.slug;
                                });
                            },
                            drop: function(date,
                                allDay) { // this function is called when something is dropped
                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject');
                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject);

                                // assign it the date that was reported
                                copiedEventObject.start = date;
                                copiedEventObject.allDay = allDay;

                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                                store(copiedEventObject, date.format("YYYY-MM-DD"));
                            },
                            events: dataCalendar,
                        });

                        /*Add new event*/
                        // Form to add new event
                    } else {
                        alert("Calendar plugin is not installed");
                    }
                },
                //init
                $.CalendarPage = new CalendarPage,
                $.CalendarPage.Constructor = CalendarPage
        }
        
        (window.jQuery),


        //initializing
        function($) {
            $.CalendarPage.init()
        }(window.jQuery);
    </script>
@endsection
