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


    if(isset($_SESSION['admin']))
    {
      if ($_SESSION['admin'] == 'YES')
      {
          //Do nothing
      }
    }
    else
    {
      die("You do not have permission to be here. This has been recorded");
    }

require_once(__DIR__ . '/../oc-config.php');
require_once(__DIR__ . '/../oc-functions.php');

    include("../actions/adminActions.php");

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
              <!--<a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>-->
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
                    <li><a href="<?php echo BASE_URL; ?>/profile.php">My Profile</a></li>
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
                <h3>CAD Administration</h3>
              </div>

              <?php /* HIUE SEARCH FUNCTION FOR NOW
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                  <!-- ./ input-group -->
                </div>
                <!-- ./ col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search -->
              </div>
              <!-- ./ title_right -->
              */?>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Statistics at a glance</h2>
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
                      <div class="row tile_count">
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                          <div class="count"><?php echo getUserCount();?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                      </div>
                      <!-- ./ row tile_count -->
                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
            </div>
            <!-- ./ row -->

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Access Requests</h2>
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
                      <?php echo $accessMessage;?>

                      <?php getPendingUsers();?>
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
