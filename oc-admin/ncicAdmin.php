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
	require_once( ABSPATH ."/oc-includes/adminActions.php");
	require_once( ABSPATH . "/oc-includes/ncicAdminActions.php");

    if (empty($_SESSION['logged_in']))
    {
        header('Location: ../index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
    }


    if ( $_SESSION['adminPrivilege'] == 3)
    {
      if ($_SESSION['adminPrivilege'] == 'Administrator')
      {
          //Do nothing
      }
    }
    else if ($_SESSION['adminPrivilege'] == 2)
    {
      if ($_SESSION['adminPrivilege'] == 'Moderator')
      {
          // Do Nothing
      }
    }
    else
    {
        permissionDenied();
    }

    $accessMessage = "";
    if(isset($_SESSION['accessMessage']))
    {
        $accessMessage = $_SESSION['accessMessage'];
        unset($_SESSION['accessMessage']);
    }
    $adminMessage = "";
    if(isset($_SESSION['adminMessage']))
    {
        $adminMessage = $_SESSION['adminMessage'];
        unset($_SESSION['adminMessage']);
    }

    $successMessage = "";
    if(isset($_SESSION['successMessage']))
    {
        $successMessage = $_SESSION['successMessage'];
        unset($_SESSION['successMessage']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>


<body class="app header-fixed">

    <header class="app-header navbar">

      <?php require_once ( ABSPATH . OCTHEMEINC ."/admin/topbarNav.inc.php" ); ?>
      <?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/topProfile.inc.php"); ?>
    </header>

      <div class="app-body">
        <main class="main">
        <div class="breadcrumb" />
        <div class="container-fluid">
          <div class="animated fadeIn">
			<div class="card">
				<div class="card-header">
				<em class="fa fa-align-justify"></em> <?php echo lang_key("NCIC_NAMES_DB"); ?></div>
				<div class="card-body">
					<?php echo $nameMessage;?>
					<?php ncicGetNames();?>
				</div>
				<!-- /.row-->
			</div>
			<!-- /.card-->

			<div class="card">
				<div class="card-header">
				<em class="fa fa-align-justify"></em> <?php echo lang_key("NCIC_VEHICLES_DB"); ?></div>
				<div class="card-body">
					<?php echo $plateMessage;?>
					<?php ncicGetPlates();?>
				</div>
				<!-- /.row-->
			</div>
			<!-- /.card-->

			<div class="card">
				<div class="card-header">
				<em class="fa fa-align-justify"></em> <?php echo lang_key("NCIC_WEAPONS_DB"); ?></div>
				<div class="card-body">
					<?php echo $weaponMessage;?>
					<?php ncicGetWeapons();?>
				</div>
				<!-- /.row-->
			</div>
			<!-- /.card-->

			<div class="card">
				<div class="card-header">
				<em class="fa fa-align-justify"></em> <?php echo lang_key("NCIC_WARNINGS_DB"); ?></div>
				<div class="card-body">
					<?php echo $warningMessage;?>
					<?php ncicGetWarnings();?>
				</div>
				<!-- /.row-->
			</div>
			<!-- /.card-->

			<div class="card">
				<div class="card-header">
				<em class="fa fa-align-justify"></em> <?php echo lang_key("NCIC_WARRANTS_DB"); ?></div>
				<div class="card-body">
					<?php echo $warrantMessage;?>
					<?php ncicGetWarrants();?>
				</div>
				<!-- /.row-->
			</div>
			<!-- /.card-->

			<div class="card">
				<div class="card-header">
				<em class="fa fa-align-justify"></em> <?php echo lang_key("ncicArrests_DB"); ?></div>
				<div class="card-body">
					<?php echo $arrestMessage;?>
					<?php ncicGetArrests();?>
				</div>
				<!-- /.row-->
			</div>
			<!-- /.card-->

    </main>

        </div>
      </div>
			<?php require_once ( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/footer.inc.php"); ?>

    <?php
    include (__DIR__ . "/" . ABSPATH . OCTHEMEINC ."/admin/topbarNav.inc.php" );
    require_once( ABSPATH . OCTHEMEINC ."/scripts.inc.php" );  ?>

        <script>
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
    </script>
    <script>
    $(document).ready(function() {

        $('#pendingUsers').DataTable({
            paging: false,
            searching: false
        });

    });
    </script>
</body>

</html>