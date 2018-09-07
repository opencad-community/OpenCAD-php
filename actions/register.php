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

if (isset($_POST['register']))
{
    register();
}
if (isset($_POST['civreg']))
{
    civreg();
}

function register()
{
    $name = htmlspecialchars($_POST['uname']);
    $email = htmlspecialchars($_POST['email']);
    $identifier = htmlspecialchars($_POST['identifier']);
    $divisions = array();
    foreach ($_POST['division'] as $selectedOption)
    {
        array_push($divisions, htmlspecialchars($selectedOption));
    }
    if($_POST['password'] !== $_POST['password1'])
    {
        session_start();
        $_SESSION['register_error'] = "Passwords do not match";
        sleep(1);
        header("Location:".BASE_URL."/index.php#signup");
        exit();
    }
    //Hash the password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //Establish database connection

    //Check to see if the email has already been used
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("SELECT email from users where email = ?");
    $resStatus = $stmt->execute(array($email));
    $result = $stmt;

    if (!$resStatus)
    {
        die($stmt->errorInfo());
    }

    $num_rows = $result->rowCount();
    if ($num_rows>0)
    {
        session_start();
        $_SESSION['register_error'] = "Email already exists";
        sleep(1);
        header("Location:".BASE_URL."/index.php#signup");
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, identifier) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute(array($name, $email, $password, $identifier));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    /*Add user to departments they requested, temporary table */
    /*This is really inefficient. There should be a better way*/
    foreach($divisions as $division)
    {
        if($division == "communications")
            {$division = "1";}
        elseif($division == "state")
            {$division = "2";}
        elseif($division == "highway")
            {$division = "3";}
        elseif($division == "sheriff")
            {$division = "4";}
        elseif($division == "police")
            {$division = "5";}
        elseif($division == "fire")
            {$division = "6";}
        elseif($division == "ems")
            {$division = "7";}
        elseif($division == "civilian")
            {$division = "8";}

        $stmt = $pdo->prepare("INSERT INTO user_departments_temp (user_id, department_id) SELECT id , ? FROM users WHERE email = ?");
        $result = $stmt->execute(array($division, $email));

        if (!$result)
        {
            die($stmt->errorInfo());
        }
    }

    $pdo = null;
    session_start();
    $_SESSION['register_success'] = "Successfully requested access. Please wait for an administrator to approve your request.";
    sleep(1);
    header("Location:".BASE_URL."/index.php#signup");
}

function civreg()
{
    $name = htmlspecialchars($_POST['uname']);
    $email = htmlspecialchars($_POST['email']);
    $identifier = htmlspecialchars($_POST['identifier']);
    if($_POST['password'] !== $_POST['password1'])
    {
        session_start();
        $_SESSION['register_error'] = "Passwords do not match";
        sleep(1);
        header("Location:".BASE_URL."/index.php#signup");
        exit();
    }
    //Hash the password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //Establish database connection

    //Check to see if the email has already been used
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("SELECT email from users where email = ?");
    $resStatus = $stmt->execute(array($email));
    $result = $stmt;

    if (!$resStatus)
    {
        die($stmt->errorInfo());
    }
    $num_rows = $result->rowCount();

    if ($num_rows>0)
    {
        session_start();
        $_SESSION['register_error'] = "Email already exists";
        sleep(1);
        header("Location:".BASE_URL."/index.php#civreg");
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, identifier, approved) VALUES (?, ?, ?, ?, '1')");
    $result = $stmt->execute(array($name, $email, $password, $identifier));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

    $civ = "8";
    $stmt = $pdo->prepare("INSERT INTO users (name, emailINSERT INTO user_departments (user_id, department_id) SELECT id , ? FROM users WHERE email = ?");
    $result = $stmt->execute(array($civ, $email));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

    $pdo = null;
    session_start();
    $_SESSION['register_success'] = "Successfully registered. You may now log-in.";
    sleep(1);
    header("Location:".BASE_URL."/index.php#civreg");
}
?>