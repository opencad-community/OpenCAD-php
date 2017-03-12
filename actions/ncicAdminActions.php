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

require_once($connectionsFileLocation);

/* Handle POST requests */
if (isset($_POST['create_citation'])){ 
    create_citation();
}

function ncicGetNames()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT * FROM ncic_names";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are currently no names in the NCIC Database</span></div>";
    }
    else
    {
        echo '
            <table id="ncic_names" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Address</th>
                <th>Sex</th>
                <th>Race</th>
                <th>DL Status</th>
                <th>Hair Color</th>
                <th>Build</th>
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
                <td>'.$row[8].'</td>
                <td>'.$row[9].'</td>
                <td>
                    <form action="../actions/ncicAdminActions.php" method="post">
                    <input name="approveUser" type="submit" class="btn btn-xs btn-link" value="Edit" disabled />
                    <input name="deleteName" type="submit" class="btn btn-xs btn-link" value="Delete" disabled/>
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

function ncic_warrants()
{
   $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_names.first_name, ncic_names.last_name, ncic_warrants.id, ncic_warrants.issued_date, ncic_warrants.expiration_date, ncic_warrants.warrant_name, ncic_warrants.issuing_agency, ncic_warrants.status FROM ncic_warrants INNER JOIN ncic_names ON ncic_warrants.name_id=ncic_names.id";

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
                <td>'.$row[7].'</td>
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[6].'</td>
                <td>
                    <form action="../actions/ncicAdminActions.php" method="post">
                    <input name="approveUser" type="submit" class="btn btn-xs btn-link" value="Edit" disabled />
                    ';
                        if ($row[7] == "Active")
                        {
                            echo '<input name="serveWarrant" type="submit" class="btn btn-xs btn-link" value="Serve" disabled/>';
                        }
                        else
                        {
                            //Do Nothing
                        }
                    echo '
                    <input name="deleteWarrant" type="submit" class="btn btn-xs btn-link" value="Delete" disabled />
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

function ncic_citations()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT ncic_names.first_name, ncic_names.last_name, ncic_citations.id, ncic_citations.citation_name, ncic_citations.issued_date, ncic_citations.issued_by FROM ncic_citations INNER JOIN ncic_names ON ncic_citations.name_id=ncic_names.id";

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
                    <form action="../actions/ncicAdminActions.php" method="post">
                    <input name="approveUser" type="submit" class="btn btn-xs btn-link" value="Edit" disabled />
                    <input name="deleteWarrant" type="submit" class="btn btn-xs btn-link" value="Delete" disabled/>
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

function getCivilianNames()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}
	
	$sql = "SELECT ncic_names.id, ncic_names.first_name, ncic_names.last_name FROM ncic_names";

	$result=mysqli_query($link, $sql);
	
	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		echo "<option value=\"$row[0]\">$row[1] $row[2]</option>";
	}
	mysqli_close($link);
}

function create_citation()
{
    $userId = $_POST['civilian_names'];
    $citation_name = $_POST['citation_name'];
    session_start();
    $issued_by = $_SESSION['name'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $sql = "INSERT INTO ncic_citations (name_id, citation_name, issued_by) VALUES (?, ?, ?)";
	
    
	try {
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "iss", $userId, $citation_name, $issued_by);
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

    $_SESSION['citationMessage'] = '<div class="alert alert-success"><span>Successfully created citation</span></div>';

    header("Location:../administration/ncicAdmin.php");
}


?>