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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_homebuyerdev1' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3306' );

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
define( 'AUTH_KEY',         '3i,Y|VD8V6{.j?@bSbSaE:7l$-hiz`,]-cuN5V;Nbqo*IRUQ&B4lDEm&w#~[ZP%R' );
define( 'SECURE_AUTH_KEY',  ']j;]]a6FA3p=uH?:ZYx(uQRg>9fN/c~^pL=4ck~K$`FgkM I>J4n)M kWmzcFVFO' );
define( 'LOGGED_IN_KEY',    '|_E2BV^crUw?nQ<u R`Hmi+2{hc:Mkl^f=EeMcO[IC}x4,1K]t_PGqGx02{lq^U:' );
define( 'NONCE_KEY',        '}|*^=zr^JGon0rxOzmqf-r86Dxd#2K<;)n]u,=do5>5d|5IT/L%$yX+QUajvtM#D' );
define( 'AUTH_SALT',        'RZ[qYS31~f}sUQ)6E>0Vnm@~6ph+i5i_XyJyT&<%]ize+|]+I@{d2WP#t_]](iII' );
define( 'SECURE_AUTH_SALT', '> >B9+y!O-d }4 2)o1AB<,(d*?C;up5o)O7Q{V%E:T|cpKOO+j/Q$cG_:#g4$M3' );
define( 'LOGGED_IN_SALT',   'p52fVbws,*615AS|bq[?pH 9r$%u/|qmW1tLa0t,golaJ$1N=;0qL(8Odx;k*kQ*' );
define( 'NONCE_SALT',       'i$J5x$c^][mO|hUu#Ai;s*a+x34o<c`lT8(^R}WUBt7Z0~Z<.m;o`xg^#Km[Fd(t' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
