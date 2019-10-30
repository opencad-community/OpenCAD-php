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

    session_start();

    require_once(__DIR__ . '/../oc-config.php');
    require_once( ABSPATH . '/oc-functions.php');
    require_once( ABSPATH . "/oc-includes/adminActions.php");

    if (empty($_SESSION['logged_in']))
    {
        header('Location: ../index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
    }


    if ( $_SESSION['admin_privilege'] == 3)
    {
      if ($_SESSION['admin_privilege'] == 'Administrator')
      {
          //Do nothing
      }
    }
    else if ($_SESSION['admin_privilege'] == 2)
    {
      if ($_SESSION['admin_privilege'] == 'Moderator')
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
<?php include("../oc-includes/header.inc.php"); ?>


<body class="app header-fixed">

    <header class="app-header navbar">
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/images/tail.png" width="30" height="25" alt="OpenCAD Logo">
      </a>
      <?php include( ABSPATH . "oc-admin/oc-admin-includes/topbarNav.inc.php"); ?>
      <?php include( ABSPATH . "oc-includes/topProfile.inc.php"); ?>
    </header>

    <div class="app-body">
    <main class="main">
      <div class="breadcrumb" />
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
             <i class="fa fa-align-justify"></i> <strong> <?php echo lang_key("ABOUT_ENVIRONMENT"); ?></strong>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="name"><?php echo lang_key("PHP_VERSION"); ?></label><input type="text" class="form-control" readonly="readonly" placeholder="<?php echo phpversion(); ?>" />
                <?php echo lang_key("PHP_VERSION_notes"); ?>
              </div>
              <div class="form-group">
                <label for="name"><?php echo lang_key("DATABASE_ENGINE"); ?></label>
                <input type="text" class="form-control" readonly="readonly" placeholder="<?php echo getMySQLVersion(); ?>" />
                <?php echo lang_key("DATABASE_ENGINE_notes"); ?>
              </div>
              <div class="form-group">
                <label for="name"><?php echo lang_key("LOADED_PHP_MODULES"); ?></label>
                <input type="text" class="form-control" readonly="readonly" placeholder="<?php print_r(get_loaded_extensions()); ?>" />
                <?php echo lang_key("LOADED_PHP_MODULES_notes"); ?>
              </div>
            </div>
            <!-- /.row-->
            </div>
          </div>
          <!-- /.card-->

			      <div class="card">
            	<div class="card-header">
          			<i class="fa fa-align-justify"></i> <strong><?php echo lang_key("ABOUT_ENVIRONMENT"); ?></strong>
				      </div>
              <div class="card-body">
					      <div class="form-group">
						      <label for="name"><?php echo lang_key("APPLICATION_VERSION"); ?></label><input type="text" class="form-control" readonly="readonly" placeholder="<?php echo number_format($oc_version,2); ?>" />
						      <?php echo lang_key("APPLICATION_VERSION_notes"); ?>
					      </div>
					      <div class="form-group">
						      <label for="name"><?php echo lang_key("DATABASE_VERSION"); ?></label><input type="text" class="form-control" readonly="readonly" placeholder="<?php echo number_format($oc_db_version,2 ); ?>" />
						      <?php echo lang_key("DATABASE_VERSION_notes"); ?>
					      </div>
              </div>
              <!-- /.row-->
            </div>
          </div>
          <!-- /.card-->
    </main>

        </div>
      </div>
        <footer class="app-footer">
          <div>
              <a href="https://opencad.io">OpenCAD</a>
              <span>&copy; 2017 <?php echo date("Y"); ?>.</span>
          </div>
          <div class="ml-auto">

          </div>
        </footer>

    <?php
    include (__DIR__ . "/oc-admin-includes/globalModals.inc.php");
    include (__DIR__ . "/../oc-includes/jquery-colsolidated.inc.php"); ?>
</body>

            <script type="text/javascript"
        src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
    </script>

</html>