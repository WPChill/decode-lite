module.exports = function(grunt) {
	
	// Configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		modernizr: {
			makefile: {
				"devFile": "js/src/modernizr-dev.js",
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
				"matchCommunityTests": false,
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
		
		csscomb: {
			options: {
                config: 'csscomb.json'
            },
			comb: {
				expand: true,
				flatten: true,
				cwd: 'css/src/',
				src: ['*.css'],
				dest: 'css/src/',
				ext: '.css'
			}
		},

		autoprefixer: {
            options: {
				browsers: ['> 1%', 'last 2 versions', 'ie 9', 'ie 8', 'firefox 24', 'opera 12.1'],
				map: true
			},
			prefix: {
				expand: true,
				flatten: true,
				cwd: 'css/src/',
				src: ['*.css'],
				dest: 'css/',
				ext: '.css'
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
					'docs/README.html': ['docs/src/README.md'],
				}
			},
			customcss: {
				options: {
					template: 'docs/src/CustomCSSTemplate.html'
				},
				files: {
					'docs/CustomCSS.html': ['docs/src/CustomCSS.md'],
				}
			}
		},
		
		copy: {
			readme: {
				expand: true,
				flatten: true,
				src: 'docs/src/README.md'
			}
		},

        watch: {
			scripts: {
				files: ['js/src/*.js'],
				tasks: ['uglify'],
				options: {
					spawn: false
				}
			},
			css: {
				files: ['css/src/*.css'],
				tasks: ['csscomb', 'autoprefixer', 'cssmin'],
				options: {
					spawn: false
				}
			},
			docs: {
				files: ['docs/src/*.md'],
				tasks: ['markdown', 'copy'],
				options: {
					spawn: false
				}
			},
			livereload: {
				options: { livereload: true },
				files: ['*.php', '**/*.php', 'style.css', 'css/**', 'js/build/*.js'],
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
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-csscomb');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks("grunt-modernizr");
    grunt.loadNpmTasks('grunt-imageoptim');
    grunt.loadNpmTasks('grunt-markdown');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-exec');

    
	// Workflows
	// $ grunt: Concencates, prefixes, minifies JS and CSS files. The works.
	grunt.registerTask('default', [
		'modernizr',
		'jshint',
		'uglify',
		'csscomb',
		'autoprefixer',
		'cssmin',
		'markdown',
		'copy'
	]);
	
	// $ grunt images: Goes through all images with ImageOptim and ImageAlpha (Requires ImageOptim and ImageAlpha to work)
	grunt.registerTask('images', [
		'imageoptim'
	]);
	
	// $ grunt dev: Watches for changes while developing, start MAMP server
	grunt.registerTask('dev', [
		'exec:serverup',
		'watch',
		'exec:serverdown'
	]);

};