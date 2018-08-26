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

include_once(__DIR__ . "/../oc-config.php");

/* Handle POST requests */
if (isset($_POST['delete_name'])){
    delete_name();
}
if (isset($_POST['delete_plate'])){
    delete_plate();
}
if (isset($_POST['delete_weapon'])){
    delete_weapon();
}
if (isset($_POST['create_name'])){
    create_name();
}
if (isset($_POST['create_plate'])){
    create_plate();
}
if (isset($_POST['create_weapon'])){
    create_weapon();
}
if (isset($_POST['new_911']))
{
    create911Call();
}
if (isset($_POST['edit_name'])){
    edit_name();
}
if (isset($_POST['edit_plate'])){
    edit_plate();
}
if (isset($_POST['editid'])){
    editnameid();
}
if (isset($_POST['edit_plateid'])){
    editplateid();
}
if (isset($_POST['delete_warrant'])){
    delete_warrant();
}
if (isset($_POST['create_warrant'])){
    create_warrant();
}
function getCivilianNamesOwn()
{
    $uid = $_SESSION['id'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

	$sql = 'SELECT ncic_names.id, ncic_names.name FROM ncic_names where ncic_names.submittedByID = "' . $uid . '"';

	$result=mysqli_query($link, $sql);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		echo "<option value=\"$row[0]\">$row[1]</option>";
	}
	mysqli_close($link);
}

