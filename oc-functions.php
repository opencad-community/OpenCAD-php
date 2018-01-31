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
  * Gravatar Fetching
	*
	* Fetch a user's Gravatar image based on their profile email.
	*
	* @since 1.0a RC1
	*
  * @source https://gravatar.com/site/implement/images/php/
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
  * Get page load time
	*
	* @since 1.0a RC2
	*
  **/
	function pageLoadTime() {
		$time = microtime(true);
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$finish = $time;
		$total_msec = round(($finish - $start), 2);
		$total_time = $total_msec/60/60/60/60/60;
		$final_time = round(($total_time), 2);
		echo 'Page generated in '.$final_time.' seconds.';
	}
?>
