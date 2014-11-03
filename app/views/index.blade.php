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

		{{ Form::select('category', $categories, null, array('class' => 'form-control')); }}

	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>2. Select an advisor</strong></h3></div>
	<div class="panel-body">
		<p>Choose an advisor from the list below</p>
        <select class="form-control">
        @foreach($advisors as $advisor)
            <option value="{{ $advisor->id}}">{{ $advisor->fname." ".$advisor->lname }}</option>
        @endforeach
        </select>
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
                <select multiple class="form-control">
                    <option class="list-group-item">9:00</option>
                    <option class="list-group-item">9:15</option>
                    <option class="list-group-item">9:30</option>
                    <option class="list-group-item">9:45</option>
                    <option class="list-group-item">10:00</option>
                    <option class="list-group-item">10:15</option>
                    <option class="list-group-item">10:30</option>
                    <option class="list-group-item">10:45</option>
                    <option class="list-group-item">11:00</option>
                    <option class="list-group-item">11:15</option>
                    <option class="list-group-item">11:30</option>
                    <option class="list-group-item">11:45</option>
                    <option class="list-group-item">12:00</option>
                    <option class="list-group-item">12:15</option>
                    <option class="list-group-item">12:30</option>
                    <option class="list-group-item">12:45</option>
                    <option class="list-group-item">1:00</option>
                    <option class="list-group-item">1:15</option>
                    <option class="list-group-item">1:30</option>
                    <option class="list-group-item">1:45</option>
                    <option class="list-group-item">2:00</option>
                    <option class="list-group-item">2:15</option>
                    <option class="list-group-item">2:30</option>
                    <option class="list-group-item">2:45</option>
                    <option class="list-group-item">3:00</option>
                    <option class="list-group-item">3:15</option>
                    <option class="list-group-item">3:30</option>
                    <option class="list-group-item">3:45</option>
                    <option class="list-group-item">4:00</option>
                    <option class="list-group-item">4:15</option>
                    <option class="list-group-item">4:30</option>
                    <option class="list-group-item">4:45</option>
                    <option class="list-group-item">5:00</option>
                    <option class="list-group-item">5:15</option>
                    <option class="list-group-item">5:30</option>
                    <option class="list-group-item">5:45</option>
                    <option class="list-group-item">6:00</option>
                    <option class="list-group-item">6:15</option>
                    <option class="list-group-item">6:30</option>
                    <option class="list-group-item">6:45</option>
                </ul>
                <p>Your Appointment Time: 12:00-12:30</p>
            </div>
        </div>
	</div>
</div>

{{ Form::close() }}

@stop