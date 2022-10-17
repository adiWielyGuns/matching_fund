@extends('../layouts/front_end/main_front_end')
@section('body_main')
    <!-- Page Banner Start -->
    <section class="page-banner text-white py-165 rpy-130"
        style="background-image: url({{ cms('faq-banner') ? cms('faq-banner') : 'assets/images/banner/banner.jpg' }});">
        <div class="container">

            <div class="banner-inner">
                <h1 class="page-title wow fadeInUp delay-0-2s">Schedule</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center wow fadeInUp delay-0-4s">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Schedule</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Banner End -->
    <!-- FAQs Section Start -->
    <section class="faq-section rel z-1 pt-130 rpt-100">
        <div class="section-title text-center mb-60">
            <span class="sub-title mb-20">Lihat Jadwal Menu Kami Disini</span>
            <h2>Schedule</h2>
        </div>
        <div class="container">
            <div class="faqs wow fadeInUp delay-0-2s" id="faqs">
                <div id='calendar' class="col-xl-12"></div>
            </div>
        </div>
        <div class="faq-shapes">
            <img class="shape-one" src="assets/images/shapes/faq-shape1.png" alt="Shape">
            <img class="shape-two" src="assets/images/shapes/faq-shape2.png" alt="Shape">
            <img class="shape-three" src="assets/images/shapes/faq-shape3.png" alt="Shape">
            <img class="shape-four" src="assets/images/shapes/faq-shape4.png" alt="Shape">
        </div>
    </section>
    <!-- FAQs Section End -->
@endsection
@section('script')
    <link href="{{ asset('assets/cms/plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/cms/plugins/moment/moment.js') }}"></script>
    <script src='{{ asset('assets/cms/plugins/fullcalendar/js/fullcalendar.min.js') }}'></script>
    <script>
        function search() {
            location.href = "{{ route('menu-front-end') }}?param=" + $('#filter-search').val();
        }
    </script>
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
