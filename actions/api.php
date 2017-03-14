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
    
}

function getUnAvailableUnits()
{
    
}

?>