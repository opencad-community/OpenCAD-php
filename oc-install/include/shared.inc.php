<?php

//--------------------------------------------------------------------------
// *** remote file inclusion, check for strange characters in $_GET keys
// *** all keys with "/", "\", ":" or "%-0-0" are blocked, so it becomes virtually impossible
// *** to inject other pages or websites
foreach($_GET as $get_key => $get_value){
    if(is_string($get_value) && (preg_match("/\//", $get_value) || preg_match("/\[\\\]/", $get_value) || preg_match("/:/", $get_value) || preg_match("/%00/", $get_value))){
        if(isset($_GET[$get_key])) unset($_GET[$get_key]);
        die("A hacking attempt has been detected. For security reasons, we're blocking any code execution.");
    }
}

// *** check token for POST requests
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$token_post = isset($_POST['token']) ? $_POST['token'] : 'post';
	$token_session = isset($_SESSION['token']) ? $_SESSION['token'] : 'session';
	
	if($token_session != $token_post){
		unset($_POST['task']); 
	}
}
// *** check and set token
$_SESSION['token'] = md5(uniqid(rand(), true));

function generateRandomString2($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// *** disabling magic quotes at runtime
if(get_magic_quotes_gpc()){
    function stripslashes_gpc(&$value) {
		$value = stripslashes($value);	
	}
    array_walk_recursive($_GET, 'stripslashes_gpc');
    array_walk_recursive($_POST, 'stripslashes_gpc');
    array_walk_recursive($_COOKIE, 'stripslashes_gpc');
    if(is_array($_REQUEST)) array_walk_recursive($_REQUEST, 'stripslashes_gpc');
}

