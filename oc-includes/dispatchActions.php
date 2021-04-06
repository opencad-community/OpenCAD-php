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
include_once(__DIR__ . "/../oc-content/plugins/api_auth.php");

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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT name from ".DB_PREFIX."streets WHERE name LIKE ?");
    $result = $stmt->execute(array("%$term%"));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."calls SET callNarrative = concat(callNarrative, ?) WHERE callId = ?");
    $result = $stmt->execute(array($narrativeAdd, $callId));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT callsign, id FROM ".DB_PREFIX."activeUsers WHERE identifier = ?");
    $resStatus = $stmt->execute(array($unit));
    $result = $stmt;

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

	foreach($result as $row)
	{
		$callsign = $row[0];
		$id = $row[1];
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."callsUsers (callId, identifier, callsign, id) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute(array($callId, $unit, $callsign, $id));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."activeUsers SET status = '0', statusDetail = '3' WHERE ".DB_PREFIX."activeUsers.callsign = ?");
    $result = $stmt->execute(array($callsign));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    //Now we'll add data to the call log for unit history
    $narrativeAdd = date("Y-m-d H:i:s").': Dispatched: '.$callsign.'<br/>';

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."calls SET callNarrative = concat(callNarrative, ?) WHERE callId = ?");
    $result = $stmt->execute(array($narrativeAdd, $callId));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."callHistory SELECT ".DB_PREFIX."calls.* FROM ".DB_PREFIX."calls WHERE callId = ?");
    $result = $stmt->execute(array($callId));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."calls WHERE callId = ?");
    $result = $stmt->execute(array($callId));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT identifier FROM ".DB_PREFIX."callsUsers WHERE callId = ?");
    $resStatus = $stmt->execute(array($callId));
    $result = $stmt;

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."callsUsers WHERE callId = ? AND identifier = ?");
    $result = $stmt->execute(array($callId, $unit));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;
}

function freeUnitStatus($unit)
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."activeUsers SET status = '1', statusDetail = '1' WHERE ".DB_PREFIX."activeUsers.identifier = ?");
    $result = $stmt->execute(array($unit));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;
}

function newCall()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT MAX(callId) AS max FROM ".DB_PREFIX."callList");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

	foreach($result as $row)
	{
		$callid = $row['max'];
	}
	
	$callid++;

	$stmt = $pdo->prepare("REPLACE INTO ".DB_PREFIX."callList (callId) VALUES (?)");
    $result = $stmt->execute(array($callid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
	
    //Need to explode the details by &
    $details = htmlspecialchars($_POST['details']);
    $details = urldecode($details);

    $detailsArr = explode("&", $details);

    //Now, each item in the details array needs to be exploded by = to get the value
    $callType = explode("=", $detailsArr[0])[1];
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

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."calls (callId, callType, callStreet1, callStreet2, callStreet3, callNarrative) VALUES (?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($callid, $callType, $street1, $street2, $street3, $narrative));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT ".DB_PREFIX."bolosVehicles.* FROM ".DB_PREFIX."bolosVehicles");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
            <table id="ncicPlates" class="table table-striped table-bordered">
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
					<form action="".BASE_URL."/oc-includes/dispatchActions.php" method="post">
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT ".DB_PREFIX."bolosPersons.* FROM ".DB_PREFIX."bolosPersons");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
                    <form action="".BASE_URL."/oc-includes/dispatchActions.php" method="post">
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
    $Issuer = $_SESSION['name'];
    $date = date('Y-m-d');

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_citations (nameId, citationName, citationFine, Issuer, status, issuedDate) VALUES (?, ?, ?, ?, '1', ?)");
    $result = $stmt->execute(array($userId, $citation_name_1, $citation_fine_1, $Issuer, $date));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

	if ($citation_name_2){
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_citations (nameId, citationName, citationFine, Issuer, status, issuedDate) VALUES (?, ?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $citation_name_2, $citation_fine_2, $Issuer, $date));

        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	if ($citation_name_3) {
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_citations (nameId, citationName, citationFine, Issuer, status, issuedDate) VALUES (?, ?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $citation_name_3, $citation_fine_3, $Issuer, $date));

        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	if ($citation_name_4) {
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_citations (nameId, citationName, citationFine, Issuer, status, issuedDate) VALUES (?, ?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $citation_name_4, $citation_fine_4, $Issuer, $date));

        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	if ($citation_name_5) {
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_citations (nameId, citationName, citationFine, Issuer, status, issuedDate) VALUES (?, ?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $citation_name_5, $citation_fine_5, $Issuer, $date));

        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
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
    $Issuer = $_SESSION['name'];
    $date = date('Y-m-d');

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_warnings (nameId, warningName, Issuer, status, issuedDate) VALUES (?, ?, ?, '1', ?)");
    $result = $stmt->execute(array($userId, $warning_name_1, $Issuer, $date));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

	if ($warning_name_2){
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_warnings (nameId, warningName, Issuer, status, issuedDate) VALUES (?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $warning_name_2, $Issuer, $date));
    
        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	
	if ($warning_name_3) {
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_warnings (nameId, warningName, Issuer, status, issuedDate) VALUES (?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $warning_name_3, $Issuer, $date));
    
        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	
	if ($warning_name_4) {
		$stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_warnings (nameId, warningName, Issuer, status, issuedDate) VALUES (?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $warning_name_4, $Issuer, $date));

        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	
	if ($warning_name_5) {
		$stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_warnings (nameId, warningName, Issuer, status, issuedDate) VALUES (?, ?, ?, '1', ?)");
        $result = $stmt->execute(array($userId, $warning_name_5, $Issuer, $date));

        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}

    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created warning</span></div>';

    $pdo = null;
    header("Location:".BASE_URL."/cad.php");
}

