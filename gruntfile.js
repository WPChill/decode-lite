module.exports = function(grunt) {
	
	// Configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		modernizr: {
			makefile: {
				"devFile": "remote", // Skip check for dev file
				"outputFile": "scripts/src/modernizr.js",
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
			all: ['Gruntfile.js', 'scripts/src/decode.js', 'scripts/src/sidebar.js', 'scripts/src/dropdown.js']
		},
		
		uglify: {
			options: {
				sourceMap: true
			},
			decode: {
				options: {
					sourceMapName: 'scripts/srcmaps/decode.js.map'
				},
				files: {
					'scripts/decode.js': ['scripts/src/modernizr.js', 'scripts/src/fastclick.js', 'scripts/src/sidebar.js', 'scripts/src/dropdown.js', 'scripts/src/decode.js' ],
				}
			},
			customizer: {
				options: {
					sourceMapName: 'scripts/srcmaps/customizer.js.map'
				},
				files: {
					'scripts/customizer.js': ['scripts/src/customizer.js'],
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
				cwd: 'styles/src/',
				src: '*.scss',
				dest: 'styles/',
				ext: '.css'
			}
    	},
		
		csscomb: {
			options: {
				config: 'csscomb.json'
			},
			comb: {
				expand: true,
				src: 'styles/src/*.scss'
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
				src: 'styles/*.css'
			}
		},

		autoprefixer: {
			options: {
				browsers: ['> 1%', 'last 2 versions', 'ie 9', 'ie 8', 'firefox 24', 'opera 12.1'],
				map: true
			},
			prefix: {
				expand: true,
				src: 'styles/*.css'
			}
		},

		cssmin: {
			minify: {
				expand: true,
				flatten: true,
				cwd: 'styles/',
				src: '*.css',
				ext: '.css'
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
				files: ['scripts/src/*.js'],
				tasks: ['uglify']
			},
			css: {
				files: ['styles/src/**/*.scss'],
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
	grunt.loadNpmTasks('grunt-markdown');
	grunt.loadNpmTasks('grunt-contrib-watch');

	
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
		'markdown',
		'copy',
		'watch'
	]);
	
	// $ grunt build: Concencates, prefixes, minifies JS and CSS files, and generates docs. For deployments and Travis.
	grunt.registerTask('build', [
		'modernizr',
		'jshint',
		'uglify',
		'sass',
		'csscomb',
		'autoprefixer',
		'cssmin',
		'markdown',
		'copy'
	]);
		
	// $ grunt dev: Watches for changes while developing.
	grunt.registerTask('dev', [
		'watch'
	]);

};