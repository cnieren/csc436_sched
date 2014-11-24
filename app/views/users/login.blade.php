@section('content')
@if(Session::has('message') && Session::has('error'))
	@if(Session::get('error'))
	<p class="alert alert-danger" role="alert">{{ Session::get('message') }}</p>
	@else
	<p class="alert alert-success" role="alert">{{ Session::get('message') }}</p>
	@endif
@endif


{{ Form::open(array('url'=>'login', 'class'=>'form-signin')) }}
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			Please Login
		</h4>
	</div>
	<div class="panel-body">
		<div class="inner-well-padding">
	{{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}<br>
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}<br>
		</div>
		<hr>
		<span class="pull-right" >{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}</span>
	</div>
</div>
{{ Form::close() }}

<a href="register">Create an Account</a>
@stop