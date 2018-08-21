<?php

/**#@+
  * Application Settings
  *
  * This section includes settings for Database connectivity, base url, email config, and more.
  * These settings are MANDATORY. If they are not configured properly OpenCAD will not function correctly.
  * When you save this file, rename it to 'oc-config.php', as it will not work as it is.
  * When editing configuration constants be sure to only edit the contents of the second set of quotes in each.
  * @since 1.0a RC2
  **/

/**#@+
 * Community Name
 *
 * This is where you will change the community name to suit your Community.
 * Only change the variable named 'My Community'
 *
 * @since 1.0a RC1
 **/
define('COMMUNITY_NAME', 'My Community');

/**#@+
 *
 * Database connection variables
 * These are viable to the CAD system, and must be correct.
 * DB_NAME will typically have a subdirectory, such as 'OpenCAD_(database name)'
 * DB_USER is sometimes different, it can have a subdirectory and sometimes it doesn't. An example would be 'opencad_(username)'
 * DB_PASSWORD will be your password that you created with the user. This has no subdirectory.
 * DB_HOST can vary, it can be localhost or '127.0.0.1', if these do not work then please contact our support desk.
 *
 * @since 1.0a RC1
 *
 **/
define('DB_NAME', 'DatabaseName');
define('DB_USER', 'DatabaseUser');
define('DB_PASSWORD', 'DatabasePassword');
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
 *             //subdomain.example.com/subdir - subdomain with subdirectory
 *             //example.com/subdir - root domain with subdirectory
 *
 *             The OpenCAD team does not recommend including the trailing / on any of the above examples.
 *             It won't necessarily break anything but just makes reference look strange having
 *             two slashed when it isn't needed.
 *
 * @since 1.0a RC1
 **/
define('BASE_URL', '//example.com');

/**#@+
 * To & From emails for system generated emails
 * To be used in a later version for notificaton emails
 *
 * @since 1.0a RC2
 *
 **/
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
 * These do nothing so far, we are working on this.
 **/
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

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
 * @since OpenCAD 0.2.3
 **/

 /**#@+
  * POLICE_NCIC
  *
  * Shows or hides NCIC functionality on MDT console.
  * If 'true' then LEO will be able to use NCIC functions without the need for
  * a dispatcher, else if 'false' then LEO will require the presence of
  * dispatcher to use the NCIC function.
	*
  * These settings will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD 1804
  **/
define('POLICE_NCIC', false);


/**#@+
 * OpenCAD Feature Settings - Fire
 *
 * This section controls settings for OpenCAD's core features for Fire
 *
 * These setting will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD version 0.2.3
 **/

 /**#@+
	* FIRE_PANIC
	*
	* Shows or hides Panic functionality on MDT console for Fire
	* If 'true' then Fire personnel will be able to use the Panic button,
	* else if 'false' then Fire personnel will not be able to use the Panic button.
	*
	* These settings will likely be moved to an *_options table in a future version.
	*
	* @since OpenCAD version 0.2.3
	**/
  define('FIRE_PANIC', false);


 /**#@+
	* FIRE_BOLO
	*
	* Shows or Hides BOLO functionality on MDT console for Fire
	* If 'true' then Fire personnel will be able to view the BOLO board,
	* if 'false' then Fire personnel will not be able to view the BOLO board
	*.
	* These settings will likely be moved to an *_options table in a future version.
	*
	* @since OpenCAD version 0.2.3
	**/
 define('FIRE_BOLO', false);

/**#@+
  * FIRE_NCIC_NAME
  *
  * Shows or hides NCIC name functionality on MDT console for Fire
  * If 'true' then Fire personnel will be able to use the NCIC name name lookup,
  * else if 'false' then Fire personnel will not be able to use
	* NCIC name lookup.
	*
  * These settings will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
 define('FIRE_NCIC_NAME', false);

/**#@+
	* FIRE_NCIC_PLATE
	*
	* Shows or hides NCIC plate functionality on MDT console for Fire
	* If 'true' then Fire personnel will be able to use the NCIC plate lookup
	* function, if 'false' then Fire personnel will not be
	* able to use the NCIC plate look-up function.
	*
	* These settings will likely be moved to an *_options table in a future version.
	*
	* @since OpenCAD version 0.2.3
	**/
 define('FIRE_NCIC_PLATE', false);

/**#@+
  * OpenCAD Feature Settings - EMS
  *
  * This section controls settings for OpenCAD's core features for EMS
	*
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/

/**#@+
	 * EMS_PANIC
	 *
	 * Shows or hides Panic functionality on MDT console for EMS
	 * If 'true' then EMS personnel will be able to use the Panic button,
	 * else if 'false' then EMS personnel will not be able to use the Panic button.
	 * These settings will likely be moved to an *_options table in a future version.
	 *
	 * @since OpenCAD version 0.2.3
	 **/
	define('EMS_PANIC', false);

/**#@+
	 * EMS_BOLO
	 *
	 * Shows or hides BOLO functionality on MDT console for EMS
	 * If 'true' then EMS personnel will be able to view the BOLO board.
	 * else if 'false' then EMS personnel will not be able to view the BOLO board.
	 * These settings will likely be moved to an *_options table in a future version.
	 *
	 * @since OpenCAD version 0.2.3
	 **/
	define('EMS_BOLO', false);


/**#@+
	 * EMS_NCIC_NAME
	 *
	 * Shows or hides NCIC name functionality on MDT console for EMS
	 * If 'true' then EMS personnel will be able to use the NCIC name lookup
	 * funcion, else if 'false' then EMS personnel will not be
	 * to use the NCIC name lookup function.
	 *
	 * These settings will likely be moved to an *_options table in a future version.
	 *
	 * @since OpenCAD version 0.2.3
	 **/
	define('EMS_NCIC_NAME', false);

