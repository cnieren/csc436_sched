<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Slate</title>

	{{ HTML::style('assets/bootstrap/dist/css/bootstrap.css') }}
	{{ HTML::style('css/cal.css') }}
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	{{ HTML::style('css/styles.css') }}
</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><i class="fa fa-calendar"></i></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<!-- <ul class="nav navbar-nav">
					<li class="active"><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li class="divider"></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul> -->
				<!-- <form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form> -->
				<ul class="nav navbar-nav navbar-right">
					<!-- <li><a href="#">Link</a></li> -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $user->fname }}  {{ $user->lname }}<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Logout</a></li>
							<!-- <li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li> -->
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<!-- end navbar -->
	<div class="container">
		@yield('content')
	</div>

	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
	{{ HTML::script('assets/handlebars/handlebars.min.js') }}
	{{ HTML::script('assets/bootstrap/dist/js/bootstrap.min.js') }}
	{{ HTML::script('assets/moment/min/moment.min.js') }}
	{{ HTML::script('assets/clndr/clndr.min.js') }}

	{{ HTML::script('js/handlebarsHelpers.js') }}
	{{ HTML::script('js/main.js') }}
</body>
</html>