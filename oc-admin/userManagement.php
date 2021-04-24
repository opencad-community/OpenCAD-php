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
	session_start();
	}
	require_once('../oc-config.php');
	require_once( ABSPATH . '/oc-functions.php');
	require_once( ABSPATH . '/oc-settings.php');
	require_once( ABSPATH . "/oc-includes/adminActions.php");
	require_once( ABSPATH . "/oc-includes/publicFunctions.php");
	if (empty($_SESSION['logged_in']))
	{
		header('Location: ../index.php');
		die("Not logged in");
	}

	if ( $_SESSION['adminPrivilege'] == 3)
	{
		if ($_SESSION['adminPrivilege'] == 'Administrator');
	}
	else if ($_SESSION['adminPrivilege'] == 2)
	{
		if ($_SESSION['adminPrivilege'] == 'Moderator');
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
<?php include ( ABSPATH . "/". OCCONTENT ."/themes/" .THEME. "/includes/header.inc.php"); ?>

<body class="app header-fixed">

	<header class="app-header navbar">

	<?php require_once ( ABSPATH . OCTHEMEINC ."/admin/topbarNav.inc.php" ); ?>
	<?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/topProfile.inc.php"); ?>
	</header>

	<div class="app-body">
		<main class="main">
		<div class="breadcrumb" />
		<div class="container-fluid">
		<div class="animated fadeIn">
			<div class="row">
			<div class="col-sm-2 col-sm-2">
				<div class="card text-white bg-primary">
				<div class="card-body pb-0">
					<div class="text-value"><?php echo getGroupCount("1");?></div>
					<div><?php echo getGroupName("1");?></div>
					<br />
				</div>
				</div>
			</div>
			<!-- /.col-->
			<div class="col-sm-2 col-sm-2">
				<div class="card text-white bg-primary">
				<div class="card-body pb-0">
					<button class="btn btn-transparent p-0 float-right" type="button">
					<em class="icon-location-pin"></em>
					</button>
					<div class="text-value"><?php echo getGroupCount("2");?></div>
					<div><?php echo getGroupName("2");?></div>
					<br />
				</div>
				</div>
				<br />
			</div>
			<!-- /.col-->
			<div class="col-sm-2 col-sm-2">
				<div class="card text-white bg-primary">
				<div class="card-body pb-0">
					<div class="text-value"><?php echo getGroupCount("3");?></div>
					<div><?php echo getGroupName("3");?></div>
				</div>
				<br />
				</div>
			</div>
			<!-- /.col-->
			<div class="col-sm-2 col-sm-2">
				<div class="card text-white bg-primary">
				<div class="card-body pb-0">
					<div class="text-value"><?php echo getGroupCount("4");?></div>
					<div><?php echo getGroupName("4");?></div>
					<br />
				</div>
				</div>
			</div>
			<!-- /.col-->
			<div class="col-sm-2 col-sm-2">
				<div class="card text-white bg-primary">
				<div class="card-body pb-0">
					<div class="text-value"><?php echo getGroupCount("5");?></div>
					<div><?php echo getGroupName("5");?></div>
					<br />
				</div>
				</div>
			</div>
			<!-- /.col-->
			</div>
			<!-- /.row-->
			<div class="row align-self-center">
			<div class="col-sm-2 col-sm-2">
				<div class="card text-white bg-primary">
				<div class="card-body pb-0">
					<div class="text-value"><?php echo getGroupCount("5");?></div>
					<div><?php echo getGroupName("5");?></div>
					<br />
				</div>
				</div>
			</div>
			<!-- /.col-->
			<div class="col-sm-2 col-sm-2">
				<div class="card text-white bg-primary">
				<div class="card-body pb-0">
					<div class="text-value"><?php echo getGroupCount("6");?></div>
					<div><?php echo getGroupName("6");?></div>
					<br />
				</div>
				</div>
			</div>
			<!-- /.col-->
			<div class="col-sm-2 col-sm-2">
				<div class="card text-white bg-primary">
				<div class="card-body pb-0">
					<div class="text-value"><?php echo getGroupCount("7");?></div>
					<div><?php echo getGroupName("7");?></div>
					<br />
				</div>
				</div>
			</div>
			<!-- /.col-->
			</div>
			<!-- /.row-->
			<div class="card">
				<div class="card-header">
					<em class="fa fa-align-justify"></em> <<?php echo lang_key("USER_MANAGER"); ?>
				</div>
				<div class="card-body">
					<?php echo $accessMessage;?>
					<?php getUsers();?>
				</div>
				<!-- /.row-->

			</div>

			</div>
			<!-- /.card-->

		</main>

		</div>

		<footer class="app-footer">
		<div>
			<a rel="noopener" href="https://opencad.io">OpenCAD</a>
			<span>&copy; 2017 <?php echo date("Y"); ?>.</span>
		</div>
		<div class="ml-auto">

		</div>
		</footer>

			<?php
	 require_once ( ABSPATH . OCTHEMEMOD . "/admin/globalModals.inc.php");
	require_once( ABSPATH . OCTHEMEINC ."/scripts.inc.php" ); ?>


<!-- Edit User Modal -->
	<div class="modal" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Dismiss: Edit User">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/adminActions.php" class="form-horizontal" aria-label="Administrative user profile editor">
							<div class="form-group row">
								<label class="col-md-3 control-label">Name</label>
								<div class="col-md-9">
									<input name="name" class="form-control" id="name" />
									<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input type="email" name="email" class="form-control" id="Email" />
									<span class="fas fa-envelope form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-md-3 control-label">Identifier</label>
								<div class="col-md-9">
									<input type="text" name="identifier" class="form-control" id="identifier" />
									<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-md-3 control-label">User Groups</label>
								<div class="col-md-9">
									<select name="userGroups[]" class="selectpicker form-control" id="userGroups" multiple>
										<?php getDataSetTable($data = "departments", $column1 = "departmentId", $column2 = "departmentLongName", $leadTrim = 17, $followTrim = 11, $modeIs = "userGroupEditor" ); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->                                               
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
					<input type="hidden" name="userId" id="userId">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" name="editUserAccount" class="btn btn-primary" value="Update User" />
					</div>
					<!-- ./ modal-footer -->
					</form>
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		<!-- ./ modal fade bs-example-modal-lg -->

			<!-- Change User Role Modal -->
	<div class="modal" id="editUserRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="editUserRoleModal">Change User Role</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Dismiss: Change User Role">
						<span aria-hidden="true">&times;</span>
						</button>
				</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/adminActions.php" class="form-horizontal" aria-label="Administrative user role editor">
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-md-3 control-label">User Role</label>
								<div class="col-md-9">
									<select name="userRole" class="selectpicker form-control" id="userRole">
										<?php getRole();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->                                               
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="hidden" name="userId" id="userId">
						<input type="submit" name="editUserAccountRole" class="btn btn-primary" value="Update Role" />
					</div>
					<!-- ./ modal-footer -->
					</form>
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		<!-- ./ modal fade bs-example-modal-lg -->
		</div>

		<!-- Change Password -->
	<div class="modal" id="changeUserPassword" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
						<h4 class="modal-title" id="changeUserPasswordLabel">Change Password</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Dismiss: Change Password">
						<span aria-hidden="true">&times;</span>
						</button>
			</div>
		<!-- ./ modal-header -->
		<div class="modal-body">
		<form role="form" action="<?php echo BASE_URL; ?>/oc-includes/adminActions.php" method="post" aria-labelledby="changeUserPasswordLabel">
			<div class="form-group row">
			<label class="col-lg-2 control-label" id="NewPassword">Password</label>
			<div class="col-lg-10">
				<input class="form-control" type="password" name="password" id="password" size="30" maxlength="255" placeholder="Enter your new password..." value="" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?> aria-labelledby="NewPassword" />
			</div>
			<!-- ./ col-sm-9 -->
			</div>
			<div class="form-group row">
			<label class="col-lg-2 control-label" id="NewPasswordConfirmation">Confirm Password</label>
			<div class="col-lg-10">
				<input class="form-control" type="password" name="confirm_password" size="30" id="confirm_password" maxlength="255" placeholder="Retype your new password..." value="" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?> aria-labelledby="NewPasswordConfirmation" />
			</div>
			<!-- ./ col-sm-9 -->
			</div>
		</div>
		<!-- ./ modal-body -->
		<div class="modal-footer">
			<input type="hidden" name="userId" id="userId">
			<input type="submit" name="changeUserPassword" id="changeUserPassword" class="btn btn-primary" value="Change Password" />
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</form>
		</div>
		<!-- ./ modal-footer -->
	</div>
	<!-- ./ modal-content -->
	</div>
	<!-- ./ modal-dialog modal-lg -->
</div>
<!-- ./ modal fade bs-example-modal-lg -->

			<script>
		$(document).ready(function() {

			$('#pendingUsers').DataTable({
				paging: true,
				searching: true
			});

		});
		</script>

		
		<script>
		$(document).ready(function() {
			$('#allUsers').DataTable;
		});

		$('#editUserModal').on('show.bs.modal', function(e) {
			var $modal = $(this),
				userId = e.relatedTarget.id;

			$.ajax({
				cache: false,
				type: 'POST',
				url: '../<?php echo OCINC ?>/adminActions.php',
				data: {
					'getUserDetails': 'yes',
					'userId': userId
				},                
				success: function(result) {
					data = JSON.parse(result);
					console.log(data);
					$('input[name="name"]').val(data['name']);
					$('input[name="email"]').val(data['email']);
					$('input[name="identifier"]').val(data['identifier']);
					$('input[name="userId"]').val(data['userId']);

					$("#userRole").selectpicker();
					for (var i = 0; i < data['userRole'].length; i++) {
						$('select[name="userRole"] option[value="' + data['userRole'][i] +
							' selected"]').val(1);
					}
					console.log("object: %O", result)
					$('#userRole').selectpicker('refresh');
				},

				error: function(exception) {
					alert('Exeption:' + exception);
				}
			});
		});

		$('#editUserRoleModal').on('show.bs.modal', function(e) {
			var $modal = $(this),
				userId = e.relatedTarget.id;

			$.ajax({
				cache: false,
				type: 'POST',
				url: '../<?php echo OCINC ?>/adminActions.php',
				data: {
					'getUserID': 'yes',
					'userId': userId
				},
				success: function(result) {
					data = JSON.parse(result);
					$('input[name="userId"]').val(data['userId']);

				},

				error: function(exception) {
					alert('Exeption:' + exception);
				}
			});
		});



		$(".delete_group").click(function() {
			var dept_id = $(this).attr("data-dept-id");
			var userId = $(this).attr("data-user-id");
			if (confirm("Are you sure to delete the selected Group?")) {
				$.ajax({
					cache: false,
					type: 'GET',
					url: '../<?php echo OCINC ?>/adminActions.php',
					data: 'dept_id=' + dept_id + '&userId=' + userId,
					success: function(result) {
						//obj = jQuery.parseJSON(result);

						$("#show_group").html(result);
						window.location.href =
							'<?php echo BASE_URL; ?>/oc-admin/userManagement.php';

					}

				});
			}
		});
		</script>


		<script>
		$(document).ready(function() {

			$('#pendingUsers').DataTable({
				paging: false,
				searching: false
			});

		});
		</script>

</body>

</html>