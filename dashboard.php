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

require("./oc-config.php");
require("./oc-functions.php");
session_start();

if (empty($_SESSION['logged_in']))
{
	header('Location: ./index.php');
    die("Not logged in");
}

/*
    The purpose of this page is to simply determine if the user has multiple roles.
    If they do, provide them the option to go where they want to go.
    Else, redirect to the only place they can go.
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$link) {
    die('Could not connect: ' .mysql_error());
}

$id = $_SESSION['id'];
$sql = "SELECT * from user_departments WHERE user_id = \"$id\"";

$result=mysqli_query($link, $sql);

$adminButton = "";
$dispatchButton = "";
$highwayButton = "";
$fireButton = "";
$emsButton = "";
$sheriffButton = "";
$policeButton = "";
$civilianButton = "";

$num_rows = $result->num_rows;
// This loop will auto redirect the user if they only have one option
// TODO: Add the rest of the headers
if($num_rows < 2)
{
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        if ($row[1] == "0")
        {
            $_SESSION['admin'] = 'YES';
            header("Location:./oc-admin/admin.php");

        }
        else if ($row[1] == "1")
        {
            $_SESSION['dispatch'] = 'YES';
            header("Location:./cad.php");

        }
        else if ($row[1] == "2")
        {
            $_SESSION['ems'] = 'YES';
            header("Location:./mdt.php");
        }
            else if ($row[1] == "3")
        {
            $_SESSION['fire'] = 'YES';
            header("Location:./mdt.php");
        }
        else if ($row[1] == "4")
        {
            $_SESSION['highway'] = 'YES';
            header("Location:./mdt.php");
        }
        else if ($row[1] == "5")
        {
            $_SESSION['police'] = 'YES';
            header("Location:./mdt.php");
        }
        else if ($row[1] == "6")
        {
            $_SESSION['sheriff'] = 'YES';
            header("Location:./mdt.php");
        }
        else if ($row[1] == "7")
        {
            $_SESSION['civilian'] = 'YES';
            header("Location:./civillian.php");
        }

    }
}
else
{

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        if ($row[1] == 0)
        {
            $adminButton = "<a href=\"./oc-admin/admin.php\" class=\"btn btn-primary btn-lg\">Administration</a>";
            $_SESSION['admin'] = 'YES';
        }
        if ($row[1] == 1)
        {
            $_SESSION['dispatch'] = 'YES';
            $dispatchButton = "<a href=\"./cad.php\" class=\"btn btn-primary btn-lg\">Dispatch</a>";
        }
        if ($row[1] == "2")
        {
            $_SESSION['ems'] = 'YES';
            $emsButton = "<a href=\"./mdt.php\" class=\"btn btn-primary btn-lg\">EMS</a>";
        }
        if ($row[1] == "3")
        {
            $_SESSION['fire'] = 'YES';
            $fireButton = "<a href=\"./mdt.php?fire=true\" class=\"btn btn-primary btn-lg\">Fire Department</a>";
        }
        if ($row[1] == "4")
        {
            $_SESSION['highway'] = 'YES';
            $highwayButton = "<a href=\"./mdt.php\" class=\"btn btn-primary btn-lg\">Highway Patrol</a>";
        }
        if ($row[1] == "5")
        {
            $_SESSION['police'] = 'YES';
            $policeButton = "<a href=\"./mdt.php\" class=\"btn btn-primary btn-lg\">Police Department</a>";
        }
        if ($row[1] == "6")
        {
            $_SESSION['sheriff'] = 'YES';
            $sheriffButton = "<a href=\"./mdt.php\" class=\"btn btn-primary btn-lg\">Sheriff's Office</a>";
        }
        if ($row[1] == "7")
        {
            $_SESSION['civillian'] = 'YES';
            $civilianButton = "<a href=\"./civilian.php\" class=\"btn btn-primary btn-lg\">Civilian</a>";
        }
    }
}
mysqli_close($link);


?>

<html lang="en">
<!DOCTYPE html>
<head>
    <!-- CSS -->
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <style>
    #cadWelcome {
    height:20px;
    width:50px;
    margin: 50%px 50%px;
    position:relative;
    top:90%;
    left:45%;
    text-align:center;
    }
    </style>
    <title>CAD/MDT Launcher</title>
    <link rel="icon" href="./images/favicon.ico" />
</head>
<body>
   <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align:center;">Select console to laucnh:</h1>
                </div>
                <!-- ./ col-lg-12 -->
            </div>
            <!-- ./ row -->
            </div class="row">
                <div class="col-lg-12" id="cadWelcome">
                    <?php echo $adminButton;?><br/><br/>

                    <?php echo $dispatchButton;?>
                    &nbsp;
                    <?php echo $sheriffButton;?>
                    &nbsp;
                    <?php echo $highwayButton;?>
                    &nbsp;
                    &nbsp;
                    <?php echo $policeButton;?>
                    &nbsp;
                    <?php echo $fireButton;?>
                    &nbsp;
                    <?php echo $civilianButton;?>
                </div>
                <!-- ./ col-lg-12 -->
            </div>
            <!-- ./ row -->
        </div>
        <!-- ./ container-fluid -->
    </div>
    <!-- ./ page-wrapper -->
</body>
</html>
