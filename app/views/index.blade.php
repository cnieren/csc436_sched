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
		{{ Form::open(array('url' => 'foo/bar')) }}

			{{ Form::select('category', $categories, null, array('class' => 'form-control')); }}

		{{ Form::close() }}

	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>2. Select an advisor</strong></h3></div>
	<div class="panel-body">
		<p>Choose an advisor from the list below</p>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>3. Select your appointment time</strong></h3></div>
	<div class="panel-body">
    <div class="row">
      <div class="col-md-8">
        <div id="cal"></div>
      </div>
      <div class="col-md-4">
      <p>Oct 31, 2014</p>
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
            <li class="list-group-item">1:00</li>
            <li class="list-group-item">1:15</li>
            <li class="list-group-item">1:30</li>
            <li class="list-group-item">1:45</li>
            <li class="list-group-item">2:00</li>
            <li class="list-group-item">2:15</li>
            <li class="list-group-item">2:30</li>
            <li class="list-group-item">2:45</li>
            <li class="list-group-item">3:00</li>
            <li class="list-group-item">3:15</li>
            <li class="list-group-item">3:30</li>
            <li class="list-group-item">3:45</li>
            <li class="list-group-item">4:00</li>
            <li class="list-group-item">4:15</li>
            <li class="list-group-item">4:30</li>
            <li class="list-group-item">4:45</li>
            <li class="list-group-item">5:00</li>
            <li class="list-group-item">5:15</li>
            <li class="list-group-item">5:30</li>
            <li class="list-group-item">5:45</li>
            <li class="list-group-item">6:00</li>
            <li class="list-group-item">6:15</li>
            <li class="list-group-item">6:30</li>
            <li class="list-group-item">6:45</li>
          </ul>
        </div>
        <p>Your Appointment Time: 12:00-12:30</p>
      </div>
    </div>
	</div>
</div>

{{ Form::close() }}

@stop