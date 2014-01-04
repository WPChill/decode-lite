module.exports = function(grunt) {

    // Configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        modernizr: {

			// [REQUIRED] Path to the build you're using for development.
			"devFile" : "js/modernizr-dev.js",

			// [REQUIRED] Path to save out the built file.
			"outputFile" : "js/modernizr.js",

			// Based on default settings on http://modernizr.com/download/
			"extra" : {
				"shiv" : false,
				"printshiv" : true,
				"load" : true,
				"mq" : true,
				"cssclasses" : true
			},

			// Based on default settings on http://modernizr.com/download/
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

			// By default, source is uglified before saving
			"uglify" : false,

			// Define any tests you want to implicitly include.
			"tests" : ['csstransforms', 'inlinesvg', 'touch'],

			// By default, this task will crawl your project for references to Modernizr tests.
			// Set to false to disable.
			"parseFiles" : false,

			// When parseFiles = true, this task will crawl all *.js, *.css, *.scss files, except files that are in node_modules/.
			// You can override this by defining a "files" array below.
			// "files" : [],

			// When parseFiles = true, matchCommunityTests = true will attempt to
			// match user-contributed tests.
			"matchCommunityTests" : false,

			// Have custom Modernizr tests? Add paths to their location here.
			"customTests" : []
		},
		
		'jsmin-sourcemap': {
			build_decode_basic: {
				cwd: 'js/',
				src: ['modernizr.js', 'decode.js'],
				srcRoot: '../',
				dest: 'build/decode.js',
				destMap: 'build/decode.js.map'
			},
			build_decode_with_sidebar: {
				cwd: 'js/',
				src: ['modernizr.js', 'decode.js', 'sidebar.js', 'fastclick.js'],
				srcRoot: '../',
				dest: 'build/decode-with-sidebar.js',				
				destMap: 'build/decode-with-sidebar.js.map'
			},
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
		
		copy: {
			stylecss: {
				expand: true,
				flatten: true,
				src: 'css/build/style.min.css',
				ext: '.css'
			},
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

        watch: {
			scripts: {
				files: ['js/*.js'],
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
    grunt.loadNpmTasks('grunt-jsmin-sourcemap');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks("grunt-modernizr");
    grunt.loadNpmTasks('grunt-imageoptim');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-exec');

	// Workflows
	// $ grunt: Concencates, prefixes, minifies JS and CSS files. The works.
	grunt.registerTask('default', ['modernizr', 'jsmin-sourcemap', 'autoprefixer', 'cssmin', 'copy']);
	
	// $ grunt images: Goes through all images with ImageOptim and ImageAlpha (Requires ImageOptim and ImageAlpha to work)
	grunt.registerTask('images', ['imageoptim']);
	
	// $ grunt dev: Watches for changes while developing, start MAMP server
	grunt.registerTask('dev', ['exec:serverup', 'watch', 'exec:serverdown']);

}