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


    if ($_SESSION['state'] = 'YES')
    {
        $stateButton = "<a href=\"".BASE_URL."/".OCAPPS."//mdt.php?dep=state\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">State</a>";
    }
    if ($_SESSION['ems'] = 'YES')
    {
        $emsButton = "<a href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=ems\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">EMS</a>";   
    }
        if ($_SESSION['fire'] = 'YES')
    {
        $fireButton = "<a href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=fire\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Fire</a>";
    }
    if ($_SESSION['highway'] = 'YES')
    {
        $highwayButton = "<a href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=highway\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Highway Patrol</a>";
    }
    if ($_SESSION['police'] = 'YES')
    {
        $policeButton = "<a href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=police\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Police Department</a>";
    }
    if ($_SESSION['sheriff'] = 'YES')
    {
        $sheriffButton = "<a href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=sheriff\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Sheriff's Office</a>";
    }
    if ($_SESSION['dispatch'] = 'YES')
    {
        $dispatchButton = "<a href=\"".BASE_URL."/".OCAPPS."/cad.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Dispatch</a>";
    }
    if ($_SESSION['roadsideAssist'] = 'YES')
    {
        $roadsideAssistButton = "<a href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=roadesideAssist\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Roadside Assistance</a>";
    }
    if ($_SESSION['civilianPrivilege'] = '1')
    {
        $civilianButton = "<a href=\"".BASE_URL."/".OCAPPS."/civilian.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Civilian Services</a>";
    }


    if ($_SESSION['adminPrivilege'] = '3')
    {
        $adminButton = "<a href=\"".BASE_URL."/oc-admin/admin.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Admin</a>";
    }
    if ($_SESSION['adminPrivilege'] == "2")
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
