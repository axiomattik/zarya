const { src, dest, series, parallel, watch } = require('gulp');
const del = require('del');
const sass = require('gulp-sass');
const rtlcss = require('gulp-rtlcss');
const concat = require('gulp-concat');
const minify = require('gulp-minify');
const path = require('path');
const wpot = require('gulp-wp-pot');
const potomo = require('gulp-potomo');
const jsvalidate = require('gulp-jsvalidate');
const eslint = require('gulp-eslint');
const phpcs = require('gulp-phpcs');
const stylelint = require('gulp-stylelint');
const zip = require('gulp-zip');

const bs = require('browser-sync').create();

const THEMENAME = path.basename(__dirname);
const BLDROOT = 'bld/' + THEMENAME;


/* JavaScript */
/**************/

// concatenates and minifies all js into a single file
function minifyJS() {
  return src(['src/js/**/*.js', `!**/*${THEMENAME}*`])
    .pipe(concat(`${THEMENAME}.js`))
    .pipe(minify())
    .pipe(dest('src/js/.'));
}


// copies the concatenated and minified js files into the 'bld' directory
function copyJS() {
  return src(`src/js/${THEMENAME}*.js`)
    .pipe(dest(`${BLDROOT}/js/`))
}


/* CSS */
/*******/

// compiles SASS and puts style.css in 'bld' directory
function compileSASS() {
  return src('src/sass/style.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(dest(`${BLDROOT}/`))
}


// compiles WooCommerce SASS (if it exists) 
// and puts woocommerce.css in 'bld' directory
function compileWooCommerceSASS() {
  return src('src/sass/woocommerce.scss', {
      allowEmpty: 'true',
    })
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(dest(`${BLDROOT}/`))
}


// generates style-rtl.css in 'bld' directory
function rtl() {
  return src(`${BLDROOT}/style.css`)
    .pipe(rtlcss())
    .pipe(dest(`${BLDROOT}/style-rtl.css`))
}


/* Internationalisation */
/************************/

// generates the pot file
function i18npot() {
  return src('src/**/*.php')
    .pipe(wpot( {
      domain: THEMENAME
    }))
    .pipe(dest('src/languages/' + THEMENAME + '.pot'))
}


// compiles 'po' files to 'mo' files and places them in the 'bld' directory
function i18npotomo() {
  return src('src/languages/*.po')
    .pipe(potomo())
    .pipe(dest(`${BLDROOT}/languages/`))
}


/* Linting */
/***********/

function lintphp() {
  return src('src/**/*.php')
    .pipe(phpcs({
      bin: '/usr/bin/phpcs',
      standard: 'phpcs.xml.dist',
      warningSeverity: 0
    }))
    .pipe(phpcs.reporter('log'));
}


function lintsass() {
  return src('src/**/*.scss')
    .pipe(stylelint({
      configFile: ".stylelintrc.json",
      reporters: [
        {formatter: 'verbose', console: true }
      ],
      failAfterError: false,
      fix: true
    }))
    .pipe(dest('src'));
}


function validatejs() {
  return src('/src/**/*.js')
    .pipe(jsvalidate());
}


function lintes() {
  return src('/src/**/*.js')
    .pipe(eslint())
    .pipe(eslint.format());
}


/* Distribution */
/****************/

// empties the 'bld' directory
function clean() {
  return del(['bld/**', '!bld']);
}


// copies files (not js/css) into the 'bld' directory
function copyfiles() {
  let exts = ['php', 'txt', 'png'];
  return src(exts.map((ext) => `src/**/*.${ext}`))
    .pipe(dest(`${BLDROOT}/.`))
}


// creates a zip archive in the 'bld' directory
function createarchive() {
  return src('bld/*')
    .pipe(zip(`${THEMENAME}.zip`))
    .pipe(dest('bld/.'));
}


/* Browser */
/***********/

// watches for changes
function monitor(cb) {

	// sass
  watch('src/sass/**/*.scss', exports.css).on('change', bs.reload);

	// js
  watch(
		['src/js/**/*.js', `!src/js/**/*${THEMENAME}*`], 
		exports.js
	).on('change', bs.reload);

	// i18n
  watch('src/languages/**/*', exports.i18n).on('change', bs.reload);

	// other files
  watch(
		['php', 'txt', 'php'].map((ext) => `src/**/*.${ext}`),
    copyfiles
	).on('change', bs.reload);

  cb();
}


// initialises BrowserSync
function serve(cb) {
  bs.init({proxy: 'localhost:8000'});
  cb();
}


/* Tasks */
/*********/

exports.clean = clean;

exports.js = series(minifyJS, copyJS);

exports.css = series(compileSASS, compileWooCommerceSASS, rtl);

exports.i18n = series(i18npot, i18npotomo);

exports.build = series(
  exports.clean,
  exports.js,
  exports.css,
  exports.i18n,
  copyfiles
);

exports.lintphp = lintphp;

exports.lintsass = lintsass;

exports.lintjs = series(validatejs, lintes);

exports.lint = series(
  exports.lintphp,
  exports.lintsass,
  exports.lintjs
)

exports.zip = createarchive;

exports.watch = monitor;

exports.serve = parallel(exports.watch, serve);

exports.default = series(exports.build, exports.serve);
