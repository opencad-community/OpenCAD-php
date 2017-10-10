<?php

/**#@+
 *Community Name
 *
 * @since 1.0a RC1
 */
define('COMMUNITY_NAME', 'My Community');

/**#@+
 * Database connection variables
 *
 * @since 1.0a RC1
 */
define('DB_NAME', 'openCAD');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');


/**#@+
 * Base URL Settings
 *
 * BASE_URL - The URL to your installation of OpenCAD inlcuding,
 *             if utilized, it's subdirectory
 *
 *             Valid Examples include:
 *             //example.com - Root domain, no subdirectory
 *             //subdomain.example.com - subdomain, no subdirectory
 *             //subdomain.example.comsubdir - subdomain with subdirectory
 *             //example.com/subdir - root domain with subdirectory
 *
 *						We do not reccomend including the trailing / on any of the above examples.
 * 						It won't necessarily break anything but just make reference look strange having
 * 						two slashed when it isn't needed.
 *
 * @since 1.0a RC1
 */
define('BASE_URL', '//example.com');

/**#@+
 *To & From emails for system generated emails
 * To be used in a later version for notificaton emails
 *
 * @since 1.0a RC2
 *
 */
define('CAD_FROM_EMAIL', 'cad@community.com');
define('CAD_FROM_NAME', COMMUNITY_NAME.' CAD');
define('CAD_TO_EMAIL', 'admins@community.com');
define('CAD_TO_NAME', COMMUNITY_NAME.' Administrators');

/**#@+
  * Toggle Gravatar
  *
  * OpenCAD will dynamically retrieve your avatar from {@link Gravatar http://en.gravatar.com/} if you have an account. Otherwise
 * it will use the default generic avatar image included with OpenCAD .
  *
  * @since 1.0a RC1
  */
define('USE_GRAVATAR', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link  WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * UTILIZIATION TO BE IMPLEMENTED
 *
 * @since 1.0a RC2
 *
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/* That's all, stop editing! Happy dispatching. */

/** Absolute path to the OpenCAD directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

include ABSPATH . "oc-functions.php";
