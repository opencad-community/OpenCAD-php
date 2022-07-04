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
		require_once('../oc-config.php');
		require_once( ABSPATH . '/oc-functions.php');
		require_once( ABSPATH . "/oc-includes/generalActions.php");
		require_once( ABSPATH . "/oc-includes/profileActions.php");

		if (empty($_SESSION['logged_in']))
		{
				header('Location: ../index.php');
				die("Not logged in");
		}
		else
		{
			$name = $_SESSION['name'];
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

		$profileUpdate = "";
		if (isset($_SESSION['profileUpdate']))
		{
			$profileUpdate = $_SESSION['profileUpdate'];
			unset($_SESSION['profileUpdate']);
		}
		
		setDispatcher("1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>


<body class="app header-fixed">

		<header class="app-header navbar">
			<?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/topProfile.inc.php"); ?>
		</header>

			<div class="app-body">
				<main class="main">
				<div class="breadcrumb" />
				<div class="container-fluid">
					<div class="animated fadeIn">
						<div class="card">
							<div class="card-header">
								<em class="fa fa-align-justify"></em> <?php echo lang_key("MY_PROFILE"); ?>
					</div>
				<div class="card-body">
					<?php echo $profileUpdate ?>
									<form action="<?php echo BASE_URL; ?>/oc-includes/profileActions.php" method="post" class="form-horizontal">
									<fieldset>
										<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo lang_key("NAME"); ?></label>
						<div class="col-sm-10">
							<input name="name" class="form-control" type="text" maxlength="255" value="<?php echo $name;?>" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?>>
						</div>
												<!-- ./ col-sm-10 -->
										</div>
										<!-- ./ form-group -->
										<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo lang_key("EMAIL"); ?></label>
												<div class="col-sm-10">
														<input name="email" class="form-control" type="email" maxlength="255" value="<?php echo $_SESSION['email'];?>" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?>>
														<span class="muted">Note: Your email is how you login, so make sure it's valid!</span>
												</div>
												<!-- ./ col-sm-10 -->
										</div>
										<!-- ./ form-group -->
										<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo lang_key("IDENTIFIER"); ?></label>
												<div class="col-sm-10">
														<input name="identifier" class="form-control" type="text" maxlength="255" value="<?php echo $_SESSION['identifier'];?>" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?>>
												</div>
												<!-- ./ col-sm-10 -->
										</div>
										<?php if ( DEMO_MODE == false ) {?>
										<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo lang_key("PASSWORD"); ?></label>
												<div class="col-sm-10">
														<a rel="noopener" class="btn btn-primary" data-toggle="modal" data-target="#changePassword" ?><?php echo lang_key("CHANGE_PASSWORD"); ?></a>
												</div>
												<!-- ./ col-sm-10 -->
										</div>
									<?php } ?>
										<!-- ./ form-group -->
										<input name="update_profile_btn" type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo lang_key("UPDATE"); ?>" <?php if ( DEMO_MODE == true ) {?> disabled <?php } ?>/>
									</fieldset>
									</form>
						</div>
						<!-- /.card-->
				</main>

				</div>
			</div>
			<?php require_once ( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/footer.inc.php"); ?>


		<!-- modals -->

		<!-- Change Password -->
		<div class="modal" id="changePassword" tabindex="-1" role="dialog" aria-hidden="true">
			 <div class="modal-dialog modal-lg">
					<div class="modal-content">
						 <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Change Password</h4>
								<button type="button" class="close" data-dismiss="modal" id="closeChangePassword"><span aria-hidden="true">×</span>
								</button>
					
				</div>
				<!-- ./ modal-header -->
				<div class="modal-body">
					<form role="form" action="<?php BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/oc-includes/profileActions.php" method="post">
						<div class="form-group row">
							<label class="col-lg-2 control-label"><?php echo lang_key("PASSWORD"); ?></label>
							<div class="col-lg-10">
						<input class="form-control" type="password" name="password" id="password" size="30" maxlength="255" placeholder="<?php echo lang_key("PASSWORD"); ?>" value="" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?> />
							</div>
							<!-- ./ col-sm-9 -->
						</div>
						<div class="form-group row">
							<label class="col-lg-2 control-label"><?php echo lang_key("CONFIRM_PASSWORD"); ?></label>
							<div class="col-lg-10">
				<input class="form-control" type="password" name="confirm_password" size="30" id="confirm_password" maxlength="255" placeholder="<?php echo lang_key("CONFIRM_PASSWORD"); ?>" value="" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?> />
							</div>
							<!-- ./ col-sm-9 -->
						</div>
				</div>
				<!-- ./ modal-body -->
				<div class="modal-footer">
							<input type="submit" name="changePassword" id="changePassword" class="btn btn-primary" value="Change Password" />
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
		<?php
		require_once( ABSPATH . OCTHEMEINC ."/scripts.inc.php" );  ?>
</body>


</html>
