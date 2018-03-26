<?php

/**#@+
  *Application Settings
	*
	* This section includes settings for Database connectivity, base url, email config, and
	* These settings are MANDATORY. If they are not configured properly OpenCAD will not function correctly.
	*
	* When editing configuration constants be sure to only edit the contents of the second set of quotes in each.
	* @since 1.0a RC2
	**/

/**#@+
 *Community Name
 *
 * Set your communities name by changing 'My Community'
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

/**#@+
 * OpenCAD Feature Settings
 *
 * This section controls settings for OpenCAD's core features.
 * These setting will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD 1804
 **/

 /**#@+
  * POLICE_NCIC
  *
  * Shows/Hides NCIC functionality on MDT console.
  * If 'true' then LEO will be able to use NCIC functions without the need for
	* a dispatcher, else if 'flase' then LEO will require the presence of
	* dispatcher to use NCIC funcationality.
	* These settings will likely be moved to an *_options table in a future version.
  *
  * @sicne OpenCAD 1804
  **/
/* Enable or disable NCIC in MDT */
define('POLICE_NCIC', false);

/**#@+
 * CIV_WARRANT
 *
 * Allow/Disallow Civiliians from managing their warrants. If set to 'true'
 * then Civs will be able to delete warrants from their profile, else if set
 * to 'false' then Civs will not have the ability to remove warrants.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @since  OpenCAD 1803
 **/
define('CIV_WARRANT', false);

/**#@+
 * CIV_REG
 *
 * Allow/Disallow immediate regitration for civilians.
 * If 'true' then civilian registartion will require Administrator approval
 * else if 'false' then civilian registrations will NOT require
 * Administrator approval.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @since  OpenCAD 1803
 **/
define('CIV_REG', false);

/**#@+
  * Extra Settings
	*
	* This section included boolean settings for Gravatar Fetch, NCIC in MDT, and more.
	* These setting will likely be moved to an *_options table in a future version.
	*
	* @since  1.0a RC2
	**/

/**#@+
  * Gravatar Fetch
  *
  * OpenCAD will dynamically retrieve your avatar from {@link Gravatar http://en.gravatar.com/} if you have an account. Otherwise
 * it will use the default generic avatar image included with OpenCAD .
  *
  * @since 1.0a RC1
  */
define('USE_GRAVATAR', true);

/* That's all, stop editing! Happy dispatching. */
/** Absolute path to the OpenCAD directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

include ABSPATH . "oc-functions.php";
