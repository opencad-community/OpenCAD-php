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


$lang = isset($_REQUEST['lang']) ? prepare_input($_REQUEST['lang']) : '';
	
if(!isset($arr_active_languages)) $arr_active_languages = array();

if(!empty($lang) && array_key_exists($lang, $arr_active_languages)){
	$curr_lang = $_SESSION['curr_lang'] = $lang;
	$curr_lang_direction = $_SESSION['curr_lang_direction'] = isset($arr_active_languages[$lang]['direction']) ? $arr_active_languages[$lang]['direction'] : EI_DEFAULT_LANGUAGE;
}else if(isset($_SESSION['curr_lang']) && array_key_exists($_SESSION['curr_lang'], $arr_active_languages)){
	$curr_lang = $_SESSION['curr_lang'];
	$curr_lang_direction = isset($_SESSION['curr_lang_direction']) ? $_SESSION['curr_lang_direction'] : EI_DEFAULT_LANGUAGE_DIRECTION;
}else{
	$curr_lang = DEFAULT_LANGUAGE;
	$curr_lang_direction = DEFAULT_LANGUAGE_DIRECTION;
}

if(file_exists('/oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php')){
	include_once('/oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php');
}else if(file_exists('../oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php')){
	include_once('../oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php');
}else if(file_exists('../../oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php')){
	include_once('../../oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php');
}else{
	include_once('./oc-lang/en/en.inc.php');    	
}	


 if(version_compare(PHP_VERSION, '7.1', '<')) {
	session_start();
	$_SESSION['error_title'] = "Incompatable PHP Version";
	$_SESSION['error'] = "An incompatable version  of PHP is active. OpenCAD requires PHP 7.1 at minimum, the current recommended version is 7.2. Currently PHP ".phpversion()." is active, please contact your server administrator.";
	header('Location: '.BASE_URL.'/plugins/error/index.php');
}

if ( OC_DEBUG == "true" )
	{	
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
	} else {
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
		error_reporting(E_ERROR);
	}

if(!file_exists(getcwd().'/.htaccess') && is_writable(getcwd())){
	
	$root = str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd())."/plugins/error/static";

	$htaccess =	"RewriteEngine on".PHP_EOL
				."RewriteCond %{REQUEST_FILENAME} -d".PHP_EOL
				."RewriteRule ^ - [R=403,L]".PHP_EOL
				."### Begin ATVG ErrorPages ###".PHP_EOL
				."ErrorDocument 403 $root/403.php".PHP_EOL
				."ErrorDocument 404 $root/404.php".PHP_EOL
				."ErrorDocument 502 $root/502.php".PHP_EOL
				."ErrorDocument 503 $root/503.php".PHP_EOL
				."### End ATVG ErrorPages ###".PHP_EOL
				."Options -Indexes".PHP_EOL;

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

    $result = $pdo->query("SELECT value FROM ".DB_PREFIX."config WHERE `key`='api_key'");

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
		$result = $pdo->query("UPDATE ".DB_PREFIX."config SET `value`='$key' WHERE `key`='api_key'");

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
		$result = $pdo->query("INSERT INTO ".DB_PREFIX."config VALUES ('api_key', '$key')");

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
	echo '0.3.1 (commit f1cfe311e6a)';
}

/**#@+
* function function()
* Description of function
*
* @since version
*
**/
function permissionDenied()
{
	$_SESSION['error_title'] = "Permission Denied";
	$_SESSION['error'] = "Sorry, you don't have permission to access this page.";
	header('Location: '.BASE_URL.'/plugins/error/index.php');
	die();
}

?>
