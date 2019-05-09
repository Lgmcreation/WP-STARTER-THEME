/*JAVASCRIPT*/
var concat = require('gulp-concat'),
	plumber = require('gulp-plumber'),
	uglify = require('gulp-uglify'),
	babel = require('gulp-babel'),
	notify = require('gulp-notify'),
	sourcemaps = require('gulp-sourcemaps'),
	_if = require('gulp-if'),
	add = require('gulp-add-src');

var plumberErrorHandler = {
	errorHandler: notify.onError({
		title: 'Gulp',
		message: 'Error: <%= error.message %>'
	})
};
module.exports = function (gulp, paths, plugins, prod) {
	return function () {
		gulp.src([paths.devjs + 'jquery.js'])
			.pipe(plumber(plumberErrorHandler))
			.pipe(_if(!prod, sourcemaps.init()))
			//.pipe(add.prepend(paths.devjslibs+'tweenmax.js'))
			//.pipe(add.append(paths.devjslibs+'fancybox.js'))
			.pipe(add.append(paths.devjs + 'main.js'))
			.pipe(concat('main.min.js'))
			.pipe(babel({
				"presets": [
					["env", {
						"targets": {
							// The % refers to the global coverage of users from browserslist
							"browsers": [">0.25%", "not ie 11", "not op_mini all"]
						}
					}]
				]
			}))
<<<<<<< HEAD
			.pipe(_if(prod, uglify()))
			.pipe(_if(!prod, sourcemaps.write()))
=======
			.pipe(_if(prod,uglify()))
			.pipe(_if(!prod,sourcemaps.write()))
>>>>>>> 679d478cd8fd68f5df856e57fca5046629aec3b9
			.pipe(gulp.dest(paths.assetjs));
	};
};
