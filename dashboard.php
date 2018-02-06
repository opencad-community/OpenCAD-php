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

include("./oc-config.php");
require("./actions/api.php");
session_start();

if (empty($_SESSION['logged_in']))
{
	header('Location: ./index.php');
    die("Not logged in");
}
    setDispatcher("1");

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
$stateButton = "";
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
            header("Location:".BASE_URL."/oc-admin/admin.php");

        }
        else if ($row[1] == "1")
        {
            $_SESSION['dispatch'] = 'YES';
            header("Location:".BASE_URL."/cad.php");

        }
        else if ($row[1] == "2")
        {
            $_SESSION['ems'] = 'YES';
            header("Location:".BASE_URL."/mdt.php");
        }
            else if ($row[1] == "3")
        {
            $_SESSION['fire'] = 'YES';
            header("Location:".BASE_URL."/mdt.php");
        }
        else if ($row[1] == "4")
        {
            $_SESSION['highway'] = 'YES';
            header("Location:".BASE_URL."/mdt.php");
        }
        else if ($row[1] == "5")
        {
            $_SESSION['police'] = 'YES';
            header("Location:".BASE_URL."/mdt.php");
        }
        else if ($row[1] == "6")
        {
            $_SESSION['sheriff'] = 'YES';
            header("Location:".BASE_URL."/mdt.php");
        }
        else if ($row[1] == "7")
        {
            $_SESSION['civilian'] = 'YES';
            header("Location:".BASE_URL."/civilian.php");
        }

    }
}
else
{

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        if ($row[1] == 0)
        {
            $_SESSION['admin'] = 'YES';
						$adminButton = "<a href=\"".BASE_URL."/oc-admin/admin.php\" class=\"btn btn-primary btn-lg\">Admin</a>";
        }
        if ($row[1] == 1)
        {
            $_SESSION['dispatch'] = 'YES';
            $dispatchButton = "<a href=\"".BASE_URL."/cad.php\" class=\"btn btn-primary btn-lg\">Dispatch</a>";
        }
        if ($row[1] == "2")
        {
            $_SESSION['ems'] = 'YES';
            $emsButton = "<a href=\"".BASE_URL."/mdt.php\" class=\"btn btn-primary btn-lg\">EMS</a>";
        }
        if ($row[1] == "3")
        {
            $_SESSION['fire'] = 'YES';
            $fireButton = "<a href=\"".BASE_URL."/mdt.php\" class=\"btn btn-primary btn-lg\">Fire</a>";
        }
        if ($row[1] == "4")
        {
            $_SESSION['highway'] = 'YES';
            $highwayButton = "<a href=\"".BASE_URL."/mdt.php\" class=\"btn btn-primary btn-lg\">Highway Patrol</a>";
        }
        if ($row[1] == "5")
        {
            $_SESSION['police'] = 'YES';
            $policeButton = "<a href=\"".BASE_URL."/mdt.php\" class=\"btn btn-primary btn-lg\">Police Department</a>";        }
        if ($row[1] == "6")
        {
            $_SESSION['sheriff'] = 'YES';
            $sheriffButton = "<a href=\"".BASE_URL."/mdt.php\" class=\"btn btn-primary btn-lg\">Sheriff's Office</a>";
        }
        if ($row[1] == "9")
        {
            $_SESSION['state'] = 'YES';
            $stateButton = "<a href=\"".BASE_URL."/mdt.php\" class=\"btn btn-primary btn-lg\">State Police</a>";
        }
        if ($row[1] == "7")
        {
            $_SESSION['civillian'] = 'YES';
            $civilianButton = "<a href=\"".BASE_URL."/civilian.php\" class=\"btn btn-primary btn-lg\">Civilian</a>";
        }
    }
}
mysqli_close($link);


?>

<html lang="en">
   <!DOCTYPE html>
   <?php include "./oc-includes/header.inc.php"; ?>
   <body>
      <div id="page-wrapper">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <h1 class="page-header" style="text-align:center;">Select console to launch:</h1>
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
               <?php echo $stateButton;?>
               &nbsp;
               <?php echo $policeButton;?>
               &nbsp;
               <?php echo $fireButton;?>
			   &nbsp;
			   <?php echo $emsButton;?>
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
