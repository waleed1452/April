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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Aprildb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'd(uM1@lF<>5D;RK !9(=w4%x:d%);b`U{|zt]K6#]q^dAEYElC]TfiqHY]v=FDqd' );
define( 'SECURE_AUTH_KEY',  '>n2B0pr=@O88BJ(52c=`R8~.j>!v/B!EBgKx[4Z&46g3i_8TGcN#*aZ;wr69awG.' );
define( 'LOGGED_IN_KEY',    'M>;{7v&MV?c}<MqR;X2sPA?C2~6!JY^b&*/D6zpO}|Y]Nu?t?@pvE5%3VR{%#Caj' );
define( 'NONCE_KEY',        'tCd;VPE+:FrgPnN4TnlJGF)oB `O|p]q~4|67Z9cJ_wC%v<KsR9k&DcM16@^/AGf' );
define( 'AUTH_SALT',        ')i#S^EB6JMwu+Uas`Q;/p)|ZMjL/J=iG}G4C.}KXcGuV6mGK4?BGs7S7.` ;R)C1' );
define( 'SECURE_AUTH_SALT', ')ji=M^5(h+dF5L;/43l3xw%uZ cL?aC(3qxF4 ^! a>NlES^^S1a?3t$i?%;Uvx!' );
define( 'LOGGED_IN_SALT',   '`s,if8,UvBiG@elz88ZY`2ND>NiRcBLXn~2:?0LoOkII)O8Cr.=BF15PI9`StTe(' );
define( 'NONCE_SALT',       'VUO/RCX$^V>U|w6- RE2cl =D#<I96iPj6g:+_f*oYIz6aCE]|QJ(g5c{h/5M&%?' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
