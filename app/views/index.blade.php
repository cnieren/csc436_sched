@section('content')
<div class="jumbotron">
	<h1>Welcome!</h1>
	<p>Please complete the steps below to schedule an appointment with a CS advisor.</p>
</div>
{{ Form::open(array('url' => 'foo/bar')) }}	
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>1. Select a category</strong></h3></div>
	<div class="panel-body">
<<<<<<< HEAD
		<p>What's the reason for your appointment?</p>
		{{ Form::open(array('url' => 'foo/bar')) }}

			{{ Form::select('category', $category, null, array('class' => 'form-control')); }}

		{{ Form::close() }}
=======
		<p>What's the reason for your appointment?</p>			
		{{ Form::select('categories', $categories, null, array('class' => 'form-control')); }}
>>>>>>> 69d6502eb5977240a57b854514afbf48cd08ee8c
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>2. Select an advisor</strong></h3></div>
	<div class="panel-body">
		<p>Choose an advisor from the list below</p>
	</div>
</div>
<<<<<<< HEAD
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>#. Select your appointment time</strong></h3></div>
	<div class="panel-body">
    <div class="row">
      <div class="col-md-8">
        <div id="cal"></div>
      </div>
      <div class="col-md-4">

        <div style="overflow:scroll; height:500px;">
          <ul class="list-group">
            <li class="list-group-item">9:00</li>
            <li class="list-group-item">9:15</li>
            <li class="list-group-item">9:30</li>
            <li class="list-group-item">9:45</li>
            <li class="list-group-item">10:00</li>
            <li class="list-group-item">10:15</li>
            <li class="list-group-item">10:30</li>
            <li class="list-group-item">10:45</li>
            <li class="list-group-item">11:00</li>
            <li class="list-group-item">11:15</li>
            <li class="list-group-item">11:30</li>
            <li class="list-group-item">11:45</li>
            <li class="list-group-item">12:00</li>
            <li class="list-group-item">12:15</li>
            <li class="list-group-item">12:30</li>
            <li class="list-group-item">12:45</li>
          </ul>
        </div>
      </div>
    </div>
	</div>
</div>
=======
{{ Form::close() }}
>>>>>>> 69d6502eb5977240a57b854514afbf48cd08ee8c
@stop