@section('content')
@if(Session::has('message') && Session::has('error'))
	@if(Session::get('error'))
	<p class="alert alert-danger" role="alert">{{ Session::get('message') }}</p>
	@else
	<p class="alert alert-success" role="alert">{{ Session::get('message') }}</p>
	@endif
@endif

{{ Form::open(array('url'=>'register', 'id'=>'register', 'class'=>'form-signin')) }}
    <h1 class="form-signin-heading">Register</h1>
    {{ Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=>'First Name', 'required')) }}<br>
    {{ Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=>'Last Name', 'required')) }}<br>
    {{ Form::text('phone', null, array('class'=>'form-control', 'placeholder'=>'Phone', 'required')) }}<br>
    {{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address', 'required')) }}<br>
    {{ Form::password('password', array('id'=>'password', 'class'=>'form-control', 'placeholder'=>'Password', 'required')) }}<br>
    {{ Form::password('password_rt', array('class'=>'form-control', 'placeholder'=>'Password Confirm', 'required')) }}<br>
    {{ Form::submit('Create Account', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}

@stop

@section('js')
<script>
$(document).ready(function() {
    $('#register').validate({
        rules: {
            password_rt: {
                equalTo: "#password"
            }
        }
    });
});
</script
@stop
