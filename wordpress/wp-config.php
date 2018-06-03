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
define('DB_NAME', 'blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '12');

/** MySQL hostname */
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
define('AUTH_KEY',         '$U3v@)$q r0|d=gy=,foThf<QznynhtQ8E)CzwT;j<,R!D|3=3}I=zU!,hHddhax');
define('SECURE_AUTH_KEY',  'uNTAKgJ$wQ/jWJ7UANV[M6i&Ia=x2;JDUFA sW67Fk^SUnv-*@UN^^h@+>+W6&mL');
define('LOGGED_IN_KEY',    'Xo&U;`/mi!F]WW]we0IDs@v,Gt1t4R0f^RT]v{oOKv5IxK?_*N`E4@wQ8QUq<Qx7');
define('NONCE_KEY',        'LbOOT_)ka[xV)t#:u6t9!Iw@hwDw]gv4/N]pqmk#}a88EjFxIud9P-b#@|~6M<qd');
define('AUTH_SALT',        '0N]ZB[JVuxg8m+W-Ld$zfk3bTea4=.TOW+nw$jo-&Sw&vR3W,_$jGKDwe8w,S_$k');
define('SECURE_AUTH_SALT', 'nV?GZF>sE6h+W}[$l%SSrGLR$|feYD!b[)X4N9eEy|dXH`MF,#w4aKdp=/EO>U q');
define('LOGGED_IN_SALT',   'YIxzb<gHJoCu#aGwh]bgvl.BKtbUD0j7kqsi!x^AecR7-&YL38lH[kI 9>J%+QkL');
define('NONCE_SALT',       'lb1=Y&%UB^qIz1^Dvy$Lfvwq9&N(P&xK77`G/>Sy22@EsTQrspd.V&c&?p4oMsd?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'blog_';

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

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
