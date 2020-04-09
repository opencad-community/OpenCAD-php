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
    include_once(__DIR__."/oc-config.php");
    include_once(__DIR__."/oc-functions.php");
    include(__DIR__."/actions/civActions.php");
    include(__DIR__."/actions/publicFunctions.php");
    include(__DIR__."/actions/generalActions.php");

    if (empty($_SESSION['logged_in']))
    {
        header('Location: ./index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
      $uid = $_SESSION['id'];
    }

    $civName = $civDob = $civAddr = "";

    $good911 = "";
    if(isset($_SESSION['good911']))
    {
        $good911 = $_SESSION['good911'];
        unset($_SESSION['good911']);
    }

    $identityMessage = "";
    if(isset($_SESSION['identityMessage']))
    {
        $identityMessage = $_SESSION['identityMessage'];
        unset($_SESSION['identityMessage']);
    }

    $plateMessage = "";
    if(isset($_SESSION['plateMessage']))
    {
        $plateMessage = $_SESSION['plateMessage'];
        unset($_SESSION['plateMessage']);
    }

    $nameMessage = "";
    if(isset($_SESSION['nameMessage']))
    {
        $nameMessage = $_SESSION['nameMessage'];
        unset($_SESSION['nameMessage']);
    }
    $weaponMessage = "";
    if(isset($_SESSION['weaponMessage']))
    {
        $weaponMessage = $_SESSION['weaponMessage'];
        unset($_SESSION['weaponMessage']);
    }

    if(isset($_SESSION['civillian']))
    {

      if ($_SESSION['civillian'] == 'YES')
      {
    	setDispatcher("1");
      }
    }
    else
    {
		echo "You do not have permission to be here. Request access to dispatch through your administration.<br />Redirecting to the dashboard...";
		sleep(5);
		header("Location:".BASE_URL);
		die();
    }

?>

<!DOCTYPE html>
<html lang="en">
	<?php include "./oc-includes/header.inc.php"; ?>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="javascript:void(0)" class="site_title"><i class="fas fa-user"></i> <span>
									Civilian</span></a>
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
						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<h3>General</h3>
								<ul class="nav side-menu">
									<li class="active">
										<a><i class="fas fa-home"></i> Home</a>
										<ul class="nav child_menu" style="display: block;">
											<li class="current-page"><a href="javascript:void(0)">Civilian Dashboard</a>
											</li>
										</ul>
									</li>
									<?php
						   if (CIV_WARRANT === true) { ?> <li>
										<a><i class="fas fa-warning"></i> Warrants <span
												class="fas fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li><a type="button" data-toggle="modal" data-target="#createWarrant">
													Create Warrants</a></li>
											<li><a type="button" data-toggle="modal" data-target="#viewWarrant"> View
													Warrants</a></li>
										</ul>
									</li>
									<?php } else { ?>
									<?php } ?>
									<li><a type="button" data-toggle="modal" data-target="#newCall"> <i
												class="fas fa-phone"></i> Create a Call</a></li>
									<?php
				if ( CIV_LIMIT_MAX_IDENTITIES == 0 ) {
					echo '<li><a type="button" data-toggle="modal" data-target="#createIdentityModal"><i class="fas fa-user-alt"></i> Add New Identity</a></li>';
				} else if ( CIV_LIMIT_MAX_IDENTITIES > getNumberOfProfiles() ) {
					echo '<li><a type="button" data-toggle="modal" data-target="#createIdentityModal"><i class="fas fa-user-alt"></i> Add New Identity</a></li>';
				} else {/* Do Nothing. */}
				if ( CIV_LIMIT_MAX_VEHICLES == 0 ) {
					echo '<li><a type="button" data-toggle="modal" data-target="#createPlateModal"> <i class="fas fa-car"></i> Add New Plate</a></li>';
				} else if ( CIV_LIMIT_MAX_VEHICLES > getNumberOfVehicles() ) {
					echo '<li><a type="button" data-toggle="modal" data-target="#createPlateModal"> <i class="fas fa-car"></i> Add New Plate</a></li>';
				} else {/* Do Nothing. */}
				if ( CIV_LIMIT_MAX_WEAPONS == 0 ) {
					echo '<li><a type="button" data-toggle="modal" data-target="#createWeaponModal">Add New Weapon</a></li>';
				} else if ( CIV_LIMIT_MAX_WEAPONS > getNumberOfWeapons() ) {
					echo '<li><a type="button" data-toggle="modal" data-target="#createWeaponModal">Add New Weapon</a></li>';
				} else {/* Do Nothing. */}
			?>
								</ul>
							</div>
							<!-- ./ menu_section -->
						</div>
						<!-- /sidebar menu -->
						<!-- /menu footer buttons -->
						<div class="sidebar-footer hidden-small">
							<a data-toggle="tooltip" data-placement="top" title="Go to Dashboard"
								href="<?php echo BASE_URL; ?>/dashboard.php">
								<span class="fas fa-clipboard-list" aria-hidden="true"></span>
							</a>
							<a data-toggle="tooltip" data-placement="top" title="FullScreen"
								onClick="toggleFullScreen()">
								<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
							</a>
							<a data-toggle="tooltip" data-placement="top" title="Need Help?"
								href="https://guides.opencad.io/">
								<span class="fas fa-info-circle" aria-hidden="true"></span>
							</a>
							<a data-toggle="tooltip" data-placement="top" title="Logout"
								href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>">
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
								<a id="menu_toggle"><i class="fas fa-bars"></i></a>
							</div>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
										aria-expanded="false">
										<img src="<?php echo get_avatar() ?>" alt=""><?php echo $_SESSION['name']; ?>
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li><a href="<?php echo BASE_URL; ?>/profile.php"><i
													class="fas fa-user pull-right"></i> My Profile</a></li>
										<li><a
												href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>"><i
													class="fas fa-sign-out-alt pull-right"></i> Log Out</a></li>
										<span class="glyphicon glyphicon-log">
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
								<h3>Civilian Console</h3>
								<p>(Not <?php echo $name;?>?, <a
										href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>">Log
										Out</a>)
									<?php echo $good911;?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel" id="name_panel">
									<div class="x_title">
										<h2>My Identities</h2>
										<ul class="nav navbar-right panel_toolbox">
											<li><a class="collapse-link"><i class="fasfa-chevron-up"></i></a>
											</li>
											<li><a class="close-link"><i class="fasfa-close"></i></a>
											</li>
										</ul>
										<div class="clearfix"></div>
									</div>
									<!-- ./ x_title -->
									<div class="x_content">
										<?php echo $nameMessage;?>
										<?php echo $identityMessage;?>
										<?php ncicGetNames();?>
									</div>
									<!-- ./ x_content -->
									<!-- ./ x_panel -->
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel" id="plate_panel">
									<div class="x_title">
										<h2>My Vehicles</h2>
										<ul class="nav navbar-right panel_toolbox">
											<li><a class="collapse-link"><i class="fasfa-chevron-up"></i></a>
											</li>
											<li><a class="close-link"><i class="fasfa-close"></i></a>
											</li>
										</ul>
										<div class="clearfix"></div>
									</div>
									<!-- ./ x_title -->
									<div class="x_content">
										<?php echo $plateMessage;?>
										<?php ncicGetPlates();?>
									</div>
									<!-- ./ x_content -->
								</div>
								<!-- ./ x_panel -->
							</div>
							<!-- ./ col-md-12 col-sm-12 col-xs-12 -->
						</div>
						<div class="clearfix"></div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel" id="plate_panel">
									<div class="x_title">
										<h2>My Weapons</h2>
										<ul class="nav navbar-right panel_toolbox">
											<li><a class="collapse-link"><i class="fasfa-chevron-up"></i></a>
											</li>
											<li><a class="close-link"><i class="fasfa-close"></i></a>
											</li>
										</ul>
										<div class="clearfix"></div>
									</div>
									<!-- ./ x_title -->
									<div class="x_content">
										<?php echo $weaponMessage;?>
										<?php ncicGetWeapons();?>
									</div>
									<!-- ./ x_content -->
								</div>
								<!-- ./ x_panel -->
							</div>
							<!-- ./ col-md-12 col-sm-12 col-xs-12 -->
						</div>
						<!-- ./ row -->
						<!-- ./ row -->
						<!-- ./ col-md-6 col-sm-6 col-xs-6 -->

					</div>
					<!-- ./ row -->
				</div>
				<!-- "" -->
			</div>
			<!-- /page content -->
			<!-- footer content -->
			<footer>
				<div class="pull-right">
					<?php echo COMMUNITY_NAME;?> CAD System | <?php pageLoadTime(); ?>
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
		</div>
		<!-- modals -->

		<!-- Create 911 Call Modal -->
		<div class="modal fade" id="newCall" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span
								aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Create Call</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form id="new_911" method="post" action="<?php echo BASE_URL; ?>/actions/civActions.php">
							<div class="form-group row">
								<label class="col-md-2 control-label">Caller Name</label>
								<div class="col-md-10">
									<input type="text" name="911_caller" class="form-control" id="911_caller"
										required />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group row -->
							<div class="form-group row">
								<label class="col-md-2 control-label">Location</label>
								<div class="col-md-10">
									<input type="text" name="911_location" class="form-control" id="911_location"
										required />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group row -->
							<div class="form-group row">
								<label class="col-md-2 control-label"><span>Description <a data-toggle="modal"
											href="#911CallHelpModal"><i
												class="fasfa-question-circle"></i></a></span></label>
								<div class="col-md-10">
									<textarea id="911_description" name="911_description" class="form-control"
										style="resize:none;" rows="4"></textarea>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group row -->
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="new_911" value="Submit 911 Call" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>

		<!-- Create Warrant Modal -->
		<div class="modal fade" id="createWarrant" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span
								aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Warrant Creator</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/actions/civActions.php" method="post">
							<div class="form-group row">
								<label class="col-lg-2 control-label">Civilian Name</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="civilian_names" id="civilian_names"
										data-live-search="true" required>
										<option> </option>
										<?php getCivilianNamesOwn();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Warrant Name</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="warrant_name_sel" id="warrant_name_sel" data-live-search="true" title="Select a Warrant">
									<?php getDataSetTable($dataSet = "warrant_types", $column1 = "id", $column2 = "warrant_description", $leadTrim = 17, $followTrim = 11, $isVeh="", $isRegistration=""); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Issuing Agency</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="issuing_agency" id="issuing_agency" data-live-search="true" required>
										<?php getDataSetTable($dataSet = "departments", $column1 = "department_long_name", $column2 = "department_short_name", $leadTrim = 17, $followTrim = 11, $isVeh, $isRegistration); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->

					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<input name="create_warrant" type="submit" class="btn btn-primary" value="Create" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>

		<!-- View Warrant Modal -->
		<div class="modal fade" id="viewWarrant" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span
								aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Warrant Viewer</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel" id="citation_panel">
								<div class="x_title">
									<h2>NCIC Warrants</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fasfa-chevron-up"></i></a>
										</li>
										<li><a class="close-link"><i class="fasfa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<!-- ./ x_title -->
								<div class="x_content">
									<?php ncic_warrants();?>
								</div>
								<!-- ./ x_content -->
							</div>
							<!-- ./ x_panel -->
						</div>
						<!-- ./ form-group -->
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>

		<div class="modal fade" id="createIdentityModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Create Identity</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/actions/civActions.php" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input name="civNameReq" class="form-control" id="civNameReq"value="<?php echo $civName;?>" required />
									<span class="fasfa-user form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Date of Birth</label>
								<div class="col-lg-10">
									<input type="text" name="civDobReq" class="form-control" id="datepicker" maxlength="10" value="<?php echo $civDob;?>" required />
									<span class="fasfa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Address</label>
								<div class="col-lg-10">
									<input type="text" name="civAddressReq" class="form-control" id="civAddressReq" value="<?php echo $civAddr;?>" required />
									<span class="fasfa-location-arrow form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Sex</label>
								<div class="col-lg-10">
									<select name="civSexReq" class="form-control selectpicker" id="civSexReq"
										title="Select a sex" data-live-search="true" required>
										<?php getDataSetColumn($table = "ncic_names", $data = "gender", $leadTrim = 11, $followTrim = 16); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Race</label>
								<div class="col-lg-10">
									<select name="civRaceReq" class="form-control selectpicker civRaceReq_picker" id="civRaceReq" title="Select a race or ethnicity" data-live-search="true" required>
										<?php getDataSetColumn($table = "ncic_names", $data = "race", $leadTrim = 9, $followTrim = 19); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->	
							<div class="form-group row">
								<label class="col-lg-2 control-label">Hair Color</label>
								<div class="col-lg-10">
									<select name="civHairReq" class="form-control selectpicker civHairReq_picker" id="civHairReq"
										title="Select a hair color" required>
										<?php getDataSetColumn($table = "ncic_names", $data = "hair_color", $leadTrim = 15, $followTrim = 20); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Build</label>
								<div class="col-lg-10">
									<select name="civBuildReq" class="form-control selectpicker civBuildReq_picker" id="civBuildReq" title="Select a build" required>
										<?php getDataSetColumn($table = "ncic_names", $data = "build", $leadTrim = 20, $followTrim = 25); ?>
									</select>
									<!-- ./ col-sm-9 -->
								</div>
								<!-- ./ form-group -->
							</div>
							<!-- ./ modal-body -->
							<div class="modal-footer">
								<input name="create_name" type="submit" class="btn btn-primary" value="Create" />
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		</div>
		<!--Edit modal -->
		<div class="modal fade" id="editIdentityModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Edit Identity</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/actions/civActions.php"
							class="editname_modalform" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input name="civNameReq" class="form-control civNameReq" id="civNameReq" value="<?php echo $civName;?>" required />
									<span class="fasfa-user form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Date of Birth</label>
								<div class="col-lg-10">
									<input type="text" name="civDobReq" class="form-control civDobReq" id="datepicker2" maxlength="10" value="<?php echo $civDob;?>" readonly />
									<span class="fasfa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Address</label>
								<div class="col-lg-10">
									<input type="text" name="civAddressReq" class="form-control civAddressReq" id="civAddressReq" value="<?php echo $civAddr;?>" required />
									<span class="fasfa-location-arrow form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Sex</label>
								<div class="col-lg-10">
									<select name="civSexReq" class="form-control selectpicker selectpicker3" id="civSexReq" title="Select a sex" data-live-search="true" required>
										<?php getDataSetColumn($table = "ncic_names", $data = "gender", $leadTrim = 11, $followTrim = 16); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Race</label>
								<div class="col-lg-10">
									<select name="civRaceReq" class="form-control selectpicker civRaceReq_picker" id="civRaceReq" title="Select a race or ethnicity" data-live-search="true" required>
										<?php getDataSetColumn($table = "ncic_names", $data = "race", $leadTrim = 9, $followTrim = 19); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Hair Color</label>
								<div class="col-lg-10">
									<select name="civHairReq" class="form-control selectpicker civHairReq_picker" id="civHairReq" title="Select a hair color" required>
										<?php getDataSetColumn($table = "ncic_names", $data = "hair_color", $leadTrim = 15, $followTrim = 20); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Build</label>
								<div class="col-lg-10">
									<select name="civBuildReq" class="form-control selectpicker civBuildReq_picker"id="civBuildReq" title="Select a build" required>
										<?php getDataSetColumn($table = "ncic_names", $data = "build", $leadTrim = 20, $followTrim = 25); ?>
									</select>
									<!-- ./ col-sm-9 -->
								</div>
								<!-- ./ form-group -->

							</div>

							</div>
							<!-- ./ modal-body -->
							<div class="modal-footer">
								<input type="hidden" name="Edit_id" value="" class="Editdataid" />
								<input name="edit_name" type="submit" class="btn btn-primary" value="Edit" />
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		</div>
		<!-- ./ modal fade bs-example-modal-lg -->

		<div class="modal fade" id="createPlateModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Add Plate to Database</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/actions/civActions.php" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Registered Owner</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" required>
										<option> </option>
										<?php getCivilianNamesOwn();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">License Plate</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="veh_plate" required />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Make-Model</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="veh_make_model" id="veh_make_model" data-live-search="true" required>
									<?php getDataSetTable($dataSet = "vehicles", $column1 = "Make", $column2 = "Model", $leadTrim = 17, $followTrim = 11, $isRegistration = false, $isVehicle = true); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Primary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="veh_pcolor" data-live-search="true"
										required>
										<option val=""> </option>
										<?php getDataSetTable($data = "colors", $column1 = "color_group", $column2 = "color_name", $leadTrim = 17, $followTrim = 22, $veh, $isRegistration); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Secondary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="veh_scolor" data-live-search="true"
										required>
										<option val=""> </option>
										<?php getDataSetTable($data = "colors", $column1 = "color_group", $column2 = "color_name", $leadTrim = 17, $followTrim = 22, $veh, $isRegistration); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
														<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle's Registered State</label>
								<div class="col-lg-10">
									<select class="form-control veh_reg_state_option" name="veh_reg_state" required>
										<option></option>
										<?php getDataSetColumn($table = "ncic_plates", $data = "veh_reg_state", $leadTrim = 18, $followTrim = 22); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Notes</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="notes" />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<input name="create_plate" type="submit" class="btn btn-primary" value="Create" />
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
		<!-- Edit Plate Modal -->
		<div class="modal fade" id="editPlateModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Edit Plate in Database</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/actions/civActions.php" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Registered Owner</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker civilian_names_picker"
										name="civilian_names" id="civilian_names" data-live-search="true" required>
										<?php getCivilianNamesOwn();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">License Plate</label>
								<div class="col-lg-10">
									<input type="text" class="form-control veh_plate" name="veh_plate" required />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Make-Model</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker veh_make_model" name="veh_make_model" id="veh_make_model" data-live-search="true" required>
									<?php getDataSetTable($dataSet = "vehicles", $column1 = "Make", $column2 = "Model", $leadTrim = 17, $followTrim = 11, $isRegistration = false, $isVehicle = true); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Primary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker veh_pcolor" name="veh_pcolor" data-live-search="true" required>
									<?php getDataSetTable($data = "colors", $column1 = "color_group", $column2 = "color_name", $leadTrim = 17, $followTrim = 22, $veh = false, $isRegistration = false); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Secondary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker veh_scolor" name="veh_scolor" data-live-search="true" required>
									<?php getDataSetTable($data = "colors", $column1 = "color_group", $column2 = "color_name", $leadTrim = 17, $followTrim = 22, $veh, $isRegistration); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Notes</label>
								<div class="col-lg-10">
									<input type="text" class="form-control notes" name="notes" />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle's Registered State</label>
								<div class="col-lg-10">
									<select class="form-control veh_reg_state_option" name="veh_reg_state" required>
									<?php getDataSetColumn($table = "ncic_plates", $data = "veh_reg_state", $leadTrim = 18, $followTrim = 22); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<input type="hidden" class="editplateid" name="Edit_plateId" />
						<input name="edit_plate" type="submit" class="btn btn-primary" value="Edit" />
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
		<!-- modals -->
		<div class="modal fade" id="createWeaponModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Add Weapon to Database</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/actions/civActions.php" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Registered Owner</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="civilian_names" id="civilian_names"
										data-live-search="true" required>
										<option> </option>
										<?php getCivilianNamesOwn();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Weapon Type-Name</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="weapon_all" id="weapon_all" data-live-search="true" required>
										<option> </option>
										<?php getDataSetTable($data = "weapons", $column1 = "weapon_type", $column2 = "weapon_name", $leadTrim = 17, $followTrim = 22, $veh, $isRegistration); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Notes</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="weapon_notes" />
								</div>
							</div>
							<!-- ./ modal-body -->
							<div class="modal-footer">
								<input name="create_weapon" type="submit" class="btn btn-primary" value="Create" />
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

		<!-- 911 Call Help Modal -->
		<div class="modal fade" id="911CallHelpModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">How to Submit a 911 Call</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<span>
							<p><b>Where, What, Who, When, How, Why if available are the primary things to provide to a
									911 dispatcher.</b></p>
							<p>Some things to consider reporting:</p>
							<p>
								<ul>
									<li>Your name</li>
									<li>Address responders need to go to</li>
									<li>Any weapons?</li>
									<li>Age of suspect(s) or victim(s)</li>
									<li>Height and Weight of suspect(s)</li>
									<li>Clothing description of suspect(s)</li>
									<li>Drug use (current or past, includes perscription medications) of any victim(s)
									</li>
									<li>Any prior violent behavior</li>
									<li>Any prior information about psychosis, delusions, hallucinations or other mental
										health considerations</li>
								</ul>
							</p>
						</span>
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		<!-- ./ modal fade bs-example-modal-lg -->
		<?php include "./oc-includes/jquery-colsolidated.inc.php"; ?>
		<script>
		$('#civilianDetailsModal').on('show.bs.modal', function(e) {
			var $modal = $(this),
				civId = e.relatedTarget.id;


			$.ajax({
				cache: false,
				type: 'GET',
				url: './actions/civActions.php',
				data: {
					'getCivilianDetails': 'yes',
					'name_id': civId
				},
				success: function(result) {
					console.log(result);
					data = JSON.parse(result);

					$('input[name="civName"]').val(data['name']);
					$('input[name="civDob"]').val(data['dob']);
					$('input[name="civAddress"]').val(data['address']);
					$('input[name="civSex"]').val(data['sex']);
					$('input[name="civRace"]').val(data['race']);
					$('input[name="civHair"]').val(data['hair_color']);
					$('input[name="civBuild"]').val(data['build']);
					$('input[name="civPlate"]').val(data['veh_plate']);
					$('input[name="civMake"]').val(data['veh_make']);
					$('input[name="civModel"]').val(data['veh_model']);
					$('input[name="civColor"]').val(data['veh_color']);


				},

				error: function(exception) {
					alert('Exeption:' + exception);
				}
			});
		});
		</script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>jQuery UI Datepicker - Default functionality</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script>
		$(function() {
			$("#datepicker").datepicker({
				dateFormat: 'yy-mm-dd'
			});
		});


		// Edit Name
		$(function() {
			$(document).on('click', '#edit_nameBtn', function(e) {
				e.preventDefault();
				var edit_id = $(this).data('id');
				console.log(edit_id);
				$.ajax({
						url: '<?php echo BASE_URL; ?>/actions/civActions.php',
						type: 'POST',
						data: 'editid=' + edit_id,
						dataType: 'json',
						cache: false
					})
					.done(function(data) {
						console.log(data.address);
						$('.civNameReq').val(data.name);
						$('.civDobReq').val(data.dob);
						/*$('.civDobReq_picker').datepicker({
							dateFormat: 'yyyy-mm-dd'
						}).datepicker('setDate', new Date(data.dob));*/
						$('.civAddressReq').val(data.address);
						$('.selectpicker3').selectpicker('val', data.gender);
						$('.civRaceReq_picker').selectpicker('val', data.race);
						$('.civDL_picker').selectpicker('val', data.dl_status);
						$('.civHairReq_picker').selectpicker('val', data.hair_color);
						$('.civBuildReq_picker').selectpicker('val', data.build);
						$('.civWepStat_picker').selectpicker('val', data.weapon_permit);
						$('.civDec_picker').selectpicker('val', data.deceased);
						$('#IdentityEditModal .Editdataid').val(data.id);
					});

			})
			/* Edit Plate */
			$(document).on('click', '#edit_plateBtn', function(e) {
				e.preventDefault();
				var edit_id = $(this).data('id');
				console.log(edit_id);
				$.ajax({
						url: '<?php echo BASE_URL; ?>/actions/civActions.php',
						type: 'POST',
						data: 'edit_plateid=' + edit_id,
						dataType: 'json',
						cache: false
					})
					.done(function(data) {
						$('.civilian_names').selectpicker('val', data.name_id);
						$('.veh_plate').val(data.veh_plate);
						$('.veh_makemodel').selectpicker('val', data.veh_make + ' ' + data
							.veh_model);
						$('.veh_pcolor').selectpicker('val', data.veh_pcolor);
						$('.veh_scolor').selectpicker('val', data.veh_scolor);
						$('.notes').val(data.notes);
						$('.veh_reg_state').val(data.veh_reg_state);
						$('.editplateid').val(data.id);
					});
			});
		})
		</script>
	</body>

</html>