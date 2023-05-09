<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bookswpdb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?zTTE?mJ~K?Bco(60#tR1#DceWI_Tt:3o!L5Rc%M,8CmGLo&{w![jibk(~@s)FtK' );
define( 'SECURE_AUTH_KEY',  '9; j{_=8JwCa!L~Xn3pb4to4n--^L>Y}Fub-`x+f,rSmHljf6Wws%]jp2sbq|<$q' );
define( 'LOGGED_IN_KEY',    '&[^(<c~89g$L/V9prBL LYN%hQK^Q~u6y^{$l^I t=nlN44vD03eG{^`~MUri5jx' );
define( 'NONCE_KEY',        'G3fK:w1&UbHu38Z4mx#X{6gJAC%ilq(aenheAwFK;pO>_mw*YWNjWm]fbeeIo$@y' );
define( 'AUTH_SALT',        'z7gX|&xyM{3-@]_}:{|?epSPb0!jrYtlVl@{AC[GFEG@O9Uv5x(hw]?YlDyL?pBy' );
define( 'SECURE_AUTH_SALT', '/PjM!,Zt,X6^(9Gdsrs;f=49XH?q=[qmb0%E+KLS3gPB9O5cPuQ%d0,r>j{Gs[)9' );
define( 'LOGGED_IN_SALT',   '8v-B3 w/L^T~|p*z|;`Y[]2cNeiVI8|Nw657h{x_%c>L&+Q#S`-0>V=ob[@tz!Ij' );
define( 'NONCE_SALT',       'wON/whE|8m@4Te[ge^2_4}mS)*SNTSiobK,}VyPtw]jqoNnc0X|eJtK|h%AkLK}8' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'booksfusion1234';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
