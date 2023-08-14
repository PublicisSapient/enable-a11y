/* gulpfile.js -- needed to import uswds code (used for input masking) */

/**
* Import uswds-compile
*/
const uswds = require("@uswds/compile");

/**
* USWDS version
* Set the major version of USWDS you're using
* (Current options are the numbers 2 or 3)
*/
uswds.settings.version = 3;

/**
* Path settings
* Set as many as you need
*/
uswds.paths.dist.css = './enable-node-libs/uswds/css';
uswds.paths.dist.theme = './enable-node-libs/uswds/sass';
uswds.paths.dist.js = './enable-node-libs/uswds/js';
uswds.paths.dist.fonts = './enable-node-libs/uswds/fonts';
uswds.paths.dist.img = './enable-node-libs/uswds/img';

/**
* Exports
* Add as many as you need
*/
exports.init = uswds.init;
exports.compile = uswds.compile;
exports.watch = uswds.watch;
