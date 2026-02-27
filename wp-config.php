<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dev_marcelo_mota' );

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
define( 'AUTH_KEY',         'u(UR@|#_Iztp ?15,q8M%bYc[6iF@<$rI[*<W[z20r/us$@u{;voqXqD3`x.9:d ' );
define( 'SECURE_AUTH_KEY',  '1_o#cFEYd{VBlJX@;OL`&_-bV`HacjveIV|;5D2S?eE*3RKW<bf{=!/9|wr!r~`P' );
define( 'LOGGED_IN_KEY',    'O.X#IX2+BJP>Hox<[@o)Iu4u^Nu%3W]r6C:u]{qGrB$].Dv%fMCF2#bOI9 O{EE=' );
define( 'NONCE_KEY',        '#&e2YK>uSKboX|ePr7v]vkDD8>Y8&sm! (L-V}Xjn%}?!#Ar MCB/6V;:rA^t.gC' );
define( 'AUTH_SALT',        'R,r4h<`<i.7S/Fy3fA6-Q:U4 D5.#&6{CU@K)_f ;fpo9hS=~Vag)&?a NkOUVy]' );
define( 'SECURE_AUTH_SALT', '9`1ce]8Co3y3z}b`zylplFFLf<.eZi`|U,N*!<R~jJdwd&mI%agL9.#KYt-&l/#g' );
define( 'LOGGED_IN_SALT',   ';fp@fzhv>jWAZy3vd2f(RDDR?gC~yUm6>BG9^~Fn2~844X79elUFI}1$6t~)Le_R' );
define( 'NONCE_SALT',       '@Dh?kvaF]$mv8HJollPZI6[%K_x)Er:~+yg}Y7106%.;,^P4kcJ:ks:C#L_!B.my' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'mm_sec_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
