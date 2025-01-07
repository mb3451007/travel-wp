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
define( 'DB_NAME', 'traveldb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',          'VD3v%dP@M@]URjOJr.aSK-TM~%@{.}sj];X<)Kc_1CeZ#&Vt)AfPKd?UB@C%T_=v' );
define( 'SECURE_AUTH_KEY',   'Ks{NM-DuR}sOWLR`}|sok>R?gry1;E?_Ohm|O*h|#8nb)dYYT>+7owY$gXWdsy|R' );
define( 'LOGGED_IN_KEY',     'l.Q@w#xo&0Pj)*K`_nUo1N3OYBg}[MK=yTz0&c,XFw211R)|a:n1C.p%B,gN~|V%' );
define( 'NONCE_KEY',         'YyZe53ewM9%Q{_ @54fCC0R%H0BId]R>D~bpM%AERzzY5kv#QO(.D~j;6$9?zbS1' );
define( 'AUTH_SALT',         '0C(Sy~dqTH=;ZI6j*SUc@G@q^^Xm+ErOHynDF}0|f)Bx%6%Sg1EH&B~`$>^+lK^b' );
define( 'SECURE_AUTH_SALT',  'iqJv9_a9nj=/)QS9~MH!W m;MG7QyX.lv prpHV%&}&l)F@wT>iA(#_g*f*.&NnR' );
define( 'LOGGED_IN_SALT',    'x_M4^6q)K4$bWCM)S]g=ys<r;p*3i>3eKa~S~uwDm<$8nt6?DMCJb>24FKO4pjtY' );
define( 'NONCE_SALT',        ']2h37;Cspa?yX.VG2{!rW#;U&^k6awb|baiSP-_lg8P.&l:^uLBLO!5iqN?TFL54' );
define( 'WP_CACHE_KEY_SALT', 'P|gCwnesNbC]=t`A}UwS[=!4M)TjrEV.J<0H{H3[!~^R-BSs@K:dy!/G+udj*D?y' );


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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );


/* Add any custom values between this line and the "stop editing" line. */
define('WP_HOME', 'http://localhost/travel');
define('WP_SITEURL', 'http://localhost/travel');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';