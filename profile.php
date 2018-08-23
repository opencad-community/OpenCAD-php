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


require("./oc-config.php");

include("./actions/profileActions.php");

    session_start();

    // TODO: Verify user has permission to be on this page

    if (empty($_SESSION['logged_in']))
    {
        header('Location: ./index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
    }

    $profileUpdate = "";
    if (isset($_SESSION['profileUpdate']))
    {
        $profileUpdate = $_SESSION['profileUpdate'];
        unset($_SESSION['profileUpdate']);
    }


    if (isset($_GET['changePassword']))
    {
        $changePassword = '<div class="alert alert-success"><span>Password successfully updated.</span></div>';
        unset($_SESSION['changePassword']);
    }

?>

<!DOCTYPE html>
<html lang="en">
	<?php include "./oc-includes/header.inc.php"; ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="javascript:void(0)" class="site_title"><i class="fas fa-user"></i> <span><?php echo $name;?></span></a>
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

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li class="active"><a><i class="fas fa-home"></i> Home</span></a>
                    <ul class="nav child_menu" style="display: block;">
                      <li class="current-page"><a href="javascript:void(0)"><i class="fas fa-user"></i> My Profile</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <!-- ./ menu_section -->
            </div>
            <!-- /sidebar menu -->

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
                    <li><a href="<?php echo BASE_URL; ?>/profile.php"><i class="fas fa-user pull-right"></i> My Profile</a></li>
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
                <h3><?php echo $name; ?>'s Profile</h3>
              </div>
              <!-- ./ title_left -->
            </div>
            <!-- ./ page-title -->

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>My Information</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                  <?php echo $profileUpdate, $changePassword;?>
                  <form action="<?php echo BASE_URL; ?>/actions/profileActions.php" method="post" class="form-horizontal">
                  <fieldset>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-10">
                            <input name="name" class="form-control" type="text" maxlength="255" value="<?php echo $name;?>" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?>>
                        </div>
                        <!-- ./ col-sm-10 -->
                    </div>
                    <!-- ./ form-group -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email:</label>
                        <div class="col-sm-10">
                            <input name="email" class="form-control" type="email" maxlength="255" value="<?php echo $_SESSION['email'];?>" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?>>
                            <span class="muted">Note: Your email is how you login, so make sure it's valid!</span>
                        </div>
                        <!-- ./ col-sm-10 -->
                    </div>
                    <!-- ./ form-group -->
                    <?php if ( DEMO_MODE == false ) {?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password:</label>
                        <div class="col-sm-10">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#changePassword" ?>Change Password</a>
                        </div>
                        <!-- ./ col-sm-10 -->
                    </div>
                  <?php } else {} ?>
                    <!-- ./ form-group -->
                    <!-- ./ form-group -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Identifier:</label>
                        <div class="col-sm-10">
                            <input name="identifier" class="form-control" type="text" maxlength="255" value="<?php echo $_SESSION['identifier'];?>" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?>>
                        </div>
                        <!-- ./ col-sm-10 -->
                    </div>

                  <input name="update_profile_btn" type="submit" class="btn btn-primary btn-lg btn-block" value="Update" <?php if ( DEMO_MODE == true ) {?> disabled <?php } ?>/>
                  </fieldset>
                  </form>
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

    <!-- modals -->

    <!-- Change Password -->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="closeChangePassword"><span aria-hidden="true">×</span>
                </button>
          <h4 class="modal-title" id="myModalLabel">Change Password</h4>
        </div>
        <!-- ./ modal-header -->
        <div class="modal-body">
          <form role="form" action="<?php echo BASE_URL; ?>/actions/profileActions.php" method="post">
            <div class="form-group row">
              <label class="col-lg-2 control-label">Password</label>
              <div class="col-lg-10">
        <input class="form-control" type="password" name="password" id="password" size="30" maxlength="255" placeholder="Enter your new password..." value="" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?> />
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <div class="form-group row">
              <label class="col-lg-2 control-label">Confirm Password</label>
              <div class="col-lg-10">
        <input class="form-control" type="password" name="confirm_password" size="30" id="confirm_password" maxlength="255" placeholder="Retype your new password..." value="" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?> />
              </div>
              <!-- ./ col-sm-9 -->
            </div>
        </div>
        <!-- ./ modal-body -->
        <div class="modal-footer">
              <input type="submit" name="changePassword" id="changePassword" class="btn btn-primary" value="Change Password" />
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </form>
        </div>
        <!-- ./ modal-footer -->
      </div>
      <!-- ./ modal-content -->
    </div>
    <!-- ./ modal-dialog modal-lg -->
  </div>
  <!-- ./ modal fade bs-example-modal-lg -->

  <!-- modals -->

    <?php include "./oc-includes/jquery-colsolidated.inc.php"; ?>

    <script>

    </script>

    <script>
       $(document).ready(function() {
         getMyRank("<?php echo $_SESSION['id'];?>");
       });
    </script>

    <!-- Custom Theme Scripts -->
    <script src="./js/custom.js"></script>
    <!-- openCad Script -->
    <script src="./js/OpenCAD.js"></script>

  </body>
</html>
