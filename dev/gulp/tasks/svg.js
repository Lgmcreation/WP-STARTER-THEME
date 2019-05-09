/*GENERATION FICHIER SVG*/
var svgmin = require('gulp-svgmin'),
rename = require('gulp-rename'),
util= require('gulp-util'),
del = require('del'),
newer= require('gulp-newer'),
svgstore = require('gulp-svgstore');

module.exports = function (gulp, paths, plugins) {
	return function () {
		del(paths.assetimages+'svguse.svg');
		gulp.src(paths.devimg+'svg/use/*.svg')
		.pipe(newer(paths.devimg+'svg/use/*.svg'))
		.pipe(svgmin())
		.pipe(svgstore())
		.pipe(rename('svguse.svg'))
		.pipe(gulp.dest(paths.assetimages));
		};
};