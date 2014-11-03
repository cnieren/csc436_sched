@section('content')
<div class="jumbotron">
	<h1>Welcome!</h1>
	<p>Please complete the steps below to schedule an appointment with a CS advisor.</p>
</div>
<div class="panel panel-primary">
	<div class="panel-heading"><h3><strong>1. Select a category</strong></h3></div>
	<div class="panel-body">
		<p>What's the reason for your appointment?</p>
        <select id="category" class="form-control">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        </select>
	</div>
</div>
@stop