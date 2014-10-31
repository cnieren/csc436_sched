@section('content')
<div class="jumbotron">
	<h1>Welcome!</h1>
	<p>Please complete the steps below to schedule an appointment with a CS advisor.</p>
</div>
{{ Form::open(array('url' => 'foo/bar')) }}	
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>1. Select a category</strong></h3></div>
	<div class="panel-body">
		<p>What's the reason for your appointment?</p>			
		{{ Form::select('categories', $categories, null, array('class' => 'form-control')); }}
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>2. Select an advisor</strong></h3></div>
	<div class="panel-body">
		<p>Choose an advisor from the list below</p>
	</div>
</div>
{{ Form::close() }}
@stop