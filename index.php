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
        $loginMessage = '<div class="alert alert-success" ><span>You\'ve successfully been logged out</span></div>';  
    }
    if(isset($_SESSION['register_error']))
    {
        $registerError = '<div class="alert alert-danger" ><span>'.$_SESSION['register_error'].'</span></div>';
        unset($_SESSION['register_error']);
    }
    if(isset($_SESSION['register_success']))
    {
        $registerError = '<div class="alert alert-success" ><span>'.$_SESSION['register_success'].'</span></div>';
        unset($_SESSION['register_success']);
    }
    if(isset($_SESSION['loginMessageDanger']))
    {
        $loginMessage = '<div class="alert alert-danger" ><span>'.$_SESSION['loginMessageDanger'].'</span></div>';
        unset($_SESSION['loginMessageDanger']);
    }

    
?>

<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- CSS -->
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap-multiselect.css"> <!-- CSS for MultiSelect Plugin -->

    <!-- JS -->
    <script type="text/javascript" src="./js/bootstrap-multiselect.js"></script> <!-- Script for MultiSelect Plugin -->
    <script type="text/javascript" src="./js/bootstrap.js"></script><!-- Bootstrap Core JS -->
    <!-- jQuery -->
    <script src="./vendors/jquery/dist/jquery.min.js"></script>

    <title><?php echo $community;?> CAD System</title>
    <link rel="icon" href="./images/favicon.ico" />
</head>
<body>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align:center;"><?php echo $community;?> CAD System</h1>
                </div>
                <!-- ./ col-lg-12 -->
            </div>
            <!-- ./ row -->
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="text-align:center;">Please Login to Use This System</h3>
                        </div>
                        <!-- ./ panel-heading -->
                        <div class="panel-body">
                        <?php echo $loginMessage;?>
                            <form role="form" action="./actions/login.php" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email" name="email" type="text" value="<?php if($testing){echo "test@test.test";}?>" required>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="<?php if($testing){echo "password";}?>" required >
                                    </div>
                                    <!-- ./ form-group -->
								    <input name="login_btn" type="submit" class="btn btn-lg btn-primary btn-block" value="Login" />
                                </fieldset>
                            </form>
                        </div>
                        <!-- ./ panel-body -->
                    </div>
                    <!-- ./ panel panel-primary -->
                </div>
                <!-- ./ col-lg-6 col-lg-offset-3 -->
            </div>
            <!-- ./ row -->
            <br/><br/>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="text-align:center;">Not Registered? Request Access</h3>
                        </div>
                        <!-- ./ panel-heading -->
                        <div class="panel-body">
                        <?php echo $registerError, $registerSuccess;?>
                            <form role="form" action="./actions/register.php" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Name" name="uname" type="text" value="<?php if($testing){echo "Test";}?>" required>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email" name="email" type="email" value="<?php if($testing){echo "test@test.test";}?>" required>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Identifier (Code Number, Unit ID)" name="identifier" type="text" value="<?php if($testing){echo "1A-1";}?>" required>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <label>Division (Can choose more than one)</label>
                                        <select class="form-control" id="division" name="division[]" multiple="multiple" size="6" required>
                                            <option value="communications">Communications (Dispatch)</option>
                                            <!--<option value="ems">EMS</option>-->
                                            <option value="fire">Fire</option>
                                            <option value="highway" <?php if($testing){echo "selected=\"selected\"";}?>>Highway Patrol</option>
                                            <option value="police">Police</option>
                                            <option value="sheriff">Sheriff</option>
                                            <option value="civilian">Civilian</option>
                                        </select>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="<?php if($testing){echo "password";}?>" required>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Confirm Password" name="password1" type="password" value="<?php if($testing){echo "password";}?>" required>
                                    </div>
                                    <!-- ./ form-group -->

								    <input name="login_btn" type="submit" class="btn btn-lg btn-primary btn-block" value="Request Access" />
                                </fieldset>
                            </form>
                        </div>
                        <!-- ./ panel-body -->
                    </div>
                    <!-- ./ panel panel-primary -->
                </div>
                <!-- ./ col-lg-6 col-lg-offset-3 -->
            </div>
            <!-- ./ row -->

        </div>
        <!-- ./ container-fluid -->
    </div>
    <!-- ./ page-wrapper -->

    <!-- Plugin Intializations -->
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#division').multiselect();
    });
    </script>
</body>
</html>