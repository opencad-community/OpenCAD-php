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

if (isset($_GET['responder']))
{
    logoutResponder();
}

//Need to make sure they're out of the active_users table
function logoutResponder()
{
    $identifier = $_GET['responder'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "DELETE FROM active_users WHERE identifier = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $identifier);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    mysqli_close($link);
}

session_start();
session_unset();
session_destroy();

header("Location: ../index.php?loggedOut=true");
exit();
?>
