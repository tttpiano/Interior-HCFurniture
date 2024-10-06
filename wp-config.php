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
define( 'DB_NAME', 'noi_that_wp' );

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
define( 'AUTH_KEY',         '%|uxI7$g`rT7[&*.<~{r}lpw}l%sq!dRo@B${UY$r=)t+Or7<QZ1goR@U1{jj^NH' );
define( 'SECURE_AUTH_KEY',  'x]|9mA0X;Jt1_j&x1Jzl-t[Zug}Gi@W:e@/[~dL3_fV[o.{![:;H@@9YxC?.f!mL' );
define( 'LOGGED_IN_KEY',    '|2vAit#b[v]TF((MQt:voM5(S&F%A5[Ju2{Av/6vuPZGhO_;b<yldaj-3Zy6KPH(' );
define( 'NONCE_KEY',        'rG4%xWW)1eHM6j9hoZOf4u4y$Lt2~JR8aE@4^,pI?AN_QesgK!g_#ku=pqzU){OR' );
define( 'AUTH_SALT',        '&dYHd$CwgbnB-VCJrYb|C)|h:(CmF36I.9wC6DDiMSTz2N=o%fiuAX~l}&o#x`)J' );
define( 'SECURE_AUTH_SALT', 'D`5fs{I_@rh-=:M?pW@0LKIx>A17G* [B(w9Cl)-3H@SR-kF&}?`4Aok_0:NpC.a' );
define( 'LOGGED_IN_SALT',   '64Xpa-bIMxD67CPB ;W}+$,<Fx(oUJlI7o,L%Y7b<Ry> qbjUQEy?>Drak^>++B9' );
define( 'NONCE_SALT',       '^o~kkN)tuXKC1}=)dyPFDjx[?`^g^Nv~X)aqOZt7l6uY[ZUh(HtnpI>J=io^;x<6' );

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
