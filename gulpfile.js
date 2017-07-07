'use strict';

var gulp        = require('gulp'),
    sass        = require('gulp-sass'),
    cssmin      = require('gulp-cssmin'),
    rename      = require('gulp-rename'),
    prefix      = require('gulp-autoprefixer'),
    uglify      = require('gulp-uglify'),
    concat      = require('gulp-concat');

var scripts = [
  'assets/js/lib/jquery-3.2.1.min.js',
  'assets/js/lib/headroom/headroom.min.js',
  'assets/js/lib/headroom/jQuery.headroom.js',
  'assets/js/app.js'
];

// Static Server + watching scss/html files
gulp.task('serve', ['sass', 'js'], function() {
    gulp.watch('assets/scss/**/*.scss', ['sass']);
    gulp.watch('assets/js/**/*.js', ['js']);
});

// Configure CSS tasks.
gulp.task('sass', function () {
  return gulp.src('assets/scss/**/*.scss')
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(prefix('last 2 versions'))
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('dist/css'))
});

// Configure JS.
gulp.task('js', function() {
  return gulp.src(scripts)
    .pipe(uglify())
    .pipe(concat('app.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('dist/js'))
});

gulp.task('watch', function () {
  gulp.watch('dist/scss/**/*.scss', ['sass']);
  gulp.watch('dist/js/**/*.js', ['js']);
});

gulp.task('default', ['sass', 'js', 'serve']);
