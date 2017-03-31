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
    
    $iniContents = parse_ini_file("./properties/config.ini", true); //Gather from config.ini file
    $community = $iniContents['strings']['community'];

    $testing = false; //If set to true, will default some data for you

    

    session_start();
    $registerError = "";
    $registerSuccess = "";
    $loginMessage = "";

    if (isset($_GET['loggedOut']))
    {
        $loginMessage = '<div class="alert alert-success" style="text-align: center; font-weight:normal;" ><span>You\'ve successfully been logged out</span></div>';  
    }
    if(isset($_SESSION['register_error']))
    {
        $registerError = '<div class="alert alert-danger" style="text-align: center; font-weight:normal;"><span>'.$_SESSION['register_error'].'</span></div>';
        unset($_SESSION['register_error']);
    }
    if(isset($_SESSION['register_success']))
    {
        $registerError = '<div class="alert alert-success" style="text-align: center; font-weight:normal;"><span>'.$_SESSION['register_success'].'</span></div>';
        unset($_SESSION['register_success']);
    }
    if(isset($_SESSION['loginMessageDanger']))
    {
        $loginMessage = '<div class="alert alert-danger" style="text-align: center; font-weight:normal;"><span>'.$_SESSION['loginMessageDanger'].'</span></div>';
        unset($_SESSION['loginMessageDanger']);
    }

    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $community;?> CAD System</title>
    <link rel="icon" href="./images/favicon.ico" />

    
    <!-- Bootstrap -->
    <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS for MultiSelect Plugin -->
    <link rel="stylesheet" href="./css/bootstrap-multiselect.css"> 
    <!-- jQuery -->
    <script src="./vendors/jquery/dist/jquery.min.js"></script>
    <!-- JS -->
    <script type="text/javascript" src="./js/bootstrap-multiselect.js"></script> <!-- Script for MultiSelect Plugin -->
    <script type="text/javascript" src="./js/bootstrap.js"></script><!-- Bootstrap Core JS -->
    <!-- Font Awesome -->
    <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="./vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="./css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <?php echo $loginMessage;?>
          <section class="login_content">
            <form role="form" action="./actions/login.php" method="post">
              <h1>Login Form</h1>
              <div>
                <input class="form-control" placeholder="Email" name="email" type="text" value="<?php if($testing){echo "test@test.test";}?>" required>
              </div>
              <div>
                <input class="form-control" placeholder="Password" name="password" type="password" value="<?php if($testing){echo "password";}?>" required >
              </div>
              <div>
                <input name="login_btn" type="submit" class="btn btn-default submit" value="Login" />
                <a class="reset_pass" href="#" onclick="alert('Request an administrator reset your password through your community.');" >Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New?
                  <a href="#signup" class="to_register"> Request Access </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-tachometer"></i> <?php echo $community;?> CAD System</h1>
                  <p>©2017 All Rights Reserved. openCad is open source. <a href="http://www.github.com/ossified/openCad">Download from GitHub.</a></p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <?php echo $registerError, $registerSuccess;?>
            <form action="./actions/register.php" method="post">
              <h1>Request Access</h1>
              <div>
                <input class="form-control" placeholder="Name" name="uname" type="text" value="<?php if($testing){echo "Test";}?>" required>
              </div>
              <div>
                <input class="form-control" placeholder="Email" name="email" type="email" value="<?php if($testing){echo "test@test.test";}?>" required>
              </div>
              <div>
                <input class="form-control" placeholder="Identifier (Code Number, Unit ID)" name="identifier" type="text" value="<?php if($testing){echo "1A-1";}?>" required>
              </div>
              <div class="form-group">
                <label>Division (Can choose more than one)</label>
                <select class="form-control" id="division" name="division[]" multiple="multiple" size="6" required>
                    <option value="civilian">Civilian</option>
                    <option value="communications">Communications (Dispatch)</option>
                    <!--<option value="ems">EMS</option>-->
                    <option value="fire">Fire</option>
                    <option value="highway" <?php if($testing){echo "selected=\"selected\"";}?>>Highway Patrol</option>
                    <option value="police">Police</option>
                    <option value="sheriff">Sheriff</option>
                </select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" type="password" value="<?php if($testing){echo "password";}?>" required>
            </div>
            <!-- ./ form-group --> 
            <div class="form-group">
                <input class="form-control" placeholder="Confirm Password" name="password1" type="password" value="<?php if($testing){echo "password";}?>" required>
            </div>
            <!-- ./ form-group -->
            <div class="clearfix"></div>
              <div>
                <input name="login_btn" type="submit" class="btn btn-default btn-sm pull-right" value="Request Access" />
              </div>
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-tachometer"></i> <?php echo $community;?> CAD System</h1>
                  <p>©2017 All Rights Reserved. openCad is open source. <a href="http://www.github.com/ossified/openCad">Download from GitHub.</a></p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
       // $('#division').multiselect();
    });
    </script>
  </body>
</html>
