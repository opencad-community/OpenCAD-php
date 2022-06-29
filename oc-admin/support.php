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
require_once(ABSPATH . '/oc-functions.php');
require_once(ABSPATH . '/oc-settings.php');
require_once(ABSPATH . "/oc-includes/adminActions.php");

if (empty($_SESSION['logged_in'])) {
	header('Location: ' . BASE_URL);
	die("Not logged in");
} else {
	// Do Nothing
}


isAdminOrMod();

$accessMessage = "";
if (isset($_SESSION['accessMessage'])) {
	$accessMessage = $_SESSION['accessMessage'];
	unset($_SESSION['accessMessage']);
}
$adminMessage = "";
if (isset($_SESSION['adminMessage'])) {
	$adminMessage = $_SESSION['adminMessage'];
	unset($_SESSION['adminMessage']);
}

$successMessage = "";
if (isset($_SESSION['successMessage'])) {
	$successMessage = $_SESSION['successMessage'];
	unset($_SESSION['successMessage']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include(ABSPATH . "/" . OCTHEMES . "/" . THEME . "/includes/header.inc.php"); ?>

<body class="app header-fixed">

	<header class="app-header navbar">
		<button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php require_once(ABSPATH . OCTHEMEINC . "/admin/topbarNav.inc.php"); ?>
		<?php include(ABSPATH . "/" . OCTHEMES . "/" . THEME . "/includes/topProfile.inc.php"); ?>
	</header>
	<div class="app-body">
		<main class="main">
			<div class="breadcrumb" />
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<em class="fa fa-align-justify"></em> <?php echo lang_key("SUPPORT_TITLE"); ?>
						</div>
						<form action="<?php echo BASE_URL; ?>/oc-content/plugins/support/index.php" method="POST">
							<div class="card-body">
								<div class="form-group">
									<label for="name"><?php echo lang_key("SUPPORT_DESCRIBE_PROBLEM"); ?></label><input type="text" class="form-control" name="PROBLEMS" placeholder="<?php echo lang_key("SUPPORT_DESCRIBE_PROBLEM_notes"); ?>" />
								</div>
								<div class="form-group">
									<label for="name"><?php echo lang_key("SUPPORT_AFFECTING_FILE"); ?></label><input type="text" class="form-control" name="FILE" placeholder="<?php echo lang_key("SUPPORT_AFFECTING_FILE_notes"); ?>" />
								</div>
								<h6>Once you click "Submit", your support request will be submitted. Please note that lots of additional information is sent with your request, you can find out what by clicking the "Show me" button.<br>Please note also, we will support you as quickly as possible. We are unable to provide 24/7 instant support.</h6>
								<input class="btn btn-primary" type="submit" value="Submit">
								<a  class="btn btn-primary" href="<?php echo BASE_URL; ?>/oc-content/plugins/support/index.php?showme=1">Show Me</a>
							</div>
						</form>
					</div>
				</div>
		</main>
	</div>
	<?php require_once(ABSPATH . "/" . OCTHEMES . "/" . THEME . "/includes/footer.inc.php"); ?>
	<?php require_once(ABSPATH . OCTHEMEINC . "/admin/topbarNav.inc.php"); ?>
	<?php require_once(ABSPATH . OCTHEMEINC . "/scripts.inc.php"); ?>


	<script>
		function copyAPI() {
			/* Get the text field */
			var copyText = document.getElementById("apikey");

			/* Select the text field */
			copyText.select();
			copyText.setSelectionRange(0, 99999); /* For mobile devices */

			/* Copy the text inside the text field */
			navigator.clipboard.writeText(copyText.value);
		}
	</script>

</body>

</html>