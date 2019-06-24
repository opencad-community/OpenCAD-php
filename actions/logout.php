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

if (isset($_GET['responder']))
{
    logoutResponder();
}

//Need to make sure they're out of the active_users table
function logoutResponder()
{
    $identifier = htmlspecialchars($_GET['responder']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."active_users WHERE identifier = ?");
    $result = $stmt->execute(array($identifier));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;
}

session_start();
session_unset();
session_destroy();
if(ENABLE_API_SECURITY === true)
    setcookie('aljksdz7', null, -1, "/");

header("Location: ".BASE_URL."/index.php?loggedOut=true");
exit();
?>