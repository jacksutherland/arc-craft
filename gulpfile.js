/*
 * Reality Gems
 * https://realitygems.com
 *
 * Website Gulp File
 */

const { src, dest, parallel, watch } = require('gulp');

// Gulp Plugins

const rename = require('gulp-rename'),
	  //sass = require('node-sass'),
	  sass = require("gulp-sass")(require("node-sass")),
	  terser = require('gulp-terser'),
      concat = require('gulp-concat');


var site = {

	// CSS Commands
	css: function(callback)
	{
	  	return src([
	  			'./src/styles/site.scss'
	  		])
			.pipe(sass())
	        .pipe(dest('./web/css/'))
	        .pipe(sass({outputStyle: 'compressed'}))
	        .pipe(rename({ suffix: '.min' }))
	        .pipe(dest('./web/css/'));
	},

	// JavaScript Commands
	js: function(callback)
	{
		return src([
				'./src/scripts/site.js'
			])
			.pipe(dest('./web/js/'))
			.pipe(terser())
			.pipe(rename({ suffix: '.min' }))
			.pipe(dest('./web/js/'));
	}
};

// Execute Default Tasks

exports.default = parallel(site.css, site.js);

// Execute Watch Tasks

exports.watch = function()
{
	exports.default();

	// watch js files
	watch('./src/styles/*.scss', site.css);
	
	// watch scss files
	watch('./src/scripts/*.js', site.js);
}
