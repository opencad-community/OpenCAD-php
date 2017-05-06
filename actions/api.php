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
    This file handles all actions for admin.php script
*/

$iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
$connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"]."/openCad/".$iniContents['main']['connection_file_location'];

require($connectionsFileLocation);

if (isset($_GET['a'])){
    getActiveCalls();
}
if (isset($_GET['getCalls'])){
    getActiveCalls();
}
if (isset($_GET['getCallDetails'])){
    getCallDetails();
}
if (isset($_GET['getAvailableUnits'])){
    getAvailableUnits();
}
if (isset($_GET['getUnAvailableUnits'])){
    getUnAvailableUnits();
}
if (isset($_POST['changeStatus'])){
    changeStatus();
}
if (isset($_GET['getActiveUnits']))
{
    getActiveUnits();
}
if (isset($_POST['logoutUser']))
{
    logoutUser();
}
if (isset($_POST['setTone']))
{
    setTone();
}
if (isset($_GET['checkTones']))
{
    checkTones();
}
if (isset($_GET['getDispatchers']))
{
    getDispatchers();
}

//Checks to see if there are any active tones. Certain tones will add a session variable
function checkTones()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "SELECT * from tones";

    $result=mysqli_query($link, $sql);

    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        // If the tone is set to active
        if ($row[2] == "1")
        {
            $encode[$row[1]] = "ACTIVE";
        }
        else if ($row[2] == "0")
        {
            $encode[$row[1]] = "INACTIVE";  
        }
    }
    
    mysqli_close($link);
    echo json_encode($encode);
    
}

function setTone()
{
    $tone = $_POST['tone'];
    $action = $_POST['action'];
    
    $status;
    switch ($action)
    {
        case "start":
            $status = '1';
            break;
        case "stop":
            $status = '0';
            break;
    }

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "UPDATE tones SET active = ? WHERE name = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $status, $tone);
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
    
    if ($action == "start")
    {
        echo "SUCCESS START";
    }
    else
    {
        echo "SUCCESS STOP";
    }

}

function logoutUser()
{
    $identifier = $_POST['unit'];

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
    echo "SUCCESS";

}

function changeStatus()
{
    $unit = $_POST['unit'];
    $status = $_POST['status'];
    $statusId;
    $statusDet;
    $onCall = false;

    switch ($status)
    {
        case "statusMeal":
            $statusId = '0';
            $statusDet = '4';
            break;
        case "statusOther":
            $statusId = '0';
            $statusDet = '2';
            break;
        case "statusAvailBusy":
            $statusId = '1';
            $statusDet = '1';
            $onCall = true;
            break;
        case "10-8":
            $statusId = '1';
            $statusDet = '1';
            $onCall = true;
            break;
        case "10-6":
            $statusId = '0';
            $statusDet = '2';
            break;
        case "10-5":
            $statusId = '0';
            $statusDet = '4';
            break;
    }

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

	$sql = "UPDATE active_users SET status = ?, status_detail = ? WHERE identifier = ?";
	
	try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $statusId, $statusDet, $unit);
        $result = mysqli_stmt_execute($stmt);
    
        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    if ($onCall)
    {
        //Figure out what call they're on
        $sql = "SELECT call_id FROM calls_users WHERE identifier = \"$unit\"";

        $result=mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            $callId = $row[0];
        }

        //Get their callsign for the narrative
        $sql = "SELECT callsign FROM active_users WHERE identifier = \"$unit\"";

        $result=mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            $callsign = $row[0];
        }

        //Update the call_notes to say they were cleared
        $narrativeAdd = date("Y-m-d H:i:s").': Unit Cleared: '.$callsign.'<br/>';

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


       //Remove them from the call
       $sql = "DELETE FROM calls_users WHERE identifier = ?";
	
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

	mysqli_close($link);
    echo "SUCCESS";
}

function getDispatchers()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	$sql = "SELECT * from active_users WHERE status = '2'";
	
	$result = mysqli_query($link, $sql);

    echo '
            <table id="dispatchersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Identifier</th>
                </tr>
            </thead>
            <tbody>
        ';

		

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[0].'</td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
	mysqli_close($link);


}
function setUnitActive($dep)
{
    $status;
    switch($dep)
    {
        case "1":
            $status = "2";
            break;
        case "2":
            $status = "1";
            break;
    }

    $sql = "INSERT IGNORE INTO active_users (identifier, callsign, status, status_detail) VALUES (?, ?, ?, '1')";

    $identifier = $_SESSION['identifier'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $identifier, $identifier, $status);
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

function getAvailableUnits()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	$sql = "SELECT * from active_users WHERE status = '1'";
	
	$result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-danger\"><span>No available units</span></div>";
    }
    else
    {

    echo '
            <table id="activeUsers" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Identifier</th>
                <th>Callsign</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
        ';

		
        $counter = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>
                <div class="dropdown"><button class="btn btn-link dropdown-toggle nopadding" type="button" data-toggle="dropdown">Status <span class="caret"></span></button><ul class="dropdown-menu">
                    <li><a id="statusMeal'.$counter.'" class="statusMeal '.$row[0].'" onclick="testFunction(this);">10-5/Meal Break</a></li>
                    <li><a id="statusOther'.$counter.'" class="statusOther '.$row[0].'" onclick="testFunction(this);">10-6/Other</a></li>
                </ul></div>
                
                </td>
                <input name="uid" type="hidden" value='.$row[0].' />
            </tr>
            ';
            $counter++;
        }

        echo '
            </tbody>
            </table>
        ';
    }
	mysqli_close($link);
}

