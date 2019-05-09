//Var
var  replace = require('gulp-replace');

module.exports = function (gulp, paths, plugins) {
	return function () {
		gulp.src([paths.assetcss+'critical/*.css'])
		.pipe(replace('../images/', site+'/wp-content/themes/'+theme+'/assets/images/'))
		.pipe(gulp.dest(paths.assetcss+'critical/'));
	};
};