function ncicGetNames()
{
    $uid = $_SESSION['id'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = 'SELECT ncic_names.* FROM `ncic_names` WHERE ncic_names.submittedById = "' . $uid . '"';

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>You currently have no identities</span></div>";
    }
    else
    {
        echo '
            <table id="ncic_names" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>DOB</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Race</th>
                <th>DL Status</th>
                <th>Hair Color</th>
                <th>Build</th>
				<th>Weapon Status</th>
				<th>Deceased</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[6].'</td>
                <td>'.$row[7].'</td>
                <td>'.$row[8].'</td>
                <td>'.$row[9].'</td>
                <td>'.$row[10].'</td>
                <td>'.$row[11].'</td>
				<td>'.$row[12].'</td>
                <td>
                    <button name="edit_name" data-toggle="modal" data-target="#IdentityEditModal" id="edit_nameBtn" data-id='.$row[0].' class="btn btn-xs btn-link">Edit</button>
                    <form action="".BASE_URL."/actions/civActions.php" method="post">
                    <input name="delete_name" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete"/>
                    <input name="uid" type="hidden" value='.$row[0].' />
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

function ncicGetPlates()
{

    $uid = $_SESSION['id'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }


    $query = 'SELECT ncic_plates.*, ncic_names.name FROM ncic_plates INNER JOIN ncic_names ON ncic_names.id=ncic_plates.name_id WHERE ncic_plates.user_id = "' . $uid . '"';

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>You currently have no vehicles</span></div>";
    }
    else
    {
        echo '
            <table id="ncic_plates" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>Plate</th>
                <th>Reg. State</th>
                <th>Make</th>
                <th>Model</th>
                <th>Color</th>
                <th>Ins. Status</th>
                <th>Flags</th>
                <th>Notes</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {

            echo '
            <tr>
                <td>'.$row[12].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[9].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'/'.$row[6].'</td>
                <td>'.$row[7].'</td>
                <td>'.$row[8].'</td>
                <td>'.$row[10].'</td>
                <td>
                    <button name="edit_plate" data-toggle="modal" data-target="#editPlateModal" id="edit_plateBtn" data-id='.$row[0].' class="btn btn-xs btn-link">Edit</button>
                    <form action="".BASE_URL."/actions/civActions.php" method="post">
                    <input name="delete_plate" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete" enabled/>
                    <input name="vehid" type="hidden" value='.$row[0].' />
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

function delete_name()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $uid = htmlspecialchars($_POST['uid']);

    $query = "DELETE FROM ncic_names WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
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
    $_SESSION['nameMessage'] = '<div class="alert alert-success"><span>Successfully removed civilian name</span></div>';
    header("Location: ".BASE_URL."/civilian.php");
}

function delete_plate()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $vehid = htmlspecialchars($_POST['vehid']);

    $query = "DELETE FROM ncic_plates WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $vehid);
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
    $_SESSION['plateMessage'] = '<div class="alert alert-success"><span>Successfully removed civilian plate</span></div>';
    header("Location: ".BASE_URL."/civilian.php");
}

function create_name()
{
    session_start();

    $fullName = htmlspecialchars($_POST['civNameReq']);
    $firstName = explode(" ", $fullName) [0];
    $lastName = explode(" ", $fullName) [1];

    //Set first name to all lowercase
    $firstName = strtolower($firstName);
    //Remove all special characters
    $firstName = preg_replace('/[^A-Za-z0-9\-]/', '', $firstName);
    //Set first letter to uppercase
    $firstName = ucfirst($firstName);

    //Set last name to all lowercase
    $lastName = strtolower($lastName);
    //Remove all special characters
    $lastName = preg_replace('/[^A-Za-z0-9\-]/', '', $lastName);
    //Set first letter to uppercase
    $lastName = ucfirst($lastName);

	$name = $firstName . ' ' . $lastName;

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = 'SELECT name FROM ncic_names WHERE name = "' . $name . '" ';

    $result = mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if (!$num_rows == 0)
    {
        $_SESSION['identityMessage'] = '<div class="alert alert-danger"><span>Name already exists</span></div>';

        sleep(1);
        header("Location:".BASE_URL."/civilian.php");
    }

    // If name doesn't exist, add it to ncic_requests table
    //Who submitted it
    $submittedByName = $_SESSION['name'];
    $submitttedById = $_SESSION['id'];
    //Submission Data
    $name;
    $dob = htmlspecialchars($_POST['civDobReq']);
    $address = htmlspecialchars($_POST['civAddressReq']);
    $sex = htmlspecialchars($_POST['civSexReq']);
    $race = htmlspecialchars($_POST['civRaceReq']);
	$dlstatus = htmlspecialchars($_POST['civDL']);
    $hair = htmlspecialchars($_POST['civHairReq']);
    $build = htmlspecialchars($_POST['civBuildReq']);
	$weapon = htmlspecialchars($_POST['civWepStat']);
	$deceased = htmlspecialchars($_POST['civDec']);

    $query = "INSERT INTO ncic_names (submittedByName, submittedById, name, dob, address, gender, race, dl_status, hair_color, build, weapon_permit, deceased)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $submittedByName, $submitttedById, $name, $dob, $address, $sex, $race, $dlstatus, $hair, $build, $weapon, $deceased);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made

    }

    $_SESSION['identityMessage'] = '<div class="alert alert-success"><span>Successfully created your identity!</span></div>';

    sleep(1);
    header("Location:".BASE_URL."/civilian.php#name_panel");

}

function create_plate()
{
	session_start();

	$plate = htmlspecialchars($_POST['veh_plate']);

    //Remove all spaces from plate
    $plate = str_replace(' ', '', $plate);
    //Set plate to all uppercase
    $plate = strtoupper($plate);
    //Remove all hyphens
    $plate = str_replace('-', '', $plate);
    //Remove all special characters
    $plate = preg_replace('/[^A-Za-z0-9\-]/', '', $plate);

    $vehicle = htmlspecialchars($_POST['veh_make_model']);
    $veh_make = explode(" ", $vehicle) [0];
    $veh_model = explode(" ", $vehicle) [1];

    $uid = $_SESSION['id'];

    $submittedById = $_SESSION['id'];
    $userId = htmlspecialchars($_POST['civilian_names']);
    $veh_plate = $plate;
    $veh_make;
    $veh_model;
    $veh_pcolor = htmlspecialchars($_POST['veh_pcolor']);
    $veh_scolor = htmlspecialchars($_POST['veh_scolor']);
    $veh_insurance = htmlspecialchars($_POST['veh_insurance']);
    $flags = htmlspecialchars($_POST['flags']);
    $veh_reg_state = htmlspecialchars($_POST['veh_reg_state']);
    $notes = htmlspecialchars($_POST['notes']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_plates (name_id, veh_plate, veh_make, veh_model, veh_pcolor, veh_scolor, veh_insurance, flags, veh_reg_state, notes, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "issssssssss", $userId, $veh_plate, $veh_make, $veh_model, $veh_pcolor, $veh_scolor, $veh_insurance, $flags, $veh_reg_state, $notes, $submittedById);
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
    $_SESSION['plateMessage'] = '<div class="alert alert-success"><span>Successfully added plate to the database</span></div>';

    header("Location:".BASE_URL."/civilian.php#plate_panel");
}

function create911Call()
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

    $caller = htmlspecialchars($_POST['911_caller']);
    $location = htmlspecialchars($_POST['911_location']);
    $description = htmlspecialchars($_POST['911_description']);

    $created = date("Y-m-d H:i:s").': 911 Call Received<br/><br/>Caller Name: '.$caller;

    $call_narrative = $created.'<br/>Caller States: '.$description.'<br/>';

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "INSERT IGNORE INTO calls (call_id, call_type, call_street1, call_narrative) VALUES (?, '911', ?, ?)";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $callid, $location, $call_narrative);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    session_start();
    $_SESSION['good911'] = '<div class="alert alert-success"><span>Successfully created 911 call</span></div>';

    sleep(1);
    header("Location:".BASE_URL."/civilian.php#911_panel");

}
function edit_name()
{
    session_start();

    $fullName = htmlspecialchars($_POST['civNameReq']);
    $firstName = explode(" ", $fullName) [0];
    $lastName = explode(" ", $fullName) [1];

    //Set first name to all lowercase
    $firstName = strtolower($firstName);
    //Remove all special characters
    $firstName = preg_replace('/[^A-Za-z0-9\-]/', '', $firstName);
    //Set first letter to uppercase
    $firstName = ucfirst($firstName);

    //Set last name to all lowercase
    $lastName = strtolower($lastName);
    //Remove all special characters
    $lastName = preg_replace('/[^A-Za-z0-9\-]/', '', $lastName);
    //Set first letter to uppercase
    $lastName = ucfirst($lastName);

	$name = $firstName . ' ' . $lastName;

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = 'SELECT first_name FROM ncic_names WHERE first_name = "' . $name . '"';

    $result = mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if (!$num_rows == 0)
    {
        $_SESSION['identityMessage'] = '<div class="alert alert-danger"><span>Name already exists</span></div>';

        sleep(1);
        header("Location:".BASE_URL."/civilian.php");
    }

    // If name doesn't exist, add it to ncic_requests table
    //Who submitted it
    $submittedByName = $_SESSION['name'];
    $submitttedById = $_SESSION['id'];
    //Submission Data
    $name;
    $dob = htmlspecialchars($_POST['civDobReq']);
    $address = htmlspecialchars($_POST['civAddressReq']);
    $sex = htmlspecialchars($_POST['civSexReq']);
    $race = htmlspecialchars($_POST['civRaceReq']);
    $dlstatus = htmlspecialchars($_POST['civDL']);
    $hair = htmlspecialchars($_POST['civHairReq']);
    $build = htmlspecialchars($_POST['civBuildReq']);
	$weapon = htmlspecialchars($_POST['civWepStat']);
	$deceased = htmlspecialchars($_POST['civDec']);
    $editid = htmlspecialchars($_POST['Edit_id']);

    $query = "UPDATE ncic_names SET name = ?, dob = ?, address = ?, gender = ?, race = ?, dl_status = ?, hair_color = ?, build = ?, weapon_permit = ?, deceased = ? WHERE id = ?";
    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $name, $dob, $address, $sex, $race, $dlstatus, $hair, $build, $weapon, $deceased, $editid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made

    }

    $_SESSION['identityMessage'] = '<div class="alert alert-success"><span>Successfully updated the identity.</span></div>';

    sleep(1);
    header("Location:".BASE_URL."/civilian.php#name_panel");

}
function edit_plate()
{
    session_start();

    $plate = htmlspecialchars($_POST['veh_plate']);

    //Remove all spaces from plate
    $plate = str_replace(' ', '', $plate);
    //Set plate to all uppercase
    $plate = strtoupper($plate);
    //Remove all hyphens
    $plate = str_replace('-', '', $plate);
    //Remove all special characters
    $plate = preg_replace('/[^A-Za-z0-9\-]/', '', $plate);

    $vehicle = htmlspecialchars($_POST['veh_make_model']);
    $veh_make = explode(" ", $vehicle) [0];
    $veh_model = explode(" ", $vehicle) [1];

    $uid = $_SESSION['id'];

    $submittedById = $_SESSION['id'];
    $userId = htmlspecialchars($_POST['civilian_names']);
    $veh_plate = $plate;
    $veh_make;
    $veh_model;
    $veh_pcolor = htmlspecialchars($_POST['veh_pcolor']);
    $veh_scolor = htmlspecialchars($_POST['veh_scolor']);
    $veh_insurance = htmlspecialchars($_POST['veh_insurance']);
    $flags = htmlspecialchars($_POST['flags']);
    $veh_reg_state = htmlspecialchars($_POST['veh_reg_state']);
    $notes = htmlspecialchars($_POST['notes']);
    $plate_id = htmlspecialchars($_POST['Edit_plateId']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }


    $sql = "UPDATE ncic_plates SET name_id = ?, veh_plate = ?, veh_make = ?, veh_model = ?, veh_pcolor = ?, veh_scolor = ?, veh_insurance = ?, flags = ?, veh_reg_state = ?, notes = ? WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "issssssssss", $userId, $veh_plate, $veh_make, $veh_model, $veh_pcolor, $veh_scolor, $veh_insurance, $flags, $veh_reg_state, $notes, $plate_id);
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
    $_SESSION['plateMessage'] = '<div class="alert alert-success"><span>Successfully Updated plate to the database</span></div>';

    header("Location:".BASE_URL."/civilian.php#plate_panel");
}
function editnameid()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_names.* FROM ncic_names WHERE id=".$_POST['editid'];
    $resultset = mysqli_query($link, $query) or die("database error:". mysqli_error($link));
    $data = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {
    $data = $rows;
    }
    echo json_encode($data);
}
function editplateid()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_plates.* FROM ncic_plates WHERE id=".$_POST['edit_plateid'];
    $resultset = mysqli_query($link, $query) or die("database error:". mysqli_error($link));
    $plates = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {
    $plates = $rows;
    }
    echo json_encode($plates);
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

    header("Location:".BASE_URL."/civilian.php");
}
function ncic_warrants()
{
    $uid = $_SESSION['id'];

   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
	$sql = 'SELECT ncic_names.id from ncic_names where submittedById = "' . $uid . '"';

	$results=mysqli_query($link, $sql);
	while($row = mysqli_fetch_array($results, MYSQLI_BOTH))
        {
            $nameid = ''.$row[0].'';
		}

    $query = 'SELECT ncic_warrants.*, ncic_names.name FROM ncic_warrants INNER JOIN ncic_names ON ncic_names.id=ncic_warrants.name_id WHERE name_id = "' . $nameid . '"';

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
                    <form action="".BASE_URL."/actions/civActions.php" method="post">
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
    header("Location: ".BASE_URL."/civilian.php");
}

