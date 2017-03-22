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


function getDispatchers()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	$sql = "SELECT * from active_users WHERE status = '2'";
	
	$result = mysqli_query($link, $sql);

    echo '
            <table id="dispatchers" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Identifier</th>
                <th>Callsign</th>
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
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
	mysqli_close($link);


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
        echo "<div class=\"alert alert-danger\"><span>No active units</span></div>";
    }

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

		

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td><a href="#" style="color:red;">Logout</a>&nbsp;&nbsp;&nbsp;<a href="#"">Status</a></td>
                <input name="uid" type="hidden" value='.$row[0].' />
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
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
        echo "<div class=\"alert alert-danger\"><span>No unavailable units</span></div>";
    }
    else
    {
        echo '
                <table id="activeUsers" class="table table-striped table-bordered">
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
                    <td><a href="#" style="color:red;">Logout</a>&nbsp;&nbsp;&nbsp;<a href="#"">Status</a></td>
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

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
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
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>';

                    getUnitsOnCall($row[0]);

                echo '</td>';

                echo '<td>'.$row[3].'/'.$row[4].'/'.$row[5].'</td>';

                if (isset($_GET['responder']))
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
                    <button id="'.$row[0].'" class="btn-link" style="color: red;" value="'.$row[0].'" onclick="test('.$row[0].')">Clear</button>
                    <button id="'.$row[0].'" class="btn-link" name="call_details_btn" data-toggle="modal" data-target="#callDetails">Details</button>
                    <input name="uid" name="uid" type="hidden" value="'.$row[0].'"/>
                    <input type="submit" name="assign_unit" class="btn-link" value="Assign"/>
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

    while($row1 = mysqli_fetch_array($result1, MYSQLI_BOTH))
    {
        $units = $units.''.$row1[1].' ';   
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

?>