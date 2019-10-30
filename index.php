<?php

 error_reporting(-1);
ini_set('display_errors', 'On');
/**
Open source CAD system for RolePlaying Communities.
Copyright (C) 2017 Shane Gill

This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
**/

if(!file_exists(getcwd().'/oc-config.php') && is_writable(getcwd())){
    
   header('Location://'.$_SERVER['SERVER_NAME'].'/oc-install/start.php');
} else {}
    require_once("oc-config.php");
    require_once( ABSPATH . "/oc-functions.php");
    require_once( ABSPATH . "/oc-settings.php");
    require_once( ABSPATH . "/oc-includes/register.php");
    require_once( ABSPATH . "/oc-includes/publicFunctions.php");

    $testing = false; //If set to true, will default some data for you

        $_SESSION['root_path'] = getcwd();
    $registerError = "";
    $registerSuccess = "";
    $loginMessage = "";

    if ( (isset($_SESSION['logged_in'])) == "YES" )
    {
      header ('Location:'.OCAPPS."/oc-start.php" );
;      //echo $_SESSION['name']." is logged in!";
    }
    if (isset($_GET['loggedOut']))
    {
      $loginMessage = '<div class="alert alert-success" style="text-align: center;" ><span>You\'ve successfully been logged out</span></div>';
   }
   if(isset($_SESSION['register_error']))
   {
    }
    if(isset($_SESSION['register_error']))
    {
      $registerError = '<div class="alert alert-danger" style="text-align: center;"><span>'.$_SESSION['register_error'].'</span></div>';
        unset($_SESSION['register_error']);
    }
    if(isset($_SESSION['register_success']))
    {
      $registerError = '<div class="alert alert-success" style="text-align: center;"><span>'.$_SESSION['register_success'].'</span></div>';
        unset($_SESSION['register_success']);
    }
    if(isset($_SESSION['loginMessageDanger']))
    {
      $loginMessage = '<div class="alert alert-danger" style="text-align: center;"><span>'.$_SESSION['loginMessageDanger'].'</span></div>';
        unset($_SESSION['loginMessageDanger']);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include( ABSPATH . "oc-includes/header.inc.php"); ?>


<body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>Login</h1>
				<form role="form" action="<?php echo BASE_URL; ?>/oc-includes/login.php" method="post">
                	<p class="text-muted">Sign In to your account</p>
                		<div class="input-group mb-3">
                  		<div class="input-group-prepend">
                    	<span class="input-group-text">
                      	<i class="icon-user"></i>
                    </span>
                  </div>
                  <input class="form-control" type="text"  name="email">
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input class="form-control" type="password" name="password" >
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary px-4" type="button">Login</button>
                  </div>
				  </form>
                </div>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>I am a...</p>
                  <button class="btn btn-primary active mt-3" type="button">First Responder</button><br />
				  <button class="btn btn-primary active mt-3" type="button">Civilian</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
          <?php include( ABSPATH . "/oc-includes/jquery-colsolidated.inc.php" ); ?>

</body>

            <script type="text/javascript"
        src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
    </script>

</html>