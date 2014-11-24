@section('content')
<div class="panel panel-default" >
	<div class="panel-heading">
		<h4 class="panel-title">
			My Schedule
		</h4>
	</div>
	<div class="panel-body">
		<div class="inner-well-padding">
			<div id='calendar'></div>
		</div>
	</div>
</div>


@stop
@section('js')
<script type="text/javascript">
$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
    	editable: true,
         weekends: false,
         defaultView:'agendaWeek',
         selectable: true,
			selectHelper: true,
			select: function(start, end) {
				var title = "Available";
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#calendar').fullCalendar('renderEvent', eventData, true);
				}
				$('#calendar').fullCalendar('unselect');
			},

    })

});
</script>
@stop