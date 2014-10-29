<!doctype html>
<html>
<head>
	<title>Slate - Polymer Test</title>
	<meta name="viewport"content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
	
	{{ HTML::script('assets/bower_components/platform/platform.js') }}

	<link rel="import" href="/assets/bower_components/font-roboto/roboto.html">
	<link rel="import" href="/assets/bower_components/core-drawer-panel/core-drawer-panel.html">
	<link rel="import" href="/assets/bower_components/core-toolbar/core-toolbar.html">
	<link rel="import" href="/assets/bower_components/core-ajax/core-ajax.html">

	{{ HTML::style('assets/css/styles.css') }}

</head>
<body unresolved fullbleed>
	<core-toolbar></core-toolbar>
	<core-drawer-panel>
		<div drawer>
			<p>Drawer</p>
		</div>
		<div main>
			<p>Main Pannel...</p>
		</div>
	</core-drawer-panel>


	<script>
		var request = new XMLHttpRequest(),
			data;
		request.open('GET', '/api/v1/advisors', true);

		request.onload = function() {
			if(this.status >= 200 && this.status < 400) {
				//data = JSON.parse(this.response);
				console.log(this.response);
			} else {
				console.log('error');
			}
		};

		request.onerror = function() {
			console.log('error');
		}

		request.send();
	</script>
</body>
</html>