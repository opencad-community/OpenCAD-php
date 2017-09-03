<?php

/* Community Name */
\define('COMMUNITY_NAME', 'My Community');

/* Database connection variables */
define('DB_NAME', 'YourMySQLdatabaseName');
define('DB_USER', 'YourMySQLuser');
define('DB_PASSWORD', 'YourMySQLDatabasePassword');
define('DB_HOST', 'HostnameOrIPtoYourDBserver');


/* To & From emails for system generated emails */
/* To be used in a later version for notificaton emails */
define('CAD_FROM_EMAIL', 'cad@community.com');
define('CAD_FROM_NAME', COMMUNITY_NAME.' CAD');
define('CAD_TO_EMAIL', 'admins@community.com');
define('CAD_TO_NAME', COMMUNITY_NAME.' Administrators');

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

?>
