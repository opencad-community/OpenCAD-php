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

/**
 * Patch notes:
 * Adding the `else` to make a `else if` prevents the execution
 * of multiple functions at the same time by the same client
 *
 * Running multiple functions at the same time doesnt seem to
 * be a needed feature.
 */
if (isset($_POST['delete_citation'])){
    delete_citation();
}else if (isset($_POST['delete_arrest'])){
    delete_arrest();
}else if (isset($_POST['delete_warning'])){
    delete_warning();
}else if (isset($_POST['delete_warrant'])){
    delete_warrant();
}else if (isset($_POST['delete_personbolo'])){
    delete_personbolo();
}else if (isset($_POST['delete_vehiclebolo'])){
    delete_vehiclebolo();
}
if (isset($_GET['cadGetPersonBOLOS'])){
    cadGetPersonBOLOS();
}
if (isset($_GET['cadGetVehicleBOLOS'])){
    cadGetVehicleBOLOS();
}else if (isset($_POST['clearCall'])){
    storeCall();
}else if (isset($_POST['newCall'])){
    newCall();
}else if (isset($_POST['assignUnit'])){
    assignUnit();
}else if (isset($_POST['addNarrative'])){
    addNarrative();
}else if (isset($_POST['create_warrant'])){
    create_warrant();
}else if (isset($_POST['create_arrest'])){
    create_arrest();
}else if (isset($_POST['create_citation'])){
    create_citation();
}else if (isset($_POST['create_warning'])){
    create_warning();
}else if (isset($_POST['create_personbolo'])){
    create_personbolo();
}else if (isset($_POST['create_vehiclebolo'])){
    create_vehiclebolo();
}else if (isset($_POST['bolos_personid'])){
    cadGetPersonBOLOSid();
}else if(isset($_POST['bolos_vehicleid'])){
    cadGetVehicleBOLOSid();
}else if(isset($_POST['edit_personbolo'])){
    editPersonBOLOS();
}else if(isset($_POST['edit_vehiclebolo'])){
    edit_vehiclebolo();
}else if (isset($_POST['change_aop'])){
    changeaop();
}
if (isset($_GET['term'])) {
    $data = array();
    $term = htmlspecialchars($_GET['term']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("SELECT * from streets WHERE name LIKE ?");
    $result = $stmt->execute(array("%$term%"));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    foreach($result as $row)
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

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("UPDATE calls SET call_narrative = concat(call_narrative, ?) WHERE call_id = ?");
    $result = $stmt->execute(array($narrativeAdd, $callId));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

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

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("SELECT callsign, id FROM active_users WHERE identifier = ?");
    $resStatus = $stmt->execute(array($unit));
    $result = $stmt;

    if (!$resStatus)
    {
        die($stmt->errorInfo());
    }

	foreach($result as $row)
	{
		$callsign = $row[0];
		$id = $row[1];
    }

    $stmt = $pdo->prepare("INSERT INTO calls_users (call_id, identifier, callsign, id) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute(array($callId, $unit, $callsign, $id));

    if (!$result)
    {
        print_r($stmt->errorInfo());
        die();
    }

    $stmt = $pdo->prepare("UPDATE active_users SET status = '0', status_detail = '3' WHERE active_users.callsign = ?");
    $result = $stmt->execute(array($callsign));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

    //Now we'll add data to the call log for unit history
    $narrativeAdd = date("Y-m-d H:i:s").': Dispatched: '.$callsign.'<br/>';

    $stmt = $pdo->prepare("UPDATE calls SET call_narrative = concat(call_narrative, ?) WHERE call_id = ?");
    $result = $stmt->execute(array($narrativeAdd, $callId));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

    echo "SUCCESS";
    $pdo = null;
}

function storeCall()
{

    $callId = htmlspecialchars($_POST['callId']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("INSERT INTO call_history SELECT calls.* FROM calls WHERE call_id = ?");
    $result = $stmt->execute(array($callId));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    clearCall();
}

function clearCall()
{

    $callId = htmlspecialchars($_POST['callId']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("DELETE FROM calls WHERE call_id = ?");
    $result = $stmt->execute(array($callId));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

    $stmt = $pdo->prepare("SELECT identifier FROM calls_users WHERE call_id = ?");
    $resStatus = $stmt->execute(array($callId));
    $result = $stmt;

    if (!$resStatus)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

	foreach($result as $row)
	{
		clearUnitFromCall($callId, $row[0]);
	}
}

function clearUnitFromCall($callId, $unit)
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("DELETE FROM calls_users WHERE call_id = ? AND identifier = ?");
    $result = $stmt->execute(array($callId, $unit));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;
}

function freeUnitStatus($unit)
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("UPDATE active_users SET status = '1', status_detail = '1' WHERE active_users.identifier = ?");
    $result = $stmt->execute(array($unit));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;
}

function newCall()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $result = $pdo->query("SELECT MAX(call_id) AS max FROM call_list");

    if (!$result)
    {
        die($pdo->errorInfo());
    }

	foreach($result as $row)
	{
		$callid = $row['max'];
	}
	
	$callid++;

	$stmt = $pdo->prepare("REPLACE INTO call_list (call_id) VALUES (?)");
    $result = $stmt->execute(array($callid));

    if (!$result)
    {
        die($stmt->errorInfo());
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

    $stmt = $pdo->prepare("INSERT INTO calls (call_id, call_type, call_street1, call_street2, call_street3, call_narrative) VALUES (?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($callid, $call_type, $street1, $street2, $street3, $narrative));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

    echo "SUCCESS";
    $pdo = null;
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
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $result = $pdo->query("SELECT bolos_vehicles.* FROM bolos_vehicles");

    if (!$result)
    {
        die($pdo->errorInfo());
    }
    $pdo = null;

    $num_rows = $result->rowCount();

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

        foreach($result as $row)
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
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $result = $pdo->query("SELECT bolos_persons.* FROM bolos_persons");

    if (!$result)
    {
        die($pdo->errorInfo());
    }
    $pdo = null;

    $num_rows = $result->rowCount();

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

        foreach($result as $row)
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
    session_start();
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
    $issued_by = $_SESSION['name'];
    $date = date('Y-m-d');

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)");
    $result = $stmt->execute(array($userId, $citation_name_1, $citation_fine_1, $issued_by, $date));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

	if ($citation_name_2){
        $stmt = $pdo->prepare("INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $citation_name_2, $citation_fine_2, $issued_by, $date));

        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	if ($citation_name_3) {
        $stmt = $pdo->prepare("INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $citation_name_3, $citation_fine_3, $issued_by, $date));

        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	if ($citation_name_4) {
        $stmt = $pdo->prepare("INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $citation_name_4, $citation_fine_4, $issued_by, $date));

        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	if ($citation_name_5) {
        $stmt = $pdo->prepare("INSERT INTO ncic_citations (name_id, citation_name, citation_fine, issued_by, status, issued_date) VALUES (?, ?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $citation_name_5, $citation_fine_5, $issued_by, $date));

        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created citation</span></div>';

    $pdo = null;
    header("Location:".BASE_URL."/cad.php");
}

function create_warning()
{
    session_start();
    $userId = htmlspecialchars($_POST['civilian_names']);
    $warning_name_1 = htmlspecialchars($_POST['warning_name_1']);
	$warning_name_2 = htmlspecialchars($_POST['warning_name_2']);
	$warning_name_3 = htmlspecialchars($_POST['warning_name_3']);
	$warning_name_4 = htmlspecialchars($_POST['warning_name_4']);
	$warning_name_5 = htmlspecialchars($_POST['warning_name_5']);
    $issued_by = $_SESSION['name'];
    $date = date('Y-m-d');

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)");
    $result = $stmt->execute(array($userId, $warning_name_1, $issued_by, $date));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

	if ($warning_name_2){
        $stmt = $pdo->prepare("INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $warning_name_2, $issued_by, $date));
    
        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	
	if ($warning_name_3) {
        $stmt = $pdo->prepare("INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $warning_name_3, $issued_by, $date));
    
        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	
	if ($warning_name_4) {
		$stmt = $pdo->prepare("INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $warning_name_4, $issued_by, $date));

        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	
	if ($warning_name_5) {
		$stmt = $pdo->prepare("INSERT INTO ncic_warnings (name_id, warning_name, issued_by, status, issued_date) VALUES (?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $warning_name_5, $issued_by, $date));

        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}

    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created warning</span></div>';

    $pdo = null;
    header("Location:".BASE_URL."/cad.php");
}

function create_warrant()
{
    $userId = htmlspecialchars($_POST['civilian_names']);
    $warrant_name = htmlspecialchars($_POST['warrant_name_sel']);
    $issuing_agency = htmlspecialchars($_POST['issuing_agency']);

    $warrant_name = htmlspecialchars($_POST['warrant_name_sel']);

	$status = 'Active';
	$date = date('Y-m-d');

    $expire = date('Y-m-d',strtotime('+1 day',strtotime($date)));

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("INSERT INTO ncic_warrants (name_id, expiration_date, warrant_name, issuing_agency, status, issued_date) VALUES (?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($userId, $expire, $warrant_name, $issuing_agency, $status, $date));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['warrantMessage'] = '<div class="alert alert-success"><span>Successfully created warrant</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function delete_citation()
{
    $cid = htmlspecialchars($_POST['cid']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("DELETE FROM ncic_citations WHERE id = ?");
    $result = $stmt->execute(array($cid));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully removed citation</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function delete_arrest()
{
    $aid = htmlspecialchars($_POST['aid']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("DELETE FROM ncic_arrests WHERE id = ?");
    $result = $stmt->execute(array($aid));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['arrestMessage'] = '<div class="alert alert-success"><span>Successfully removed arrest</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function delete_warning()
{
    $wgid = htmlspecialchars($_POST['wgid']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("DELETE FROM ncic_warnings WHERE id = ?");
    $result = $stmt->execute(array($wgid));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['warningMessage'] = '<div class="alert alert-success"><span>Successfully removed warning</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function delete_warrant()
{
    $wid = htmlspecialchars($_POST['wid']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
	}

    $stmt = $pdo->prepare("DELETE FROM ncic_warrants WHERE id = ?");
    $result = $stmt->execute(array($wid));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['warrantMessage'] = '<div class="alert alert-success"><span>Successfully removed warrant</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function ncic_arrests()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $result = $pdo->query("SELECT ncic_arrests.*, ncic_names.name FROM ncic_arrests INNER JOIN ncic_names ON ncic_names.id=ncic_arrests.name_id");

    if (!$result)
    {
        die($pdo->errorInfo());
    }
    $pdo = null;

    $num_rows = $result->rowCount();

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

        foreach($result as $row)
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
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $result = $pdo->query("SELECT ncic_warrants.*, ncic_names.name FROM ncic_warrants INNER JOIN ncic_names ON ncic_names.id=ncic_warrants.name_id");

    if (!$result)
    {
        die($pdo->errorInfo());
    }
    $pdo = null;

    $num_rows = $result->rowCount();

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

        foreach($result as $row)
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
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $result = $pdo->query("SELECT ncic_citations.*, ncic_names.name FROM ncic_citations INNER JOIN ncic_names ON ncic_names.id=ncic_citations.name_id");

    if (!$result)
    {
        die($pdo->errorInfo());
    }
    $pdo = null;

    $num_rows = $result->rowCount();

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

        foreach($result as $row)
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
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $result = $pdo->query("SELECT ncic_warnings.*, ncic_names.name FROM ncic_warnings INNER JOIN ncic_names ON ncic_names.id=ncic_warnings.name_id");

    if (!$result)
    {
        die($pdo->errorInfo());
    }
    $pdo = null;

    $num_rows = $result->rowCount();

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

        foreach($result as $row)
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

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("INSERT INTO bolos_persons (first_name, last_name, gender, physical_description, reason_wanted, last_seen) VALUES (?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($first_name, $last_name, $gender, $physical_description, $reason_wanted, $last_seen));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

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

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("INSERT INTO bolos_vehicles (vehicle_make, vehicle_model, vehicle_plate, primary_color, secondary_color, reason_wanted, last_seen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($vehicle_make, $vehicle_model, $vehicle_plate, $primary_color, $secondary_color, $reason_wanted, $last_seen));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully created BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function delete_personbolo()
{
    $pbid = htmlspecialchars($_POST['pbid']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("DELETE FROM bolos_persons WHERE id = ?");
    $result = $stmt->execute(array($pbid));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully removed person BOLO</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function delete_vehiclebolo()
{
    $vbid = htmlspecialchars($_POST['vbid']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("DELETE FROM bolos_vehicles WHERE id = ?");
    $result = $stmt->execute(array($vbid));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully removed vehicle BOLO</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function cadGetPersonBOLOSid()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("SELECT bolos_persons.* FROM bolos_persons WHERE id = ?");
    $resStatus = $stmt->execute(array(htmlspecialchars($_POST['bolos_personid'])));
    $result = $stmt;

    if (!$resStatus)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    $person = array();
    foreach($result as $row){
        $person = $row;
    }
    echo json_encode($person);
}

function cadGetVehicleBOLOSid()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("SELECT bolos_vehicles.* FROM bolos_vehicles WHERE id = ?");
    $resStatus = $stmt->execute(array(htmlspecialchars($_POST['bolos_vehicleid'])));
    $result = $stmt;

    if (!$resStatus)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    $vehicle = array();
    foreach($result as $row){
        $vehicle = $row;
    }
    echo json_encode($vehicle);
}

function changeaop()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("UPDATE aop SET aop = ?");
    $result = $stmt->execute(array(htmlspecialchars($_POST['aop'])));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    header("Location:".BASE_URL."/cad.php");
}

function editPersonBOLOS()
{
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $gender = htmlspecialchars($_POST['gender']);
    $physical_description = htmlspecialchars($_POST['physical_description']);
    $reason_wanted = htmlspecialchars($_POST['reason_wanted']);
    $last_seen = htmlspecialchars($_POST['last_seen']);
    $person_id = htmlspecialchars($_POST['edit_personId']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("UPDATE bolos_persons SET first_name = ?, last_name = ?, gender = ?, physical_description = ?, reason_wanted = ?, last_seen = ? WHERE id = ?");
    $result = $stmt->execute(array($first_name, $last_name, $gender, $physical_description, $reason_wanted, $last_seen, $person_id));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

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

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("UPDATE bolos_vehicles SET vehicle_make = ?, vehicle_model = ?, vehicle_plate = ?, primary_color = ?, secondary_color = ?, reason_wanted = ?, last_seen = ? WHERE id = ?");
    $result = $stmt->execute(array($vehicle_make, $vehicle_model, $vehicle_plate, $primary_color, $secondary_color, $reason_wanted, $last_seen, $vehicle_id));

    if (!$result)
    {
        die($stmt->errorInfo());
    }
    $pdo = null;

    session_start();
    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully Updated BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function create_arrest()
{
    session_start();
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
    $issued_by = $_SESSION['name'];
    $date = date('Y-m-d');

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($userId, $arrest_reason_1, $arrest_fine_1, $issued_by, $date));

    if (!$result)
    {
        die($stmt->errorInfo());
    }

	if ($arrest_reason_2){
        $stmt = $pdo->prepare("INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute(array($userId, $arrest_reason_2, $arrest_fine_2, $issued_by, $date));
    
        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	if ($arrest_reason_3) {
        $stmt = $pdo->prepare("INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute(array($userId, $arrest_reason_3, $arrest_fine_3, $issued_by, $date));
    
        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	if ($arrest_reason_4) {
        $stmt = $pdo->prepare("INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute(array($userId, $arrest_reason_4, $arrest_fine_4, $issued_by, $date));
    
        if (!$result)
        {
            die($stmt->errorInfo());
        }
	}
	if ($arrest_reason_5) {
        $stmt = $pdo->prepare("INSERT INTO ncic_arrests (name_id, arrest_reason, arrest_fine, issued_by, issued_date) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute(array($userId, $arrest_reason_5, $arrest_fine_5, $issued_by, $date));
    
        if (!$result)
        {
            die($stmt->errorInfo());
        }
    }
    session_start();
    $_SESSION['arrestMessage'] = '<div class="alert alert-success"><span>Successfully created arrest report</span></div>';

    $pdo = null;
    header("Location:".BASE_URL."/cad.php");
}
?>