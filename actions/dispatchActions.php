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

if (isset($_POST['delete_citation'])){
    delete_citation();
}
if (isset($_POST['delete_arrest'])){
    delete_arrest();
}
if (isset($_POST['delete_warning'])){
    delete_warning();
}
if (isset($_POST['delete_warrant'])){
    delete_warrant();
}
if (isset($_POST['delete_personbolo'])){
    delete_personbolo();
}
if (isset($_POST['delete_vehiclebolo'])){
    delete_vehiclebolo();
}
if (isset($_GET['cadGetPersonBOLOS']))
{
    cadGetPersonBOLOS();
}
if (isset($_GET['cadGetVehicleBOLOS']))
{
    cadGetVehicleBOLOS();
}
if (isset($_POST['clearCall']))
{
    storeCall();
}
if (isset($_POST['newCall']))
{
    newCall();
}
if (isset($_POST['assignUnit']))
{
    assignUnit();
}
if (isset($_POST['addNarrative']))
{
    addNarrative();
}
if (isset($_POST['create_warrant'])){
    create_warrant();
}
if (isset($_POST['create_arrest'])){
    create_arrest();
}
if (isset($_POST['create_citation'])){
    create_citation();
}
if (isset($_POST['create_warning'])){
    create_warning();
}
if (isset($_POST['create_personbolo'])){
    create_personbolo();
}
if (isset($_POST['create_vehiclebolo'])){
    create_vehiclebolo();
}
if (isset($_POST['bolos_personid'])){
    cadGetPersonBOLOSid();
}
if(isset($_POST['bolos_vehicleid'])){
    cadGetVehicleBOLOSid();
}
if(isset($_POST['edit_personbolo'])){
    editPersonBOLOS();
}
if(isset($_POST['edit_vehiclebolo'])){
    edit_vehiclebolo();
}
if (isset($_POST['change_aop'])){
    changeaop();
}
if (isset($_GET['term'])) {
    $data = array();

    $term = $_GET['term'];
    //echo json_encode($term);
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT * from streets WHERE name LIKE \"%$term%\"";

    $result=mysqli_query($link, $query);

    while($row = $result->fetch_assoc())
    {
        $data[] = $row['name'];
    }

    echo json_encode($data);


}

function addNarrative()
{
    session_start();
    $details = htmlspecialchars($_POST['details']);
    $callId = htmlspecialchars($_POST['callId']);
    $who = $_SESSION['identifier'];

    $detailsArr = explode("&", $details);

    $narrativeAdd = explode("=", $detailsArr[0])[1];
    $narrativeAdd = strtoupper($narrativeAdd);

    $narrativeAdd = date("Y-m-d H:i:s").': '.$who.': '.$narrativeAdd.'<br/>';

    $narrativeAdd = str_replace("+", " ", $narrativeAdd);


    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "UPDATE calls SET call_narrative = concat(call_narrative, ?) WHERE call_id = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "si", $narrativeAdd, $callId);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    echo "SUCCESS";

}

function assignUnit()
{
    //var_dump($_POST);
    //Need to explode the details by &
    $details = htmlspecialchars($_POST['details']);
    $detailsArr = explode("&", $details);

    if ($detailsArr[0] == 'unit=')
    {
        echo "ERROR";
        die();
    }

    $unit = explode("=", $detailsArr[0])[1];
    $callId = explode("=", $detailsArr[1])[1];
    $unit = str_replace("+", " ", $unit);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT callsign, id FROM active_users WHERE identifier = \"$unit\"";

    $result=mysqli_query($link, $sql);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		$callsign = $row[0];
		$id = $row[1];
	}

    $sql = "INSERT INTO calls_users (call_id, identifier, callsign, id) VALUES (?, ?, ?, ?)";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "issi", $callId, $unit, $callsign, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    //Now we need to modify the assigned user's status
    $sql = "UPDATE active_users SET status = '0', status_detail = '3' WHERE active_users.callsign = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $callsign);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    //Now we'll add data to the call log for unit history
    $narrativeAdd = date("Y-m-d H:i:s").': Dispatched: '.$callsign.'<br/>';

    $sql = "UPDATE calls SET call_narrative = concat(call_narrative, ?) WHERE call_id = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "si", $narrativeAdd, $callId);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    echo "SUCCESS";
}

