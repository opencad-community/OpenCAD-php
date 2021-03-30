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

    require_once('../oc-config.php');
    require_once( ABSPATH . '/oc-functions.php');
    require_once( ABSPATH . '/oc-settings.php');
    require_once( ABSPATH . "/oc-includes/adminActions.php");

    if (empty($_SESSION['logged_in']))
    {
        header('Location: '.BASE_URL);
        die("Not logged in");
    }
    else
    {
      // Do Nothing
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

      <?php include( ABSPATH . "oc-admin/oc-admin-includes/topbarNav.inc.php"); ?>
      <?php include( ABSPATH . "/" .  OCCONTENT . "/themes/". THEME ."/includes/topProfile.inc.php"); ?>
    </header>

<<<<<<< HEAD
    <div class="app-body">
    <main class="main">
      <div class="breadcrumb" />
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
             <i class="fa fa-align-justify"></i> <strong> <?php echo lang_key("ABOUT_ENVIRONMENT"); ?></strong>
=======
                    <?php include (__DIR__ ."/oc-admin-includes/sidebarNav.inc.php"); ?>

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Go to Dashboard"
                            href="<?php echo BASE_URL; ?>/dashboard.php">
                            <span class="fas fa-clipboard-list" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen" onClick="toggleFullScreen()">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Need Help?"
                            href="https://docs.opencad.io/">
                            <span class="fas fa-info-circle" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout"
                            href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>">
                            <span class="fas fa-sign-out-alt" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
>>>>>>> oc-main/canary
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="name"><?php echo lang_key("PHP_VERSION"); ?></label><input type="text" class="form-control" readonly="readonly" placeholder="<?php echo phpversion(); ?>" />
                <?php echo lang_key("PHP_VERSION_notes"); ?>
              </div>
              <div class="form-group">
                <label for="name"><?php echo lang_key("DATABASE_ENGINE"); ?></label>
                <input type="text" class="form-control" readonly="readonly" value="<?php echo getMySQLVersion(); ?>" />
                <?php echo lang_key("DATABASE_ENGINE_notes"); ?>
              </div>
              <div class="form-group">
                <label for="name"><?php echo lang_key("LOADED_PHP_MODULES"); ?></label>
                <input type="text" class="form-control" readonly="readonly" placeholder="<?php getPHPModules(); ?>" />
                <?php echo lang_key("LOADED_PHP_MODULES_notes"); ?>
              </div>
            </div>
<<<<<<< HEAD
            <!-- /.row-->
=======
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>About OpenCAD</h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div style="text-align:center;">
                                        <img src="<?php echo BASE_URL; ?>/images/logo.png" width="239px" height="104px"
                                            alt="The Official OpenCAD project logo, Three tails colors red, blue, and red, swoop down from top above the O in Open and finish just below the C in CAD. Stacked words, Open in a bold red font face, and CAD in a bold blue font face." />
                                        <img src="<?php echo BASE_URL; ?>/images/gplv3-127x51.png" height="128px"
                                            width="251px" />
                                    </div>
                                    <div class="row tile_count">
                                        <h2>About Your Environment</h2>
                                        <div class="input-group">
                                            PHP Version:<input type="text" class="form-control" readonly="readonly"
                                                placeholder="<?php echo phpversion(); ?>" />
                                            <p><em>Note:</em> The active version of PHP.</p>
                                        </div>
                                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                                        <div class="input-group">
                                            Database Engine:<input type="text" class="form-control" readonly="readonly"
                                                placeholder="<?php echo getMySQLVersion(); ?>" />
                                            <p><em>Note:</em> The database engine which is currently deployed on the
                                                server.</p>
                                        </div>
                                    </div>
                                    <!-- ./ row tile_count -->
                                    <div class="row tile_count">
                                        <h2>About Your Application</h2>
                                        <div class="input-group">
                                            OpenCAD Version:<input type="text" class="form-control" readonly="readonly"
                                                placeholder="<?php echo getOpenCADVersion(); ?>" />
                                            <p><em>Note:</em> If the limit of ten (10) requests per one (1) minute the
                                                API key will be blacklisted and support will <em>not</em> remove the
                                                block.</p>
                                        </div>
                                        <div class="input-group">
                                            OpenCAD Build:<input type="text" class="form-control" readonly="readonly"
                                                placeholder="API KEY HERE" />
                                            <p><em>Note:</em> If the limit of ten (10) requests per one (1) minute the
                                                API key will be blacklisted and support will <em>not</em> remove the
                                                block.</p>
                                        </div>
                                        <div class="x_content">
                                            <div class="input-group">
                                                API Key:
                                                <input type="text" class="form-control" readonly="readonly"
                                                    placeholder="<?php echo getApiKey(); ?>" />
                                                <p>
                                                    <em>Note:</em> Used to encrypt cookie 'aljksdz7' and authenticate
                                                    request to the api if the requestor is not logged in.
                                                </p>
                                                <a style="margin-left:10px" class="btn btn-primary"
                                                    href="<?php echo BASE_URL; ?>/actions/generalActions.php?newApiKey=1">Generate</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                                </div>
                                <!-- ./ row tile_count -->
                                <h2>About OpenCAD</h2>
                                <p>OpenCAD is an open source project licensed under GNU GPL v3. The original code and
                                    concept by <a href="https://github.com/ossified"
                                        title="a link to the original developer's GitHub.">Shane Gill</a>. This project
                                    is maintained by Overt Source</p>
                                <!--<h3>Got Feedback?</h3>
                                <p>The OpenCAD team wants to know what you think. Please send us your feedback today!
                                </p>-->
                            </div>
                            <!-- ./ x_content -->
                        </div>
                        <!-- ./ x_panel -->
                    </div>
                    <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
                </div>
                <!-- ./ row -->
>>>>>>> oc-main/canary
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

<<<<<<< HEAD
            <script type="text/javascript"
        src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
    </script>
=======
</body>
>>>>>>> oc-main/canary

</html>