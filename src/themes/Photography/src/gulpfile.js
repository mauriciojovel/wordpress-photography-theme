var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
//js
var tap = require('gulp-tap');
var gutil = require('gulp-util');
var browserify = require('browserify');
var uglify = require('gulp-uglify');
var buffer = require('gulp-buffer');
var concat = require('gulp-concat');

var browserSync = require('browser-sync').create();

// Config variables
var config = {
  localUrl: 'http://wiklapp.com',
  host: 'wiklapp.com',
  styles: {
    input: './sass/**/*.scss',
    output: '../assets/css'
  },
  scripts: {
    input: [
      './js/*.js'
    ],
    output: '../assets/js'
  },
  php : {
    input: '../php/**/*.php' 
  },
  sass: {
    errLogToConsole: true,
    outputStyle: 'compressed'
  },
  autoprefixer: {
    browsers: ['last 2 versions', '> 5%']    
  }
};

/*
 * Tasks
 */

// Sass
gulp.task('styles', function () {
  return gulp
    .src(config.styles.input)
    .pipe(sourcemaps.init())
    .pipe(sass(config.sass).on('error', sass.logError))
    .pipe(autoprefixer(config.autoprefixer))
    .pipe(sourcemaps.write('/maps'))
    .pipe(gulp.dest(config.styles.output))
    .pipe(browserSync.stream());
});

// JS
gulp.task('js', function () {
  return gulp.src(config.scripts.input, {read: false})
    .pipe(tap(function (file) {
      gutil.log('bundling ' + file.path);
      file.contents = browserify(file.path, {debug: true}).bundle();
    }))
    .pipe(buffer())
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(uglify())
    .pipe(sourcemaps.write('/maps'))
    //.pipe(concat('all.js'))
    .pipe(gulp.dest(config.scripts.output))
    .pipe(browserSync.stream());
});

// Dev
gulp.task('dev', ['styles', 'js'], function() {
  gulp.watch(config.styles.input, ['styles']);
  gulp.watch(config.scripts.input, ['js']);
});

gulp.task('serve', ['styles', 'js'], function() {
      browserSync.init({
          proxy: config.localUrl
      });
      gulp.watch(config.styles.input, ['styles']);
      gulp.watch(config.scripts.input, ['js']);
      gulp.watch(config.php.input).on('change', browserSync.reload);
  });


gulp.task('default', ['styles', 'js']);
