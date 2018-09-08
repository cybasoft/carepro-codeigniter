<div id="calendar"></div>

<script type="text/javascript">
	$(function() {
		 $('#calendar').fullCalendar({
			 header: {
				 left: 'prev,next, today',
				 center: 'title',
				 right: 'month,agendaWeek,agendaDay'
			 },
			 events: {
				 url: 'calendar/events'
			 },
			 timeFormat: 'H(:mm)',
			 eventClick: function (calEvent, jsEvent, view) {
				 var start_d = calEvent.start.format("MM/DD/YYYY");
				 var start_t = calEvent.start_t;
				 var end_d = calEvent.end.format("MM/DD/YYYY");
				 var end_t = calEvent.end_t;

				 $('#view-event').modal('show');
				 $('.modal-title').html(calEvent.title);
				 $('.event-start-sm').html(start_d + ' ' + start_t);
				 $('.event-end-sm').html(end_d + ' ' + end_t);
				 $('.event-desc').html(calEvent.description);

			 },eventRender: function () {
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
<?php $this->load->view($this->module.'view_event'); ?>
