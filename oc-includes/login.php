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
session_start();
require_once("../oc-config.php");
require_once(ABSPATH . "/oc-functions.php");
require_once(ABSPATH . "/oc-settings.php");

if(!empty($_POST))
{
    session_start();
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
}
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        
    }

    $stmt = $pdo->prepare("SELECT id, name, password, email, identifier, admin_privilege, password_reset, approved, suspend_reason FROM ".DB_PREFIX."users WHERE email = ?");
    $resStatus = $stmt->execute(array($email));
    $result = $stmt->fetch();

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
        
    $login_ok = false;

    if (password_verify($password, $result['password']))
    {
        $login_ok = true;
    }
    else
    {
        session_start();
        $_SESSION['loginMessageDanger'] = 'Invalid credentials';
        header("Location:".BASE_URL."/index.php");
        exit();
    }

    /* Check to see if they're approved to use the system
        0 = Pending Approval
        1 = Approved
        2 = Suspended
    */
    if ($result['approved'] == "0")
    {
        session_start();
        $_SESSION['loginMessageDanger'] = 'Your account hasn\'t been approved yet. Please wait for an administrator to approve your access request.';
        header("Location:".BASE_URL."/index.php");
        exit();
    }
    else if ($result['approved'] == "2")
    {
        /* TODO: Show reason why user is suspended */
        session_start();
        $_SESSION['loginMessageDanger'] = "Your account has been suspended by an administrator for: $suspended_reason";
        header("Location:".BASE_URL."/index.php");
        exit();
    }
    
    $_SESSION['logged_in'] = 'YES';
    $_SESSION['id'] = $result['id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['identifier'] = $result['identifier'];
    $_SESSION['callsign'] = $result['identifier']; //Set callsign to default to identifier until the unit changes it
    $_SESSION['admin_privilege'] = $result['admin_privilege']; //Set callsign to default to identifier until the unit changes it

    $id = $result['id'];

    $getDepartments = $pdo->prepare("SELECT department_id from ".DB_PREFIX."user_departments WHERE user_id = \"$id\" ORDER BY 1 ASC");
    $getDepartments->execute();
    $rowCount = $getDepartments->rowCount(); 
    $Departments = $getDepartments->fetchAll(PDO::FETCH_ASSOC);
    $Departments[1];
    print_r($Departments[1]);
    foreach( $Departments as $Department)
    {
            if ($Department = "7")
    {
        $_SESSION['ems'] = 'YES';
                    
    }
    else if ($Department == "6")
    {
        $_SESSION['fire'] = 'YES';
                    
    }
    else if ($Department == "3")
    {
        $_SESSION['highway'] = 'YES';
        
    }
    else if ($Department == "5")
    {
        $_SESSION['police'] = 'YES';
        
            }
    else if ($Department == "4")
    {
        $_SESSION['sheriff'] = 'YES';
        
    }
    else if ($Department == "2")
    {
        $_SESSION['state'] = 'YES';
        
    }
    else if ($Department == "8")
    {
        $_SESSION['civillian'] = 'YES';
    }
        else if ($Department == "9")
        {
                $_SESSION['roadsideAssist'] = 'YES';
                
        }
    }
$getAdminPriv = $pdo->query("SELECT `admin_privilege` from ".DB_PREFIX."users WHERE id = \"$id\"");
$getAdminPriv -> execute();
$adminPriv = $getAdminPriv->fetch(PDO::FETCH_ASSOC );
$_SESSION['admin_privilege'] = $adminPriv['admin_privilege'];

    $pdo = null;


    session_start();
    if(ENABLE_API_SECURITY === true)
        setcookie("aljksdz7", hash('md5', session_id().getApiKey()), time() + (86400 * 7), "/");
        header("Location:".BASE_URL."/".OCAPPS."/oc-start.php");

?>