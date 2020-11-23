<?php
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '' );

/** MySQL database username */
define( 'DB_USER', '' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', '' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'h6315nnPAj1W|4!q74VUal-c@9580n-6#;be0CTqaHXyz|AGFX/3ha77u;/M[U8!');
define('SECURE_AUTH_KEY', '|@e4-c@%Dm|cWU(DqwC*n9)6PTk(|j3695]OF&oK8(Yd9N54#ieI&loB230[5W4P');
define('LOGGED_IN_KEY', '5)C;D5l20Uo(8Wp&43OKMW7)[xRKJK;]FU-zq66T*:/#|w_S0c_MSz7k(/q7R;t;');
define('NONCE_KEY', 'N_!4DHP|/Y81cU3(u|%rMdF03&FKo+L-Gnaoz0P3p3o;ni2~h1uc8X117D*mQJpB');
define('AUTH_SALT', ']*;*0Q2K[p]%rm51j3o@*](g~i0yhwot!Mu3a6LN135HX#p)l-2B47(vUvSrd-1@');
define('SECURE_AUTH_SALT', 'wYE~:Z5Ho_5fP&Y]1nUMOD[!DL#W2HYQG&z3yfU08XMv9S6jaI/mi+h92kVgd24r');
define('LOGGED_IN_SALT', '0Y#+c!q!z:-G7ztnd1/R[OCpJ1[3aud@HE2%Rm7t0Rg4LH%jOX7e52h#@W3-@5Hv');
define('NONCE_SALT', '9MkIZ0/)5w/2P!:*)AJimO/sFct66&C9:51wY924n)OfA56mc5)b0L7lgfdP%b93');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'eD7NYta_';




define( 'FS_METHOD', 'direct' );
define( 'WP_DEBUG', false );
define( 'WP_HOME', 'https://woocommercewebsite.server2.trinchera.dev' );
define( 'WP_SITEURL', 'https://woocommercewebsite.server2.trinchera.dev' );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
