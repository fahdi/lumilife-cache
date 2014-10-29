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
define('DB_NAME', 'lumilife_wp_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'pass4lumilife');

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
define('AUTH_KEY',         '|arnM-enx*]1L jcx3*+cOcTSw>B`6o]*C~uH5Fi]U?nG2a;cM[& o!@?nrZO[U*');
define('SECURE_AUTH_KEY',  '&4!bbWw2a`0frvQIR2w_h]tB@e:?I {*.[+?m!$Umew`Vi=>r&{~d&5hPhyr-bZV');
define('LOGGED_IN_KEY',    '>MORRc,fe`CZfPrFk/ChJ!4`:wJlt><Maj&$p?ocbO9o~OG-JNC5M;RKsag(4,-x');
define('NONCE_KEY',        ';9hu+$>m%:Lk*q9JM; >Ag@,$,^aDw(WGY`z[,(500h}` pMqeIm]mYKAW%$IHoc');
define('AUTH_SALT',        ';YpKWZKY08C1m 3-S~<ENl+6YJ40},:8Q)wdP+Cs|<c@=[x/Si1h8>9Nx$ioV3ak');
define('SECURE_AUTH_SALT', 'Q8/,y*c&GTcb>p=/f.mvo;}i2q$y9V_;vdsdZ),+ENMPMkYSevd&(x{1+tFG8OoD');
define('LOGGED_IN_SALT',   '-7lwEUJ=`5$-}-9(2(FF|DMLv:2<`2zfxlOr1%stM?^a8A-~nX::Yp`rzW)qn[)A');
define('NONCE_SALT',       'oC%BLjP8~:qX|6-VZs%AyPN6][+ikP@.OjWl4N9 @|WtQWa{? R2sngePr?zCjpF');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
