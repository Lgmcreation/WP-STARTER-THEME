//REQUIRE
var gulp = require('gulp'),
plugins = require('gulp-load-plugins')(),
browserSync = require('browser-sync'),
package = require('./package.json'),
gutil = require('gulp-util'),
reload = browserSync.reload;
require('load-gulp-tasks')();

//PATHS AND VARIABLES
var baseurl = 'http://localhost/';
var prod = gutil.env.production;
var paths = {
    racine: './',
    theme : package.name,
    site: baseurl+package.name,
    dev : 'dev/',
    devscss : 'dev/css/',
    devimg : 'dev/img/',
    devjs : 'dev/js/',
    devjslibs : 'dev/js/libs/',
    assetcss : 'assets/css/',
    assetjs : 'assets/js/',
    assetimages : 'assets/images/',
    language : 'languages/',
    pattern: ['dev/gulp/tasks/*.js']
};

//FUNCTIONS
function getTask(task) {
    return require('./dev/gulp/tasks/' + task)(gulp,paths,plugins,prod,package);
}
//IMAGE
gulp.task('img', getTask('imagemin'));
//CSS
gulp.task('css', getTask('css'));
//JS
gulp.task('js', getTask('javascript'));
//SVG
gulp.task('svg', getTask('svg'));
//CRITICAL CSS
gulp.task('critical', getTask('critical-css'));
gulp.task('replace', getTask('replace-css'));
//Local dev
gulp.task('browser-sync', getTask('browser-sync'));

/*WATCH*/
gulp.task('default', ['browser-sync','svg','img','css','svg','js'], function() {
    gulp.watch(paths.devimg+'*.{png, gif, jpg, jpeg}',['img']).on('change', reload);
    gulp.watch(paths.devimg+'svg/use/*.svg',['svg']).on('change', reload);
    gulp.watch(paths.devscss+'**.scss',['css']).on('change', reload);
    gulp.watch(paths.devjs+'*.js',['js']).on('change', reload);
    gulp.watch('*.php').on('change', reload);
});

/*PROD*/
gulp.task('prod', ['svg','img','css','svg','js','critical']);

