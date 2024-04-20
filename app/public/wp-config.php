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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '-19_F^E`m61N#~=?n,a^,VRB-!KpZ}2&[Q@vd6],SGq(q@,5B5_YCt>3L6X=aM&C' );
define( 'SECURE_AUTH_KEY',   'o _P;WJ1,B;+mA0o]!;?4M7R4 >9i5w-.5y4C5!,q58X&eIVjx^*IXR#D0H-U(m;' );
define( 'LOGGED_IN_KEY',     'JOSV81+fgf;~WLS>A:xd{qgbunL#zO|^aOaxf9((|#;MG-^6[nm4m#+9&fq@i9*3' );
define( 'NONCE_KEY',         '[`PLU[Ix{juiW8q1RSiKz<6m{=f59)5Kap5LL^be5A0FZ;k*w~}fkSVwGvcs@=as' );
define( 'AUTH_SALT',         '$*7E5la 6s#uW 6hHL:3d@G}4!<]Zc4Knqrt}2=+TCc(./+I6Q1HjN2,B0cha&19' );
define( 'SECURE_AUTH_SALT',  'oLce.9BqKKuhmuePb#%_gO:{2U`@q[Je5QvQ[l(&7xV(8`?T?CUr@.O Pr4IK-eV' );
define( 'LOGGED_IN_SALT',    'Xua&#`CaR=vsy+rlnhzNC>8.k1LK2CFQ_yp[{X2ip8c|$ZPXv&NE=s]=-b[3C<IX' );
define( 'NONCE_SALT',        ':(z.R5?5_g)s_9HTf=_i f,I,dEinZF>x6=|=/^fKOdVUIWJy.UWNuD.=y2%;6=2' );
define( 'WP_CACHE_KEY_SALT', 'N .vwc(725us5i]Pim12pLPe.Ug+-0PM8 )C>ksC):<D,[k;mgm&OX%)ZdWMaObn' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