function create_warrant()
{
    $userId = htmlspecialchars($_POST['civilian_names']);
    $warrantName = htmlspecialchars($_POST['warrant_name_sel']);
    $issuer = htmlspecialchars($_POST['issuer']);

    $warrantName = htmlspecialchars($_POST['warrant_name_sel']);

	$status = 'Active';
	$date = date('Y-m-d');

    $expire = date('Y-m-d',strtotime('+1 day',strtotime($date)));

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncic_warrants (nameId, expirationDate, warrantName, issuer, status, issuedDate) VALUES (?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($userId, $expire, $warrantName, $issuer, $status, $date));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."ncic_citations WHERE id = ?");
    $result = $stmt->execute(array($cid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."ncicArrests WHERE id = ?");
    $result = $stmt->execute(array($aid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."ncic_warnings WHERE id = ?");
    $result = $stmt->execute(array($wgid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
	}

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."ncic_warrants WHERE id = ?");
    $result = $stmt->execute(array($wid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $_SESSION['warrantMessage'] = '<div class="alert alert-success"><span>Successfully removed warrant</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function ncicGetArrests()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT ".DB_PREFIX."ncicArrests.*, ".DB_PREFIX."ncicNames.name FROM ".DB_PREFIX."ncicArrests INNER JOIN ".DB_PREFIX."ncicNames ON ".DB_PREFIX."ncicNames.id=".DB_PREFIX."ncicArrests.nameId");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
            <table id="ncicArrests" class="table table-striped table-bordered">
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
                    <form action="".BASE_URL."/oc-includes/dispatchActions.php" method="post">
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

function ncicGetWarrants()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT ".DB_PREFIX."ncic_warrants.*, ".DB_PREFIX."ncicNames.name FROM ".DB_PREFIX."ncic_warrants INNER JOIN ".DB_PREFIX."ncicNames ON ".DB_PREFIX."ncicNames.id=".DB_PREFIX."ncic_warrants.nameId");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
                    <form action="".BASE_URL."/oc-includes/dispatchActions.php" method="post">
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

function ncicGetCitations()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT ".DB_PREFIX."ncic_citations.*, ".DB_PREFIX."ncicNames.name FROM ".DB_PREFIX."ncic_citations INNER JOIN ".DB_PREFIX."ncicNames ON ".DB_PREFIX."ncicNames.id=".DB_PREFIX."ncic_citations.nameId");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
                    <form action="".BASE_URL."/oc-includes/dispatchActions.php" method="post">
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

function ncicGetWarnings()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT ".DB_PREFIX."ncic_warnings.*, ".DB_PREFIX."ncicNames.name FROM ".DB_PREFIX."ncic_warnings INNER JOIN ".DB_PREFIX."ncicNames ON ".DB_PREFIX."ncicNames.id=".DB_PREFIX."ncic_warnings.nameId");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
                    <form action="".BASE_URL."/oc-includes/dispatchActions.php" method="post">
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
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $gender = htmlspecialchars($_POST['gender']);
    $physicalDescription = htmlspecialchars($_POST['physicalDescription']);
    $reasonWanted = htmlspecialchars($_POST['reasonWanted']);
    $lastSeen = htmlspecialchars($_POST['lastSeen']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."bolosPersons (firstName, lastName, gender, physicalDescription, reasonWanted, lastSeen) VALUES (?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($firstName, $lastName, $gender, $physicalDescription, $reasonWanted, $lastSeen));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully created BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function create_vehiclebolo()
{
    $make = htmlspecialchars($_POST['make']);
    $model = htmlspecialchars($_POST['model']);
    $plate = htmlspecialchars($_POST['plate']);
    $primaryColor = htmlspecialchars($_POST['primaryColor']);
    $secondaryColor = htmlspecialchars($_POST['secondaryColor']);
    $reasonWanted = htmlspecialchars($_POST['reasonWanted']);
    $lastSeen = htmlspecialchars($_POST['lastSeen']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."bolosVehicles (make, model, plate, primaryColor, secondaryColor, reasonWanted, lastSeen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($make, $model, $plate, $primaryColor, $secondaryColor, $reasonWanted, $lastSeen));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."bolosPersons WHERE id = ?");
    $result = $stmt->execute(array($pbid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."bolosVehicles WHERE id = ?");
    $result = $stmt->execute(array($vbid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully removed vehicle BOLO</span></div>';
    header("Location: ".BASE_URL."/cad.php");
}

function cadGetPersonBOLOSid()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT ".DB_PREFIX."bolosPersons.* FROM ".DB_PREFIX."bolosPersons WHERE id = ?");
    $resStatus = $stmt->execute(array(htmlspecialchars($_POST['bolos_personid'])));
    $result = $stmt;

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT ".DB_PREFIX."bolosVehicles.* FROM ".DB_PREFIX."bolosVehicles WHERE id = ?");
    $resStatus = $stmt->execute(array(htmlspecialchars($_POST['bolos_vehicleid'])));
    $result = $stmt;

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
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
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."patrolInformation SET `value`=? WHERE `key`='areaOfPatrol'");
    $result = $stmt->execute(array(htmlspecialchars($_POST['aop'])));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $pdo = null;

    header("Location:".BASE_URL."/oc-apps/cad.php");
}

function editPersonBOLOS()
{
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $gender = htmlspecialchars($_POST['gender']);
    $physicalDescription = htmlspecialchars($_POST['physicalDescription']);
    $reasonWanted = htmlspecialchars($_POST['reasonWanted']);
    $lastSeen = htmlspecialchars($_POST['lastSeen']);
    $person_id = htmlspecialchars($_POST['edit_personId']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."bolosPersons SET firstName = ?, lastName = ?, gender = ?, physicalDescription = ?, reasonWanted = ?, lastSeen = ? WHERE id = ?");
    $result = $stmt->execute(array($firstName, $lastName, $gender, $physicalDescription, $reasonWanted, $lastSeen, $physicalDescription));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully updated BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function edit_vehiclebolo()
{
    $make = htmlspecialchars($_POST['make']);
    $model = htmlspecialchars($_POST['model']);
    $plate = htmlspecialchars($_POST['plate']);
    $primaryColor = htmlspecialchars($_POST['primaryColor']);
    $secondaryColor = htmlspecialchars($_POST['secondaryColor']);
    $reasonWanted = htmlspecialchars($_POST['reasonWanted']);
    $lastSeen = htmlspecialchars($_POST['lastSeen']);
    $vehicle_id = htmlspecialchars($_POST['edit_vehicleboloid']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."bolosVehicles SET make = ?, model = ?, plate = ?, primaryColor = ?, secondaryColor = ?, reasonWanted = ?, lastSeen = ? WHERE id = ?");
    $result = $stmt->execute(array($make, $model, $plate, $primaryColor, $secondaryColor, $reasonWanted, $lastSeen, $vehicle_id));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $_SESSION['boloMessage'] = '<div class="alert alert-success"><span>Successfully Updated BOLO</span></div>';

    header("Location:".BASE_URL."/cad.php");
}

function create_arrest()
{
    session_start();
    $userId = htmlspecialchars($_POST['civilian_names']);
    $arrestReason1 = htmlspecialchars($_POST['arrestReason1']);
    $arrestFine1 = htmlspecialchars($_POST['arrestFine1']);
	$arrestReason2 = htmlspecialchars($_POST['arrestReason2']);
	$arrestFine2 = htmlspecialchars($_POST['arrestFine2']);
	$arrestReason3 = htmlspecialchars($_POST['arrestReason3']);
	$arrestFine3 = htmlspecialchars($_POST['arrestFine3']);
	$arrestReason4 = htmlspecialchars($_POST['arrestReason4']);
	$arrestFine4 = htmlspecialchars($_POST['arrestFine4']);
	$arrestReason5 = htmlspecialchars($_POST['arrestReason5']);
	$arrestFine5 = htmlspecialchars($_POST['arrestFine5']);
    $Issuer = $_SESSION['name'];
    $date = date('Y-m-d');

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncicArrests (nameId, arrestReason, arrestFine, Issuer, issuedDate) VALUES (?, ?, ?, ?, ?)");
    $result = $stmt->execute(array($userId, $arrestReason1, $arrestFine1, $Issuer, $date));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

	if ($arrestReason2){
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncicArrests (nameId, arrestReason, arrestFine, Issuer, issuedDate) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute(array($userId, $arrestReason2, $arrestFine2, $Issuer, $date));
    
        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	if ($arrestReason3) {
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncicArrests (nameId, arrestReason, arrestFine, Issuer, issuedDate) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute(array($userId, $arrestReason3, $arrestFine3, $Issuer, $date));
    
        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	if ($arrestReason4) {
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncicArrests (nameId, arrestReason, arrestFine, Issuer, issuedDate) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute(array($userId, $arrestReason4, $arrestFine4, $Issuer, $date));
    
        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
	if ($arrestReason5) {
        $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."ncicArrests (nameId, arrestReason, arrestFine, Issuer, issuedDate) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute(array($userId, $arrestReason5, $arrestFine5, $Issuer, $date));
    
        if (!$result)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
	}
    $_SESSION['arrestMessage'] = '<div class="alert alert-success"><span>Successfully created arrest report</span></div>';

    $pdo = null;
    header("Location:".BASE_URL."/cad.php");
}
?>