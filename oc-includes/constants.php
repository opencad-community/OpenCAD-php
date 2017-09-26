<?php

define("INCLUDES", "includes/");

/**
 * Database Constants - these constants are required in order for there to be a 
 * successful connection to the database. Make sure the information is correct.
 */
define("DB_TYPE", "mysql");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "xaiver");


/**
 * Database Table Constants - these constants hold the names of all the database 
 * tables used in the script.
 */
define("TBL_USERS", "users");
define("TBL_ACTIVE_USERS",  "active_users");
define("TBL_ACTIVE_GUESTS", "active_guests");
define("TBL_BANNED_USERS",  "banlist");
define("TBL_CONFIGURATION", "configuration");


/**
 * Special Names and Level Constants - the admin page will only be accessible to 
 * the user with the admin name and also to those users at the admin user level.
 * Feel free to change the names and level constants as you see fit, you may
 * also add additional level specifications. Levels must be digits between 0-10.
 */
define("ADMIN_NAME", "Admin");
define("GUEST_NAME", "Guest");

define("SUPER_ADMIN_LEVEL", 10); // Super Admin - There can be only one!
define("ADMIN_LEVEL", 9); // Other Admins - Promoted by the Super Admin 
define("REGUSER_LEVEL", 3); // Normal Registered User
define("ADMIN_ACT", 2); // Awaiting Admin activation
define("ACT_EMAIL", 1); // Awaiting Email Activation
define("GUEST_LEVEL", 0);


/**
 * Timeout Constants - these constants refer to the maximum amount of time 
 * (in minutes) after their last page fresh that a user and guest
 * are still considered active visitors.
 */
define("USER_TIMEOUT", 2);
define("GUEST_TIMEOUT", 5);
