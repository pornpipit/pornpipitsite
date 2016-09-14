<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
// define('DB_NAME', 'clean');
// define('DB_USER', 'root');
// define('DB_PASSWORD', '');
// define('DB_HOST', 'localhost');

/* Test SIte */
define('DB_NAME', 'u440306972_clean');
define('DB_USER', 'u440306972_clean');
define('DB_PASSWORD', 'tkelV3j2eg');
define('DB_HOST', 'localhost');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'E!-dWJ#8gkmSvI7jf8{dvK7Y/u#nIpFndVbVwp2FQ01Vj+Y-)i)[jVib-rju7#,=');
define('SECURE_AUTH_KEY',  'h$3j!uCHI:$EMd%poNN&pDY_JOVJLUoOMvas Vo>cK*08g5gZ*?k2?%cY&J.p{7P');
define('LOGGED_IN_KEY',    't?LG6@&Sp4EqN6M;qXA*x3w-S.R,%_|df|O(tZt`Gl[%ey$0r_<}^,),c+:0_L9;');
define('NONCE_KEY',        'OL_}1Oem[`nKMpFG&J^3YW$VBZJcyRT1?)29:i nJnV6SW<l5Iq#J:B:jpnh#xv&');
define('AUTH_SALT',        '~{i3t|Ly~BjuIO/hR)5B=?#OUf|lu57h[y;I4TW@97>teIC{f1$4%e+f0}i8@N.^');
define('SECURE_AUTH_SALT', '!}V3Aqu@AG_7=;eV+Yu.)Yq-=I (Tk]pbVZjeyYHbB;d,jE|1JXLO$p5NM3q#%}$');
define('LOGGED_IN_SALT',   'rQA%!;QebS$*o5b3Jn<8/qo0781mV*&ZvTU2}|cNd_F&G|uUWy8^f]Y4WFUZbm,Z');
define('NONCE_SALT',       '|Di<7Xd$p[V/m7 &p,?o7r7;0nFmca0Ma7IgrI5D``1L4:<^B1Y![iOOjDl9(aIu');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cn_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/* Change upload path */
define( 'UPLOADS', ''.'files' );

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/* chnage wp-content */
define('WP_CONTENT_FOLDERNAME', 'wp-content');
define('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME) ;
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME);
define('WP_HOME', WP_SITEURL);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

