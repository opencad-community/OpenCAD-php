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


    if ( $_SESSION['admin_privilege'] == 2)
    {
      if ($_SESSION['admin_privilege'] == 'Administrator')
      {
          //Do nothing
      }
    }
    else if ($_SESSION['admin_privilege'] == 1)
    {
      if ($_SESSION['admin_privilege'] == 'Moderator')
      {
          // Do Nothing
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
              <a href="javascript:void(0)" class="site_title"><i class="fas fa-lock"></i> <span>Administrator</span></a>
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
              <a data-toggle="tooltip" data-placement="top" title="Go to Dashboard" href="<?php echo BASE_URL; ?>/dashboard.php">
              <span class="fas fa-clipboard-list" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen" onClick="toggleFullScreen()">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>">
              <span class="fas fa-sign-out-alt" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Need Help?" href="https://guides.opencad.io/">
              <span class="fas fa-info-circle" aria-hidden="true"></span>
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
                <a id="menu_toggle"><i class="fas fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo get_avatar() ?>" alt=""><?php echo $name;?>
                    <span class="fas fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo BASE_URL; ?>/profile.php"><i class="fas fa-user pull-right"></i>My Profile</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/actions/logout.php"><i class="fas fa-sign-out-alt pull-right"></i> Log Out</a></li>
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
                        <h2>About Your Environment</h2>
                        <div class="input-group">
                           PHP Version:<input type="text" class="form-control" readonly="readonly" placeholder="<?php echo phpversion(); ?>" />
                           <p><em>Note:</em> The active version of PHP.</p>
                        </div>
                      <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                        <div class="input-group">
                           PHP Version:<input type="text" class="form-control" readonly="readonly" placeholder="<?php echo getMySQLVersion(); ?>" />
                           <p><em>Note:</em> The active version of MySQL.</p>
                        </div>
                    </div>
                    <!-- ./ row tile_count -->
                      <div class="row tile_count">
                          <h2>About Your Application</h2>
                          <div class="input-group">
                             OpenCAD Version:<input type="text" class="form-control" readonly="readonly" placeholder="<?php echo getOpenCADVersion(); ?>" />
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
                      <h3>Got Feedback?</h3>
                      <p>The OpenCAD team wants to know what you think. Please send us your feedback today!</p>
                      <a href="#" id="getFeedbackJIRA">Send Feedback</a>
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

    <script type="text/javascript" src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=296607a1"></script>

        <script type="text/javascript">window.ATL_JQ_PAGE_PROPS =  {
    	"triggerFunction": function(showCollectorDialog) {
    		//Requires that jQuery is available!
    		jQuery("#getFeedbackJIRA").click(function(e) {
    			e.preventDefault();
    			showCollectorDialog();
    		});
    	}};</script>
  </body>
</html>
