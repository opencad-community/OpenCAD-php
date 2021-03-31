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

if(!file_exists(getcwd().'/oc-config.php') && is_writable(getcwd())){
<<<<<<< HEAD
		
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
=======

   header('Location://'.$_SERVER['SERVER_NAME'].'/oc-install/start.php');
}
	require_once(__DIR__ . "/oc-config.php");
	require_once(__DIR__ . "/actions/register.php");
	require_once(__DIR__ . "/actions/publicFunctions.php");

	$testing = false; //If set to true, will default some data for you

	session_start();
	$_SESSION['root_path'] = getcwd();
	$registerError = "";
	$registerSuccess = "";
	$loginMessage = "";

	if ( (isset($_SESSION['logged_in'])) == "YES" )
	{
	  header ('Location: ./dashboard.php');
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
>>>>>>> oc-main/canary


?>

<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
	<head>
		<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>


	<body class="app flex-row align-items-center">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card-group">
						<div class="card p-4">
							<div class="card-body">
								<h1><?php echo lang_key("LOGIN"); ?></h1>
								<?php echo $loginMessage, $registerError ?>
								<form role="form" action="<?php echo BASE_URL; ?>/oc-includes/login.php" method="post">
								<p class="text-muted"><?php echo lang_key("SIGN_IN_TO_YOUR_ACCOUNT"); ?></p>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">
										<i class="fas fa-user-shield"></i>
										</span>
									</div>
									<input class="form-control" type="text"  name="email">
								</div>
								<div class="input-group mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text">
										<i class="fas fa-lock"></i>
									</span>
								</div>
								<input class="form-control" type="password" name="password" >
							</div>
								<div class="row">
									<div class="col-6">
										<button type="submit" class="btn btn-primary px-4" type="button"><?php echo lang_key("LOGIN"); ?></button>
									</div>
								</div>
							</div>
						</div>
						</form>

						<div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
							<div class="card-body text-center">
								<div>
									<h2><?php echo lang_key("REQUEST_ACCESS"); ?></h2>
									<!-- Will be reintroduced in a future version. Requires some rejiggering of functions. -->
									<!--<button class="btn btn-primary active mt-3" type="button" data-toggle="modal" data-target="#registerLawEnforcement"><?php //echo lang_key("LAW_ENFORCEMENT_OFFICER"); ?></button><br />-->
									<button class="btn btn-primary active mt-3" type="button" data-toggle="modal" data-target="#registerFirstResponder"><?php echo lang_key("FIRST_RESPONDER"); ?></button><br />
									<button class="btn btn-primary active mt-3" type="button" data-toggle="modal" data-target="#registerCivilian"><?php echo lang_key('CIVILIAN'); ?></>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		include_once ( ABSPATH . "/oc-content/themes/".THEME."/modals/register.modals.inc.php");
		include_once ( ABSPATH . "/oc-includes/jquery-colsolidated.inc.php" ); ?>
	</body>
	<script type="text/javascript" src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1"></script>
</html>
=======
   <?php include "./oc-includes/header.inc.php"; ?>
   <body class="login">
	  <div>
		 <a class="hiddenanchor" id="signup"></a>
		 <a class="hiddenanchor" id="signin"></a>
		 <a class="hiddenanchor" id="civreg"></a>
		 <div class="login_wrapper">
			<div class="animate form login_form civ_login">
			   <?php echo $loginMessage;?>
			   <section class="login_content">
				  <form role="form" action="<?php echo BASE_URL; ?>/actions/login.php" method="post">
					 <h1>Login</h1>
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
					 <?php if (CIV_REG === true) { ?>
			 <div class="clearfix"></div>
			 <div class="separator">
				<p class="change_link">New?
				   <a href="#signup" class="to_register"> Request Access </a>
				</p>
				<p class="change_link">Civilian Only?
				   <a href="#civreg" class="to_register"> Request Access as Civilian </a>
				</p>
				<div class="clearfix"></div>
				<br />
				<div>
				   <h1><i class="fas fa-users"></i> <?php echo COMMUNITY_NAME?> CAD System</h1>
				   <h2> OpenCAD Version <?php getOpenCADVersion();?> </h2>
				</div>
			 </div>
					 <?php } else { ?>
					 <div class="clearfix"></div>
					 <div class="separator">
						<p class="change_link">New?
						   <a href="#signup" class="to_register"> Request Access </a>
						</p>
						<p class="change_link">Civilian Only? Not Enabled
						</p>
						<div class="clearfix"></div>
						<br />
						<div>
						   <h1><i class="fas fa-users"></i> <?php echo COMMUNITY_NAME?> CAD System</h1>
						   <h2> OpenCAD Version <?php getOpenCADVersion();?> </h2>
						</div>
					 </div>
					 <?php } ?>
				  </form>
			   </section>
			</div>
			<div id="register" class="animate form registration_form">
			   <section class="login_content">
				  <?php echo $registerError, $registerSuccess;?>
				  <form action="<?php echo BASE_URL; ?>/actions/register.php" method="post">
					 <h1>Request Access</h1>
					 <div>
						<input class="form-control" placeholder="Name" name="uname" type="text" required>
					 </div>
					 <div>
						<input class="form-control" placeholder="Email" name="email" type="email" required>
					 </div>
					 <div>
						<input class="form-control" placeholder="Identifier (Code Number, Unit ID)" name="identifier" type="text" required>
					 </div>
					 <div class="form-group">
						<input class="form-control" placeholder="Password" name="password" type="password" value="<?php if($testing){echo "password";}?>" required>
					 </div>
					 <!-- ./ form-group -->
					 <div class="form-group">
						<input class="form-control" placeholder="Confirm Password" name="password1" type="password" required>
					 </div>
					 <!-- ./ form-group -->
					 <div class="form-group">
						<label>Division (Select all that apply)</label>
						<select class="form-control selectpicker" id="division" name="division[]" multiple="multiple" size="6" required>
							<?php getDataSetTable($dataSet = "departments", $column1 = "department_id", $column2 = "department_long_name", $leadTrim = 17, $followTrim = 11, $isRegistration = true, $isVehicle = false); ?>
						</select>
					 </div>
					 <div class="clearfix"></div>
					 <div>
						<input name="register" type="submit" class="btn btn-default btn-sm pull-right" value="Request Access" />
					 </div>
					 <div class="clearfix"></div>
					 <div class="separator">
						<p class="change_link">Already a member?
						   <a href="#signin" class="to_register"> Log in </a>
						</p>
						<div class="clearfix"></div>
						<br />
						<div>
						   <h1><i class="fas fa-users"></i> <?php echo COMMUNITY_NAME ?> CAD System</h1>
						   <h2> OpenCAD Version <?php getOpenCADVersion();?> </h2>
						</div>
					 </div>
				  </form>
			   </section>
			</div>
			 <?php if (CIV_REG === true) { ?>
			<div id="civ" class="animate form civilian_form">
			   <section class="login_content">
				  <?php echo $registerError, $registerSuccess;?>
				  <form action="<?php echo BASE_URL; ?>/actions/register.php" method="post">
					 <h1>Civilian Registration</h1>
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
						<input class="form-control" placeholder="Password" name="password" type="password" value="<?php if($testing){echo "password";}?>" required>
					 </div>
					 <!-- ./ form-group -->
					 <div class="form-group">
						<input class="form-control" placeholder="Confirm Password" name="password1" type="password" value="<?php if($testing){echo "password";}?>" required>
					 </div>
					 <!-- ./ form-group -->
					 <div class="clearfix"></div>
					 <div>
						<input name="civreg" type="submit" class="btn btn-default btn-sm pull-right" value="Register" />
					 </div>
					 <div class="clearfix"></div>
					 <div class="separator">
						<p class="change_link">Already a member?
						   <a href="#signin" class="to_register"> Log in </a>
						</p>
						<div class="clearfix"></div>
						<br />
						<div>
						   <h1><i class="fas fa-users"></i> <?php echo COMMUNITY_NAME ?> CAD System</h1>
						   <h2> OpenCAD Version <?php getOpenCADVersion();?> </h2>
						</div>
					 </div>
				  </form>
			   </section>
			</div>
			<?php } else { ?>
			  <div id="civ" class="animate form civilian_form">
					<?php echo $registerError, $registerSuccess;?>
					   <p>Stop trying to backdoor into OpenCAD
						  This has been logged. </p>
					   <div class="clearfix"></div>
					   <div class="separator">
						  <p class="change_link">Already a member?
							 <a href="#signin" class="to_register"> Log in </a>
						  </p>
						  <div class="clearfix"></div>
						  <div>
							 <h1><i class="fas fa-users"></i> <?php echo COMMUNITY_NAME ?> CAD System</h1>
							 <h2> OpenCAD Version <?php getOpenCADVersion();?> </h2>
						  </div>
					   </div>
			  </div>
			   <?php } ?>
		 </div>
	  </div>
	  <?php include "./oc-includes/jquery-colsolidated.inc.php"; ?>
	  <script type="text/javascript">
		 $(document).ready(function() {
			// $('#division').multiselect();
		 });
	  </script>
   </body>
</html>
>>>>>>> oc-main/canary
