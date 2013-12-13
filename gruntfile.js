module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
        	dist_decode_basic: {
				src: [
					'js/decode.js',
					'js/modernizr.js',
				],
				dest: 'js/build/decode.js',
			},
			
			dist_decode_with_sidebar: {
				src: [
					'js/decode.js',
					'js/modernizr.js',
					'js/fastclick.js',
					'js/sidebar.js'
				],
				dest: 'js/build/decode-with-sidebar.js',
			}
        },
        
        uglify: {
			build_decode_basic: {
				src: 'js/build/decode.js',
				dest: 'js/build/decode.min.js'
			},
			build_decode_with_sidebar: {
				src: 'js/build/decode-with-sidebar.js',
				dest: 'js/build/decode-with-sidebar.min.js'
			}
		},
				
		autoprefixer: {
            options: {
				browsers: ['> 1%', 'last 2 versions', 'ie 9', 'ie 8', 'ie 7']
			},
            dist: {
                files: {
                    'build/style.css': 'style.css'
                }
            }
        },
        
        cssmin: {
			minify: {
				expand: true,
				src: ['.css', '!*.min.css', '!rtl.css'],
				dest: 'build/',
				ext: '.min.css'
			}
		},
        
        watch: {
        	options: {
				livereload: true,
			},
			scripts: {
				files: ['js/*.js'],
				tasks: ['concat', 'uglify'],
				options: {
					spawn: false,
				}
			},
			css: {
				files: ['style.css'],
				tasks: ['autoprefixer', 'cssmin'],
				options: {
					spawn: false,
				}
			}
		}
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat', 'uglify', 'autoprefixer', 'cssmin']);
    grunt.registerTask('dev', ['watch']);

};