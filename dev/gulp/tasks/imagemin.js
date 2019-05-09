/*GENERATION IMG*/
var newer= require('gulp-newer'),
imagemin= require('gulp-imagemin');

var opts = [      
	{optimizationLevel: 5, progressive: true, interlace: true}
]

module.exports = function (gulp, paths, plugins) {
	return function () {
		gulp.src(paths.devimg+'/*.{png, gif, jpg, jpeg}')
		.pipe(newer(paths.devimg+'/*.*'))
		.pipe(imagemin(opts))
		.pipe(gulp.dest(paths.assetimages));
	};
};