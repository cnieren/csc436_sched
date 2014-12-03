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
						<td>Appointments</td>
						<td>Advisor</td>
						<td>Start Time</td>
						<td>End Time</td>
						<td>Cancel Appointment</td>
					</thead>
					@foreach ($appointments as $appointment)
					<tr>
						<td>{{$appointment->title}}</td>
						<td>{{$appointment->advisor}}</td>
						<td>{{$appointment->start}}</td>
						<td>{{$appointment->end}}</td>
						<td><a onclick="alert({{$appointment->id}})" class="glyphicon glyphicon-remove"></a></td>
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