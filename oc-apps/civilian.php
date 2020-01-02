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
    require_once( ABSPATH . '/oc-settings.php');
    require_once( ABSPATH . "/" . OCINC . '/civActions.php');
    require_once( ABSPATH . "/" . OCINC . '/generalActions.php');
    require_once( ABSPATH . "/" . OCINC . '/publicFunctions.php');

    if (empty($_SESSION['logged_in']))
    {
        header('Location: ../index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/header.inc.php"); ?>


<body class="app header-fixed">

    <header class="app-header navbar">
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/images/tail.png" width="30" height="25" alt="OpenCAD Logo">
      </a>
      
      <?php include( ABSPATH . "oc-includes/civNav.inc.php"); ?>
      <?php include( ABSPATH . "oc-includes/topProfile.inc.php"); ?>
      
    </header>

	<div class="app-body">
		<main class="main">
			<div class="breadcrumb" />
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<i class="fa fa-align-justify"></i> <?php echo lang_key("MY_IDENTITIES"); ?>
						</div>
<<<<<<< HEAD
                        <div class="card-body">
							<?php echo $nameMessage, $identityMessage;?>
							<?php ncicGetNames();?>
                        </div>
                        <!-- /.row-->
                    </div>
                </div>
            <!-- /.card-->
            </div>
=======
              			<div class="card-body">
							<?php echo $nameMessage;?>
							<?php echo $identityMessage;?>
							<?php ncicGetNames();?>
		                </div>
        	        	<!-- /.row-->
						
		            </div>
        	    </div>
            <!-- /.card-->
			</div>
>>>>>>> Ignored web.config and removed sql.php.

			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<i class="fa fa-align-justify"></i> <?php echo lang_key("MY_VEHICLES"); ?>
						</div>
              			<div class="card-body">
							<?php echo $plateMessage;?>
							<?php ncicGetPlates();?>
		                </div>
        	        	<!-- /.row-->
						
		            </div>
        	    </div>
            <!-- /.card-->
			</div>

			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<i class="fa fa-align-justify"></i> <?php echo lang_key("MY_WEAPONS"); ?>
						</div>
              			<div class="card-body">
							<?php echo $weaponMessage;?>
							<?php ncicGetWeapons();?>
		                </div>
        	        	<!-- /.row-->
						
		            </div>
        	    </div>
            <!-- /.card-->
			</div>

        </main>

        </div>
      </div>
        <footer class="app-footer">
        <div>
            <a href="https://opencad.io">OpenCAD</a>
            <span>&copy; 2017 <?php echo date("Y"); ?>.</span>
        </div>
        <div class="ml-auto">

        </div>
    
        </footer>

<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> Ignored web.config and removed sql.php.
    <?php
    include ( ABSPATH . "/" . OCCONTENT . "/themes/". THEME . "/modals/civilian.modals.inc.php");
    include ( ABSPATH . "/oc-includes/jquery-colsolidated.inc.php"); ?>
</body>
<<<<<<< HEAD

            <script type="text/javascript"
        src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
    </script>
=======
<<<<<<< HEAD
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

						<!-- /sidebar menu -->
						<!-- /menu footer buttons -->
						<div class="sidebar-footer hidden-small">
							<!--
                        —— Left in for user settings. To be introduced later. Probably after RC1. ——
                        <a data-toggle="tooltip" data-placement="top">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>-->
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
								href="<?php echo BASE_URL; ?>/oc-includes/logout.php?responder=<?php echo $_SESSION['identifier'];?>">
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
												href="<?php echo BASE_URL; ?>/oc-includes/logout.php?responder=<?php echo $_SESSION['identifier'];?>"><i
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
										href="<?php echo BASE_URL; ?>/oc-includes/logout.php?responder=<?php echo $_SESSION['identifier'];?>">Log
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
						<form id="new_911" method="post" action="<?php echo BASE_URL .'/'. OCINC ?>/civActions.php">
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
						<form role="form" action="<?php echo BASE_URL .'/'. OCINC ?>/civActions.php" method="post">
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
									<select class="form-control selectpicker" name="warrant_name_sel"
										id="warrant_name_sel" data-live-search="true" title="Select a Warrant">
										<optgroup label="Violent Warrants (60 day expiry)">
											<option value="1st Degree Murder">1st Degree Murder</option>
											<option value="2nd Degree Murder">2nd Degree Murder</option>
											<option value="3rd Degree Murder">3rd Degree Murder</option>
											<option value="Attempted Murder">Attempted Murder</option>
											<option value="Kidnapping">Kidnapping</option>
											<option value="Attempted Kidnapping">Attempted Kidnapping</option>
											<option value="Hostage Taking">Hostage Taking</option>
											<option value="Bank/Fed Robbery">Bank/Fed Robbery</option>
											<option value="Terroristic Activity">Terroristic Activity</option>
											<option value="Terroristic Threats">Terroristic Threats</option>
											<option value="JailBreak">JailBreak</option>
											<option value="Robbery">Robbery</option>
											<option value="Grand Theft Auto">Grand Theft Auto</option>
											<option value="Burglary">Burglary</option>
											<option value="Threatening an Official">Threatening an Official</option>
											<option value="Sexual Assault">Sexual Assault</option>
											<option value="Hate Crime">Hate Crime</option>
											<option value="Assault">Assault</option>
											<option value="Conspiracy">Conspiracy</option>
											<option value="Drug Trafficking">Drug Trafficking</option>
											<option value="Evasion/Fleeing/Eluding">Evasion/Fleeing/Eluding</option>
											<option value="Felony Evading">Felony Evading</option>
											<option value="Resisting Arrest">Resisting Arrest</option>
											<option value="Firearm in City Limits">Firearm in City Limits</option>
											<option value="Firearm by Felon">Firearm by Felon</option>
											<option value="Unlicensed Firearm">Unlicensed Firearm</option>
											<option value="Firearm Discharge in City Limits">Firearm Discharge in City
												Limits</option>
											<option value="Illegal Weapon">Illegal Weapon</option>
											<option value="Illegal Magazine">Illegal Magazine</option>
											<option value="Concealed Carry Rifle">Concealed Carry Rifle</option>
											<option value="Failure to Inform">Failure to Inform</option>
										</optgroup>
										<optgroup label="Non-Violent Warrants (30 day expiry)">
											<option value="FTA: Lewd Conduct">FTA: Lewd Conduct</option>
											<option value="FTA: DUI/DWI">FTA: DUI/DWI</option>
											<option value="FTA: Fraud">FTA: Fraud</option>
											<option value="FTA: Hit and Run">FTA: Hit and Run</option>
											<option value="FTA: Speeding">FTA: Speeding</option>
											<option value="FTA: Reckless Driving">FTA: Reckless Driving</option>
											<option value="FTA: Obstruction of Justice">FTA: Obstruction of Justice
											</option>
											<option value="FTA: Verbal Abuse">FTA: Verbal Abuse</option>
											<option value="FTA: Bribery">FTA: Bribery</option>
											<option value="FTA: Disorderly Conduct">FTA: Disorderly Conduct</option>
											<option value="FTA: Drug Posession">FTA: Drug Posession</option>
											<option value="FTA: Trespassing">FTA: Trespassing</option>
											<option value="FTA: Excessive Noise">FTA: Excessive Noise</option>
											<option value="FTA: Failure to Identify">FTA: Failure to Identify</option>
											<option value="FTA: Stalking">FTA: Stalking</option>
											<option value="FTA: Public Intoxication">FTA: Public Intoxication</option>
										</optgroup>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Issuing Agency</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="issuing_agency" id="issuing_agency"
										data-live-search="true" required>
										<?php getAgencies();?>
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
									<?php ncicGetWarrants();;?>
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

		<div class="modal fade" id="IdentityModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Create Identity</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL .'/'. OCINC ?>/civActions.php" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input name="civNameReq" class="form-control" id="civNameReq"
										value="<?php echo $civName;?>" required />
									<span class="fasfa-user form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Date of Birth</label>
								<div class="col-lg-10">
									<input type="text" name="civDobReq" class="form-control" id="datepicker"
										maxlength="10" value="<?php echo $civDob;?>" required />
									<span class="fasfa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Address</label>
								<div class="col-lg-10">
									<input type="text" name="civAddressReq" class="form-control" id="civAddressReq"
										value="<?php echo $civAddr;?>" required />
									<span class="fasfa-location-arrow form-control-feedback right"
										aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Sex</label>
								<div class="col-lg-10">
									<select name="civSexReq" class="form-control selectpicker" id="civSexReq"
										title="Select a sex" data-live-search="true" required>
										<?php getGenders();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Race</label>
								<div class="col-lg-10">
									<select name="civRaceReq" class="form-control selectpicker" id="civRaceReq"
										title="Select a race or ethnicity" data-live-search="true" required>
										<?php getRaces(); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Hair Color</label>
								<div class="col-lg-10">
									<select name="civHairReq" class="form-control selectpicker" id="civHairReq"
										title="Select a hair color" required>
										<option val="bld">Bald</option>
										<option val="blk">Black</option>
										<option val="bln">Blonde</option>
										<option val="blu">Blue</option>
										<option val="bro">Brown</option>
										<option val="gry">Gray or Partially Gray</option>
										<option val="grn">Green</option>
										<option val="ong">Orange</option>
										<option val="pnk">Pink</option>
										<option val="ple">Purple</option>
										<option val="red">Red or Auburn</option>
										<option val="sdy">Sandy</option>
										<option val="stw">Strawberry</option>
										<option val="whi">White</option>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Build</label>
								<div class="col-lg-10">
									<select name="civBuildReq" class="form-control selectpicker" id="civBuildReq"
										title="Select a build" required>
										<option val="Average">Average</option>
										<option val="Fit">Fit</option>
										<option val="Muscular">Muscular</option>
										<option val="Overweight">Overweight</option>
										<option val="Skinny">Skinny</option>
										<option val="Thin">Thin</option>
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
		<div class="modal fade" id="IdentityEditModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Edit Identity</h4>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL .'/'. OCINC ?>/civActions.php"
							class="editname_modalform" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input name="civNameReq" class="form-control" id="civNameReq"
										value="<?php echo $civName;?>" required />
									<span class="fasfa-user form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Date of Birth</label>
								<div class="col-lg-10">
									<input type="text" name="civDobReq" class="form-control" id="datepicker2"
										maxlength="10" value="<?php echo $civDob;?>" required />
									<span class="fasfa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Address</label>
								<div class="col-lg-10">
									<input type="text" name="civAddressReq" class="form-control" id="civAddressReq"
										value="<?php echo $civAddr;?>" required />
									<span class="fasfa-location-arrow form-control-feedback right"
										aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Sex</label>
								<div class="col-lg-10">
									<select name="civSexReq" class="form-control selectpicker selectpicker3"
										id="civSexReq" title="Select a sex" data-live-search="true" required>
										<?php getGenders();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Race</label>
								<div class="col-lg-10">
									<select name="civRaceReq" class="form-control selectpicker" id="civRaceReq"
										title="Select a race or ethnicity" data-live-search="true" required>
										<?php getRaces(); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Hair Color</label>
								<div class="col-lg-10">
									<select name="civHairReq" class="form-control selectpicker civHairReq_picker"
										id="civHairReq" title="Select a hair color" required>
										<option val="bld">Bald</option>
										<option val="blk">Black</option>
										<option val="bln">Blonde</option>
										<option val="blu">Blue</option>
										<option val="bro">Brown</option>
										<option val="gry">Gray or Partially Gray</option>
										<option val="grn">Green</option>
										<option val="ong">Orange</option>
										<option val="pnk">Pink</option>
										<option val="ple">Purple</option>
										<option val="red">Red or Auburn</option>
										<option val="sdy">Sandy</option>
										<option val="stw">Strawberry</option>
										<option val="whi">White</option>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Build</label>
								<div class="col-lg-10">
									<select name="civBuildReq" class="form-control selectpicker civBuildReq_picker"
										id="civBuildReq" title="Select a build" required>
										<option val="Average">Average</option>
										<option val="Fit">Fit</option>
										<option val="Muscular">Muscular</option>
										<option val="Overweight">Overweight</option>
										<option val="Skinny">Skinny</option>
										<option val="Thin">Thin</option>
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
						<form role="form" action="<?php echo BASE_URL .'/'. OCINC ?>/civActions.php" method="post">
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
									<select class="form-control selectpicker" name="veh_make_model" id="veh_make_model"
										data-live-search="true" required>
										<option> </option>
										<?php getVehicle();?>
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
										<?php getColors();?>
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
										<?php getColors();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
														<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle's Registered State</label>
								<div class="col-lg-10">
									<select class="form-control veh_reg_state_option" name="veh_reg_state" required>
										<?php getStates();?>
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
						<form role="form" action="<?php echo BASE_URL .'/'. OCINC ?>/civActions.php" method="post">
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
									<select class="form-control selectpicker veh_make_model" name="veh_make_model"
										id="veh_make_model" data-live-search="true" required>
										<?php getVehicle();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Primary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker veh_pcolor" name="veh_pcolor"
										data-live-search="true" required>
										<?php getColors();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Secondary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker veh_scolor" name="veh_scolor"
										data-live-search="true" required>
										<?php getColors();?>
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
										<?php getStates();?>
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
						<form role="form" action="<?php echo BASE_URL .'/'. OCINC ?>/civActions.php" method="post">
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
									<select class="form-control selectpicker" name="weapon_all" id="weapon_all"
										data-live-search="true" required>
										<option> </option>
										<?php getWeapons();?>
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
				url: '/oc-includes/civActions.php',
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
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
		$(function() {
			$("#datepicker").datepicker({
				dateFormat: 'yy-mm-dd'
			});
		});
		</script>
		<script>
		$(function() {
			$(document).on('click', '#edit_nameBtn', function(e) {
				e.preventDefault();
				var edit_id = $(this).data('id');
				console.log(edit_id);
				$.ajax({
						url: '<?php echo BASE_URL .'/'. OCINC ?>/civActions.php',
						type: 'POST',
						data: 'editid=' + edit_id,
						dataType: 'json',
						cache: false
					})
					.done(function(data) {
						$('#IdentityEditModal #civNameReq').val(data.name);
						$('#IdentityEditModal #datepicker2').datepicker({
							dateFormat: 'yy-mm-dd'
						}).datepicker('setDate', new Date(data.dob));
						$('#IdentityEditModal #civAddressReq').val(data.address);
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
						url: '<?php echo BASE_URL .'/'. OCINC ?>/civActions.php',
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
    <?php
    include ( ABSPATH . "/" . OCCONTENT . "/themes/". THEME . "/modals/civilian.modals.inc.php");
    include ( ABSPATH . "/oc-includes/jquery-colsolidated.inc.php"); ?>
            <script type="text/javascript"
        src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
    </script>

</html>