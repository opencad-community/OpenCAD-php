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

require_once(__DIR__ . "/../oc-config.php");
include_once(__DIR__ . "/../oc-content/plugins/api_auth.php");

//Handle requests
if (isset($_POST['update_profile_btn']))
{
    updateProfile();
}
if (isset($_GET['getMyRank']))
{
	getMyRank();
}
if (isset($_POST['changePassword']))
{
  changePassword();
}

function updateProfile()
{
    session_start();
    $id = $_SESSION['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $identifier = htmlspecialchars($_POST['identifier']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET name = ?, email = ?, identifier = ? WHERE ID = ?");
    $result = $stmt->execute(array($name, $email, $identifier, $id));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

    //Reset the session variables so on refresh the fields are populated correctly
	$_SESSION['email'] = $email;
	$_SESSION['name'] = $name;
	$_SESSION['identifier'] = $identifier;

	//Let the user know their information was updated
	$_SESSION['profileUpdate'] = '<div class="alert alert-success"><span>'.lang_key("PROFILE_SUCCESS").'</span></div>';

	sleep(1); //Seconds to wait
	header("Location: ".BASE_URL."/".OCAPPS."/oc-profile.php");
}

function getMyRank()
{
    $id = $_GET['unit'];
    
	try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error_blob'] = $ex;
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT ".DB_PREFIX."ranks.rankName FROM ".DB_PREFIX."ranksUsers INNER JOIN ".DB_PREFIX."ranks ON ".DB_PREFIX."ranks.rank_id=".DB_PREFIX."ranksUsers.rank_id WHERE ".DB_PREFIX."ranksUsers.userId = ?");
    $result = $stmt->execute(array($id));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

	foreach($result as $row)
	{
		echo $row[0];
	}
}

function changePassword()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $id = $_SESSION['id'];
    $newpassword = htmlspecialchars($_POST['password']);
    $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET password = ? WHERE id = ?");
    $result = $stmt->execute(array($hashedPassword, $id));

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $_SESSION['profileUpdate'] = '<div class="alert alert-success"><span>'.lang_key("PASSWORD_SUCCESS").'</span></div>';

    $pdo = null;
    sleep(1); //Seconds to wait
    echo $_SESSION['profileUpdate'];
    header("Location: ".BASE_URL."/".OCAPPS."/oc-profile.php");
}