function storeCall()
{

    $callId = htmlspecialchars($_POST['callId']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "INSERT INTO call_history SELECT calls.* FROM calls WHERE call_id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $callId);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    clearCall();
}

function clearCall()
{

    $callId = htmlspecialchars($_POST['callId']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    //First delete from calls list
    $query = "DELETE FROM calls WHERE call_id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $callId);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    //Get units that were on the call
    $query = "SELECT identifier FROM calls_users WHERE call_id = \"$callId\"";

    $result=mysqli_query($link, $query);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		clearUnitFromCall($callId, $row[0]);
	}

}

function clearUnitFromCall($callId, $unit)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    //First delete from calls list
    $query = "DELETE FROM calls_users WHERE call_id = ? AND identifier = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "is", $callId, $unit);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }

        echo "Here ".$unit;
        freeUnitStatus($unit);
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }
}

function freeUnitStatus($unit)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "UPDATE active_users SET status = '1', status_detail = '1' WHERE active_users.identifier = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $unit);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }
}

function newCall()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	$sql = "SELECT MAX(call_id) AS max FROM call_list";
	$result=mysqli_query($link, $sql);

	while($r=mysqli_fetch_array($result))
	{
		$callid = $r['max'];
	}
	
	$callid++;
	
    $sql = "REPLACE INTO call_list (call_id) VALUES (?)";

	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "s", $callid);
		$result = mysqli_stmt_execute($stmt);

		if ($result == FALSE) {
			die(mysqli_error($link));
		}
	}
	catch (Exception $e)
	{
		die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
	}
	
    //Need to explode the details by &
    $details = htmlspecialchars($_POST['details']);
    $details = urldecode($details);

    $detailsArr = explode("&", $details);

    //Now, each item in the details array needs to be exploded by = to get the value
    $call_type = explode("=", $detailsArr[0])[1];
    $street1 = str_replace('+',' ', explode("=", $detailsArr[1])[1]);
    $street2 = str_replace('+',' ', explode("=", $detailsArr[2])[1]);
    $street3 = str_replace('+',' ', explode("=", $detailsArr[3])[1]);
    $narrative = str_replace('+',' ', explode("=", $detailsArr[4])[1]);
    $narrative = strtoupper($narrative);

    $created = date("Y-m-d H:i:s").': Call Created<br/>';
    if ($narrative == "")
    {
        $narrative = $created;
    }
    else
    {
        $narrative = $created.date("Y-m-d H:i:s").': '.$narrative.'<br/>';
    }

    $sql = "INSERT INTO calls (call_id, call_type, call_street1, call_street2, call_street3, call_narrative) VALUES (?, ?, ?, ?, ?, ?)";

	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "ssssss", $callid, $call_type, $street1, $street2, $street3, $narrative);
		$result = mysqli_stmt_execute($stmt);

        //Get the ID of the new call to assign units to it
        $last_id = mysqli_insert_id($link);

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

/**#@+
 * function cadGetVehicleBOLOS()
 *
 * Querys database to retrieve all currently entered Vehicle BOLOS.
 *
 * @since 1.0a RC2
 */

function cadGetVehicleBOLOS()
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
            <table id="ncic_plates" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Vehicle Make</th>
                <th>Vehicle Model</th>
                <th>Vehicle Plate</th>
                <th>Primary Color</th>
                <th>Secondary Color</th>
                <th>Reason Wanted</th>
                <th>Last Seen</th>
                <th>Actions</th>
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
                <td>
                    <button name="edit_vehiclebolo" data-toggle="modal" data-target="#editVehicleBOLO" id="edit_vehiclebolo" data-id='.$row[0].' class="btn btn-xs btn-link">Edit</button>
					<form action="".BASE_URL."/actions/dispatchActions.php" method="post">
                    <input name="delete_vehiclebolo" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete"/>
                    <input name="vbid" type="hidden" value='.$row[0].' />
                    </form>
                </td>
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

function cadGetPersonBOLOS()
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
        echo "<div class=\"alert alert-info\"><span>Good work! No Active Person BOLOS.</span></div>";
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
                <th>Actions</th>
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
                <td>
                    <button name="edit_personbolo" data-toggle="modal" data-target="#editPersonboloModal" id="edit_personbolo" data-id='.$row[0].' class="btn btn-xs btn-link">Edit</button>
                    <form action="".BASE_URL."/actions/dispatchActions.php" method="post">
                    <input name="delete_personbolo" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete"/>
                    <input name="pbid" type="hidden" value='.$row[0].' />
                    </form>
                </td>
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
    session_start();
    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created citation</span></div>';

    header("Location:".BASE_URL."/cad.php");
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

    session_start();
    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created warning</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function create_warrant()
{
    $userId = htmlspecialchars($_POST['civilian_names']);
    $warrant_name = htmlspecialchars($_POST['warrant_name_sel']);
    $issuing_agency = htmlspecialchars($_POST['issuing_agency']);

    $warrant_name = htmlspecialchars($_POST['warrant_name_sel']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	$status = 'Active';
	$date = date('Y-m-d');

    $expire = date('Y-m-d',strtotime('+1 day',strtotime($date)));

    $sql = "INSERT INTO ncic_warrants (name_id, expiration_date, warrant_name, issuing_agency, status, issued_date) SELECT ?, ?, ?, ?, ?, ?";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isssss", $userId, $expire, $warrant_name, $issuing_agency, $status, $date);
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

    session_start();
    $_SESSION['warrantMessage'] = '<div class="alert alert-success"><span>Successfully created warrant</span></div>';

    header("Location:".BASE_URL."/cad.php");
}


function delete_citation()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $cid = htmlspecialchars($_POST['cid']);

    $query = "DELETE FROM ncic_citations WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $cid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    session_start();
    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully removed citation</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}
