'use strict';

const gulp = require('gulp');

gulp.task('sass', function () {
  const sass = require('gulp-sass');
  return gulp.src('./sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'));
});

gulp.task('sass:watch', function () {
  gulp.watch('./sass/**/*.scss', ['sass']);
});

gulp.task('postcss', function () {
  var postcss = require('gulp-postcss');
  var sourcemaps = require('gulp-sourcemaps');
  var autoprefixer = require('autoprefixer');
  var cssnano = require('cssnano');
  return gulp.src('./css/*.css')
    .pipe(sourcemaps.init())
    .pipe(postcss([
      autoprefixer(),
      cssnano()
    ]))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./css'));
});
