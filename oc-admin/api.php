<?php

/**
 * Open source CAD system for RolePlaying Communities.
 * Copyright (C) 2022 OpenCAD Project
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
 */


require_once('../oc-config.php');
require_once(ABSPATH . '/oc-functions.php');
require_once(ABSPATH . '/oc-settings.php');
require_once(ABSPATH . "/oc-includes/adminActions.inc.php");

isSessionStarted();

if (empty($_SESSION['logged_in'])) {
	permissionDenied();
}

isSessionStarted();
isAdminOrMod();

$api_data = new API\APIManager();
$api_key = $api_data->generateAPIKey();

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

if (isset($_SESSION["api_error"])) {
	$errorMsg = $_SESSION["api_error"];
	unset($_SESSION["api_error"]);
}

if (isset($_SESSION["api_success"])) {
	$successMsg = $_SESSION["api_success"];
	unset($_SESSION["api_success"]);
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
			<div class="breadcrumb">
				<div class="container-fluid">
					<div class="animated fadeIn">
						<div class="card">
							<div class="card-header">
								<em class="fa fa-align-justify"></em> <?php echo lang_key("API_CREATE_TITLE"); ?>
							</div>
							<form action="<?php if (isset($_GET["update"]) && $_GET["update"] == true) {
												echo BASE_URL . "/oc-includes/api.inc.php?updateApi";
											} else {
												echo BASE_URL . "/oc-includes/api.inc.php?verifyApi";
											} ?>" method="POST">
								<div class="card-body">
									<?php if (!empty($errorMsg)) {
										echo "<span class='label danger'>" . $errorMsg . "</span>";
									} elseif (!empty($successMsg)) {
										echo "<span class='label success'>" . $successMsg . "</span>";
									} ?>
									<p>Welcome to the API Management page, here you can create and revoke active APIs. You are able to set permissions based on each API.</p>
									<p>You can view the API documentation <a href="<?php echo BASE_URL;?>/oc-api/docs/">here</a></p>
									<div class="form-group">
										<label for="name"><?php echo lang_key("API_NEW_TITLE"); ?></label><input type="text" class="form-control" name="API_title" placeholder="<?php echo lang_key("API_NEW_TITLE_PLACEHOLDER"); ?>" value="<?php if (isset($_GET["title"])) {
																																																													echo $_GET["title"];
																																																												} ?>" required />
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("API_NEW_KEY"); ?></label><input type="text" class="form-control" name="API_key" placeholder="<?php echo $api_key ?>" value="<?php if (isset($_GET["uri"])) {
																																																				echo $_GET["uri"];
																																																			} else {
																																																				echo $api_key;
																																																			} ?>" readonly />
										<p>
											<em>Note:</em> Above is your new API Key, please copy it for your records.
										</p>
									</div>
									<table class="table table-bordered table-condensed table-hover table-striped text-center">
										<thead>
											<tr>
												<th scope="col">Method Permissions</th>
												<th scope="col">NCIC Permissions</th>
											</tr>
										</thead>
										<tbody class="text-left">
											<tr>
												<td><input type="checkbox" id="allowPOST" name='API_perms[]' value="allowPOST" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "allowPOST")) {
																																		echo "checked='checked'";
																																	} ?>>
													<label for="allowPOST"><?php echo lang_key("API_SETTINGS_ALLOWPOST"); ?></label><br>
												</td>
												<td><input type="checkbox" id="ncicArrests" name='API_perms[]' value="ncicArrests" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "ncicArrests")) {
																																			echo "checked='checked'";
																																		} ?>>
													<label for="ncicArrests"><?php echo lang_key("API_SETTINGS_NCICARRESTS"); ?></label><br>
												</td>
											</tr>
											<tr>
												<td>
													<input type="checkbox" id="allowGET" name='API_perms[]' value="allowGET" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "allowGET")) {
																																		echo "checked='checked'";
																																	} ?>>
													<label for="allowGET"><?php echo lang_key("API_SETTINGS_ALLOWGET"); ?></label><br>
												</td>
												<td><input type="checkbox" id="ncicWeapons" name='API_perms[]' value="ncicWeapons" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "ncicWeapons")) {
																																			echo "checked='checked'";
																																		} ?>>
													<label for="ncicWeapons"><?php echo lang_key("API_SETTINGS_NCICWEAPONS"); ?></label><br>
												</td>
											</tr>
											<tr>
												<td><input type="checkbox" id="allowDELETE" name='API_perms[]' value="allowDELETE" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "allowDELETE")) {
																																			echo "checked='checked'";
																																		} ?>>
													<label for="allowDELETE"><?php echo lang_key("API_SETTINGS_ALLOWDELETE"); ?></label><br>
												</td>
												<td><input type="checkbox" id="ncicWarnings" name='API_perms[]' value="ncicWarnings" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "ncicWarnings")) {
																																			echo "checked='checked'";
																																		} ?>>
													<label for="ncicWarnings"><?php echo lang_key("API_SETTINGS_NCICWARNINGS"); ?></label><br>
												</td>
											</tr>
											<tr>
												<td><input type="checkbox" id="allowPUT" name='API_perms[]' value="allowPUT" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "allowPUT")) {
																																		echo "checked='checked'";
																																	} ?> disabled>
													<label for="allowPUT"><?php echo lang_key("API_SETTINGS_ALLOWPUT"); ?></label><br>
												</td>
												<td>
													<input type="checkbox" id="ncicCitations" name='API_perms[]' value="ncicCitations" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "ncicCitations")) {
																																				echo "checked='checked'";
																																			} ?>>
													<label for="ncicCitations"><?php echo lang_key("API_SETTINGS_NCICCITATIONS"); ?></label><br>
												</td>
											</tr>
											<tr>
												<td></td>
												<td><input type="checkbox" id="ncicWarrants" name='API_perms[]' value="ncicWarrants" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "ncicWarrants")) {
																																				echo "checked='checked'";
																																			} ?>>
													<label for="ncicWarrants"><?php echo lang_key("API_SETTINGS_NCICWARRANTS"); ?></label><br>
												</td>
											</tr>
											<tr>
												<td></td>
												<td><input type="checkbox" id="ncicPlates" name='API_perms[]' value="ncicPlates" <?php if (isset($_GET["settings"]) && str_contains($_GET["settings"], "ncicPlates")) {
																																			echo "checked='checked'";
																																		} ?>>
													<label for="ncicPlates"><?php echo lang_key("API_SETTINGS_NCICPLATES"); ?></label><br>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="form-group">
										<?php if (isset($_GET["update"]) && $_GET["update"] == "true") {
											echo '<input type="hidden" id="API_id" name="API_id" value="' . $_GET["id"] . '">';
										} ?>

									</div>
									<?php
									if (isset($_GET["update"]) && $_GET["update"] == "true") {
										echo '<input class="btn btn-primary" type="submit" value="Update">';
									} else {
										echo '<input class="btn btn-primary" type="submit" value="Submit">';
									} ?>
								</div>
							</form>
						</div>



						<?php $api_data = new API\APIManager(); ?>
						<div class="card">
							<div class="card-header">
								<em class="fa fa-align-justify"></em> <?php echo lang_key("API_LIST_TITLE"); ?>
							</div>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Title</th>
										<th scope="col">Key</th>
										<th scope="col">Permissions</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$getApiData = $api_data->getAPIs();
									if (!$getApiData) {

										echo "<td>No APIs Set!</td>";
									} else {
										foreach ($getApiData as $data) {
											echo "<form action='" . BASE_URL . "/oc-includes/api.inc.php' method='POST'";
											echo "<tr>";
											echo "<td>" . $data["title"] . "</td>";
											echo "<td>" . $data["value"] . "</td>";
											echo "<td>" . $data["permissions"] . "</td>";
											echo '<td><input class="btn btn-primary" name="delete" type="submit" value="Revoke"></td>';
											echo '<input name="apiID" type="hidden" value=' . $data["id"] . ' />';
											echo "</tr>";
											echo "</form>";
										}
									} ?>
								</tbody>
							</table>
						</div>

					</div>
		</main>
	</div>
	<?php require_once(ABSPATH . "/" . OCTHEMES . "/" . THEME . "/includes/footer.inc.php"); ?>
	<?php require_once(ABSPATH . OCTHEMEINC . "/admin/topbarNav.inc.php"); ?>
	<?php require_once(ABSPATH . OCTHEMEINC . "/scripts.inc.php"); ?>

</body>

</html>