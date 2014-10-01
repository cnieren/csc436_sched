<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
		{{ HTML::style('assets/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('assets/css/bootstrap_override.css') }}
</head>
<body>
<div class="container">
	<div class="row">
		<table class="table table-bordered">
				<tr>
					<td></td>
					<td>Mon 9/30</td>
					<td>Tues 9/31</td>
					<td>Wed 10/1</td>
					<td>Thurs 10/2</td>
					<td>Fri 10/3</td>
				</tr>
			<tr>
				<td><span class="pull-right">8:00-8:30</span></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><span class="pull-right">8:30-9:00</span></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><span class="pull-right">9:00-9:30</span></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><span class="pull-right">9:30-10:00</span></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><span class="pull-right">10:00-10:30</span></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><span class="pull-right">10:30-11:00</span></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div class="row week-view">
		<div class="col-md-2"></div>
		<div class="col-md-2" style="margin:0;padding:0;">
			<h2>Monday</h2>
			<div class="list-group" >
				<a href="#" class="list-group-item">7-8</a>
			  <a href="#" class="list-group-item">8-9</a>
			  <a href="#" class="list-group-item">9-10</a>
			  <a href="#" class="list-group-item">10-11</a>
			  <a href="#" class="list-group-item">11-12</a>
			  <a href="#" class="list-group-item">12-1</a>
			  <a href="#" class="list-group-item">1-2</a>
			  <a href="#" class="list-group-item">2-3</a>
			  <a href="#" class="list-group-item">3-4</a>
			  <a href="#" class="list-group-item">4-5</a>
			</div>
		</div>
		<div class="col-md-2" style="margin:0;padding:0;">
			<h2>Tuesday</h2>
			<div class="list-group" style="border-radius:0;">
				<a href="#" class="list-group-item">7-8</a>
			  <a href="#" class="list-group-item">8-9</a>
			  <a href="#" class="list-group-item">9-10</a>
			  <a href="#" class="list-group-item">10-11</a>
			  <a href="#" class="list-group-item">11-12</a>
			  <a href="#" class="list-group-item">12-1</a>
			  <a href="#" class="list-group-item">1-2</a>
			  <a href="#" class="list-group-item">2-3</a>
			  <a href="#" class="list-group-item">3-4</a>
			  <a href="#" class="list-group-item">4-5</a>
			</div></div>
		<div class="col-md-2" style="margin:0;padding:0;">
			<h2>Wednesday</h2>
			<div class="list-group">
				<a href="#" class="list-group-item">7-8</a>
			  <a href="#" class="list-group-item">8-9</a>
			  <a href="#" class="list-group-item">9-10</a>
			  <a href="#" class="list-group-item">10-11</a>
			  <a href="#" class="list-group-item">11-12</a>
			  <a href="#" class="list-group-item">12-1</a>
			  <a href="#" class="list-group-item">1-2</a>
			  <a href="#" class="list-group-item">2-3</a>
			  <a href="#" class="list-group-item">3-4</a>
			  <a href="#" class="list-group-item">4-5</a>
			</div></div>
		<div class="col-md-2" style="margin:0;padding:0;">
			<h2>Thursday</h2>
			<div class="list-group">
				<a href="#" class="list-group-item">7-8</a>
			  <a href="#" class="list-group-item">8-9</a>
			  <a href="#" class="list-group-item">9-10</a>
			  <a href="#" class="list-group-item">10-11</a>
			  <a href="#" class="list-group-item">11-12</a>
			  <a href="#" class="list-group-item">12-1</a>
			  <a href="#" class="list-group-item">1-2</a>
			  <a href="#" class="list-group-item">2-3</a>
			  <a href="#" class="list-group-item">3-4</a>
			  <a href="#" class="list-group-item">4-5</a>
			</div></div>
		<div class="col-md-2" style="margin:0;padding:0;">
			<h2>Friday</h2>
			<div class="list-group">
				<a href="#" class="list-group-item">7-8</a>
			  <a href="#" class="list-group-item">8-9</a>
			  <a href="#" class="list-group-item">9-10</a>
			  <a href="#" class="list-group-item">10-11</a>
			  <a href="#" class="list-group-item">11-12</a>
			  <a href="#" class="list-group-item">12-1</a>
			  <a href="#" class="list-group-item">1-2</a>
			  <a href="#" class="list-group-item">2-3</a>
			  <a href="#" class="list-group-item">3-4</a>
			  <a href="#" class="list-group-item">4-5</a>
			</div></div>
		<div class="col-md-2"></div>

	</div>
	</div>

	{{ HTML::script('assets/bootstrap/js/bootstrap.js') }}
</body>
</html>
