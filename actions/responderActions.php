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
    This file handles all actions for responder.php script
*/

$iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
$connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"]."/openCad/".$iniContents['main']['connection_file_location'];

require($connectionsFileLocation);

/* Handle POST requests */
if (isset($_POST['updateCallsign'])){ 
    updateCallsign();
}

/* Handle GET requests */
if (isset($_GET['getStatus']))
{
    getStatus();
}

function updateCallsign()
{
    $details = $_POST['details'];
    $details = str_replace('+', ' ', $details);
    $details = str_replace('%7C', '|', $details);
    $detailsArr = explode("&", $details);
    //Now, each item in the details array needs to be exploded by = to get the value
    $callsign = explode("=", $detailsArr[0])[1];

    //Use the user's session ID
    session_start();
    $identifier = $_SESSION['identifier'];
    
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "UPDATE `active_users` SET `callsign` = ?, status = '0', status_detail='2' WHERE `active_users`.`identifier` = ?";

	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "ss", $callsign, $identifier);
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

    echo "SUCCESS";
}

function getStatus()
{
    session_start();
    $identifier = $_SESSION['identifier'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
    
    $sql = "SELECT status_detail FROM active_users WHERE identifier = \"$identifier\"";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $statusDetail = $row[0];
    }

    $sql = "SELECT status_text FROM statuses WHERE status_id = \"$statusDetail\"";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $statusText = $row[0];
    }

    echo $statusText;
}

?>