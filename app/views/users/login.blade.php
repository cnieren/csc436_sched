@section('content')
@if(Session::has('message') && Session::has('error'))
	@if(Session::get('error'))
	<p class="alert alert-danger" role="alert">{{ Session::get('message') }}</p>
	@else
	<p class="alert alert-success" role="alert">{{ Session::get('message') }}</p>
	@endif
@endif

{{ Form::open(array('url'=>'login', 'class'=>'form-signin')) }}
    <h1 class="form-signin-heading">Login</h1>
    {{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}<br>
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}<br>
    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}

<a href="register">Create an Account</a>
@stop