var browserSync = require('browser-sync');

module.exports = function(gulp, paths, plugins) {
	return function() {
		browserSync.init(null, {
			host: 'lgm.dev',
			proxy: paths.site,
			port:3000,
		});
	};
};