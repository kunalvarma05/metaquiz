var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');

//Build Application CSS
gulp.task('buildAppCSS', function() {
	return gulp.src('site_modules/scss/application/master.scss').pipe(sass()).pipe(autoprefixer('last 1 version')).pipe(concat('assets/stylesheets/application.css')).pipe(minifycss({
		keepBreaks : true
	})).pipe(gulp.dest(''));
});

//Build Management CSS
gulp.task('buildManagementCSS', function() {
	return gulp.src('site_modules/scss/management/master.scss').pipe(sass()).pipe(autoprefixer('last 1 version')).pipe(concat('assets/stylesheets/management.css')).pipe(minifycss({
		keepBreaks : true
	})).pipe(gulp.dest(''));
});

//Build JS
gulp.task('buildJS', function() {
	gulp.src('site_modules/javascript/*.js').pipe(uglify()).pipe(gulp.dest('assets/javascripts/'));
});

//Watch CSS Changes
gulp.task('watch', function() {
	//Watch App Css
	gulp.watch('site_modules/scss/application/**/*.scss', function() {
		gulp.run('buildAppCSS');
	});
	//Watch Management Css
	gulp.watch('site_modules/scss/management/**/*.scss', function() {
		gulp.run('buildManagementCSS');
	});
	//Wacth JS Changes
	gulp.watch('site_modules/javascript/*.js', function() {
		gulp.run('buildJS');
	});
});

//Default Task
gulp.task('default', function() {
	gulp.run('buildAppCSS');
	gulp.run('buildManagementCSS');
	gulp.run('buildJS');
	gulp.run('watch');
});
