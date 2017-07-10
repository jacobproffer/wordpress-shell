'use strict';

// Requires + Variables
var gulp        = require('gulp'),
    sass        = require('gulp-sass'),
    cssmin      = require('gulp-cssmin'),
    rename      = require('gulp-rename'),
    prefix      = require('gulp-autoprefixer'),
    uglify      = require('gulp-uglify'),
    concat      = require('gulp-concat'),
    scripts = [
      '../assets/js/lib/jquery-3.2.1.min.js',
      '../assets/js/lib/headroom/headroom.min.js',
      '../assets/js/lib/headroom/jQuery.headroom.js',
      '../assets/js/app.js'
    ];

// Configure css tasks
gulp.task('sass', function () {
  return gulp.src('../assets/scss/**/*.scss')
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(prefix('last 2 versions'))
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('../dist/css'))
});

// Configure js tasks
gulp.task('js', function() {
  return gulp.src(scripts)
    .pipe(uglify())
    .pipe(concat('app.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('../dist/js'))
});

// Watch scss/js files
gulp.task('serve', ['sass', 'js'], function() {
    gulp.watch('../assets/scss/**/*.scss', ['sass']);
    gulp.watch('../assets/js/**/*.js', ['js']);
});

// Default task
gulp.task('default', ['sass', 'js', 'serve']);