function delete_arrest()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $aid = htmlspecialchars($_POST['aid']);

    $query = "DELETE FROM ncic_arrests WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $aid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    session_start();
    $_SESSION['arrestMessage'] = '<div class="alert alert-success"><span>Successfully removed arrest</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function delete_warning()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $wgid = htmlspecialchars($_POST['wgid']);

    $query = "DELETE FROM ncic_warnings WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $wgid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    session_start();
    $_SESSION['warningMessage'] = '<div class="alert alert-success"><span>Successfully removed warning</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function delete_warrant()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $wid = htmlspecialchars($_POST['wid']);

    $query = "DELETE FROM ncic_warrants WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $wid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    session_start();
    $_SESSION['warrantMessage'] = '<div class="alert alert-success"><span>Successfully removed warrant</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}
function ncic_arrests()
{
   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_arrests.*, ncic_names.name FROM ncic_arrests INNER JOIN ncic_names ON ncic_names.id=ncic_arrests.name_id";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are currently no arrests in the NCIC Database</span></div>";
    }
    else
    {
        echo '
            <table id="ncic_arrests" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>Arrest Reason</th>
                <th>Arrest Amount</th>
                <th>Issued On</th>
                <th>Issued By</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[6].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>
                    <form action="".BASE_URL."/actions/dispatchActions.php" method="post">
                    <input name="delete_arrest" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Remove"/>
                    <input name="aid" type="hidden" value='.$row[0].' />
                    </form>
                </td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    }
}
function ncic_warrants()
{
   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_warrants.*, ncic_names.name FROM ncic_warrants INNER JOIN ncic_names ON ncic_names.id=ncic_warrants.name_id";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are currently no warrants in the NCIC Database</span></div>";
    }
    else
    {
        echo '
            <table id="ncic_warrants" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Status</th>
                <th>Name</th>
                <th>Warrant Name</th>
                <th>Issued On</th>
                <th>Expires On</th>
                <th>Issuing Agency</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[6].'</td>
                <td>'.$row[7].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[3].'</td>
                <td>
                    <form action="".BASE_URL."/actions/dispatchActions.php" method="post">
                    ';
                        if ($row[6] == "Active")
                        {
                            echo '<input name="serveWarrant" type="submit" class="btn btn-xs btn-link" value="Serve" disabled/>';
                        }
                        else
                        {
                            //Do Nothing
                        }
                    echo '
                    <input name="delete_warrant" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Expunge"/>
                    <input name="wid" type="hidden" value='.$row[0].' />
                    </form>
                </td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    }
}
function ncic_citations()
{
   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_citations.*, ncic_names.name FROM ncic_citations INNER JOIN ncic_names ON ncic_names.id=ncic_citations.name_id";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are currently no citations in the NCIC Database</span></div>";
    }
    else
    {
        echo '
            <table id="ncic_citations" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>Citation Name</th>
                <th>Citation Amount</th>
                <th>Issued On</th>
                <th>Issued By</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[7].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[6].'</td>
                <td>
                    <form action="".BASE_URL."/actions/dispatchActions.php" method="post">
                    <input name="delete_citation" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Remove"/>
                    <input name="cid" type="hidden" value='.$row[0].' />
                    </form>
                </td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    }
}
function ncic_warnings()
{
   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_warnings.*, ncic_names.name FROM ncic_warnings INNER JOIN ncic_names ON ncic_names.id=ncic_warnings.name_id";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are currently no warnings in the NCIC Database</span></div>";
    }
    else
    {
        echo '
            <table id="ncic_warnings" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>Warning Name</th>
                <th>Issued On</th>
                <th>Issued By</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[6].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>
                    <form action="".BASE_URL."/actions/dispatchActions.php" method="post">
                    <input name="delete_warning" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Remove"/>
                    <input name="wgid" type="hidden" value='.$row[0].' />
                    </form>
                </td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    }
}
function create_personbolo()
{
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $gender = htmlspecialchars($_POST['gender']);
    $physical_description = htmlspecialchars($_POST['physical_description']);
    $reason_wanted = htmlspecialchars($_POST['reason_wanted']);
    $last_seen = htmlspecialchars($_POST['last_seen']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO bolos_persons (first_name, last_name, gender, physical_description, reason_wanted, last_seen) SELECT ?, ?, ?, ?, ?, ?";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $gender, $physical_description, $reason_wanted, $last_seen);
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

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully created BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function create_vehiclebolo()
{
    $vehicle_make = htmlspecialchars($_POST['vehicle_make']);
    $vehicle_model = htmlspecialchars($_POST['vehicle_model']);
    $vehicle_plate = htmlspecialchars($_POST['vehicle_plate']);
    $primary_color = htmlspecialchars($_POST['primary_color']);
    $secondary_color = htmlspecialchars($_POST['secondary_color']);
    $reason_wanted = htmlspecialchars($_POST['reason_wanted']);
    $last_seen = htmlspecialchars($_POST['last_seen']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO bolos_vehicles (vehicle_make, vehicle_model, vehicle_plate, primary_color, secondary_color, reason_wanted, last_seen) SELECT ?, ?, ?, ?, ?, ?, ?";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "sssssss", $vehicle_make, $vehicle_model, $vehicle_plate, $primary_color, $secondary_color, $reason_wanted, $last_seen);
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

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully created BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function delete_personbolo()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $pbid = htmlspecialchars($_POST['pbid']);

    $query = "DELETE FROM bolos_persons WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $pbid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully removed person BOLO</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}


function delete_vehiclebolo()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $vbid = htmlspecialchars($_POST['vbid']);

    $query = "DELETE FROM bolos_vehicles WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $vbid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully removed vehicle BOLO</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}
function cadGetPersonBOLOSid()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT bolos_persons.* FROM bolos_persons WHERE id=".$_POST['bolos_personid'];
    $resultset = mysqli_query($link, $query) or die("database error:". mysqli_error($link));
    $person = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {
    $person = $rows;
    }
    echo json_encode($person);
}
function cadGetVehicleBOLOSid()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT bolos_vehicles.* FROM bolos_vehicles WHERE id=".$_POST['bolos_vehicleid'];
    $resultset = mysqli_query($link, $query) or die("database error:". mysqli_error($link));
    $vehicle = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {
    $vehicle = $rows;
    }
    echo json_encode($vehicle);
}
function changeaop(){
    $aop = htmlspecialchars($_POST['aop']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "UPDATE aop SET aop = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $aop);
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

    header("Location:".BASE_URL."/cad.php");
}
function editPersonBOLOS(){
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $gender = htmlspecialchars($_POST['gender']);
    $physical_description = htmlspecialchars($_POST['physical_description']);
    $reason_wanted = htmlspecialchars($_POST['reason_wanted']);
    $last_seen = htmlspecialchars($_POST['last_seen']);
    $person_id = htmlspecialchars($_POST['edit_personId']);
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "UPDATE bolos_persons SET first_name = ?, last_name = ?, gender = ?, physical_description = ?, reason_wanted = ?, last_seen = ? WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $first_name, $last_name, $gender, $physical_description, $reason_wanted, $last_seen, $person_id);
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

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully updated BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
}
function edit_vehiclebolo()
{
    $vehicle_make = htmlspecialchars($_POST['vehicle_make']);
    $vehicle_model = htmlspecialchars($_POST['vehicle_model']);
    $vehicle_plate = htmlspecialchars($_POST['vehicle_plate']);
    $primary_color = htmlspecialchars($_POST['primary_color']);
    $secondary_color = htmlspecialchars($_POST['secondary_color']);
    $reason_wanted = htmlspecialchars($_POST['reason_wanted']);
    $last_seen = htmlspecialchars($_POST['last_seen']);
    $vehicle_id = htmlspecialchars($_POST['edit_vehicleboloid']);
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "UPDATE bolos_vehicles SET vehicle_make = ?, vehicle_model = ?, vehicle_plate = ?, primary_color = ?, secondary_color = ?, reason_wanted = ?, last_seen = ? WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $vehicle_make, $vehicle_model, $vehicle_plate, $primary_color, $secondary_color, $reason_wanted, $last_seen, $vehicle_id);
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

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully Updated BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
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

    header("Location:".BASE_URL."/cad.php");
}
?>
