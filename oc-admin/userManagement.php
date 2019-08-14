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
    require_once(__DIR__ . '/../oc-functions.php');
    include(__DIR__."/../oc-includes/adminActions.php");

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
<?php include "../oc-includes/header.inc.php"; ?>


<body class="app header-fixed">

    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/images/tail.png" width="30" height="25" alt="OpenCAD Logo">
      </a>

      <?php include "oc-admin-includes/sidebarNav.inc.php"; ?>

      <ul class="nav navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo get_avatar() ?>" alt="..." class="img-avatar">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Account</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-bell-o"></i> Updates
              <span class="badge badge-info">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-envelope-o"></i> Messages
              <span class="badge badge-success">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-tasks"></i> Tasks
              <span class="badge badge-danger">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-comments"></i> Comments
              <span class="badge badge-warning">42</span>
            </a>
            <div class="dropdown-header text-center">
              <strong>Settings</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-user"></i> Profile</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-wrench"></i> Settings</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-usd"></i> Payments
              <span class="badge badge-dark">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-file"></i> Projects
              <span class="badge badge-primary">42</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-shield"></i> Lock Account</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-lock"></i> Logout</a>
          </div>
        </li>
      </ul>
    </header>

      <div class="app-body">
        <main class="main">
        <div class="breadcrumb" />
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("1");?></div>
                    <div><?php echo getGroupName("1");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <button class="btn btn-transparent p-0 float-right" type="button">
                      <i class="icon-location-pin"></i>
                    </button>
                    <div class="text-value"><?php echo getGroupCount("2");?></div>
                    <div><?php echo getGroupName("2");?></div>
                    <br />
                  </div>
                </div>
                <br />
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("3");?></div>
                    <div><?php echo getGroupName("3");?></div>
                  </div>
                  <br />
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("4");?></div>
                    <div><?php echo getGroupName("4");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
            <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("5");?></div>
                    <div><?php echo getGroupName("5");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="row align-self-center">
            <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("5");?></div>
                    <div><?php echo getGroupName("5");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("6");?></div>
                    <div><?php echo getGroupName("6");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("7");?></div>
                    <div><?php echo getGroupName("7");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Striped Table
                </div>
                <div class="card-body">
                    <?php echo $accessMessage;?>
                    <?php getUsers();?>
                </div>
                <!-- /.row-->

              </div>

            </div>
            <!-- /.card-->
        </main>

        </div>

        <footer class="app-footer">
        <div>
            <a href="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/images/tail.png">CoreUI Pro</a>
            <span>&copy; 2018 creativeLabs.</span>
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