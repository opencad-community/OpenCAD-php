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

if (isset($_POST['delete_plate'])){
    delete_plate();
}
if (isset($_POST['delete_warrant'])){
    delete_warrant();
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
if (isset($_POST['create_citation'])){
    create_citation();
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
    $details = $_POST['details'];
    $callId = $_POST['callId'];
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

    $sql = "UPDATE calls SET call_notes = concat(call_notes, ?) WHERE call_id = ?";

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
    $details = $_POST['details'];
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

    $sql = "SELECT callsign FROM active_users WHERE identifier = \"$unit\"";

    $result=mysqli_query($link, $sql);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		$callsign = $row[0];
	}

    $sql = "INSERT INTO calls_users (call_id, identifier, callsign) VALUES (?, ?, ?)";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $callId, $unit, $callsign);
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

    $sql = "UPDATE calls SET call_notes = concat(call_notes, ?) WHERE call_id = ?";

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

    $callId = $_POST['callId'];

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

    $callId = $_POST['callId'];

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
    //Need to explode the details by &
    $details = $_POST['details'];
    $details = urldecode($details);

    $detailsArr = explode("&", $details);

    //Now, each item in the details array needs to be exploded by = to get the value
    $call_type = explode("=", $detailsArr[0])[1];
    $street1 = str_replace('+',' ', explode("=", $detailsArr[1])[1]);
    $street2 = str_replace('+',' ', explode("=", $detailsArr[2])[1]);
    $street3 = str_replace('+',' ', explode("=", $detailsArr[3])[1]);
    $unit1 = str_replace('+',' ', explode("=", $detailsArr[4])[1]);
    $unit2 = str_replace('+',' ', explode("=", $detailsArr[5])[1]);
    $narrative = str_replace('+',' ', explode("=", $detailsArr[6])[1]);
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

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO calls (call_type, call_street1, call_street2, call_street3, call_notes) VALUES (?, ?, ?, ?, ?)";

	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "sssss", $call_type, $street1, $street2, $street3, $narrative);
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

    $query = "SELECT identifier FROM active_users WHERE callsign = \"$unit1\"";

	$result=mysqli_query($link, $query);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		$unit_call_identifier = $row[0];
	}

    //Add the units into the calls_users table
    if ($unit1 == "")
    { /*Do nothing*/ }
    else
    {
        $sql = "INSERT INTO calls_users (call_id, identifier, callsign) VALUES (?, ?, ?)";

        try {
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "iss", $last_id, $unit_call_identifier, $unit1);
            $result = mysqli_stmt_execute($stmt);

            if ($result == FALSE) {
                die(mysqli_error($link));
            }
        }
        catch (Exception $e)
        {
            die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
        }

        //Now we need to modify the assigned user's status'
        $sql = "UPDATE active_users SET status = '0', status_detail = '3' WHERE active_users.callsign = ?";

        try {
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $unit1);
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
        $narrativeAdd = date("Y-m-d H:i:s").': Dispatched: '.$unit1.'<br/>';

        $sql = "UPDATE calls SET call_notes = concat(call_notes, ?) WHERE call_id = ?";

        try {
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "si", $narrativeAdd, $last_id);
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

    //Add the units into the calls_users table
    if ($unit2 == "")
    { /*Do nothing*/ }
    else
    {
        $sql = "INSERT INTO calls_users (call_id, identifier) VALUES (?, ?)";

        try {
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "is", $last_id, $unit2);
            $result = mysqli_stmt_execute($stmt);

            if ($result == FALSE) {
                die(mysqli_error($link));
            }
        }
        catch (Exception $e)
        {
            die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
        }

        //Now we need to modify the assigned user's status'
        $sql = "UPDATE active_users SET status = '0', status_detail = '3' WHERE active_users.callsign = ?";

        try {
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $unit2);
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
        $narrativeAdd = date("Y-m-d H:i:s").': Dispatched: '.$unit2.'<br/>';

        $sql = "UPDATE calls SET call_notes = concat(call_notes, ?) WHERE call_id = ?";

        try {
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "si", $narrativeAdd, $last_id);
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

function mdtGetVehicleBOLOS()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT bolo_vehicle.* FROM bolo_vehicle";

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
                    <form action="../actions/ncicAdminActions.php" method="post">
                    <input name="approveUser" type="submit" class="btn btn-xs btn-link" value="Edit" disabled />
                    <input name="delete_plate" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete" disabled/>
                    <input name="id" type="hidden" value='.$row[0].' />
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

function mdtGetPersonBOLOS()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT bolo_person.* FROM bolo_person";

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
                    <form action="../actions/ncicAdminActions.php" method="post">
                    <input name="approveUser" type="submit" class="btn btn-xs btn-link" value="Edit" disabled />
                    <input name="delete_plate" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete" disabled/>
                    <input name="id" type="hidden" value='.$row[0].' />
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
    $userId = $_POST['civilian_names'];
    $citation_name = $_POST['citation_name'];
    session_start();
    $issued_by = $_SESSION['name'];
    $date = date('Y-m-d');

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_citations (name_id, citation_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isss", $userId, $citation_name, $issued_by, $date);
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
    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created citation</span></div>';

    header("Location:../cad.php");
}

function create_warrant()
{
    $userId = $_POST['civilian_names'];
    $warrant_name = $_POST['warrant_name_sel'];
    $issuing_agency = $_POST['issuing_agency'];

    $warrant_name = $_POST['warrant_name_sel'];

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

    header("Location:../cad.php");
}
function ncic_citations()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_names.first_name, ncic_names.last_name, ncic_citations.id, ncic_citations.citation_name, ncic_citations.issued_date, ncic_citations.issued_by FROM ncic_citations INNER JOIN ncic_names ON ncic_citations.name_id=ncic_names.id WHERE ncic_citations.status = '1'";

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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Citation Name</th>
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
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>
                    <form action="../actions/dispatchActions.php" method="post">
                    <input name="edit_citation" type="submit" class="btn btn-xs btn-link" value="Edit" disabled />
                    <input name="delete_citation" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Expunge" disabled/>
                    <input name="cid" type="hidden" value='.$row[2].' />
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

function delete_citation()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $cid = $_POST['cid'];

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
    header("Location: ../oc-admin/ncicAdmin.php#citation_panel");
}

function delete_warrant()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $wid = $_POST['wid'];

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
    header("Location: ../oc-admin/ncicAdmin.php#warrant_panel");
}

function ncic_warrants()
{
   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_warrants.*, ncic_names.first_name, ncic_names.last_name FROM ncic_warrants INNER JOIN ncic_names ON ncic_names.id=ncic_warrants.name_id";

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
                <th>First Name</th>
                <th>Last Name</th>
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
                <td>'.$row[8].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[3].'</td>
                <td>
                    <form action="../actions/ncicAdminActions.php" method="post">
                    <input name="approveUser" type="submit" class="btn btn-xs btn-link" value="Edit" disabled />
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
                    <input name="delete_warrant" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Expunge" disabled/>
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

?>
