!function ($) {
    "use strict";
    var CalendarApp = function () {
        this.$calendar = $('#calendar')
    };

    CalendarApp.prototype.init = function () {
        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:30:00',
            minTime: '06:00:00',
            maxTime: '19:00:00',
            defaultView: 'month',
            handleWindowResize: true,
            timeFormat: 'H(:mm)',
            editable: true,
            droppable: false,
            eventLimit: true,
            selectable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: {
                url: 'calendar/events'
            },
            drop: function (date) {
                $this.onDrop($(this), date);
            },
            select: function (start, end, allDay) {
                $this.onSelect(start, end, allDay);
            },
            eventClick: function (calEvent, jsEvent, view) {
                // $this.onEventClick(calEvent, jsEvent, view);

                var start_d = moment(calEvent.start_date).format("MM/DD/YYYY");
                var start_t = calEvent.start_t;
                var end_d = moment(calEvent.end_date).format("MM/DD/YYYY");
                var end_t = calEvent.end_t;

                $('#view-event').modal('show');
                $('.modal-title').html(calEvent.title);
                $('.event-start-sm').html(start_d + ' ' + start_t);
                $('.event-end-sm').html(end_d + ' ' + end_t);
                $('.event-desc').html(calEvent.description);
                //edit event
                $('.edit-event-btn').click(function () {
                    $('#edit-event').modal('show');
                    $('#view-event').modal('hide');
                    $('input#event_id').val(calEvent.id);
                    $('input#event_title').val(calEvent.title);

                    //populate input fields (currently disabled)
                   $('input#start_date').attr('type', 'text').val(start_d);
                   $('input#end_date').attr('type', 'text').val(end_d);

                    $('input#start_time').attr('type', 'text').val(start_t);
                    $('input#end_time').attr('type', 'text').val(end_t);
                    $("#editor2").val(calEvent.description);
                });
                //delete event
                $('.trash-event-btn').click(function (e) {
                    e.preventDefault();
                    swal({
                        title: 'Please confirm',
                        text: 'You are about to delete an event...',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, Do it!',
                        closeOnConfirm: false
                    }, function () {
                        swal('processing...');
                        $.ajax({
                            type: "POST",
                            url: 'calendar/deleteEvent',
                            data: 'event_id=' + calEvent.id,
                            success: function () {
                                window.location.href = 'calendar';
                            },
                            error: function () {
                                window.location.href = 'calendar';
                            }
                        });
                    });

                });
            },
            eventRender: function () {
                $('.fc-header-left').find('.fc-button-prev').html('<span class="fa fa-caret-left"></span>');
                $('.fc-header-left').find('.fc-button-next').html('<span class="fa fa-caret-right"></span>');
            },
            //day click
            dayClick: function (date, jsEvent, view) {
                var modal = $('#new-event');
                var start_d = date.format("YYYY-MM-DD");
                var start_t = date.format("hh:mm");
                $('input#start_date').val(start_d);
                $('input#end_date').val(start_d);
                $('input#start_time').val(start_t);
                $('input#end_time').val(start_t);

                modal.modal('show');
            }
        });

    },
        //init CalendarApp
        $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

}(window.jQuery),
    $(window).on('load', function () {
        $.CalendarApp.init()
    });
