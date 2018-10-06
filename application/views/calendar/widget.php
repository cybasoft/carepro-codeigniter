<div class="card">
    <div class="card-body">
        <div id="calendar"></div>
    </div>
    <div class="card-footer text-black"></div>
</div>

<script type="text/javascript">
    $(function () {
        $('#calendar').fullCalendar({
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
                left: 'prev,next, today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: {
                url: 'calendar/events'
            },
            eventClick: function (calEvent, jsEvent, view) {
                var start_d = moment(calEvent.start_date).format("MM/DD/YYYY");
                var end_d = moment(calEvent.end_date).format("MM/DD/YYYY");
                var start_t = calEvent.start_t;
                var end_t = calEvent.end_t;

                $('#view-event').modal('show');
                $('.modal-title').html(calEvent.title);
                $('.event-start-sm').html(start_d + ' ' + start_t);
                $('.event-end-sm').html(end_d + ' ' + end_t);
                $('.event-desc').html(calEvent.description);

            }, eventRender: function () {
                $('.fc-header-left').find('.fc-button-prev').html('<span class="fa fa-caret-left"></span>');
                $('.fc-header-left').find('.fc-button-next').html('<span class="fa fa-caret-right"></span>');
            },
            //day click
            dayClick: function (calEvent, jsEvent, view) {
                $('#new-event').modal('show');
            }
        });

    });

</script>

<!-- view event -->
<div class="modal fade" id="view-event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td><?php echo lang('start'); ?>:</td>
                        <td class="event-start-sm"></td>
                        <td><?php echo lang('end'); ?>:</td>
                        <td class="event-end-sm"></td>
                    </tr>
                    <tr>
                        <td class="event-desc" colspan="4"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>