function create_weapon()
{
	session_start();

    $weapon = htmlspecialchars($_POST['weapon_all']);
    $wea_type = explode(" ", $weapon) [0];
    $wea_name = explode(" ", $weapon) [1];

    $uid = $_SESSION['id'];

    $submittedById = $_SESSION['id'];
    $userId = htmlspecialchars($_POST['civilian_names']);
    $wea_type;
    $wea_name;

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_weapons (name_id, weapon_type, weapon_name, user_id) VALUES (?, ?, ?, ?)";


	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "isss", $userId, $wea_type, $wea_name, $submittedById);
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
    $_SESSION['weaponMessage'] = '<div class="alert alert-success"><span>Successfully added a weapon to the database</span></div>';

    header("Location:".BASE_URL."/civilian.php#weapon_panel");
}
function ncicGetWeapons()
{
    $uid = $_SESSION['id'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = 'SELECT ncic_weapons.*, ncic_names.name FROM ncic_weapons INNER JOIN ncic_names ON ncic_names.id=ncic_weapons.name_id WHERE ncic_weapons.user_id = "' . $uid . '"';

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>You currently have no weapons</span></div>";
    }
    else
    {
        echo '
            <table id="ncic_names" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>Weapon Type</th>
                <th>Weapon Name</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[5].'</td>
                <td>'.$row[2].'</td>
                <td>'.$row[3].'</td>
                <td>
                    <form action="".BASE_URL."/actions/civActions.php" method="post">
                    <input name="delete_weapon" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete"/>
                    <input name="weaid" type="hidden" value='.$row[0].' />
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
function delete_weapon()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $weaid = htmlspecialchars($_POST['weaid']);

    $query = "DELETE FROM ncic_weapons WHERE id = ?";

    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $weaid);
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
    $_SESSION['weaponMessage'] = '<div class="alert alert-success"><span>Successfully removed civilian weapon</span></div>';
    header("Location: ".BASE_URL."/civilian.php");
}
?>
