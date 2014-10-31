@section('content')
<div class="jumbotron">
	<h1>Welcome!</h1>
	<p>Please complete the following steps below to schedule an appointment with a CS adviser.</p>
</div>
<div class="panel panel-default">
	<div class="panel-heading"><h3><strong>1. Category</strong></h3></div>
	<div class="panel-body">
		<p>What's the reason for your appointment?</p>
		{{ Form::open(array('url' => 'foo/bar')) }}			

			{{ Form::select('category', $category, null, array('class' => 'form-control')); }}

		{{ Form::close() }}
	</div>
</div>
@stop