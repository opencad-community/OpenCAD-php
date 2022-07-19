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
require_once("../oc-config.php");
require_once(ABSPATH . "/oc-functions.php");
require_once(ABSPATH . "/oc-settings.php");
require_once(ABSPATH . OCINC . "/apiAuth.inc.php");

isSessionStarted();
if (!empty($_POST)) {
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
}

try {
	$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
} catch (PDOException $ex) {
	throw_new_error("DB Connection Error", "0xe133fd5eb502 Error Occured: " . $ex->getMessage());
	die();
}

$stmt = $pdo->prepare("SELECT * FROM " . DB_PREFIX . "users WHERE email = ?");
$resStatus = $stmt->execute(array($email));
$result = $stmt->fetch();

if (!$resStatus) {
	$_SESSION['error'] = $stmt->errorInfo();
	header(ERRORREDIRECT);
	die();
}

$login_ok = false;

if (password_verify($password, $result['password'])) {
	$login_ok = true;
} else {
	isSessionStarted();
	$_SESSION['loginMessageDanger'] = 'Invalid credentials';
	header("Location:" . BASE_URL . "/index.php");
	exit();
}

/* Check to see if they're approved to use the system
		0 = Pending Approval
		1 = Approved
		2 = Suspended
	*/
if ($result['approved'] == "0") {
	isSessionStarted();
	$_SESSION['loginMessageDanger'] = 'Your account hasn\'t been approved yet. Please wait for an administrator to approve your access request.';
	header("Location:" . BASE_URL . "/index.php");
	exit();
}
if ($result['approved'] == "2") {
	/* TODO: [OCPHP-704] Show reason why user is suspended */
	isSessionStarted();
	$_SESSION['loginMessageDanger'] = "Your account has been suspended by an administrator for: $suspended_reason";
	header("Location:" . BASE_URL . "/index.php");
	exit();
}

$_SESSION['logged_in'] = 'YES';
$_SESSION['id'] = $result['id'];
$id = $_SESSION['id'];
$_SESSION['name'] = $result['name'];
$_SESSION['email'] = $result['email'];
$_SESSION['identifier'] = $result['identifier'];
$_SESSION['callsign'] = $result['identifier']; //Set callsign to default to identifier until the unit changes it

$getAdminPriv = $pdo->query("SELECT `adminPrivilege` from " . DB_PREFIX . "users WHERE id = \"$id\"");
$getAdminPriv->execute();
$adminPriv = $getAdminPriv->fetch(PDO::FETCH_ASSOC);
$_SESSION['adminPrivilege'] = $adminPriv['adminPrivilege'];

$getCivPriv = $pdo->query("SELECT `civilianPrivilege` from " . DB_PREFIX . "users WHERE id = \"$id\"");
$getCivPriv->execute();
$civPriv = $getCivPriv->fetch(PDO::FETCH_ASSOC);
$_SESSION['civilianPrivilege'] = $civPriv['civilianPrivilege'];

$getSuperPriv = $pdo->query("SELECT `supervisorPrivilege` from " . DB_PREFIX . "users WHERE id = \"$id\"");
$getSuperPriv->execute();
$superPriv = $getSuperPriv->fetch(PDO::FETCH_ASSOC);
$_SESSION['supervisorPrivilege'] = $superPriv['supervisorPrivilege'];

$getDepartments = $pdo->query("SELECT `departmentId` from " . DB_PREFIX . "userDepartments WHERE userId = \"$id\"");
$getDepartments->execute();
$Department = $getDepartments->fetchAll(PDO::FETCH_COLUMN);
foreach ($Department as $Department) {

	if ($Department == "1") {
		$_SESSION['dispatch'] = 'YES';
		$dispatchButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/cad.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Dispatch</a>";
	} else if ($Department == "7") {
		$_SESSION['ems'] = 'YES';
		$emsButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/mdt.php?dep=ems\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">EMS</a>";
	} else if ($Department == "6") {
		$_SESSION['fire'] = 'YES';
		$fireButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/mdt.php?dep=fire\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Fire</a>";
	} else if ($Department == "3") {
		$_SESSION['highway'] = 'YES';
		$highwayButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/mdt.php?dep=highway\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Highway Patrol</a>";
	} else if ($Department == "5") {
		$_SESSION['police'] = 'YES';
		$policeButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/mdt.php?dep=police\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Police Department</a>";
	} else if ($Department == "4") {
		$_SESSION['sheriff'] = 'YES';
		$sheriffButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/mdt.php?dep=sheriff\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Sheriff's Office</a>";
	} else if ($Department == "2") {
		$_SESSION['state'] = 'YES';
		$stateButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/mdt.php?dep=state\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">State Police</a>";
	} else if ($Department == "8") {
		$_SESSION['civillian'] = 'YES';
		$civilianButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/civilian.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Civilian</a>";
	} else if ($Department == "9") {
		$_SESSION['roadsideAssist'] = 'YES';
		$roadsideAssistButton = "<a rel=\"noopener\" href=\"" . BASE_URL . "/mdt.php?dep=roadsideAssist\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Roadside Assistance</a>";
	}
}

$pdo = null;

setcookie(htmlspecialchars(COOKIE_NAME), hash('whirlpool', session_id() . getApiKey()), time() + (86400 * 7), "/", null, true, true);

do_hook('login_success', $id, $result['name'], $result['email'], $result['identifier']);


header("Location:" . BASE_URL . "/" . OCAPPS . "/oc-start.php");
