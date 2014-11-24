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
					</thead>
					@foreach ($appointments as $appointment)
					<tr>
						<td>{{$appointment->start_time}}</td>
					</tr>
					@endforeach
					<tr>
						<td>You have no upcoming appointments</td>
					</tr>
				</table>
		</div>
	</div>
</div>
@stop