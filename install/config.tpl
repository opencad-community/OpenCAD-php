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
define('COMMUNITY_NAME', '<COMMUNITY_NAME>');

/**#@+
 * Database connection variables
 *
 * @since 1.0a RC1
 */
define('DB_NAME', '<DB_NAME>');
define('DB_USER', '<DB_USER>');
define('DB_PASSWORD', '<DB_PASSWORD>');
define('DB_HOST', '<DB_HOST>');

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
 *             The OpenCAD teams does not reccomend including the trailing / on any of the above examples.
 *             It won't necessarily break anything but just makes reference look strange having
 *             two slashed when it isn't needed.
 *
 * @since 1.0a RC1
 */
define('BASE_URL', '//<BASE_URL>');

/**#@+
 *To & From emails for system generated emails
 * To be used in a later version for notificaton emails
 *
 * @since 1.0a RC2
 *
 */
define('CAD_FROM_EMAIL', '<CAD_FROM_EMAIL>');
define('CAD_FROM_NAME', COMMUNITY_NAME.' <CAD_FROM_NAME>');
define('CAD_TO_EMAIL', '<CAD_TO_EMAIL>');
define('CAD_TO_NAME', COMMUNITY_NAME.' <CAD_TO_NAME>');

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
 **/
define('AUTH_KEY',         '<AUTH_KEY>');
define('SECURE_AUTH_KEY',  '<SECURE_AUTH_KEY>');
define('LOGGED_IN_KEY',    '<LOGGED_IN_KEY>');
define('NONCE_KEY',        '<NONCE_KEY>');
define('AUTH_SALT',        '<AUTH_SALT>');
define('SECURE_AUTH_SALT', '<SECURE_AUTH_SALT>');
define('LOGGED_IN_SALT',   '<LOGGED_IN_SALT>');
define('NONCE_SALT',       '<NONCE_SALT>');

/**#@+
  * Feature Settings
  *
  * These settings effect OpenCAD's core functions
	*
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since  OpenCAD 1804
  **/

/**#@+
 * OpenCAD Feature Settings - LEO
 *
 * This section controls settings for OpenCAD's core features for LEO
 *
 * These setting will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD 0.2.4
 **/

 /**#@+
  * POLICE_NCIC
  *
  * Shows/Hides NCIC functionality on MDT console.
  * If 'true' then LEO will be able to use NCIC functions without the need for
  * a dispatcher, else if 'flase' then LEO will require the presence of
  * dispatcher to use NCIC funcationality.
	*
  * These settings will likely be moved to an *_options table in a future version.
  *
  * @sicne OpenCAD 1804
  **/
define('POLICE_NCIC', <POLICE_NCIC>);


/**#@+
 * OpenCAD Feature Settings - Fire
 *
 * This section controls settings for OpenCAD's core features for Fire
 *
 * These setting will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD 0.2.4
 **/

 /**#@+
	* FIRE_PANIC
	*
	* Shows/Hides Panic functionality on MDT console for Fire
	* If 'true' then Fire personnel will be able to use the Panic button,
	* else if 'false' then Fire personnel will not be able to use the Panic button.
	*
	* These settings will likely be moved to an *_options table in a future version.
	*
	* @sicne OpenCAD 0.2.4
	**/
  define('FIRE_PANIC', <FIRE_PANIC>);


 /**#@+
	* FIRE_BOLO
	*
	* Shows/Hides Panic functionality on MDT console for Fire
	* If 'true' then Fire personnel will be able to view the BOLO board,
	* else if 'false' then Fire personnel will not be able to view the BOLO board
	*.
	* These settings will likely be moved to an *_options table in a future version.
	*
	* @sicne OpenCAD 0.2.4
	**/
 define('FIRE_BOLO', <FIRE_BOLO>);

 /**#@+
  * FIRE_NCIC_NAME
  *
  * Shows/Hides Panic functionality on MDT console for Fire
  * If 'true' then Fire personnel will be able to use the NCIC name name lookup,
  * else if 'false' then Fire personnel will not be able to use
	* NCIC name lookup.
	*
  * These settings will likely be moved to an *_options table in a future version.
  *
  * @sicne OpenCAD 0.2.4
  **/
 define('FIRE_NCIC_NAME', <FIRE_NCIC_NAME>);

 /**#@+
	* FIRE_NCIC_PLATE
	*
	* Shows/Hides Panic functionality on MDT console for Fire
	* If 'true' then Fire personnel will be able to use the NCIC plate lookup
	* function, else if 'false' then Fire personnel will not be
	* able to use the NICI plate lookup function.
	*
	* These settings will likely be moved to an *_options table in a future version.
	*
	* @sicne OpenCAD 0.2.4
	**/
 define('FIRE_NCIC_PLATE', <FIRE_NCIC_PLATE>);

 /**#@+
  * OpenCAD Feature Settings - EMS
  *
  * This section controls settings for OpenCAD's core features for EMS
	*
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD 0.2.4
  **/

	/**#@+
	 * EMS_PANIC
	 *
	 * Shows/Hides Panic functionality on MDT console for EMS
	 * If 'true' then EMS personnel will be able to use the Panic button,
	 * else if 'false' then EMS personnel will not be able to use the Panic button.
	 * These settings will likely be moved to an *_options table in a future version.
	 *
	 * @sicne OpenCAD 0.2.4
	 **/
	define('EMS_PANIC', <FIRE_NCIC_PLATE>);

	/**#@+
	 * EMS_BOLO
	 *
	 * Shows/Hides Panic functionality on MDT console for EMS
	 * If 'true' then EMS personnel will be able to view the BOLO board.
	 * else if 'false' then EMS personnel will not be able to view the BOLO board.
	 * These settings will likely be moved to an *_options table in a future version.
	 *
	 * @sicne OpenCAD 0.2.4
	 **/
	define('EMS_BOLO', <EMS_BOLO>);


	/**#@+
	 * EMS_NCIC_NAME
	 *
	 * Shows/Hides Panic functionality on MDT console for EMS
	 * If 'true' then EMS personnel will be able to use the NCIC name lookup
	 * funcion, else if 'false' then EMS personnel will not be
	 * to use the NCIC name lookup function.
	 *
	 * These settings will likely be moved to an *_options table in a future version.
	 *
	 * @sicne OpenCAD 0.2.4
	 **/
	define('EMS_NCIC_NAME', <EMS_NCIC_NAME>);

	/**#@+
	 * EMS_NCIC_PLATE
	 *
	 * Shows/Hides Panic functionality on MDT console for EMS
	 * If 'true' then EMS personnel will be able to use the Panic button,
	 * else if 'false' then EMS personnel will not be able to use the Panic button.
	 * These settings will likely be moved to an *_options table in a future version.
	 *
	 * @sicne OpenCAD 0.2.4
	 **/
	define('EMS_NCIC_PLATE', <EMS_NCIC_PLATE>);

	/**#@+
	 * OpenCAD Feature Settings - Roadside Assistance
	 *
	 * This section controls settings for OpenCAD's core features for Roadside Assistance
	 * These setting will likely be moved to an *_options table in a future version.
	 *
	 * @since OpenCAD 0.2.4
	 **/

