var gulp = require('gulp');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var prefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var gcmq = require('gulp-group-css-media-queries');

var path = {
    css: ['./sass/style.scss*'],
    watch: './sass/**/*.*',
    maps: './maps/'
};

gulp.task('css', function () {
    gulp.src(path.css)
        .pipe(sourcemaps.init())
        .pipe(sass({
            'outputStyle': 'expanded',
            'indentType': 'space',
            'indentWidth': 4
        }))
        .pipe(prefixer({
            browsers: ['last 2 versions', 'IE 9']
        }))
        .pipe(gcmq())
        .pipe(sourcemaps.write(path.maps))
        .pipe(gulp.dest('./'))
});

gulp.task('watch', function () {
    watch(path.watch, function () {
        gulp.start('css')
    })
});

gulp.task('default', ['css', 'watch']);