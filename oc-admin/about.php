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

	require_once('../oc-config.php');
	require_once( ABSPATH . '/oc-functions.php');
	require_once( ABSPATH . '/oc-settings.php');
	require_once( ABSPATH . "/oc-includes/adminActions.php");

	if (empty($_SESSION['logged_in']))
	{
		header('Location: '.BASE_URL);
		die("Not logged in");
	}
	else
	{
	  // Do Nothing
	}


	if ( $_SESSION['adminPrivilege'] == 3)
	{
		if ($_SESSION['adminPrivilege'] == 'Administrator')
		{
			//Do nothing
		}
	}
	else if ($_SESSION['adminPrivilege'] == 2)
	{
		if ($_SESSION['adminPrivilege'] == 'Moderator')
		{
			// Do Nothing
		}
	}
	else
	{
		permissionDenied();
	}

	$accessMessage = "";
	if(isset($_SESSION['accessMessage']))
	{
		$accessMessage = $_SESSION['accessMessage'];
		unset($_SESSION['accessMessage']);
	}
	$adminMessage = "";
	if(isset($_SESSION['adminMessage']))
	{
		$adminMessage = $_SESSION['adminMessage'];
		unset($_SESSION['adminMessage']);
	}

	$successMessage = "";
	if(isset($_SESSION['successMessage']))
	{
		$successMessage = $_SESSION['successMessage'];
		unset($_SESSION['successMessage']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>
<body class="app header-fixed">

		<header class="app-header navbar">
			<button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php require_once ( ABSPATH . OCTHEMEINC ."/admin/topbarNav.inc.php" ); ?>
			<?php include( ABSPATH . "/" . OCTHEMES . "/" . THEME ."/includes/topProfile.inc.php"); ?>
		</header>
		<div class="app-body">
			<main class="main">
				<div class="breadcrumb" />
				<div class="container-fluid">
					<div class="animated fadeIn">
						<div class="card">
							<div class="card-header">
								<em class="fa fa-align-justify"></em> <?php echo lang_key("ABOUT_YOUR_APPLICATION"); ?>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label for="name"><?php echo lang_key("APPLICATION_VERSION"); ?></label><input type="text" class="form-control" readonly="readonly" placeholder="<?php echo OC_VERSION ?>" />
									<?php echo lang_key("APPLICATION_VERSION_notes"); ?>
								</div>
								<div class="form-group">
								<label for="name"><?php echo lang_key("DATABASE_SCHEMA_VERSION"); ?></label><input type="text" class="form-control" readonly="readonly" placeholder="<?php echo OC_DB_VERSION ?>" />
									<?php echo lang_key("DATABASE_SCHEMA_VERSION_notes"); ?>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<em class="fa fa-align-justify"></em> <?php echo lang_key("ABOUT_ENVIRONMENT"); ?>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label for="name"><?php echo lang_key("PHP_VERSION"); ?></label><input type="text" class="form-control" readonly="readonly" placeholder="<?php echo phpversion(); ?>" />
									<?php echo lang_key("PHP_VERSION_notes"); ?>
								</div>
								<div class="form-group">
									<label for="name"><?php echo lang_key("DATABASE_ENGINE"); ?></label>
									<input type="text" class="form-control" readonly="readonly" value="<?php echo getMySQLVersion(); ?>" />
									<?php echo lang_key("DATABASE_ENGINE_notes"); ?>
								</div>
								<div class="form-group">
									<label for="name"><?php echo lang_key("LOADED_PHP_MODULES"); ?></label>
									<input type="text" class="form-control" readonly="readonly" placeholder="<?php print_r(get_loaded_extensions()); ?>" />
									<?php echo lang_key("LOADED_PHP_MODULES_notes"); ?>
								</div>
								<div class="form-group">
									<label for="name"><?php echo lang_key("API_KEY"); ?></label>
									<input type="text" class="form-control" readonly="readonly" placeholder="<?php echo getApiKey(); ?>" />
									<p>
										<em>Note:</em> Used to encrypt cookie 'aljksdz7' and authenticate
										request to the api if the requestor is not logged in.
									</p>
									<a style="margin-left:10px" class="btn btn-primary" href="<?php echo BASE_URL; ?>/actions/generalActions.php?newApiKey=1">Generate</a>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<em class="fa fa-align-justify"></em> <?php echo lang_key("ABOUT_OPENCAD"); ?>
							</div>
							<div class="card-body">
								<p>OpenCAD is an open source project licensed under GNU GPL v3. The original code and concept by <a rel="noopener" href="https://github.com/ossified" title="a link to the original developer's GitHub.">Shane Gill</a>. This project is maintained by Overt Source.</p>
							</div>
						</div>
					</div>
				</main>
			</div>
	<?php require_once ( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/footer.inc.php"); ?>
	<?php require_once( ABSPATH . OCTHEMEINC ."/admin/topbarNav.inc.php" ); ?>
	<?php require_once( ABSPATH . OCTHEMEINC ."/scripts.inc.php" ); ?>
	</body>	

</html>