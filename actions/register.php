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
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$link) {
        die('Could not connect: ' .mysql_error()); //TODO: A function to send me an email when this occurs
    }
    $name = $link->real_escape_string($_POST['uname']);
    $email = $link->real_escape_string($_POST['email']);
    $identifier = $link->real_escape_string($_POST['identifier']);
    $divisions = array();
    foreach ($_POST['division'] as $selectedOption)
    {
        array_push($divisions, $selectedOption);
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
    $query = "SELECT email from users where email = \"".$email."\"";
    $result = mysqli_query($link, $query);
    $num_rows = $result->num_rows;
    if ($num_rows>0)
    {
        session_start();
        $_SESSION['register_error'] = "Email already exists";
        sleep(1);
        header("Location:".BASE_URL."/index.php#signup");
        exit();
    }
    $query = "INSERT INTO users (name, email, password, identifier) VALUES (?, ?, ?, ?)";
    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $identifier);
        $result = mysqli_stmt_execute($stmt);
        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
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
        elseif($division == "roadsideAssist")
            {$division = "9";}
        $query = "INSERT INTO user_departments_temp (user_id, department_id)
              SELECT id , ?
              FROM users
              WHERE email = ?";
        try {
            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, "is", $division, $email);
            $result = mysqli_stmt_execute($stmt);
            if ($result == FALSE) {
                die(mysqli_error($link));
            }
        }
        catch (Exception $e)
        {
            die("Failed to run query: " . $e->getMessage()); //TODO: A function to send admins an email when this occurs should be made
        }
    }
    mysqli_close($link);
    session_start();
    $_SESSION['register_success'] = "Successfully requested access. Please wait for an administrator to approve your request.";
    sleep(1);
    header("Location:".BASE_URL."/index.php#signup");
}
function civreg()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$link) {
        die('Could not connect: ' .mysql_error()); //TODO: A function to send me an email when this occurs
    }
    $name = $link->real_escape_string($_POST['uname']);
    $email = $link->real_escape_string($_POST['email']);
    $identifier = $link->real_escape_string($_POST['identifier']);
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
    $query = "SELECT email from users where email = \"".$email."\"";
    $result = mysqli_query($link, $query);
    $num_rows = $result->num_rows;
    if ($num_rows>0)
    {
        session_start();
        $_SESSION['register_error'] = "Email already exists";
        sleep(1);
        header("Location:".BASE_URL."/index.php#civreg");
        exit();
    }
    $query = 'INSERT INTO users (name, email, password, identifier, approved) VALUES (?, ?, ?, ?, "1")';
    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $identifier);
        $result = mysqli_stmt_execute($stmt);
        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }
	$query = 'INSERT INTO user_departments (user_id, department_id)
		SELECT id , ?
		FROM users
		WHERE email = ?';
		$civ = "8";
	try {
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "is", $civ, $email);
		$result = mysqli_stmt_execute($stmt);
		if ($result == FALSE) {
			die(mysqli_error($link));
			}
		}
        catch (Exception $e)
        {
            die("Failed to run query: " . $e->getMessage()); //TODO: A function to send admins an email when this occurs should be made
        }
    mysqli_close($link);
    session_start();
    $_SESSION['register_success'] = "Successfully registered. You may now log-in.";
    sleep(1);
    header("Location:".BASE_URL."/index.php#civreg");
}
?>
