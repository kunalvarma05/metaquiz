var gulp = require('gulp');
var gutil = require('gulp-util');
var minifycss = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var include = require('gulp-include');
var size = require('gulp-filesize');
var clean = require('gulp-clean');

/**
 * Clean CSS
 * - Cleans all the CSS Files in the stylesheets directory
 */
gulp.task('cleanCSS', function(){
	return gulp.src('assets/stylesheets/*.css', {read: false})
    .pipe(clean());
});

/**
 * Clean JS
 * - Cleans the complete javascripts directory
 */
gulp.task('cleanJS', function(){
	return gulp.src('assets/javascripts/*.js', {read: false})
    .pipe(clean());
});


/**
 * Build Application CSS
 * Steps
 * - Takes the master.scss file from application folder
 * - Compiles the sass to css
 * - Autoprefixes the properties with various vendor prefixes
 * - Renames to application.css
 * - Checks the size
 * - Minifies the CSS
 * - Checks the size
 * - Stores to the given destination
 */
gulp.task('buildAppCSS', function() {
	return gulp.src('site_modules/scss/application/master.scss')
	.pipe(sass())
	.pipe(autoprefixer('last 1 version', 'ie 9'))
	.pipe(rename('assets/stylesheets/application.css'))
	.pipe(size())
	.pipe(minifycss({
		keepBreaks : true
	}))
	.pipe(size())
	.pipe(gulp.dest(''));
});

/**
 * Build Global CSS
 * Steps
 * - Takes the master.scss file from global folder
 * - Compiles the sass to css
 * - Autoprefixes the properties with various vendor prefixes
 * - Renames to global.css
 * - Checks the size
 * - Minifies the CSS
 * - Checks the size
 * - Stores to the given destination
 */
gulp.task('buildGlobalCSS', function() {
	return gulp.src('site_modules/scss/global/master.scss')
	.pipe(sass())
	.pipe(autoprefixer('last 1 version', 'ie 9'))
	.pipe(rename('assets/stylesheets/global.css'))
	.pipe(size())
	.pipe(minifycss({
		keepBreaks : true
	}))
	.pipe(size())
	.pipe(gulp.dest(''));
});

/**
 * Build backend CSS
 * Steps
 * - Takes the master.scss file from backend folder
 * - Compiles the sass to css
 * - Autoprefixes the properties with various vendor prefixes
 * - Renames to backend.css
 * - Checks the size
 * - Minifies the CSS
 * - Checks the size
 * - Stores to the given destination
 */
gulp.task('buildBackendCSS', function() {
	return gulp.src('site_modules/scss/backend/master.scss')
	.pipe(sass())
	.pipe(autoprefixer('last 1 version', 'ie 9'))
	.pipe(rename('assets/stylesheets/backend.css'))
	.pipe(size())
	.pipe(minifycss({
		keepBreaks : false
	}))
	.pipe(size())
	.pipe(gulp.dest(''));
});

/**
 * Build JS
 * Steps
 * - Takes all the JS file from the ROOT of the javascripts library folder
 * - File insertion compilation
 * - Checks the size
 * - Minifies the JS
 * - Checks the size
 * - Saves to the assets/javascripts directory
 * - Outputs any errors
 */
gulp.task('buildJS', function() {
	gulp.src('site_modules/javascript/*.js')
	.pipe(include())
	.pipe(size())
	.pipe(uglify())
	.pipe(gulp.dest('assets/javascripts/'))
	.pipe(size())
	.on('error', gutil.log);
});

/**
 * Watch all the scss files for BuildCSS
 * Watch all the js files for BuildJS
 */
gulp.task('watch', function() {
	gulp.watch('site_modules/scss/application/**/*.scss', ['buildAppCSS']);
	gulp.watch('site_modules/scss/global/**/*.scss', ['buildGlobalCSS']);
	gulp.watch('site_modules/scss/backend/**/*.scss', ['buildBackendCSS']);
	gulp.watch('site_modules/javascript/**/*.js', ['buildJS']);
});

//Default Task
gulp.task('default', ['cleanCSS','cleanJS','buildAppCSS','buildGlobalCSS','buildBackendCSS','buildJS','watch']);
