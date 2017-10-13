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

include_once (__DIR__ . '/../actions/adminActions.php');
include_once (__DIR__ . '/../actions/permissions.php');

$hasPermission = checkIfHeadAdmin();

if (!$hasPermission)
{
    die("You don't have permission to be here");
}

// TODO: Verify user has permission to be on this page

if (empty($_SESSION['logged_in']))
{
    header('Location: ../index.php');
    die("Not logged in");
}
else
{
  $name = $_SESSION['name'];
}

require_once(__DIR__ . '/../oc-config.php');
require_once(__DIR__ . '/../oc-functions.php');

$accessMessage = "";
if(isset($_SESSION['accessMessage']))
{
    $accessMessage = $_SESSION['accessMessage'];
    unset($_SESSION['accessMessage']);
}
?>

<!DOCTYPE html>
<html lang="en">
  <?php include "../oc-includes/header.inc.php"; ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="javascript:void(0)" class="site_title"><i class="fa fa-tachometer"></i> <span><?php echo COMMUNITY_NAME;?> Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo get_avatar() ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $name;?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <?php include "oc-admin-includes/sidebarNav.inc.php"; ?>

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Go to Dashboard" href="/dashboard.php">
                <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="/actions/logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo get_avatar() ?>" alt=""><?php echo $name;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="../profile.php">My Profile</a></li>
                    <li><a href="https://github.com/ossified/openCad/issues">Help</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/actions/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>CAD Permission Management</h3>
              </div>
              <!-- ./ title_left -->
            </div>
            <!-- ./ page-title -->

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>CAD Permission Settings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">

                    <table id="permissions" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                            <th>Permission Name</th>
                            <th>Permission Description</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td colspan="2" style="font-weight:bold;">User Management Permissions</td>
                        </tr>
                        <tr>
                          <td>Add Users</td>
                          <td>User/Group can add users to the system</td>
                        </tr>
                        <tr>
                          <td>Edit Users</td>
                          <td>User/Group can edit users in the system</td>
                        </tr>
                        <tr>
                          <td>Suspend Users</td>
                          <td>User/Group can user accounts on the system</td>
                        </tr>
                        <tr>
                          <td>Delete Users</td>
                          <td>User/Group can remove users from the system</td>
                        </tr>
                        <tr>
                          <td>Manage Access Requests</td>
                          <td>User/Group can manage access requests</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
            </div>
            <!-- ./ row -->


          </div>
          <!-- "" -->
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php echo COMMUNITY_NAME;?> CAD System
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php include "../oc-includes/jquery-colsolidated.inc.php"; ?>
  </body>
</html>