/**#@+
	 * EMS_NCIC_PLATE
	 *
	 * Shows or hides NCIC plate functionality on MDT console for EMS
	 * If 'true' then EMS personnel will be able to use the NCIC plate function,
	 * else if 'false' then EMS personnel will not be able to use the NCIC plate function.
	 * These settings will likely be moved to an *_options table in a future version.
	 *
	 * @since OpenCAD version 0.2.3
	 **/
	define('EMS_NCIC_PLATE', false);

/**#@+
	 * OpenCAD Feature Settings - Roadside Assistance / Tow
	 *
	 * This section controls settings for OpenCAD's core features for Roadside Assistance
	 * These setting will likely be moved to an *_options table in a future version.
	 *
	 * @since OpenCAD version 0.2.3
	 **/

/**#@+
 * ROADSIDE_PANIC
 *
 * Shows or hides the Panic functionality on MDT console for Roadside Assistance
 * If 'true' then Roadside Assistance Operator will be able to use the Panic button,
 * else if 'false' then the roadside assistance operator will not be able to use the Panic button.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD version 0.2.3
 **/
define('ROADSIDE_PANIC', false);

/**#@+
 * ROADSIDE_BOLO
 *
 * Shows or hides the BOLO functionality on MDT console for Roadside Assistance
 * If 'true' then a Roadside Assitance Operator will be able to use the BOLO function,
 * if 'false' then the Roadside Assistance Operator will not be able to use the BOLO function.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD version 0.2.3
 **/
define('ROADSIDE_BOLO', false);

/**#@+
 * ROADSIDE_NCIC_NAME
 *
 * Shows or hides NCIC Name functionality on MDT console for Roadside Assistance
 * If 'true' then the Roadside Assistance Operator will be able to use NCIC name query without the need for
 * a dispatcher, if 'false' then the Roadside Assistance Operator will require the presence of
 * dispatcher to use NCIC name query functions.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD version 0.2.3
 **/
define('ROADSIDE_NCIC_NAME', false);

/**#@+
 * ROADSIDE_NCIC_PLATE
 *
 * Shows or hides NCIC Plate functionality on MDT console for Roadside Assistance
 * If 'true' then Roadside Assistance Operators will be able to use NCIC plate query without the need for
 * a dispatcher, else if 'false' then the Roadside Assistance Operators will require the presence of
 * dispatcher to use NCIC plate query funcationality.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD version 0.2.3
 **/
define('ROADSIDE_NCIC_PLATE', false);

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
 * Allow/Disallow Civilians from managing their warrants. If set to 'true'
 * then Civs will be able to delete warrants from their profile, else if set
 * to 'false' then Civs will not have the ability to remove warrants.
 * These settings will likely be moved to an *_options table in a future version.
 *
 * @since OpenCAD 1803
 **/
define('CIV_WARRANT', false);

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
 * @since OpenCAD 1803
 **/
define('CIV_REG', false);

/**#@+
  * Administrative Settings
	*
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since  OpenCAD 0.2.3
  **/

/**#@+
  * Moderator Settings - Approve User
  *
  * If 'true' then Moderators will be able to approve new user requests
  * else, if 'false' then Moderators will not be able to approve new
  * user requests.
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('MODERATOR_APPROVE_USER', true);

/**#@+
  * Moderator Settings - Edit User
  *
  * If 'true' then Moderators will be able to edit users,
  * if 'false' then Moderators will not be able to edit users.
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('MODERATOR_EDIT_USER', true);

/**#@+
  * Moderator Settings - Suspend With Reason
  *
  * If 'true' then Moderators will be able Suspend users with a reason,
  *if 'false' Moderators will not be able to do so.
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('MODERATOR_SUSPEND_WITH_REASON', true);

/**#@+
  * Moderator Settings - Approve User
  *
  * If 'true' then Moderators will be able Suspend users without a reason,
  * if 'false' Moderators will not be able to do so.
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('MODERATOR_SUSPEND_WITHOUT_REASON', true);

/**#@+
  * Moderator Settings - Reactivate User
  *
  * If 'true' then Moderators will be able to ractvate users else,
  * if 'false' Moderators will not be able to reactivate users.
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('MODERATOR_REACTIVATE_USER', true);

/**#@+
  * Moderator Settings - Remove Group
  *
  * If 'true' then Moderators will be able to ractvate users else,
  * if 'false' Moderators will not be able to reactivate users.
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('MODERATOR_REMOVE_GROUP', true);

/**#@+
  * Moderator Settings - Delete User
  *
  * If 'true' then Moderators will be able to delete users,
  * if 'false' Moderators will not be able to delete users.
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('MODERATOR_DELETE_USER', true);

/**#@+
  * Moderator Settings - NCIC Editor
  *
  * If 'true' then Moderators will be able to access the NCIC editor,
  * if 'false' Moderators will not be able to access the NCCIC editor.
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('MODERATOR_NCIC_EDITOR', true);

/**#@+
  * Extra Settings
	*
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/

/**#@+
  * Demo Mode
  *
  * If 'true' then various user management features of OpenCAD will be
  * locked down, else if 'false' then OpenCAD's full functionality
  * will be available to use.
  *
  * it will use the default generic avatar image included with OpenCAD .
  *
  * These setting will likely be moved to an *_options table in a future version.
  *
  * @since OpenCAD version 0.2.3
  **/
define('DEMO_MODE', false);


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

define('USE_GRAVATAR', true);

/** That's all, stop editing! Happy roleplaying. **/
/**    Absolute path to the OpenCAD directory.   **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

include ABSPATH . "oc-functions.php";
?>
