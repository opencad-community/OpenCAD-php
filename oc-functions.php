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

if(!file_exists(getcwd().'/.htaccess') && is_writable(getcwd())){
	
	$root = str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd())."/plugins/error/static";

	$htaccess = "ErrorDocument 403 $root/403.php".PHP_EOL
				."ErrorDocument 404 $root/404.php".PHP_EOL
				."ErrorDocument 418 $root/418.php".PHP_EOL
				."ErrorDocument 502 $root/502.php".PHP_EOL
				."ErrorDocument 503 $root/503.php";

	file_put_contents(getcwd().'/.htaccess', $htaccess);
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
  * function getApiKey()
	* Get or Set the API Security key for OpenCAD.
	*
	* @since 0.2.6
	* 
	* (Imported from ATVG-CAD 1.3.0.0)
	**/
function getApiKey($del_key = false)
{
	try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT value FROM config WHERE `key`='api_key'");

    if (!$result)
    {
		$_SESSION['error'] = $pdo->errorInfo();
		error_log(print_r($pdo->errorInfo(), true));
		header('Location: '.BASE_URL.'/plugins/error/index.php');
		die();
    }

	if($result->rowCount() >= 1 && $del_key)
	{
		error_log("Do delete: $del_key");
		$key = generateRandomString(64);
		$result = $pdo->query("UPDATE config SET `value`='$key' WHERE `key`='api_key'");

		if (!$result)
		{
			$_SESSION['error'] = $pdo->errorInfo();
			error_log(print_r($pdo->errorInfo(), true));
			header('Location: '.BASE_URL.'/plugins/error/index.php');
			die();
		}

		return $key;
	}else if($result->rowCount() >= 1){
		$key = $result->fetch(PDO::FETCH_ASSOC)['value'];
		return $key;
	}else{
		$key = generateRandomString(64);
		$result = $pdo->query("INSERT INTO config VALUES ('api_key', '$key')");

		if (!$result)
		{
			$_SESSION['error'] = $pdo->errorInfo();
			error_log(print_r($pdo->errorInfo(), true));
			header('Location: '.BASE_URL.'/plugins/error/index.php');
			die();
		}

		return $key;
	}
    $pdo = null;
}

/**#@+
  * function generateRandomString()
	* Generate a random string of custom length
	*
	* @since 0.2.6
	* 
	* (Imported from ATVG-CAD 1.3.0.0)
	**/
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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
	echo '0.2.5';
}

?>
