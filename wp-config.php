<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
// development

    define('WP_HOME','http://thenwblk.com');
    define('WP_SITEURL','http://thenwblk.com');

    // ** MySQL settings - You can get this info from your web host ** //
    /** The name of the database for WordPress */
if (isset($_SERVER['PLATFORM']) && $_SERVER['PLATFORM'] == 'PAGODABOX') {
    define('DB_NAME', $_SERVER['DB1_NAME']);
    define('DB_USER', $_SERVER['DB1_USER']);
    define('DB_PASSWORD', $_SERVER['DB1_PASS']);
    define('DB_HOST', $_SERVER['DB1_HOST'] . ':' . $_SERVER['DB1_PORT']);
}
else {
    define('DB_NAME', 'thenwblk-dev');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_HOST', 'localhost');
}
/** MySQL hostname */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'f:(p1WF>lDoJ80OtMFH-&v~;7-m&y}yGt<[5~h>lRxZqK+?| >C,GNrEPF:LLy0`');
define('SECURE_AUTH_KEY',  '-Mmk}OP<_^T01r9n,Aa0.[` ezW[p[y|{trFl&K~8@R=WKq)EG$)$urL$>$C%N^z');
define('LOGGED_IN_KEY',    ' |3WK#:?{&XS0Ng{a5*hSK5-k^:YI]w4*+>uIgq;0`f75JJ)q/Xgq{w0%0Zl9)LL');
define('NONCE_KEY',        '/m|9.GuZ@1_bUFK$D|b`mJO+4pr<TWvDoB@/p{fJrqRG}k$#Jv;-X#GY*xNYYlao');
define('AUTH_SALT',        'O8wDlB*|X8:`:J=1!$m?ja$Qk=g+ll#[w:irsrpLJ#nc^q$||9w.;P/cr0IiCMlI');
define('SECURE_AUTH_SALT', '/?JXzNtSk@csF=Nx2,%}x?yUA9i>F|E1/d-.||9gAz5#~LfwXskaeiFoV,|$rS-H');
define('LOGGED_IN_SALT',   '*]~9o7(sI-0iID;o%koY9e_H^l6Gb}{hTz=H|)KgVI>()Zg?Th5K-Zg_J<h7Z-NI');
define('NONCE_SALT',       'Ceul&l|^-A6p..o]_F5dI$IM5Q[DU]es472jOZZc%ZuMGR$1[CW-fTe2Tq5z{!/]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

@ini_set('log_errors','Off');
@ini_set('display_errors','Off');
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
