<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Slate</title>

		{{ HTML::style('assets/bootstrap/css/bootstrap.css') }}
	</head>
	<body>
		@yield('content')

		{{ HTML::script('assets/bootstrap/js/bootstrap.js') }}
	</body>
</html>