@section('content')
<div class="jumbotron">
	<h1>Welcome!</h1>
	<p>Please complete the following steps below to schedule an appointment with a CS adviser.</p>
</div>
<div class="panel panel-default">
	<div class="panel-heading"><h3><strong>1. Category</strong></h3></div>
	<div class="panel-body">
		<p>What's the reason for your appointment?</p>
		<form role="form">
			<div class="form-group">
				<select class="form-control">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>			
			</div>
			<button type="submit" class="btn btn-primary">Next</button>
		</form>
	</div>
</div>
@stop