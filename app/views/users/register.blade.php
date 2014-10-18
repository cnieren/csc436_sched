<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
@if(Session::has('message') && Session::has('error'))
	@if(Session::get('error'))
	<p class="alert alert-danger" role="alert">{{ Session::get('message') }}</p>
	@else
	<p class="alert alert-success" role="alert">{{ Session::get('message') }}</p>
	@endif
@endif

{{ Form::open(array('url'=>'register', 'class'=>'form-signin')) }}
    <h1 class="form-signin-heading">Register</h1>
    {{ Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=>'First Name')) }}<br>
    {{ Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=>'Last Name')) }}<br>
    {{ Form::text('phone', null, array('class'=>'form-control', 'placeholder'=>'Phone')) }}<br>
    {{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}<br>
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}<br>
    {{ Form::password('password_rt', array('class'=>'form-control', 'placeholder'=>'Password Confirm')) }}<br>
    {{ Form::submit('Create Account', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}

</body>
</html>