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

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = 'SELECT * from user_departments WHERE user_id = "'.$user_id.'" AND department_id = "'.$department_id.'"';

    $result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

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