/**#@+
 * ROADSIDE_PANIC
 *
 * Shows/Hides Panic functionality on MDT console for Roadside Assistance
 * If 'true' then RAO will be able to use the Panic button,
 * else if 'false' then RAO will not be able to use the Panic button.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @sicne OpenCAD 0.2.4
 **/
define('ROADSIDE_PANIC', <ROADSIDE_PANIC>);

/**#@+
 * ROADSIDE_BOLO
 *
 * Shows/Hides BOLO functionality on MDT console for Roadside Assistance
 * If 'true' then RAO will be able to use the Panic button,
 * else if 'false' then RAO will not be able to use the Panic button.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @sicne OpenCAD 0.2.4
 **/
define('ROADSIDE_BOLO', <ROADSIDE_BOLO>);

/**#@+
 * ROADSIDE_NCIC_NAME
 *
 * Shows/Hides NCIC functionality on MDT console for Roadside Assistance
 * If 'true' then RAO will be able to use NCIC plate query without the need for
 * a dispatcher, else if 'false' then RAO will require the presence of
 * dispatcher to use NCIC plate query funcationality.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @sicne OpenCAD 0.2.4
 **/
define('ROADSIDE_NCIC_NAME', <ROADSIDE_NCIC_NAME>);

/**#@+
 * ROADSIDE_NCIC_PLATE
 *
 * Shows/Hides NCIC functionality on MDT console for Roadside Assistance
 * If 'true' then RAO will be able to use NCIC plate query without the need for
 * a dispatcher, else if 'false' then RAO will require the presence of
 * dispatcher to use NCIC plate query funcationality.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @sicne OpenCAD 0.2.4
 **/
define('ROADSIDE_NCIC_PLATE', <ROADSIDE_NCIC_PLATE>);

/**#@+
 * OpenCAD Feature Settings - Civilian
 *
 * This section controls settings for OpenCAD's core features for Civilian.
 *
 * These setting will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD 0.2.4
 **/

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
define('CIV_WARRANT', <CIV_WARRANT>);

/**#@+
 * CIV_REG
 *
 * Allow/Disallow direct registration for Civillians.
 * If set to 'true' then civillians will not require admin approval, esle if
 * set to 'false' then Civillian registartion will require Admin approval.
 * Allow/Disallow immediate regitration for civilians.
 * If 'true' then civilian registartion will require Administrator approval
 * else if 'false' then civilian registrations will NOT require
 * Administrator approval.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @since  OpenCAD 1803
 **/
define('CIV_REG', <CIV_REG>);

/**#@+
  * Extra Settings
	*
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
	* These setting will likely be moved to an *_options table in a future version.
	*
  * @since 1.0a RC1
  **/
define('USE_GRAVATAR', <USE_GRAVATAR>);

/** That's all, stop editing! Happy roleplaying. **/
/**    Absolute path to the OpenCAD directory.   **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

include ABSPATH . "oc-functions.php";
?>