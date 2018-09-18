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

function checkIfHeadAdmin()
{
    //Check if the permission is already set
    if (isset($_SESSION['headAdmin']))
    {
        if ($_SESSION['headAdmin'] == "true")
        {
            return true;
            exit();
        }
        else if ($_SESSION['headAdmin'] == "false")
        {
            return false;
            exit();
        }
    }

    $user_id = $_SESSION['id'];
    $department_id = '8'; // Table departments department_name = head administrators

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("SELECT * from user_departments WHERE user_id = ? AND department_id = ?");
    $result = $stmt->execute(array($user_id, $department_id));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    $num_rows = $result->rowCount();

    if ($num_rows == 0)
    {
        $_SESSION['headAdmin'] = "false";
        return false;
        exit();
    }
    else
    {
        $_SESSION['headAdmin'] = "true";
        return true;
        exit();
    }
}
?>