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
permissionDenied();

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
			die("You do not have permission to be here. This has been recorded");

		}

		require_once(__DIR__ . '/../oc-config.php');
		require_once(__DIR__ . '/../oc-functions.php');
		include(__DIR__ . '/./oc-includes/adminActions.php');

		$historyMessage = "";
		if(isset($_SESSION['historyMessage']))
		{
				$historyMessage = $_SESSION['historyMessage'];
				unset($_SESSION['historyMessage']);
		}

?>

<!DOCTYPE html>
<html lang="en">
	<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a rel="noopener" href="javascript:void(0)" class="site_title"><em class="fas fa-lock"></em> <span>Administrator</span></a>
						</div>

						<div class="clearfix"></div>

						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="<?php echo get_avatar() ?>" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome,</span>
								<h2><?php echo $name;?></h2>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /menu profile quick info -->

						<br />

						<?php include "oc-admin-includes/sidebarNav.inc.php"; ?>

						<!-- /menu footer buttons -->
						<a data-toggle="tooltip" data-placement="top" title="Go to Dashboard" href="<?php echo BASE_URL; ?>/dashboard.php">
						<span class="fas fa-clipboard-list" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen" onClick="toggleFullScreen()">
						<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Need Help?" href="https://guides.opencad.io/">
						<span class="fas fa-info-circle" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo BASE_URL; ?>/oc-includes/logout.php?responder=<?php echo $_SESSION['identifier'];?>">
						<span class="fas fa-sign-out-alt" aria-hidden="true"></span>
						</a>
						</div>
						<!-- /menu footer buttons -->
					</div>
				</div>

				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav>
							<div class="nav toggle">
								<a id="menu_toggle"><em class="fas fa-bars"></em></a>
							</div>

							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a rel="noopener" href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<img src="<?php echo get_avatar() ?>" alt=""><?php echo $name;?>
										<span class="fas fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li><a rel="noopener" href="../profile.php"><em class="fas fa-user pull-right"></em>My Profile</a></li>
										<li><a rel="noopener" href="<?php echo BASE_URL; ?>/oc-includes/logout.php"><em class="fas fa-sign-out-alt pull-right"></em> Log Out</a></li>
									</ul>
								</li>


							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->

				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left">
								<h3>Call History</h3>
							</div>
						</div>

						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel" id="historyMessage">
									<div class="x_title">
										<h2>Call History</h2>
										<ul class="nav navbar-right panel_toolbox">
											<li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
											</li>
											<li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
											</li>
										</ul>
										<div class="clearfix"></div>
									</div>
									<!-- ./ x_title -->
									<div class="x_content">
										<?php echo $historyMessage;?>
										 <?php getCallHistory();?>
									</div>
									<!-- ./ x_content -->
								</div>
								<!-- ./ x_panel -->
							</div>
							<!-- ./ col-md-12 col-sm-12 col-xs-12 -->
						</div>
						<!-- ./ row -->
						</div>
					<!-- "" -->
				</div>
				<!-- /page content -->

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						<?php echo COMMUNITY_NAME;?> CAD System
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<? require_once( ABSPATH . OCTHEMEINC ."/scripts.inc.php" ); ?>
		<script>
		$(document).ready(function() {
				$('#callHistory').DataTable({

				});
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
