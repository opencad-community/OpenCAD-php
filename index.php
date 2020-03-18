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