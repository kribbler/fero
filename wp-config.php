<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_fero');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'l?E`3|VGccWQz7kkLGz-o4+f$E ]&v&ovN#qe+|y.]p7P(H<}rs<SVjjuIS)AbRa');
define('SECURE_AUTH_KEY',  '~GyI5J}VBDg8+=-^t(O1v|6%V2]DR+x. _5vx-xIIgN[41YbN;HOxV;2kv|}IgO|');
define('LOGGED_IN_KEY',    'QdEY;l2}FTKIb{xoS4Y@)j!/XI;UOu*PW^DN:lf--E7GegJ]$!Y,YDF>|qYL#p|$');
define('NONCE_KEY',        '9A$]HTghf1-k?ii/d_xfz{svB-,1b4%*#{)=LIWd2mk-8wJ+{:[~mJ^R) T!Bj!F');
define('AUTH_SALT',        'AT]GMjRT+v-:&qt=?B:Opn#NyA8!|I*~K(D8*HPU#*{Q(<Usk~bS+5Pmx+^1(k{M');
define('SECURE_AUTH_SALT', 'MhqRXmH=tfe-i+0tyd>9D2WBIv.f5K0y-=+mP?5!- +a8m]!.^$c,BRT$Ca-v#@p');
define('LOGGED_IN_SALT',   'uiL(CbW jSd8Sy:Mf}[tj#0>D3x@T;IRq5aR;{- 9H.!1wA?(D{(ovu3d g(!C;Y');
define('NONCE_SALT',       ';VncH1RpA!uF|dVHuQ`G0$#r#HJ`@vMX!0Ob3:`I$!m:5-F*LFWjwPq.ZRV, 2W,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
