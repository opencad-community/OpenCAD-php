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
    require_once('../oc-config.php');
    require_once( ABSPATH . '/oc-functions.php');
    require_once( ABSPATH . '/oc-settings.php');
    require_once( ABSPATH . "/" . OCINC . '/civActions.php');
    require_once( ABSPATH . "/" . OCINC . '/generalActions.php');
    require_once( ABSPATH . "/" . OCINC . '/publicFunctions.php');

    if (empty($_SESSION['logged_in']))
    {
        header('Location: ../index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
    }


    $civName = $civDob = $civAddr = "";



    $good911 = "";
    if(isset($_SESSION['good911']))
    {
        $good911 = $_SESSION['good911'];
        unset($_SESSION['good911']);
    }

    $identityMessage = "";
    if(isset($_SESSION['identityMessage']))
    {
        $identityMessage = $_SESSION['identityMessage'];
        unset($_SESSION['identityMessage']);
    }

    $plateMessage = "";
    if(isset($_SESSION['plateMessage']))
    {
        $plateMessage = $_SESSION['plateMessage'];
        unset($_SESSION['plateMessage']);
    }

    $nameMessage = "";
    if(isset($_SESSION['nameMessage']))
    {
        $nameMessage = $_SESSION['nameMessage'];
        unset($_SESSION['nameMessage']);
    }
    $weaponMessage = "";
    if(isset($_SESSION['weaponMessage']))
    {
        $weaponMessage = $_SESSION['weaponMessage'];
        unset($_SESSION['weaponMessage']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>


<body class="app header-fixed">

    <header class="app-header navbar">

      
      <?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/civNav.inc.php"); ?>
      <?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/topProfile.inc.php"); ?>
      
    </header>

	<div class="app-body">
		<main class="main">
			<div class="breadcrumb" />
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<em class="fa fa-align-justify"></em> <?php echo lang_key("MY_IDENTITIES"); ?>
						</div>
                        <div class="card-body">
							<?php echo $nameMessage, $identityMessage;?>
							<?php ncicGetNames();?>
                        </div>
                        <!-- /.row-->
                    </div>
                </div>
            <!-- /.card-->
            </div>

			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<em class="fa fa-align-justify"></em> <?php echo lang_key("MY_VEHICLES"); ?>
						</div>
              			<div class="card-body">
							<?php echo $plateMessage;?>
							<?php ncicGetPlates();?>
		                </div>
        	        	<!-- /.row-->
						
		            </div>
        	    </div>
            <!-- /.card-->
			</div>

			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<em class="fa fa-align-justify"></em> <?php echo lang_key("MY_WEAPONS"); ?>
						</div>
                    	<div class="card-body">
							<?php echo $weaponMessage;?>
							<?php ncicGetWeapons();?>
		                </div>
        	        	<!-- /.row-->
						
		            </div>
        	    </div>
            <!-- /.card-->
			</div>

        </main>

        </div>
        <?php 
        require_once ( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/footer.inc.php");
        require_once ( ABSPATH . "/" . OCTHEMEMOD  . "/civilian.modals.inc.php");
        require_once ( ABSPATH . OCTHEMEINC ."/scripts.inc.php" );
        ?>
        
	</body>

    <script type="text/javascript" src="<?php echo BASE_URL ."/". OCTHEMES ."/". THEME . "/js/civilian.inc.js";?>"></script>
</html>
