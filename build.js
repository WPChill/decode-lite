var Metalsmith = require('metalsmith'),
	markdown   = require('metalsmith-markdown'),
	templates  = require('metalsmith-templates');

Metalsmith(__dirname)
	.source('./src')
	.clean(false)
	.use(markdown())
	.use(templates('handlebars'))
	.destination('./build')
	.build(function(err){
		if (err) throw err;
	});