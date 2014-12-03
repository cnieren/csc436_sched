<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Slate</title>

	{{ HTML::style('assets/bootstrap/dist/css/bootstrap.css') }}
	{{ HTML::style('css/bootstrap-theme.css') }}
	{{ HTML::style('assets/fullcalendar/dist/fullcalendar.css') }}
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	{{ HTML::style('css/styles.css') }}
</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-default" role="navigation">
		<div id="navbar-container" class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				@if (isset($user))
				<a class="navbar-brand" href="/"><i class="fa fa-calendar"></i> Slate</a>
				@else
					<a class="navbar-brand" href="#"><i class="fa fa-calendar"></i></a>
				@endif
			</div>
			@if (isset($user))
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<ul class="nav navbar-nav navbar-right">
					<!-- <li><a href="#">Link</a></li> -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $user->fname }}  {{ $user->lname }}<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						<li><a href="/appointments">My Appointments</a></li>
						@if ($user->isAdvisor())
								<li><a href="/schedule">My Schedule</a></li>
						@endif
							<li><a href="/logout">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
			@endif
		</div><!-- /.container-fluid -->
	</nav>
	<!-- end navbar -->
	<div class="container">
		@if(Auth::check())
		<input type="hidden" id="logged-in-user-id" value="<?php echo Auth::User()->id ?>" />
		@endif
		@yield('content')
	</div>

	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
	{{ HTML::script('assets/handlebars/handlebars.min.js') }}
	{{ HTML::script('assets/bootstrap/dist/js/bootstrap.min.js') }}
	{{ HTML::script('assets/moment/min/moment.min.js') }}
	{{ HTML::script('assets/fullcalendar/dist/fullcalendar.min.js') }}
	{{ HTML::script('assets/clndr/clndr.min.js') }}
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/handlebarsHelpers.js') }}
	@if(isset($user))
		{{ HTML::script('js/main.js') }}
	@endif
	@yield('js')
</body>
</html>