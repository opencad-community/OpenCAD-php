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
require_once('../oc-config.php');
require_once(ABSPATH . '/oc-functions.php');
require_once(ABSPATH . '/oc-settings.php');
require_once(ABSPATH . "/oc-includes/adminActions.inc.php");
require_once(ABSPATH . "/oc-includes/autoload.inc.php");


isSessionStarted();

if (empty($_SESSION['logged_in'])) {
	header('Location: ' . BASE_URL);
	die("Not logged in");
} else {
	// Do Nothing
}

isAdminOrMod();
$support_data = new System\Support();

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
if (isset($_SESSION["support_error"])) {
	$errorMsg = $_SESSION["support_error"];
	unset($_SESSION["support_error"]);
}

if (isset($_SESSION["support_success"])) {
	$successMsg = $_SESSION["support_success"];
	unset($_SESSION["support_success"]);
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
							<em class="fa fa-align-justify"></em> <?php echo lang_key("ISSUE_TITLE"); ?>
						</div>
						<form action="<?php echo BASE_URL; ?>/oc-includes/issueLogger.inc.php" method="POST">
							<div class="card-body">
								<?php if (!empty($errorMsg)) {
									echo "<span class='label danger'>" . $errorMsg . "</span>";
								} elseif (!empty($successMsg)) {
									echo "<span class='label success'>" . $successMsg . "</span>";
									if (isset($_GET["id"]) && isset($_GET["link"])) {
										echo "<span class='label success'>Issue Link: <a id='successlink' href=" . $_GET["link"] . ">" . $_GET["link"] . "</a><br>Issue ID: " . $_GET["id"] . "</span>";
									}
								}
								?>
								<div class="card-body">
									<?php
									if (!$support_data->checkRow()) {
										echo "<span class='label warning'>Your key is either not set or is invalid! Set it at the bottom of the page</span>";
									} ?>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_TITLE_BUG"); ?></label><input type="text" class="form-control" name="title_bug" placeholder="<?php echo lang_key("ISSUE_TITLE_BUG_notes"); ?>" required />
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_DESCRIBE_BUG"); ?></label><textarea class="form-control" name="describe_bug" placeholder="<?php echo lang_key("ISSUE_DESCRIBE_BUG_notes"); ?> " required></textarea>
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_REPRODUCE_BUG"); ?></label><textarea class="form-control" name="reproduce_bug" placeholder="<?php echo lang_key("ISSUE_REPRODUCE_BUG_notes"); ?>" required></textarea>
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_EXPECTED_BEHAVIOUR_BUG"); ?></label><textarea class="form-control" name="expected_bug" placeholder="<?php echo lang_key("ISSUE_EXPECTED_BEHAVIOUR_BUG_notes"); ?>"></textarea>
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_SCREENSHOTS_BUG"); ?></label><textarea class="form-control" name="screenshot_bug" placeholder="<?php echo lang_key("ISSUE_SCREENSHOTS_BUG_notes"); ?>"></textarea>
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_DESKTOP_BUG"); ?></label><textarea class="form-control" name="desktop_bug" placeholder="<?php echo lang_key("ISSUE_DESKTOP_BUG_notes"); ?>"></textarea>
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_SMARTPHONE_BUG"); ?></label><textarea class="form-control" name="smartphone_bug" placeholder="<?php echo lang_key("ISSUE_SMARTPHONE_BUG_notes"); ?>"></textarea>
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_SERVER_BUG"); ?></label><textarea class="form-control" name="server_bug" placeholder="<?php echo lang_key("ISSUE_SERVER_BUG_notes"); ?>"></textarea>
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("ISSUE_ADDITIONAL_INFO_BUG"); ?></label><textarea class="form-control" name="additional_bug" placeholder="<?php echo lang_key("ISSUE_ADDITIONAL_INFO_BUG_notes"); ?>"></textarea>
									</div>
									<h6>Once you click submit, your report will be submitted to the GitHub Repo. This will allow the developers and support staff to assist you. Please be aware, we are unable to provide 24/7 support and will reply as soon as we can.</h6>
									<input class="btn btn-primary" type="submit" name="gh_bug_submit" <?php if (!$support_data->checkRow()) {
																											echo "value='Disabled Until Key Is Set' disabled";
																										} else {
																											echo 'value="Submit"';
																										} ?>>
								</div>
							</div>
						</form>
					</div>

					<div class="card">
						<div class="card-header">
							<em class="fa fa-align-justify"></em> <?php echo lang_key("ISSUE_GH_CREATE_TITLE"); ?>
						</div>
						<form action="<?php echo BASE_URL; ?>/oc-includes/issueLogger.inc.php" method="POST">
							<div class="card-body">
								<div class="card-body">
									<div class="form-group">
										<?php if ($support_data->checkRow()) {
											echo "Key is already set, if you want to change it, please delete the \"gh_key\" from the " . DB_PREFIX . "config table <br><br>";
										} ?>

										<label for="name"><?php echo lang_key("ISSUE_GH_CREATE_KEY"); ?></label><input type="text" class="form-control" name="gh_key" placeholder="<?php echo lang_key("ISSUE_GH_CREATE_KEY_notes"); ?>" <?php if ($support_data->checkRow()) {
																																																												echo "disabled";
																																																											} ?> />
									</div>
									<h6><?php echo lang_key("ISSUE_GH_CREATE_DESCRIPTION"); ?></h6>
									<input class="btn btn-primary" type="submit" name="gh_key_BTN" <?php if ($support_data->checkRow()) {
																										echo "value='Disabled Because Key Is Set' disabled";
																									} else {
																										echo 'value="Submit"';
																									} ?>>
								</div>
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