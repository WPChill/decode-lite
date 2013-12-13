module.exports = function(grunt) {

    // Configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
        	dist_decode_basic: {
				src: [
					'js/modernizr.js',
					'js/decode.js',
				],
				dest: 'js/build/decode.js',
			},

			dist_decode_with_sidebar: {
				src: [
					'js/modernizr.js',
					'js/decode.js',
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
            	expand: true,
				flatten: true,
                src: ['*.css', '!rtl.css'],
                dest: 'css/'
            }
        },

        cssmin: {
			minify: {
				expand: true,
				flatten: true,
				src: ['css/*.css', '!*.min.css'],
				dest: 'css/',
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

    // Plugin List
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');

	// Workflows
	// $grunt
	grunt.registerTask('default', ['concat', 'uglify', 'autoprefixer', 'cssmin']);
	
	// $grunt dev
	grunt.registerTask('dev', ['watch']);

}