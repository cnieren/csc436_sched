@section('content')
<div class="jumbotron">
	<h1>Welcome!</h1>
	<p>Please complete the steps below to schedule an appointment with a CS advisor.</p>
</div>
<div class="panel panel-default" >
	<div class="panel-heading">
		<h4 class="panel-title">
			1. Select a category
		</h4>
	</div>
	<div class="panel-body">
		<div class="inner-well-padding">
			<p>What's the reason for your appointment?</p>
			<select id="category" class="form-control">
				<option selected disabled>Please Select</option>
				@foreach($categories as $category)
				<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
@stop