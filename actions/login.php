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

require_once(__DIR__ . '/../oc-config.php');

    if(!empty($_POST))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (!$link) {
            die('Could not connect: ' .mysql_error());
        }

        $query = "SELECT id, name, password, email, identifier, password_reset, approved FROM users WHERE email = ?";

        try {
            $stmt = mysqli_prepare($link, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            $result = mysqli_stmt_execute($stmt);

            if ($result == FALSE) {
                die(mysqli_error($link));
            }
        }
        catch (Exception $e)
        {
            die("Failed to run query: " . $e->getMessage());
        }

        $login_ok = false;

        mysqli_stmt_bind_result($stmt, $id, $name, $pw, $email, $identifier, $password_reset, $approved);
	    mysqli_stmt_fetch($stmt);

        if (password_verify($password, $pw))
        {
            $login_ok = true;
        }
        else
        {
            session_start();
            $_SESSION['loginMessageDanger'] = 'Invalid credentials';
            header("Location:../index.php");
            exit();
        }

        /* Check to see if they're approved to use the system
            0 = Pending Approval
            1 = Approved
            2 = Suspended
        */
        if ($approved == "0")
        {
            session_start();
            $_SESSION['loginMessageDanger'] = 'Your account hasn\'t been approved yet. Please wait for an administrator to approve your access request.';
            header("Location:../index.php");
            exit();
        }
        else if ($approved == "2")
        {
            session_start();
            $_SESSION['loginMessageDanger'] = 'Your account has been suspended by an administrator.';
            header("Location:../index.php");
            exit();
        }

        /* TODO: Handle password resets */
        session_start();
        $_SESSION['logged_in'] = 'YES';
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['identifier'] = $identifier;
        $_SESSION['callsign'] = $identifier; //Set callsign to default to identifier until the unit changes it

        header("Location:../dashboard.php");
    }


?>
