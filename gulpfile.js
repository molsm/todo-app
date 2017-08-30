'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

gulp.task('sass', function () {
    return gulp.src('./resources/assets/sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write('./map'))
        .pipe(gulp.dest('./public/css'));
});

gulp.task('scripts', function() {
    gulp.src('./resources/assets/js/**/*.js')
        .pipe(concat('app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'))
});

gulp.task('sass:watch', function () {
    gulp.watch('./resources/assets/sass/**/*.scss', ['sass']);
});

gulp.task('default', function() {
    gulp.start('sass', 'scripts');
});

