// Critical Var
var  penthouse = require('penthouse'),
path = require('path'),
del = require('del'),
cleanCSS = require('clean-css'),
fs = require('fs');

// Test generate critical css
module.exports = function(gulp,paths, plugins) {
	//sup critical precedent
	del(paths.assetcss+'critical/*.css')
	function funcPenthouse(page) {
		penthouse({
			url :page.url,
			css: paths.racine+'style.css',
			// OPTIONAL params
			width : 1300,   // viewport width
			height : 900,   // viewport height
			forceInclude : [
				// '.keepMeEvenIfNotSeenInDom',
				// /^\.regexWorksToo/
			],
			propertiesToRemove: [
				
			],
			timeout: 30000, // ms; abort critical css generation after this timeout
			strict: false, // set to true to throw on css errors (will run faster if no errors)
			maxEmbeddedBase64Length: 1000, // charaters; strip out inline base64 encoded resources larger than this
			userAgent: 'Penthouse Critical Path CSS Generator' // specify which user agent string when loading the page
			/* phantomJsOptions: { // see `phantomjs --help` for the list of all available options
				'proxy': 'http://proxy.company.com:8080',
				'ssl-protocol': 'SSLv3'
			} */
		},
		function(err, data) {
			console.log('Critical CSS page ' + page.name);
			var minified = new cleanCSS().minify(data);
			fs.writeFileSync(paths.assetcss+'critical/' + page.name + '.css', minified.styles);
		});
	}
	var criticalPages = [
		{
				url: paths.site,
				name: 'home'
		},
		{
			url: paths.site+'/article1/',
			name: 'single'
		},
		{
			url: paths.site+'/mentions-legales/',
			name: 'page'
		},
		{
			url: paths.site+'/contact/',
			name: 'contact'
		}
	];
	return function() {
		criticalPages.forEach( function(page) {
				funcPenthouse(page);
		});
	};
};