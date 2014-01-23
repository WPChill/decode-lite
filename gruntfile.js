module.exports = function(grunt) {

    // Configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        modernizr: {

			"devFile" : "js/src/modernizr-dev.js",

			"outputFile" : "js/src/modernizr.js",

			"extra" : {
				"shiv" : false,
				"printshiv" : true,
				"load" : true,
				"mq" : true,
				"cssclasses" : true
			},

			"extensibility" : {
				"addtest" : false,
				"prefixed" : false,
				"teststyles" : true,
				"testprops" : true,
				"testallprops" : true,
				"hasevents" : false,
				"prefixes" : true,
				"domprefixes" : true
			},

			"uglify" : false,

			"tests" : ['csstransforms', 'inlinesvg', 'touch'],

			"parseFiles" : false,

			"matchCommunityTests" : false,
		},
		
		jshint: {
			all: ['Gruntfile.js', 'js/src/sidebar.js']
		},
		
		'jsmin-sourcemap': {
			build_decode_basic: {
				cwd: 'js/',
				src: ['src/modernizr.js', 'src/decode.js', 'src/fastclick.js'],
				srcRoot: '../',
				dest: 'decode.js',
				destMap: 'srcmaps/decode.js.map'
			},
			build_decode_with_sidebar: {
				cwd: 'js/',
				src: ['src/modernizr.js', 'src/decode.js', 'src/sidebar.js', 'src/fastclick.js'],
				srcRoot: '../',
				dest: 'decode-with-sidebar.js',				
				destMap: 'srcmaps/decode-with-sidebar.js.map'
			},
			respond: {
				cwd: 'js/',
				src: ['src/respond.js'],
				srcRoot: '../',
				dest: 'respond.js',				
				destMap: 'srcmaps/respond.js.map'
			},
			customizer: {
				cwd: 'js/',
				src: ['src/customizer.js'],
				srcRoot: '../',
				dest: 'customizer.js',				
				destMap: 'srcmaps/customizer.js.map'
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
				cwd: 'css/',
				src: ['*.css'],
				dest: 'css/build/',
				ext: '.prefixed.css'
			}
		},

        cssmin: {
			minify: {
				expand: true,
				flatten: true,
				cwd: 'css/build/',
				src: ['*.css', '!*.min.css'],
				dest: 'css/build/',
				ext: '.min.css'
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
				expand: true,
				flatten: true,
				cwd: 'docs/',
				src: 'src/README.md',
				dest: 'docs/',
				ext: '.html',
				options: {
					template: 'docs/src/READMETemplate.html'
				}
			},
			customcss: {
				expand: true,
				flatten: true,
				cwd: 'docs/',
				src: 'src/CustomCSS.md',
				dest: 'docs/',
				ext: '.html',
				options: {
					template: 'docs/src/CustomCSSTemplate.html'
				}
			},
		},
		
		copy: {
			stylecss: {
				expand: true,
				flatten: true,
				src: 'css/build/style.min.css',
				ext: '.css'
			},
			readme: {
				expand: true,
				flatten: true,
				src: 'docs/src/README.md'
			}
		},

        watch: {
			scripts: {
				files: ['js/src/*.js'],
				tasks: ['jsmin-sourcemap'],
				options: {
					spawn: false
				}
			},
			css: {
				files: ['css/*.css'],
				tasks: ['autoprefixer', 'cssmin', 'copy'],
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
    grunt.loadNpmTasks('grunt-jsmin-sourcemap');
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
	grunt.registerTask('default', ['modernizr', 'jshint', 'jsmin-sourcemap', 'autoprefixer', 'cssmin', 'markdown', 'copy']);
	
	// $ grunt images: Goes through all images with ImageOptim and ImageAlpha (Requires ImageOptim and ImageAlpha to work)
	grunt.registerTask('images', ['imageoptim']);
	
	// $ grunt dev: Watches for changes while developing, start MAMP server
	grunt.registerTask('dev', ['exec:serverup', 'watch', 'exec:serverdown']);

};