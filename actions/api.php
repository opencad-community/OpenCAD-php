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
                <!--<td>'.$row[3].'</td>-->
                <td>10-5/Meal Break</td>
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
                <td>'.$row[2].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[3].'</td>
                <td>
                    <form name="clear_call_form" class="clear_call_form" id="cidForm'.$counter.'">
                        <input id="cidBtn'.$counter.'" type="submit" name="clear_call" class="btn-link" style="color: red;" value="Clear"/>
                        <input id="cid'.$counter.'" name="cid" type="hidden" value="'.$row[0].'"/>
                    </form>
                    <form name="call_details_form" class="call_details_form">
                        <input type="submit" name="call_details" class="btn-link" value="Details" />
                        <input name="uid" name="uid" type="hidden" value="'.$row[0].'"/>
                    </form>
                    <form name="assign_unit_form" class="assign_unit_form">
                        <input type="submit" name="assign_unit" class="btn-link" value="Assign"/>
                        <input name="uid" name="uid" type="hidden" value="'.$row[0].'"/>
                    </form>    
                </td>
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

?>