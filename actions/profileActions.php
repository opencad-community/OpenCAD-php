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
/*
    This file handles all actions for profile.php script
*/

$iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
$connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"]."/openCad/".$iniContents['main']['connection_file_location'];

require($connectionsFileLocation);

//Handle requests
if (isset($_POST['update_profile_btn']))
{
    updateProfile();
}



function updateProfile()
{
    session_start();
    $id = $_SESSION['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $identifier = $_POST['identifier'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $query = "UPDATE users SET name = ?, email = ?, identifier = ? WHERE ID = ?";
	
	try {
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $identifier, $id);
		$result = mysqli_stmt_execute($stmt);
		
		if ($result == FALSE) {
            if (mysqli_errno($link) == 1062) {
                $_SESSION['profileUpdate'] = '<div class="alert alert-danger"><span>Update unsuccessful. Emails and Identifiers must be unique.</span></div>';
                sleep(1); //Seconds to wait
	            header("Location: ../profile/profile.php");
            }
			die(mysqli_error($link));
		}
	}
	catch (Exception $e)
	{
		die("Failed to run query: " . $e->getMessage());
	}

    //Reset the session variables so on refresh the fields are populated correctly
	$_SESSION['email'] = $email;
	$_SESSION['name'] = $name;
	$_SESSION['identifier'] = $identifier;

	//Let the user know their information was updated
	$_SESSION['profileUpdate'] = '<div class="alert alert-success"><span>Successfully updated your user information</span></div>';
	
	sleep(1); //Seconds to wait
	header("Location: ../profile/profile.php");
}
?>