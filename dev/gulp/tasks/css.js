/*GENERATION CSS*/
var postcss = require('gulp-postcss'),
plumber= require('gulp-plumber'),
notify= require('gulp-notify'),
sourcemaps = require('gulp-sourcemaps'),
sass= require('gulp-sass'),
cssnano = require('gulp-cssnano'),
autoprefixer= require('autoprefixer'),
mqpaker= require('css-mqpacker'),
rename = require('gulp-rename'),
del = require('del'),
_if = require('gulp-if');


var plumberErrorHandler = { errorHandler: notify.onError({
	title: 'Gulp',
	message: 'Error: <%= error.message %>' 
}) 
};
var processors = [      
	autoprefixer({browsers: ['last 5 versions']}),
	mqpaker
]
module.exports = function (gulp, paths, plugins,prod,package) {
	return function () {
			del(paths.assetcss+'*.map');
			gulp.src(paths.devscss+'*.scss')
			.pipe(plumber(plumberErrorHandler))
			.pipe(_if(!prod,sourcemaps.init()))
			.pipe(sass())
			.pipe(postcss(processors))
			.pipe(rename({basename: "style"}))
			.pipe(gulp.dest(paths.racine))
			.pipe(_if(prod,cssnano({zindex: false})))
			.pipe(_if(!prod,rename( {
				basename: "style"
			})))
			.pipe(_if(prod,rename( {
				basename: "style",
				suffix: '.min.'+ package.version
			})))
			.pipe(_if(!prod,sourcemaps.write('.')))
			.pipe(gulp.dest(paths.assetcss));
	};
};