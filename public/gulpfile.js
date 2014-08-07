var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');

//Build CSS
gulp.task('buildCSS', function() {
	return gulp.src('site_modules/scss/master.scss').pipe(sass()).pipe(autoprefixer('last 1 version')).pipe(concat('assets/stylesheets/style.css')).pipe(minifycss({
		keepBreaks : true
	})).pipe(gulp.dest(''));
});

//Build JS
gulp.task('buildJS', function() {
	gulp.src('site_modules/javascript/*.js').pipe(uglify()).pipe(gulp.dest('assets/javascripts/'));
});

//Watch CSS Changes
gulp.task('watch', function() {
	gulp.watch('site_modules/scss/**/*.scss', function() {
		gulp.run('buildCSS');
	});
	gulp.watch('site_modules/javascript/*.js', function() {
		gulp.run('buildJS');
	});
});

//Default Task
gulp.task('default', function() {
	gulp.run('buildCSS');
	gulp.run('buildJS');
	gulp.run('watch');
});
