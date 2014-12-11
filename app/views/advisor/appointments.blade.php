@section('content')
<div class="panel panel-default" >
	<div class="panel-heading">
		<h4 class="panel-title">
			My Appointments
		</h4>
	</div>
	<div class="panel-body">
		<div class="inner-well-padding">
			<table class="table table-hover">
					<thead>
						<td><Strong>Appointments</Strong></td>
						<td><Strong>Advisor</Strong></td>
						<td><Strong>Start Time</Strong></td>
						<td><Strong>End Time</Strong></td>
						<td><Strong>Cancel Appointment</Strong></td>
					</thead>
					@foreach ($appointments as $appointment)
					<tr data-id="{{$appointment->id}}">
						<td>{{$appointment->title}}</td>
						<td>{{$appointment->advisor}}</td>
						<td>{{$appointment->start}}</td>
						<td>{{$appointment->end}}</td>
						<td><a onclick="deleteAppt({{$appointment->id}})" class="glyphicon glyphicon-remove"></a></td>
					</tr>
					@endforeach
					@if($appointments->count() == 0)
					<tr>
						<td>You have no upcoming appointments</td>
					</tr>
					@endif
				</table>

		</div>
	</div>
</div>
@stop

@section('js')
<script>
function deleteAppt(id) {
	var url = 'api/v1/appointments/' + id;

	Slate.utils.destroy(url)
	.then(function(data) {
		var rows = $('tr').length;
		$('[data-id=' + data.id + ']').fadeOut('slow', function() {
			$(this).remove();
			if(rows < 3) {
				$('<tr style="display:none;"><td>You have no upcomming appointments</td></tr>')
				.appendTo('tbody')
				.fadeIn('slow');
			}
		});
	});
}
</script>
@stop

