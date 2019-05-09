/*GEBERATION FIHIER POT*/
var wpPot = require('gulp-wp-pot'),
sort = require('gulp-sort');

module.exports = function (gulp, paths, plugins) {
	return function () {
		return gulp.src(paths.racine+'*.php')
		.pipe(sort())
		.pipe(wpPot())
		.pipe(gulp.dest(paths.language+'traduction_theme.pot'));
};};