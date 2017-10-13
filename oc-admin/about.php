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
                <h3>About OpenCAD</h3>
              </div>
           </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div style="text-align:center;">
                      <img src="<?php echo BASE_URL; ?>/images/logo.png" width="239px" height="104px" alt="The Official OpenCAD project logo, Three tails colors red, blue, and red, swoop down from top above the O in Open and finish just below the C in CAD. Stacked words, Open in a bold red font face, and CAD in a bold blue font face."/> <img src="<?php echo BASE_URL; ?>/images/gplv3-127x51.png" height="128px" width="251px"  />
                    </div>
                      <div class="row tile_count">
                          <h2>About Your Application</h2>
                          <div class="input-group">
                             OpenCAD Version:<input type="text" class="form-control" readonly="readonly" placeholder="API KEY HERE" />
                             <p><em>Note:</em> If the limit of ten (10) requests per one (1) minute the API key will be blacklisted and support will <em>not</em> remove the block.</p>
                          </div>
                          <div class="input-group">
                             OpenCAD Build:<input type="text" class="form-control" readonly="readonly" placeholder="API KEY HERE" />
                             <p><em>Note:</em> If the limit of ten (10) requests per one (1) minute the API key will be blacklisted and support will <em>not</em> remove the block.</p>
                          </div>
                          <div class="x_content">
                             <div class="input-group">
                                API Key:<input type="text" class="form-control" readonly="readonly" placeholder="API KEY HERE" />
                                <p><em>Note:</em> If the limit of ten (10) requests per one (1) minute the API key will be blacklisted and support will <em>not</em> remove the block.</p>
                             </div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                      </div>
                      <!-- ./ row tile_count -->
                      <h2>About OpenCAD</h2>
                      <p>OpenCAD is an opensource project licensed under GNU GPL v3. The original code and concept by <a href="https://github.com/ossified" title="a link to the original developer's GitHub.">Shane Gill</a>. This project is maintained Stormlight Tech.</p>
                      <h3>Project Maintainers</h3>
                        <ul>
                          <li><em><a href="https://keybase.io/jrharper">Justin Harper</a></em> — <i>Co-Revitalizer, Project Manager</i></li>
                          <li><em><a href="https://keybase.io/phillf">Phill Fernandes</a></em> — <i>Co-Revitalizer, Developer</i></li>
                        </ul>
                      <h3>Project Staff</h3>
                      <ul>
                        <li><em><a href="https://keybase.io/murfasa">Murfasa Curry</a></em> — <i>Documentation Manager, Developer</i></li>
                        <li><em>Justin Farmer</em> — <i>Test Engineer</i></li>
                        <li><em><a href="https://keybase.io/Cambridgeport90">Katherine Moss</a></em> — <i>Accessibility Manager, Developer</i></li>
                        <li><em><a href="https://keybase.io/termanator1128">Brennen Stapleton</a></em> — <i>Co-Revitalizer, Developer</i></li>
                      </ul>
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
