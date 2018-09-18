<?php
/**
Open source CAD system for RolePlaying Communities.
Copyright (C) 2017 Shane Gill

This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
**/

/** Provides support for enviorments running PHP < 5.5 */
if (version_compare(PHP_VERSION, '5.5', '<' )) {
	require_once(ABSPATH . 'vendors/password_compat/password.php');
}

/**#@+
 * function get_avatar()
 * Function fetches user's gravatar based on their profile email, if one
 * doesn't exist then default to a silhouette.
 *
 * @source https://gravatar.com/site/implement/images/php/
 *
 * @since 1.0a RC2
 *
 **/
function get_avatar() {
		if (defined( 'USE_GRAVATAR' ) && USE_GRAVATAR) {
			$url = 'https://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $_SESSION['email'] ) ) );
	    $url .= "?size=200&default=https://i.imgur.com/VN4YCW7.png";
	    return $url;
		}else{
			return "https://i.imgur.com/VN4YCW7.png";
		}
}

/**#@+
  * function getMySQLVersion()
	* Get current installed version of MySQL.
	*
	* @since 1.0a RC2
	*
	**/
function getMySQLVersion()
{
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	/* print server version */
	printf($mysqli->server_info);

	/* close connection */
	$mysqli->close();
}

/**#@+
	* function pageLoadTime();
  * Get page load time
	*
	* @since 1.0a RC2
	*
  **/
function pageLoadTime() {
		$time = microtime(true);
		$time = explode(' ', $time);
		$time = $time[0];
		$finish = $time;
		$total_time = $finish/60/60/60/60/60;
		$final_time = round(($total_time), 2);
		echo 'Page generated in '.$final_time.' seconds.';
}

/**#@+
  * function getOpenCADVersion()
	* Get current installed version of OpenCAD.
	*
	* @since 0.2.0
	*
	**/
function getOpenCADVersion()
{
	echo '0.2.3';
}

?>
