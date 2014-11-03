Handlebars.getTemplate = function(name) {
	if(Handlebars.templates === undefined) {
		Handlebars.templates = {};
	} 

	if(Handlebars.templates[name] !== undefined) {
		return Handlebars.templates[name];
	}

	var request = new XMLHttpRequest(),
		url = 'views/' + name.trim() + '.handlebars';

	request.open('GET', url, false);

	request.onload = function() {
		if(this.status >= 200 && this.status < 400) {
			// Success
			var data = this.response;
			Handlebars.templates[name] = Handlebars.compile(data);
		} 
	}

	request.send();

	return Handlebars.templates[name];
}