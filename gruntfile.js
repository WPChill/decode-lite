var exec = require('child_process').exec;
process.on('SIGINT', function () {
	exec('/Applications/MAMP/bin/stop.sh', function () {
		process.exit();
	});
});

module.exports = function(grunt) {
	
	// Configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		modernizr: {
			makefile: {
				"devFile": "remote", // Skip check for dev file
				"outputFile": "js/src/modernizr.js",
				"extra": {
					"shiv": false,
					"printshiv": true,
					"load": true,
					"mq": true,
					"cssclasses": true
				},
				"extensibility": {
					"addtest": false,
					"prefixed": false,
					"teststyles": true,
					"testprops": true,
					"testallprops": true,
					"hasevents": false,
					"prefixes": true,
					"domprefixes": true
				},
				"uglify": false,
				"tests": ['csstransforms', 'inlinesvg', 'touch', 'flexbox'],
				"parseFiles": false,
				"matchCommunityTests": false
			}
		},
		
		jshint: {
			all: ['Gruntfile.js', 'js/src/sidebar.js', 'js/src/dropdown.js']
		},
		
		uglify: {
			options: {
				sourceMap: true
			},
			build_decode_basic: {
				options: {
					sourceMapName: 'js/srcmaps/decode.js.map'
				},
				files: {
					'js/decode.js': ['js/src/modernizr.js', 'js/src/decode.js', 'js/src/fastclick.js'],
				}
			},
			build_decode_with_sidebar: {
				options: {
					sourceMapName: 'js/srcmaps/decode-with-sidebar.js.map'
				},
				files: {
					'js/decode-with-sidebar.js': ['js/src/modernizr.js', 'js/src/decode.js', 'js/src/sidebar.js', 'js/src/fastclick.js'],
				}
			},
			customizer: {
				options: {
					sourceMapName: 'js/srcmaps/customizer.js.map'
				},
				files: {
					'js/customizer.js': ['js/src/customizer.js'],
				}
			}
		},
		
		sass: {
			options: {
                sourceMap: true
            },
            files: {
	        	expand: true,
				flatten: true,
				cwd: 'css/src/',
				src: ['*.scss'],
				dest: 'css/',
				ext: '.css'
			}
    	},
		
		csscomb: {
			options: {
				config: 'csscomb.json'
			},
			comb: {
				expand: true,
				src: ['css/src/*.css']
			}
		},
		
		csslint: {
			options: {
				'adjoining-classes': false,
				'box-model': false,
				'box-sizing': false,
				'unique-headings': false,
				'qualified-headings': false
			},
			lint: {
				expand: true,
				src: ['css/src/*.css']
			}
		},

		autoprefixer: {
			options: {
				browsers: ['> 1%', 'last 2 versions', 'ie 9', 'ie 8', 'firefox 24', 'opera 12.1'],
				map: true
			},
			prefix: {
				expand: true,
				src: ['css/src/*.css']
			}
		},

		cssmin: {
			minify: {
				expand: true,
				flatten: true,
				cwd: 'css/',
				src: ['*.css'],
				ext: '.css'
			}
		},
		
		imageoptim: {
			optimize: {
				expand: true,
				src: ['images'],
				options: {
					jpegMini: false,
					imageAlpha: true,
					quitAfter: true
				}
			}
		},
		
		markdown: {
			readme: {
				options: {
					template: 'docs/src/READMETemplate.html'
				},
				files: {
					'docs/README.html': ['docs/src/README.md']
				}
			},
			customcss: {
				options: {
					template: 'docs/src/CustomCSSTemplate.html'
				},
				files: {
					'docs/CustomCSS.html': ['docs/src/CustomCSS.md']
				}
			}
		},
		
		/* Copy Readme.md to project root */
		copy: {
			copy_readme: {
				files: {
					'README.md': ['docs/src/README.md']
				}
			}
		},

		watch: {
			scripts: {
				files: ['js/src/*.js'],
				tasks: ['uglify']
			},
			css: {
				files: ['css/src/*.css'],
				tasks: ['sass', 'autoprefixer', 'cssmin']
			},
			docs: {
				files: ['docs/src/*.md'],
				tasks: ['markdown', 'copy']
			},
			livereload: {
				options: { livereload: true },
				files: ['*.php', '**/*.php', 'style.css', 'css/**', 'js/build/*.js']
			}
		},
		
		exec: {
			serverup: {
				command: '/Applications/MAMP/bin/start.sh'
			},
			serverdown: {
				command: '/Applications/MAMP/bin/stop.sh'
			}
		}
	});
	
	// Plugin List
	grunt.loadNpmTasks("grunt-modernizr");
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-csscomb');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-imageoptim');
	grunt.loadNpmTasks('grunt-markdown');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-exec');

	
	// Workflows
	// $ grunt: Concencates, prefixes, minifies JS and CSS files, shrinks images, and generates docs. The works.
	grunt.registerTask('default', [
		'modernizr',
		'jshint',
		'uglify',
		'sass',
		'csscomb',
		'autoprefixer',
		'cssmin',
		'newer:imageoptim',
		'markdown',
		'copy'
	]);
		
	// $ grunt dev: Starts MAMP server, watches for changes while developing.
	grunt.registerTask('dev', [
		'exec:serverup',
		'watch',
		'exec:serverdown'
	]);

};