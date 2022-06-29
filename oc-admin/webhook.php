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

if (isset($_SESSION["webhook_error"])) {
	$errorMsg = $_SESSION["webhook_error"];
	unset($_SESSION["webhook_error"]);
}

if (isset($_SESSION["webhook_success"])) {
	$successMsg = $_SESSION["webhook_success"];
	unset($_SESSION["webhook_success"]);
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
								<em class="fa fa-align-justify"></em> <?php echo lang_key("WEBHOOK_CREATE_TITLE"); ?>
							</div>
							<form action="<?php echo BASE_URL; ?>/oc-includes/webhook.php?verifyWebhook" method="POST">
								<div class="card-body">
									<?php if (!empty($errorMsg)) {
										echo "<span class='label danger'>" . $errorMsg . "</span>";
									} elseif (!empty($successMsg)) {
										echo "<span class='label success'>" . $successMsg . "</span>";
									} ?>
									<div class="form-group">
										<label for="name"><?php echo lang_key("WEBHOOK_NEW_TITLE"); ?></label><input type="text" class="form-control" name="webhook_title" placeholder="<?php echo lang_key("WEBHOOK_NEW_TITLE_PLACEHOLDER"); ?>" value="<?php if (isset($_GET["title"])) {
																																																																echo $_GET["title"];
																																																															} ?>" />
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("WEBHOOK_NEW_URI"); ?></label><input type="text" class="form-control" name="webhook_uri" placeholder="<?php echo lang_key("WEBHOOK_NEW_URI_PLACEHOLDER"); ?>" value="<?php if (isset($_GET["uri"])) {
																																																														echo $_GET["uri"];
																																																													} ?>" />
									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("WEBHOOK_JSON"); ?></label><textarea id="json_data" rows="10" class="form-control" name="json_data"><?php if (isset($_GET["json"])) {
																																																echo $_GET["json"];
																																															} ?></textarea>
										<?php echo lang_key("WEBHOOK_JSON_NOTES"); ?><br>
										<button type="button" class="btn btn-primary" onclick="discordExample()">Example Discord Data</button>



									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("WEBHOOK_NEW_TYPE"); ?></label><br>
										<input type="radio" id="webhook_notification" name="webhook_settings" value="Notification" <?php if(isset($_GET["settings"]) && str_contains($_GET["type"], "Notification")){echo "checked='checked'";}else{echo "checked='checked'";}?>>
										<label for="webhook_notification"><?php echo lang_key("WEBHOOK_NEW_RADIO_NOTIFICATION"); ?></label><br>

									</div>
									<div class="form-group">
										<label for="name"><?php echo lang_key("WEBHOOK_NEW_SETTING"); ?></label><br>

										<input type="checkbox" id="civRegistered" name='webhook_activation[]' value="civRegistered" <?php if(isset($_GET["settings"]) && str_contains($_GET["settings"], "civRegistered")){echo "checked='checked'";}?>>
										<label for="civRegistered"><?php echo lang_key("WEBHOOK_SETTINGS_CIVREGISTERED"); ?></label><br>

										<input type="checkbox" id="userRequested" name='webhook_activation[]' value="userRequested" <?php if(isset($_GET["settings"]) && str_contains($_GET["settings"], "userRequested")){echo "checked='checked'";}?>>
										<label for="userRequested"><?php echo lang_key("WEBHOOK_SETTINGS_USERREQUESTED"); ?></label><br>

										<input type="checkbox" id="userDelete" name='webhook_activation[]' value="userDelete" <?php if(isset($_GET["settings"]) && str_contains($_GET["settings"], "userDelete")){echo "checked='checked'";}?>>
										<label for="userDelete"><?php echo lang_key("WEBHOOK_SETTINGS_USERDELETE"); ?></label><br>

										<input type="checkbox" id="userSuspension" name='webhook_activation[]' value="userSuspension" <?php if(isset($_GET["settings"]) && str_contains($_GET["settings"], "userSuspension")){echo "checked='checked'";}?>>
										<label for="userSuspension"><?php echo lang_key("WEBHOOK_SETTINGS_USERSUSPENSION"); ?></label><br>

									</div>
									<input class="btn btn-primary" type="submit" value="Submit">
								</div>
							</form>
						</div>



						<?php $webhook_data = new System\Webhook(); ?>
						<div class="card">
							<div class="card-header">
								<em class="fa fa-align-justify"></em> <?php echo lang_key("WEBHOOK_LIST_TITLE"); ?>
							</div>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Title</th>
										<th scope="col">URL</th>
										<th scope="col">JSON Data</th>
										<th scope="col">Type</th>
										<th scope="col">Settings</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $getWebhooks = $webhook_data->getWebhooks();
									if (!$getWebhooks) {
										echo "<td>No Webhooks Set!</td>";
									} else {
										foreach ($getWebhooks as $data) {
											echo "<form action='" . BASE_URL . "/oc-includes/webhook.php' method='POST'";
											echo "<tr>";
											echo "<td>" . $data["webhook_title"] . "</td>";
											echo "<td>" . $data["webhook_uri"] . "</td>";
											echo "<td>" . json_decode($data["webhook_json"], true) . "</td>";
											echo "<td>" . $data["webhook_type"] . "</td>";
											echo "<td>" . $data["webhook_settings"] . "</td>";
											echo '<td><input class="btn btn-primary" type="button" id="' . $data["id"] . '" value="Edit"></td>';
											echo '<td><input class="btn btn-primary" name="delete" type="submit" value="Delete"></td>';
											echo '<input name="webhookId" type="hidden" value=' . $data["id"] . ' />';
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

<script>
	function discordExample() {
		array = {
			"content": "Test Content",
			"embeds": [{
				"title": "Embed 1 title",
				"description": "Embed 1 content",
				"url": "https://thumbs.dreamstime.com/b/funny-face-baby-27733390.jpg",
				"color": 41983,
				"author": {
					"name": "Embed 1 Author",
					"url": "https://pbs.twimg.com/profile_images/1350309631231483904/T_l9_QWN_400x400.jpg",
					"icon_url": "https://pbs.twimg.com/profile_images/1350309631231483904/T_l9_QWN_400x400.jpg"
				},
				"footer": {
					"text": "Footer",
					"icon_url": "https://thumbs.dreamstime.com/b/funny-face-baby-27733390.jpg"
				},
				"timestamp": "2022-06-29T20:23:00.000Z",
				"image": {
					"url": "https://thumbs.dreamstime.com/b/funny-face-baby-27733390.jpg"
				},
				"thumbnail": {
					"url": "https://thumbs.dreamstime.com/b/funny-face-baby-27733390.jpg"
				}
			}],
			"username": "Username Of Bot",
			"avatar_url": "https://thumbs.dreamstime.com/b/funny-face-baby-27733390.jpg",
			"attachments": []
		}

		document.getElementById("json_data").value = JSON.stringify(array);
	}
</script>

</html>