module.exports = function(grunt) {

    // Configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
		
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
				browsers: ['> 1%', 'last 2 versions', 'ie 9', 'ie 8', 'ie 7'],
				map: true
			},
            dist: {
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
			main: {
				expand: true,
				flatten: true,
				src: 'css/build/decode.min.css',
				dest: '',
				ext: '.css'
			},
		},
				
		imageoptim: {
			myTask: {
				options: {
					jpegMini: false,
					imageAlpha: true,
					quitAfter: true
				},
				src: ['screenshot.png', 'images/']
			}
		},

        watch: {
        	options: {
				livereload: true,
			},
			scripts: {
				files: ['js/*.js'],
				tasks: ['jsmin-sourcemap'],
				options: {
					spawn: false,
				}
			},
			css: {
				files: ['css/*.css'],
				tasks: ['autoprefixer', 'cssmin', 'copy'],
				options: {
					spawn: false,
				}
			},
			images: {
				files: ['screenshot.png', 'images/'],
				tasks: ['imageoptim'],
				options: {
					spawn: false,
				}
			}
		}
    });
    
    // Plugin List
    grunt.loadNpmTasks('grunt-jsmin-sourcemap');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-imageoptim');
    grunt.loadNpmTasks('grunt-contrib-watch');

	// Workflows
	// $grunt: Concencates, prefixes, minifies JS and CSS files. The works.
	grunt.registerTask('default', ['jsmin-sourcemap', 'autoprefixer', 'cssmin', 'copy']);
	
	// $grunt images: Goes through all images with ImageOptim and ImageAlpha
	grunt.registerTask('images', ['imageoptim']);
	
	// $grunt dev: Watches for changes while developing
	grunt.registerTask('dev', ['watch']);

}