<script>
    /*
Template Name: Zoogler - Bootstrap 4 Admin Dashboard
Author: Mannatthemes
Website: www.mannatthemes.com
File: Calendar init js
*/

    var dataCalendar = [];
    var calendar;
    ! function($) {

        var CalendarPage = function() {};

        CalendarPage.prototype.init = function() {

                //checking if plugin is available
                if ($.isFunction($.fn.fullCalendar)) {
                    /* initialize the external events */
                    $('#external-events .fc-event').each(function() {
                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this)
                                .text()), // use the element's text as the event title
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

                            element.append("<span class='closeon pointer'>X</span>");
                            element.find(".closeon").click(function() {
                                hapus(copiedEventObject.schedule_id);
                                $('#calendar').fullCalendar('removeEvents', event._id);
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
