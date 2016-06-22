var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    newer = require('gulp-newer'),
    globbing = require('gulp-css-globbing'),
    cmq = require('gulp-combine-mq')

// ROOT TASKS // ---------------------------------------------------------
// Main style task
gulp.task('css', function() {
  return gulp.src('sass/application.scss')
    .pipe(globbing({extensions: '.scss'}))
    .pipe(sass())
    .on('error', handleError)
    .pipe(cmq()) // combine all @media queries into the page base
    .pipe(autoprefixer({cascade: false})) // auto prefix
    .pipe(gulp.dest('css'));
});

// Main Javascript task
gulp.task('js', function() {
  return gulp.src('js/base.js')
    .pipe(newer('js/min'))
    .pipe(uglify())
    .on('error', handleError)
    .pipe(gulp.dest('js/min'));
});

// FUNCTIONS // ---------------------------------------------------------
// Initial start function
gulp.task('start', function() {
  gulp.start('js', 'css');
});

// Watch function
gulp.task('watch', ['start'], function() {
  gulp.watch('sass/**/*.scss', ['css']);
  gulp.watch('js/base.js', ['js']);
});

// Default function
gulp.task('default', ['watch']);

// Error reporting function
function handleError(err) {
  console.log(err.toString());
  this.emit('end');
}
