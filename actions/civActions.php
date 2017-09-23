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


require_once(__DIR__ . '/../oc-config.php');

if (isset($_GET['getCivilianDetails']))
{
    getCivilianDetails();
}

if (isset($_POST['requestIdentity']))
{
    requestIdentity();
}

//Function to request an identity
function requestIdentity()
{
    session_start();

    var_dump($_POST);

    // Need to handle rank/permissions here

    // First, check to see if an identity with that name already exists
    $fullName = $_POST['civNameReq'];
    $firstName = explode(" ", $fullName)[0];
    $lastName = explode(" ", $fullName)[1];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = 'SELECT first_name, last_name FROM ncic_names WHERE first_name = "'.$firstName.'" AND last_name = "'.$lastName.'"';

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if(!$num_rows == 0)
    {
        $_SESSION['identityMessage'] = '<div class="alert alert-danger"><span>Name already exists</span></div>';

        sleep(1);
        header("Location:../civilian.php");
        die();
    }

    // If name doesn't exist, add it to ncic_requests table
    //Who submitted it
    $submittedByName = $_SESSION['name'];
    $submitttedById = $_SESSION['id'];
    //Submission Data
    $firstName;
    $lastName;
    $dob = $_POST['civDobReq'];
    $address = $_POST['civAddressReq'];
    $sex = $_POST['civSexReq'];
    $race = $_POST['civRaceReq'];
    $hair = $_POST['civHairReq'];
    $build = $_POST['civBuildReq'];
    $biography = $_POST['civBioReq'];
    $veh_plate = $_POST['civPlateReq'];
    $veh_make = $_POST['civMakeReq'];
    $veh_model = $_POST['civModelReq'];
    $veh_color = $_POST['civVehColReq'];

    $sql = "INSERT INTO identity_requests (submittedByName, submittedById, first_name, last_name, dob, address, sex, race, hair_color, build, biography, veh_plate, veh_make, veh_model, veh_color)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "sisssssssssssss", $submittedByName, $submitttedById, $firstName, $lastName, $dob, $address, $sex, $race, $hair, $build, $biography, $veh_plate, $veh_make, $veh_model, $veh_color );
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    $_SESSION['identityMessage'] = '<div class="alert alert-success"><span>Successfully submitted identity request</span></div>';

    sleep(1);
    header("Location:../civilian.php");
    die();

}

function getIdentities()
{
    //session_start();
    $uid = $_SESSION['id'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = 'SELECT civilian_names.*, ncic_names.first_name, ncic_names.last_name, ncic_plates.veh_plate, ncic_plates.veh_make, ncic_plates.veh_model, ncic_plates.veh_color FROM `ncic_names` LEFT JOIN `civilian_names` ON `civilian_names`.`names_id` = `ncic_names`.`id` LEFT JOIN `ncic_plates` ON `ncic_plates`.`name_id` = `ncic_names`.`id` WHERE civilian_names.user_id = "'.$uid.'"';

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>You currently have no identities</span></div>";
    }
    else
    {
        echo '
            <table id="identities" class="table table-striped">
            <thead>
                <tr>
                <th>Name</th>
                <th>Assigned Vehicle Plate</th>
                <th>Vehicle Make, Model, and Color</th>
                <th>Assigned Firearm</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[2].' '.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[7].', '.$row[5].' '.$row[6].'</td>
                <td>N/A</td>
                <td>
                    <form action="../actions/civActions.php" method="get">
                    <button name="civilianDetails" type="button" data-toggle="modal" id="'.$row[1].'" data-target="#civilianDetailsModal" class="btn btn-xs btn-link">Details</button>
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

function getCivilianDetails()
{
    $name_id = $_GET['name_id'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = 'SELECT ncic_names.*, ncic_plates.* FROM `ncic_names` LEFT JOIN `ncic_plates` ON `ncic_plates`.`name_id` = `ncic_names`.`id` WHERE ncic_names.id = "'.$name_id.'"';

    $result=mysqli_query($link, $query);

    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode["nameId"] = $row[0];
        $encode["name"] = $row[1].' '.$row[2];
        $encode["dob"] = $row[3];
        $encode["address"] = $row[4];
        $encode["sex"] = $row[5];
        $encode["race"] = $row[6];
        $encode["hair_color"] = $row[8];
        $encode["build"] = $row[9];
        $encode["veh_plate"] = $row[12];
        $encode["veh_make"] = $row[13];
        $encode["veh_model"] = $row[14];
        $encode["veh_color"] = $row[15];
        $encode["veh_reg_state"] = $row[18];

    }

    echo json_encode($encode);
    mysqli_close($link);
}


?>
