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

if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$id = $_SESSION['id'];
require_once( "../oc-config.php" );
require_once( ABSPATH . '/oc-functions.php');
require_once( ABSPATH . '/oc-settings.php');
require_once( ABSPATH . "/oc-includes/generalActions.php" );

if (empty($_SESSION['logged_in']))
{
	header('Location:'.ABSPATH.'/index.php');
    die("Not logged in");
}
    setDispatcher("1");


try{
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
} catch(PDOException $ex)
{
    $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
    $_SESSION['error_blob'] = $ex;
    header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
    die();
}

$getDepartments = $pdo->query("SELECT `department_id` from ".DB_PREFIX."user_departments WHERE user_id = \"$id\"");
$getDepartments -> execute();
$Departments = $getDepartments->fetch(PDO::FETCH_ASSOC);
$getAdminPriv = $pdo->query("SELECT `admin_privilege` from ".DB_PREFIX."users WHERE id = \"$id\"");
$getAdminPriv -> execute();
$adminPriv = $getAdminPriv->fetch(PDO::FETCH_ASSOC);

$_SESSION['admin_privilege'] = $adminPriv['admin_privilege'];

$adminButton = "";
$dispatchButton = "";
$highwayButton = "";
$stateButton = "";
$fireButton = "";
$emsButton = "";
$sheriffButton = "";
$policeButton = "";
$civilianButton = "";
$roadsideAssistButton = "";

    while($row = $Departments)
    {
        if ($row[1] == "1")
        {
            $_SESSION['dispatch'] = 'YES';
            $dispatchButton = "<a href=\"".BASE_URL.OCAPPS."/cad.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Dispatch</a>";
        }
        else if ($row[1] == "7")
        {
            $_SESSION['ems'] = 'YES';
						$emsButton = "<a href=\"".BASE_URL.OCAPPS."/mdt.php?dep=ems\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">EMS</a>";
        }
        else if ($row[1] == "6")
        {
            $_SESSION['fire'] = 'YES';
						$fireButton = "<a href=\"".BASE_URL.OCAPPS."/mdt.php?dep=fire\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Fire</a>";
        }
        else if ($row[1] == "3")
        {
            $_SESSION['highway'] = 'YES';
            $highwayButton = "<a href=\"".BASE_URL.OCAPPS."/mdt.php?dep=highway\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Highway Patrol</a>";
        }
        else if ($row[1] == "5")
        {
            $_SESSION['police'] = 'YES';
            $policeButton = "<a href=\"".BASE_URL.OCAPPS."/mdt.php?dep=police\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Police Department</a>";
				}
        else if ($row[1] == "4")
        {
            $_SESSION['sheriff'] = 'YES';
            $sheriffButton = "<a href=\"".BASE_URL.OCAPPS."/mdt.php?dep=sheriff\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Sheriff's Office</a>";
        }
        else if ($row[1] == "2")
        {
            $_SESSION['state'] = 'YES';
            $stateButton = "<a href=\"".BASE_URL.OCAPPS."/mdt.php?dep=state\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">State Police</a>";
        }
        else if ($row[1] == "8")
        {
            $_SESSION['civillian'] = 'YES';
            $civilianButton = "<a href=\"".BASE_URL.OCAPPS."/civilian.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Civilian</a>";
        }
				else if ($row[1] == "9")
				{
						$_SESSION['roadsideAssist'] = 'YES';
						$roadsideAssistButton = "<a href=\"".BASE_URL.OCAPPS."/mdt.php?dep=roadsideAssist\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Roadside Assistance</a>";
				}
    }

    if ($_SESSION['admin_privilege'] == "3")
    {
        $adminButton = "<a href=\"".BASE_URL."/oc-admin/admin.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Admin</a>";
    }
        if ($_SESSION['admin_privilege'] == "2")
    {
        $adminButton = "<a href=\"".BASE_URL."/oc-admin/admin.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Moderator</a>";
    }




?>

<html lang="en">
   <!DOCTYPE html>
   <?php include_once(ABSPATH . "oc-includes/header.inc.php"); ?>
   <body id="body">
      <div id="page-wrapper">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <h1 class="page-header animate fadeInLeft delay2" style="text-align:center;">Hello! What would you like to do today?</h1>
               </div>
               <!-- ./ col-lg-12 -->
            </div>
            <!-- ./ row -->
            </div class="row">
            <div class="col-lg-12">
							&nbsp;
							<div id="buttongroup">
								<?php echo $adminButton;?>
							</div>
								<div id="buttongroup">
									<?php echo $dispatchButton;?>
								</div>
								&nbsp;
								<div id="buttongroup">
									<?php echo $civilianButton; ?>
									<?php echo $roadsideAssistButton; ?>
								</div>
								&nbsp;
								<div id="buttongroup">
									<?php echo $fireButton;?>
									<?php echo $emsButton;?>
								</div>
								&nbsp;
								<div id="buttongroup">
									<?php echo $sheriffButton;?>
									<?php echo $highwayButton;?>
									<?php echo $stateButton;?>
									<?php echo $policeButton;?>
								</div>
								&nbsp;
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
