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


require_once("oc-config.php");
require_once(ABSPATH . "/oc-includes/version.inc.php");
require_once(ABSPATH . "/oc-includes/autoload.inc.php");

check_php_version();

loadPlugins();

function loadPlugins()
{

	/** 
	 * Autoloads the Plugin folder
	 */

	require_once(ABSPATH . "/oc-includes/plugin-loader.inc.php");

	$plugin = new PluginLoader(__DIR__ . '/oc-content/plugins');

	$dir = ABSPATH . '/oc-content/plugins';
	$directories = glob($dir . '/*', GLOB_ONLYDIR);

	$pluginArray = array();

	foreach ($directories as $dir) {
		$directories = substr($dir, strrpos($dir, '/') + 1);
		array_push($pluginArray, $directories);
		$pluginArray = array_diff($pluginArray, ["error", "captcha", "radioCodeReference", "support"]);
	}

	foreach ($pluginArray as $array) {
		if (!str_contains($array, "_")) {
			$plugin->load($array);
		}
	}
}

$lang = isset($_REQUEST['lang']) ? prepare_input($_REQUEST['lang']) : '';

if (!isset($arr_active_languages)) $arr_active_languages = array();

if (!empty($lang) && array_key_exists($lang, $arr_active_languages)) {
	$curr_lang = $_SESSION['curr_lang'] = $lang;
	$curr_lang_direction = $_SESSION['curr_lang_direction'] = isset($arr_active_languages[$lang]['direction']) ? $arr_active_languages[$lang]['direction'] : EI_DEFAULT_LANGUAGE;
} else if (isset($_SESSION['curr_lang']) && array_key_exists($_SESSION['curr_lang'], $arr_active_languages)) {
	$curr_lang = $_SESSION['curr_lang'];
	$curr_lang_direction = isset($_SESSION['curr_lang_direction']) ? $_SESSION['curr_lang_direction'] : EI_DEFAULT_LANGUAGE_DIRECTION;
} else {
	$curr_lang = DEFAULT_LANGUAGE;
	$curr_lang_direction = DEFAULT_LANGUAGE_DIRECTION;
}

if (file_exists('/oc-content/languages/' . $curr_lang . '/' . $curr_lang . '.inc.php')) {
	include_once('/oc-content/languages/' . $curr_lang . '/' . $curr_lang . '.inc.php');
} else if (file_exists('../oc-content/languages/' . $curr_lang . '/' . $curr_lang . '.inc.php')) {
	include_once('../oc-content/languages/' . $curr_lang . '/' . $curr_lang . '.inc.php');
} else if (file_exists('../../oc-content/languages/' . $curr_lang . '/' . $curr_lang . '.inc.php')) {
	include_once('../../oc-content/languages/' . $curr_lang . '/' . $curr_lang . '.inc.php');
} else {
	include_once(ABSPATH . '/oc-content/languages/en/en.inc.php');
}

/**
 * @return bool
 */
function isSessionStarted()
{

	if (!isset($_SESSION)) session_start();
	return FALSE;
	die();
}

if (!file_exists(getcwd() . '/.htaccess') && is_writable(getcwd())) {

	$root = "/oc-content/plugins/error/static";

	$htaccess =	"RewriteEngine on" . PHP_EOL
		. "RewriteCond %{REQUEST_FILENAME} -d" . PHP_EOL
		. "ErrorDocument 403 $root/403.php" . PHP_EOL
		. "ErrorDocument 404 $root/404.php" . PHP_EOL
		. "ErrorDocument 502 $root/502.php" . PHP_EOL
		. "ErrorDocument 503 $root/503.php" . PHP_EOL
		. "Options -Indexes";

	file_put_contents(getcwd() . '/.htaccess', $htaccess);
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
function get_avatar()
{
	if (defined('USE_GRAVATAR') && USE_GRAVATAR) {
		$url = 'https://www.gravatar.com/avatar/';
		$url .= md5(strtolower(trim($_SESSION['email'])));
		$url .= "?size=200&default=https://i.imgur.com/VN4YCW7.png";
		return $url;
	} else {
		return "//i.imgur.com/VN4YCW7.png";
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
	return $mysqli->server_info;

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
function pageLoadTime()
{
	$time = microtime(true);
	$time = explode(' ', $time);
	$time = $time[0];
	$finish = $time;
	$total_time = $finish / 60 / 60 / 60 / 60 / 60;
	$final_time = round(($total_time), 2);
	echo 'Page generated in ' . $final_time . ' seconds.';
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
	try {
		$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
	} catch (PDOException $ex) {
		throw_new_error("DB Connection Error", "0xe133fd5eb502 Error Occured: " . $ex->getMessage());
		die();
	}

	$result = $pdo->query("SELECT value FROM " . DB_PREFIX . "config WHERE `key`='api_key'");

	if (!$result) {
		throw_new_error("DB Query Error", "Error: 0x7ecbcfff5cf2 " . $pdo->errorInfo());
		die();
	}

	if ($result->rowCount() >= 1 && $del_key) {
		error_log("Do delete: $del_key");
		$key = generateRandomString(64);
		$result = $pdo->query("UPDATE " . DB_PREFIX . "config SET `value`='$key' WHERE `key`='api_key'");

		if (!$result) {
			throw_new_error("DB Query Error", "Error: 0x7ecbcfff5cf2 " . $pdo->errorInfo());

			die();
		}

		return $key;
	} else if ($result->rowCount() >= 1) {
		$key = $result->fetch(PDO::FETCH_ASSOC)['value'];
		return $key;
	} else {
		$key = generateRandomString(64);
		$result = $pdo->query("INSERT INTO " . DB_PREFIX . "config VALUES ('api_key', '$key')");

		if (!$result) {
			throw_new_error("DB Query Error", "Error: 0x7ecbcfff5cf2 " . $pdo->errorInfo());

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
function generateRandomString($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
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
	throw_new_error("Permission Denied", "Sorry, you don't have permission to view this page!");
	die();
}

/**#@+
 * function isAdminOrMod()
 * Will check if the user is an Administrator or a Moderator. If neither, will redirect to permissionDenied()
 *
 * @since 1.0
 *
 **/
function isAdminOrMod()
{
	isSessionStarted();
	if (!$_SESSION['adminPrivilege'] == 3 || !$_SESSION['adminPrivilege'] == 'Administrator' | !$_SESSION['adminPrivilege'] == 2 | !$_SESSION['adminPrivilege'] == 'Moderator') {
		permissionDenied();
	} else {
		return true;
	}
}

/**
 * 	Returns language key
 * 		@param $key
 */
function lang_key($key)
{
	global $arrLang;
	$output = '';

	if (isset($arrLang[$key])) {
		$output = $arrLang[$key];
	} else {
		$output = str_replace('_', ' ', $key);
	}
	return $output;
}

function write_to_console($data)
{
	$console = $data;
	if (is_array($console))
		$console = implode(',', $console);

	echo "<script>console.log('Console: " . $console . "' );</script>";
}

function throw_new_error($title, $body)
{
	isSessionStarted();
	$_SESSION["errorTitle"] = $title;
	$_SESSION["errorMsg"] = $body;
	header("Location: " . BASE_URL . "/oc-content/plugins/error/index.php");
	exit();
}

function check_php_version()
{
	if (phpversion() < MINIMUM_PHP_VERSION) {
		throw_new_error("Outdated PHP Version", "You need to update to PHP 8.0 (8.1 Recommended). Failure to do so will result in you being unable to use OpenCAD. Your version is: " . phpversion());
		exit();
	}
	return true;
}
