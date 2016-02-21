/**
 * Created by jmd-m on 2/20/2016.
 */

/**
 * This is a configuration file for gulp. To configure simply
 * edit the variables below with the values you prefer. For
 * reference I am using both browsersync and the versioning
 * mechanism.
 *
 * Once you have configured this file, rename it to:
 *   .env.gulp.js
 */

/**
 * Change these variables to configure gulp.
 * HOSTPATH is the URL that you use to access your web server.
 * This is required for using browsersync.
 *
 * VERSION specifies whether you want to prevent CSS caching by
 * creating a unique version of that file every time you recompile.
 *
 * BROWSERSYNC specifies whether you want to turn browsersync on.
 */
var HOSTPATH = 'localhost:8000';
var VERSION = true;
var BROWSERSYNC = true;

module.exports = {
    hostpath: HOSTPATH,
    version: VERSION,
    browsersync: BROWSERSYNC
}
