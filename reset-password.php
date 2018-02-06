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
	
	$passwordUpdate = "";
    if (isset($_SESSION['passwordUpdate']))
    {
        $passwordUpdate = $_SESSION['passwordUpdate'];
        unset($_SESSION['passwordUpdate']);
    }
	
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($con, "SELECT * FROM `users`") or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    $password = $row['password'];
    $id = $_SESSION['id'];
    $password = $_SESSION['password'];
    if (isset($_POST['resetpass'])) {
    $newpassword = $_POST['password'];
    $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
    mysqli_query($con,"UPDATE `users` SET `password` = '$hashed_password' WHERE `id` = '$id'") or die(mysqli_error($con));

	$_SESSION['passwordUpdate'] = '<div class="alert alert-success"><span>Your password has been updated!</span></div>';
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
                     <a href="javascript:void(0)" class="site_title"><i class="fa fa-tachometer"></i> <span><?php echo COMMUNITY_NAME;?> User</span></a>
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
                           <li class="active">
                              <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu" style="display: block;">
                                 <li class="current-page"><a href="javascript:void(0)">My Profile</a></li>
                              </ul>
                           </li>
                        </ul>
                     </div>
                     <!-- ./ menu_section -->
                  </div>
                  <!-- /sidebar menu -->
                  <!-- /menu footer buttons -->
                  <div class="sidebar-footer hidden-small">
                     <a data-toggle="tooltip" data-placement="top" title="Settings">
                     <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                     </a>
                     <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                     <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                     </a>
                     <a data-toggle="tooltip" data-placement="top" title="Go to Dashboard" href="<?php echo BASE_URL; ?>/dashboard.php">
                     <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                     </a>
                     <a data-toggle="tooltip" data-placement="top" title="Logout" href="./actions/logout.php">
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
                              <li><a href="./actions/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                        <h3>Reset Password</h3>
                     </div>
                     <!-- ./ title_left -->
                  </div>
                  <!-- ./ page-title -->
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>Reset My Password</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                 </li>
                                 <li><a class="close-link"><i class="fa fa-close"></i></a>
                                 </li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
						   <?php echo $passwordUpdate;?>
                           <div class="x_content">
                              <form id="resetPassword" action="reset-password.php" method="post" class="form-horizontal">
                                 <fieldset>
                                    <div class="form-group">
                                       <label class="col-sm-2 control-label">New Password:</label> 
                                       <div class="col-sm-10">
                                          <input name="password" id="password" class="form-control" type="password" maxlength="255" placeholder="Enter your new password..." value="" required>
                                       </div>
									   
									   <label class="col-sm-2 control-label">Confirm Password:</label> 
                                       <div class="col-sm-10">
                                          <input name="confirm_password" id="confirm_password" class="form-control" type="password" maxlength="255" placeholder="Retype your new password..." value="" required>
                                       </div>
                                       <!-- ./ col-sm-10 -->
                                    </div>
                                    <!-- ./ form-group --><br />
                                    <!-- ./ form-group -->
                                    <input type="submit" name="resetpass" id="resetpass" class="btn btn-primary btn-lg btn-block" value="Change Password" />
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
    
	  
      <script>
         $(document).ready(function() {
           getMyRank("<?php echo $_SESSION['id'];?>");
         });
      </script>
      <script></script>
      <!-- Custom Theme Scripts -->
      <script src="./js/custom.js"></script>
	  <script  src="./js/passconfirm.js"></script>
      <!-- openCad Script -->
      <script src="./js/OpenCAD.js"></script>
   </body>
</html>
