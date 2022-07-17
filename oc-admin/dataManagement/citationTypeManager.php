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

	if(session_id() == '' || !isset($_SESSION)) {
	// session isn't started
	session_start();
	}
	require_once('../../oc-config.php');
	require_once( ABSPATH . '/oc-functions.php');
	require_once( ABSPATH . '/oc-settings.php');
	require_once( ABSPATH . "/oc-includes/adminActions.inc.php");
	require_once( ABSPATH . "/oc-includes/dataActions.php");

	if (empty($_SESSION['logged_in']))
	{
		header('Location: ../index.php');
		die("Not logged in");
	}
	else
	{
	  $name = $_SESSION['name'];
	}


	isAdminOrMod();

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
		<?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/topProfile.inc.php"); ?>
	</header>

	<div class="app-body">
		<main class="main">
			<div class="breadcrumb" />
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<em class="fa fa-align-justify"></em> <?php echo lang_key("CITATIONTYPE_MANAGER"); ?>
						</div>
						<div class="card-body">
							<?php echo $accessMessage;?>
							<?php getCitationTypes();?>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	
			<?php require_once ( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/footer.inc.php"); ?>

	<!-- Edit Citation Modal -->
	<div class="modal" id="editCitationTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="editCitationTypeModal">Edit Citation Type</h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<!-- ./ modal-header -->
				<div class="modal-body">
					<form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/dataActions.php"
						class="form-horizontal">
						<div class="form-group row">
							<label class="col-md-3 control-label">Citation Description</label>
							<div class="col-md-9">
								<input data-lpignore='true' type="text" name="citationDescription" class="form-control" id="citationDescription" required />
							</div>
							<!-- ./ col-sm-9 -->
						</div>
						<!-- ./ form-group -->
						<div class="form-group row">
							<label class="col-md-3 control-label">Citation Fine (Reccomended)</label>
							<div class="col-md-9">
								<input data-lpignore='true' type="text" name="citationFine" class="form-control" id="citationFine"/>
							</div>
							<!-- ./ col-sm-9 -->
						</div>
						<!-- ./ form-group -->
				</div>
				<!-- ./ modal-body -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="hidden" name="id" id="id" aria-hidden="true">
					<input type="submit" name="editCitationType" class="btn btn-primary" value="Edit Citation Type" />
				</div>
				<!-- ./ modal-footer -->
				</form>
			</div>
			<!-- ./ modal-content -->
		</div>
		<!-- ./ modal-dialog modal-lg -->
	</div>
	<!-- ./ modal fade bs-example-modal-lg -->

	<?php
	require_once ( ABSPATH . OCTHEMEMOD . "/admin/globalModals.inc.php");
	require_once	( ABSPATH . OCTHEMEINC ."/scripts.inc.php" ); ?>

		<script>
	$(document).ready(function() {
		$('#allCitationTpyes').DataTable({});
	});
	</script>

	<script>
	$('#editCitationTypeModal').on('show.bs.modal', function(e) {
		var $modal = $(this),
			id= e.relatedTarget.id;

		$.ajax({
			cache: false,
			type: 'POST',
			url: '<?php echo BASE_URL; ?>/oc-includes/dataActions.php',
			data: {
				'getCitationTypeDetails': 'yes',
				'id': id
			},
			success: function(result) {
				console.log(result);
				data = JSON.parse(result);

				$('input[name="citationFine"]').val(data['citationFine']);
				$('input[name="citationDescription"]').val(data['citationDescription']);
				$('input[name="id"]').val(data['id']);
			},

			error: function(exception) {
				alert('Exeption:' + exception);
			}
		});
	})
	</script>
</body>

</html>