function getUnAvailableUnits()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	$sql = "SELECT * from active_users WHERE status = '0'";
	
	$result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>No unavailable units</span></div>";
    }
    else
    {
        echo '
                <table id="unAvailableUnitsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Identifier</th>
                    <th>Callsign</th>
                    <th>Status</th>
                    <th>Action</th>
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
                    <td>';
                    
                        getIndividualStatus($row[1]);

                    echo '</td>
                    
                    <td><a id="logoutUser" class="nopadding logoutUser '.$row[0].'" onclick="logoutUser(this);" style="color:red; cursor:pointer;">Logout</a>&nbsp;&nbsp;&nbsp;
                    <div class="dropdown"><button class="btn btn-link dropdown-toggle nopadding" style="display: inline-block; vertical-align:top;" type="button" data-toggle="dropdown">Status <span class="caret"></span></button><ul class="dropdown-menu">
                        <li><a id="statusAvail" class="statusAvailBusy '.$row[0].'" onclick="testFunction(this);">10-8/Available</a></li>
                    </ul></div>
                    </td>
                    <input name="uid" type="hidden" value='.$row[0].' />
                </tr>
                ';
            }

            echo '
                </tbody>
                </table>
            ';

      }
	mysqli_close($link);
}

function getIndividualStatus($callsign)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
    
    $sql = "SELECT status_detail FROM active_users WHERE callsign = \"$callsign\"";

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

function getCodesNcic()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }
    
    $query = "SELECT code_id, code_name FROM codes ORDER BY `code_id` ASC";

    $result=mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'">'.$row[0].'/'.$row[1].'</option>';
    }
}

function getActiveUnits()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }
    
    $query = "SELECT callsign FROM active_users WHERE status = '1'";

    $result=mysqli_query($link, $query);

    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode[$row[0]] = $row[0];
    }
    
    echo json_encode($encode);
}

function getActiveCalls()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	$sql = "SELECT * from calls";
	
	$result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo '<div class="alert alert-info"><span>No active calls</span></div>';
    }
    else
    {
        echo '<table id="activeCalls" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Call ID</th>
                <th>Call Type</th>
                <th>Units</th>
                <th>Location</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

		
        $counter = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr id="'.$counter.'">
                <td>'.$row[0].'</td>';

                //Issue #28. Check if $row[1] == bolo. If so, change text color to orange
                if ($row[1] == "BOLO")
                {
                    echo '<td style="color:orange;">'.$row[1].'</td>';
                    echo '<td><!--Leave blank--></td>';
                }
                else
                {
                    echo '<td>'.$row[1].'</td>';
                    echo '
                        <td>';
                            getUnitsOnCall($row[0]);
                        echo '</td>';
                }
                

                echo '<td>'.$row[3].'/'.$row[4].'/'.$row[5].'</td>';

                if (isset($_GET['type']) && $_GET['type'] == "responder")
                {
                    echo' 
                    <td>
                        <button id="'.$row[0].'" class="btn-link" name="call_details_btn" data-toggle="modal" data-target="#callDetails">Details</button>
                    </td>';
                }
                else
                {
                echo' 
                <td>
                    <button id="'.$row[0].'" class="btn-link" style="color: red;" value="'.$row[0].'" onclick="clearCall('.$row[0].')">Clear</button>
                    <button id="'.$row[0].'" class="btn-link" name="call_details_btn" data-toggle="modal" data-target="#callDetails">Details</button>
                    <input id="'.$row[0].'" type="submit" name="assign_unit" data-toggle="modal" data-target="#assign" class="btn-link '.$row[0].'" value="Assign"/>
                    <input name="uid" name="uid" type="hidden" value="'.$row[0].'"/>
                </td>';
                }
                
            echo'
            </tr>
            ';
            $counter++;
        }

        echo '
            </tbody>
            </table>
        ';

    }
	mysqli_close($link);

}

function getUnitsOnCall($callId)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
    
    $sql1 = "SELECT * FROM calls_users WHERE call_id = \"$callId\"";

    $result1=mysqli_query($link, $sql1);
    
    $units = "";
    
    $num_rows = $result1->num_rows;

    if($num_rows == 0)
    {
        $units = '<span style="color: red;">Unassigned</span>';
    }
    else
    {
        while($row1 = mysqli_fetch_array($result1, MYSQLI_BOTH))
        {
            $units = $units.''.$row1[1].' ';   
        }
    }

    
    
    echo $units;

    mysqli_close($link);
}

function getCallDetails()
{
    $callId = $_GET['callId'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
    
    $sql = "SELECT * FROM calls WHERE call_id = \"$callId\"";

    $result=mysqli_query($link, $sql);
    
    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode["call_id"] = $row[0];
        $encode["call_type"] = $row[1];
        $encode["call_street1"] = $row[3];
        $encode["call_street2"] = $row[4];
        $encode["call_street3"] = $row[5];
        $encode["narrative"] = $row[6];
        
    }
    
    echo json_encode($encode);
    mysqli_close($link);
}

function getCivilianNamesOption()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
    
    $sql = "SELECT id, first_name, last_name FROM ncic_names";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo "<option value=".$row[0].">".$row[1]." ".$row[2]."</option>";
    }
}

function getCitations()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
    
    $sql = "SELECT citation_name FROM citations";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo "<option value=".$row[0].">".$row[0]."</option>";
    }
}

?>