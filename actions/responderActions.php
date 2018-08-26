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

/* Handle POST requests */
if (isset($_POST['updateCallsign'])){
    updateCallsign();
}

/* Handle GET requests */
if (isset($_GET['getStatus']))
{
    getStatus();
}
if (isset($_GET['mdtGetVehicleBOLOS']))
{
    mdtGetVehicleBOLOS();
}
if (isset($_GET['mdtGetPersonBOLOS']))
{
    mdtGetPersonBOLOS();
}
if (isset($_POST['create_citation'])){
    create_citation();
}

if (isset($_POST['create_warning'])){
    create_warning();
}
if (isset($_POST['create_arrest'])){
    create_arrest();
}

function updateCallsign()
{
    $details = htmlspecialchars($_POST['details']);
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

    $sql = "UPDATE `active_users` SET `callsign` = ?, status = '0' WHERE `active_users`.`identifier` = ?";

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

    $_SESSION['callsign'] = $callsign;

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


/**#@+
 * function cadGetVehicleBOLOS()
 *
 * Querys database to retrieve all currently entered Vehicle BOLOS.
 *
 * @since 1.0a RC2
 */

function mdtGetVehicleBOLOS()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT bolos_vehicles.* FROM bolos_vehicles";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>Good work! No Active Vehicle BOLOS.</span></div>";
    }
    else
    {
        echo '
            <table id="bolo_board" class="table table-striped table-bordered bolo_board">
            <thead>
                <tr>
                  <th style="text-align: center;" >Vehicle Make</th>
                  <th>Vehicle Model</th>
                  <th>Vehicle Plate</th>
                  <th>Primary Color</th>
                  <th>Secondary Color</th>
                  <th>Reason Wanted</th>
                  <th>Last Seen</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {

            echo '
            <tr>
                <td>'.$row[1].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[6].'</td>
                <td>'.$row[7].'</td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    }
}

/**#@+
 * function cadGetPersonBOLOS()
 *
 * Querys database to retrieve all currently entered Person BOLOS.
 *
 * @since 1.0a RC2
 */

function mdtGetPersonBOLOS()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT bolos_persons.* FROM bolos_persons";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>Good work! No Active Persons BOLOS.</span></div>";
    }
    else
    {
        echo '
            <table id="bolo_board" class="table table-striped table-bordered">
            <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Gender</th>
                  <th>Physical Description</th>
                  <th>Reason Wanted</th>
                  <th>Last Seen</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[1].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[6].'</td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    }
}

function create_citation()
{
    $userId = htmlspecialchars($_POST['civilian_names']);
    $citation_name_1 = htmlspecialchars($_POST['citation_name_1']);
    $citation_fine_1 = htmlspecialchars($_POST['citation_fine_1']);
	$citation_name_2 = htmlspecialchars($_POST['citation_name_2']);
	$citation_fine_2 = htmlspecialchars($_POST['citation_fine_2']);
	$citation_name_3 = htmlspecialchars($_POST['citation_name_3']);
	$citation_fine_3 = htmlspecialchars($_POST['citation_fine_3']);
	$citation_name_4 = htmlspecialchars($_POST['citation_name_4']);
	$citation_fine_4 = htmlspecialchars($_POST['citation_fine_4']);
	$citation_name_5 = htmlspecialchars($_POST['citation_name_5']);
	$citation_fine_5 = htmlspecialchars($_POST['citation_fine_5']);
    session_start();
    $issued_by = $_SESSION['name'];
    $date = date('Y-m-d');

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $citation_name_1, $citation_fine_1, $issued_by, $date);
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
	if ($citation_name_2){
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	    $sql = "INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $citation_name_2, $citation_fine_2, $issued_by, $date);
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
	if ($citation_name_3) {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
    $sql = "INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $citation_name_3, $citation_fine_3, $issued_by, $date);
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
	if ($citation_name_4) {
   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	    $sql = "INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $citation_name_4, $citation_fine_4, $issued_by, $date);
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
	if ($citation_name_5) {
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	    $sql = "INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $citation_name_5, $citation_fine_5, $issued_by, $date);
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
    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created citation</span></div>';

    header("Location:".BASE_URL."/mdt.php");
}

function create_warning()
{
    $userId = htmlspecialchars($_POST['civilian_names']);
    $warning_name_1 = htmlspecialchars($_POST['warning_name_1']);
	$warning_name_2 = htmlspecialchars($_POST['warning_name_2']);
	$warning_name_3 = htmlspecialchars($_POST['warning_name_3']);
	$warning_name_4 = htmlspecialchars($_POST['warning_name_4']);
	$warning_name_5 = htmlspecialchars($_POST['warning_name_5']);
    session_start();
    $issued_by = $_SESSION['name'];
    $date = date('Y-m-d');

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isss", $userId, $warning_name_1, $issued_by, $date);
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
	
	if ($warning_name_2){
		    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isss", $userId, $warning_name_2, $issued_by, $date);
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
	
	if ($warning_name_3) {
		    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isss", $userId, $warning_name_3, $issued_by, $date);
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
	
	if ($warning_name_4) {
		    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isss", $userId, $warning_name_4, $issued_by, $date);
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
	
	if ($warning_name_5) {
		    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isss", $userId, $warning_name_5, $issued_by, $date);
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

    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created warning</span></div>';

    header("Location:".BASE_URL."/mdt.php");
}
function create_arrest()
{
    $userId = htmlspecialchars($_POST['civilian_names']);
    $arrest_reason_1 = htmlspecialchars($_POST['arrest_reason_1']);
    $arrest_fine_1 = htmlspecialchars($_POST['arrest_fine_1']);
	$arrest_reason_2 = htmlspecialchars($_POST['arrest_reason_2']);
	$arrest_fine_2 = htmlspecialchars($_POST['arrest_fine_2']);
	$arrest_reason_3 = htmlspecialchars($_POST['arrest_reason_3']);
	$arrest_fine_3 = htmlspecialchars($_POST['arrest_fine_3']);
	$arrest_reason_4 = htmlspecialchars($_POST['arrest_reason_4']);
	$arrest_fine_4 = htmlspecialchars($_POST['arrest_fine_4']);
	$arrest_reason_5 = htmlspecialchars($_POST['arrest_reason_5']);
	$arrest_fine_5 = htmlspecialchars($_POST['arrest_fine_5']);
    session_start();
    $issued_by = $_SESSION['name'];
    $date = date('Y-m-d');

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $arrest_reason_1, $arrest_fine_1, $issued_by, $date);
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
	if ($arrest_reason_2){
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	    $sql = "INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $arrest_reason_2, $arrest_fine_2, $issued_by, $date);
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
	if ($arrest_reason_3) {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
    $sql = "INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $arrest_reason_3, $arrest_fine_3, $issued_by, $date);
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
	if ($arrest_reason_4) {
   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	    $sql = "INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $arrest_reason_4, $arrest_fine_4, $issued_by, $date);
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
	if ($arrest_reason_5) {
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	    $sql = "INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isiss", $userId, $arrest_reason_5, $arrest_fine_5, $issued_by, $date);
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
    $_SESSION['arrestMessage'] = '<div class="alert alert-success"><span>Successfully created arrest report</span></div>';

    header("Location:".BASE_URL."/mdt.php");
}
?>
