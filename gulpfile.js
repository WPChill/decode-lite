var gulp       = require('gulp'),
	merge      = require('merge-stream'),
	csscomb    = require('gulp-csscomb'),
	sass       = require('gulp-sass'),
	postcss    = require('gulp-postcss'),
	concat     = require('gulp-concat'),
	uglify     = require('gulp-uglify'),
	modernizr  = require('gulp-modernizr');
	sourcemaps = require('gulp-sourcemaps');

var paths = {
	styles:           ['styles/src/*.scss', '!styles/src/_*.scss'],
	decodeScript:     ['scripts/src/modernizr.js', 'node_modules/fastclick/lib/fastclick.js', 'scripts/src/sidebar.js', 'scripts/src/dropdown.js', 'scripts/src/decode.js' ],
	customizerScript: 'scripts/src/customizer.js'
};

gulp.task('styles', function() {
	var processors = [
		require('autoprefixer-core')('last 2 versions', '> 1%', 'ie 9', 'ie 8', 'Firefox ESR'),
		require('css-mqpacker'),
		require('postcss-import')({path: ['node_modules']}),
		require('csswring')
    ];
    
	return gulp.src(paths.styles)
		.pipe(sourcemaps.init())
			.pipe(csscomb())
			.pipe(sass())
			.pipe(postcss(processors))
		.pipe(sourcemaps.write('srcmaps/'))
		.pipe(gulp.dest('styles/'));
});

gulp.task('copy', ['styles'], function() {
	gulp.src('styles/style.css')
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(sourcemaps.write('styles/srcmaps/'))
		.pipe(gulp.dest('./'));
});

gulp.task('scripts', function() {
	var decodeScript = gulp.src(paths.decodeScript)
		.pipe(sourcemaps.init())
			.pipe(concat('decode.js'))
			.pipe(uglify())
		.pipe(sourcemaps.write('srcmaps/'))
		.pipe(gulp.dest('scripts/'));

	var customizerScript = gulp.src(paths.customizerScript)
		.pipe(sourcemaps.init())
			.pipe(concat('customizer.js'))
			.pipe(uglify())
		.pipe(sourcemaps.write('srcmaps/'))
		.pipe(gulp.dest('scripts/'));

	return merge(decodeScript, customizerScript);
});

gulp.task('modernizr', function() {
	gulp.src('scripts/src/*.js').pipe(modernizr({
		cache:   true,
		dest:    'scripts/src/modernizr.js',
		options: ['setClasses', 'mq', 'html5printshiv'],
		tests:   ['csstransforms', 'flexbox', 'inlinesvg', 'touchevents'],
		crawl:   false
	}))
	.pipe(gulp.dest('scripts/src/'));
});

gulp.task('watch', function() {
	gulp.watch(paths.styles, ['styles', 'copy']);
	gulp.watch([paths.decodeScript, paths.customizerScript], ['scripts']);
});

// Workflows
// $ gulp: Builds, prefixes, and minifies CSS files; concencates and minifies JS files; watches for changes. The works.
gulp.task('default', ['styles', 'copy', 'scripts', 'watch']);

// $ gulp build: Builds, prefixes, and minifies CSS files; concencates and minifies JS files. For deployments.
gulp.task('build', ['styles', 'copy', 'scripts']);