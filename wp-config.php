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
define('FS_METHOD', 'direct');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dbunite');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'secret');

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
define('AUTH_KEY',         '7g:>Xw7HxI,hh@EjE@l|8LFN3jeE2+Q pk;QK8p-OV5`lP]RcJu]JkkDJw*OV/YI');
define('SECURE_AUTH_KEY',  's)YCO,E!361KFT#h$J]?I>4R/kSj!L![OcTV+t7hg% nj1dh*rk:^t3/JBD=$UgZ');
define('LOGGED_IN_KEY',    '&J`)Bh9cF>7#vs(4<kzd Z$/7l?k@KO}cJE:@;]$WMpbr>5-n%osxsTO:irSwwOx');
define('NONCE_KEY',        'cnsS)eEmDSLyLHQVS^+!j<n*8k,7Nfi8)Mcl;?Ov064wb`$WcA`P7|(RbZ?Xav^!');
define('AUTH_SALT',        'd -IWnux-1D^g+1=%Tpu:^[bj>mVb``58[{N{r;V[i]5f|4~2Km4@^mj(!Gg9*i-');
define('SECURE_AUTH_SALT', 'sX)8/*We>J&B4_V]/rRwh`&A.jP|c$vKBYt |[6X{=Pi%oQ_csNR6mM5J`y,TZ>4');
define('LOGGED_IN_SALT',   'eh8KeV|6T({=Owv!WMd+}~j,eW4+!=S$?wRS3Z*R2-[m-8;7^=w`+n]b4<-uQ;iZ');
define('NONCE_SALT',       'es7U<zZVxMaw^!@027pp~5KSm>[Se9>o[M=h%L8oHhGJ;3Z+CXVq!K}OHW~[/e|)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
