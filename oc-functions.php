<?php

/** Absolute path to the OpenCAD directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Provides support for enviorments running PHP < 5.5 */
if (version_compare(PHP_VERSION, '5.5', '<' )) {
	require_once(ABSPATH . 'vendors/password_compat/password.php');
}

/**
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_avatar() {
		if (defined( 'USE_GRAVATAR' ) && USE_GRAVATAR) {
			$url = 'https://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $_SESSION['email'] ) ) );
	    $url .= "?size=200&default=https%3A%2F%2Fnyc3.digitaloceanspaces.com%2Fopencad%2Fimages%2Fuser.png&rating=pg";
	    return $url;
		}else{
			return "https://nyc3.digitaloceanspaces.com/opencad/images/user.png";
		}
}
?>
