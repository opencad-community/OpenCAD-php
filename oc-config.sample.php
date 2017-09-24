<?php

/* Community Name */
\define('COMMUNITY_NAME', 'My Community');

/* Database connection variables */
define('DB_NAME', 'openCAD');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');


/* Base URL Settings
*
* BASE_URL - The URL to your installation of OpenCAD inlcuding,
*             if utilized, it's subdirectory
*/
define('BASE_URL', 'www.ExampleURL.com/somedir');

/* To & From emails for system generated emails */
/* To be used in a later version for notificaton emails */
define('CAD_FROM_EMAIL', 'cad@community.com');
define('CAD_FROM_NAME', COMMUNITY_NAME.' CAD');
define('CAD_TO_EMAIL', 'admins@community.com');
define('CAD_TO_NAME', COMMUNITY_NAME.' Administrators');

define('USE_GRAVATAR', true)

?>
