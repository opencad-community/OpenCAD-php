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
		include_once("../oc-config.php");
		include_once(ABSPATH . "/oc-functions.php");
		include_once(ABSPATH . "/oc-settings.php");
		include_once(ABSPATH . OCINC . "/generalActions.php");
		include_once( "../" . OCINC . "/publicFunctions.php" );
		include_once( "../" . OCINC . "/dispatchActions.php" );
		include_once( "../" . OCCONTENT . "/plugins/api_auth.php" );
		if (empty($_SESSION['logged_in']))
		{
				header('Location: ../index.php');
				die("Not logged in");
		}
		else
		{
			$name = $_SESSION['name'];
		}

		setDispatcher("1");

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
		$aop = 
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

		$boloMessage = "";
		if(isset($_SESSION['boloMessage']))
		{
				$boloMessage = $_SESSION['boloMessage'];
				unset($_SESSION['boloMessage']);
		}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>

<body class="app header-fixed">

		<header class="app-header navbar">
				<a rel="noopener" class="navbar-brand" href="#">
					<img class="navbar-brand-full" src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/images/logo_brand.png" width="30" height="25" alt="<?php echo COMMUNITY_NAME; ?> Logo">
				</a>
		<?php
			include_once ( ABSPATH . "/" . OCTHEMES . "/".THEME."/includes/topProfile.inc.php");
		?>
		</header>

		<div class="app-body">
			<main class="main">
			<div class="breadcrumb" />
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<button class="btn btn-primary" name="aop" data-toggle="modal" data-target="#aop" id="getAOP"></button>
						</div>
						<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="card">
									<div class="card-header">
										<h2><?php echo lang_key("ACTIVE_CALLS"); ?></h2>
									</div>
									<!-- ./ x_title -->
									<div class="card-content">
										<div id="noCallsAlertHolder">
										<span id="noCallsAlertSpan"></span>
										<div id="live_calls"></div>
									</div>
								</div>
								<!-- ./ x_content -->
									<div class="card-footer">
										<button class="btn btn-primary" name="new_call_btn" data-toggle="modal" data-target="#newCall"><?php echo lang_key("NEW_CALL"); ?></button>
										<button class="btn btn-danger float-right" onClick="priorityTone('single')" value="0" id="priorityTone"><?php echo lang_key("STOP_TRANSMITTING"); ?></button>
										<button class="btn btn-danger float-right" onClick="priorityTone('recurring')" value="0" id="recurringTone"><?php echo lang_key("PRIORITY_SIGNAL"); ?>/button>
										<button class="btn btn-danger float-right" onClick="priorityTone('panic')" value="0" id="panicTone"><?php echo lang_key("PANIC_BUTTON"); ?></button>
									</div>
								</div>
								<!-- ./ x_panel -->
							</div>
							<!-- ./ col-md-12 col-sm-12 col-xs-12 -->
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="card">
									<div class="card-header">
										<h2><?php echo lang_key("ACTIVE_BOLOS"); ?></h2>
									</div>
									<!-- ./ x_title -->
									<div class="card-conent">
										<div id="noCallsAlertHolder">
										<?php echo $boloMessage;?>
									</div>
									<div class="card-content">
										<?php cadGetPersonBOLOS(); ?>
									</div>
									<div class="card-content">
										<?php cadGetVehicleBOLOS(); ?>
									</div>
									<div class="card-content">
										<span id="noCallsAlertSpan"></span>
										<div id="live_calls"></div>
									</div>
									<!-- ./ x_content -->

									<div class="card-footer">
										<button class="btn btn-warning" name="new_call_btn" data-toggle="modal" data-target="#newPersonsBOLO"><?php echo lang_key("NEW_PERSONS_BOLO"); ?></button>
										<button class="btn btn-warning" name="new_call_btn" data-toggle="modal" data-target="#newVehicleBOLO"><?php echo lang_key("NEW_VEHICLE_BOLO"); ?></button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row justify-content-center">
						<div class="col-md-4 col-xs-4">
							<div class="card w-1000">
								<div class="card-header">
									<h2><?php echo lang_key("ACTIVE_DISPATCHERS"); ?></h2>
									<div class="clearfix"></div>
								</div>
								<!-- ./ x_title -->
								<div class="card-content">
									<?php getDispatchers(); ?>
								</div>
							</div>
						</div>
					<!-- /.col-->
						<div class="col-md-4 col-xs-4">
							<div class="card">
								<div class="card-header">
									<h2><?php echo lang_key("AVAILABLE_UNITS"); ?></h2>
									<div class="clearfix"></div>
								</div>
								<!-- ./ x_title -->
								<div class="card-contenmt">
									<?php getAvailableUnits(); ?>
								</div>
							</div>
						</div>
						<!-- /.col-->
						<div class="col-md-4 col-xs-4">
							<div class="card">
								<div class="card-header">
									<h2><?php echo lang_key("UNAVAILABLE_UNITS"); ?></h2>
								</div>
								<!-- ./ x_title -->
								<div class="card-content">
									<div id="unAvailableUnits">
										<?php getUnAvailableUnits(); ?> 
									</div>
								</div>
							</div>
							<!-- /.col-->
						</div>
						<!-- ./ row -->
					</div>
					<!-- ./ col-md-12 col-sm-12 col-xs-12 -->

					<div class="row justify-content-center"">
						<div class="col-md-4 col-xs-4">
							<div class="card">
								<div class="card-header">
									<h2><?php echo lang_key("NCIC_NAME_LOOKUP"); ?></h2>
									<div class="clearfix"></div>
								</div>
								<!-- ./ x_title -->
								<div class="card-body">
									<div class="input-group">
										<input id="ncic_name" type="text" class="form-control" placeholder="John Doe" name="ncic_name"/>
										<span class="input-group-append">
											<button class="btn btn-primary" type="button" name="ncic_name_btn" id="ncic_name_btn"><?php echo lang_key("SEND"); ?></button>
										</span>
									</div>
									<!-- ./ input-group -->
									<div name="ncic_name_return" id="ncic_name_return" contenteditable="false" style="background-color: #eee; opacity: 1;  font-size: 15px; font-weight: bold;">
									</div>
									<!-- ./ ncic_name_return -->
								</div>
								<!-- ./ x_content -->
							</div>
							<!-- ./ x_panel -->
						</div>
						<!-- ./ col-md-4 col-sm-4 col-xs-4 -->
						<div class="col-md-4 col-xs-4">
							<div class="card">
								<div class="card-header">
								<h2><?php echo lang_key("NCIC_PLATE_LOOKUP"); ?></h2>
							</div>
							<!-- ./ x_title -->
							<div class="card-body">
								<div class="input-group">
									<input type="text" name="ncic_plate" class="form-control" id="ncic_plate" placeholder="License Plate, (ABC123)"/>
									<span class="input-group-append">
										<button type="button" class="btn btn-primary" id="ncic_plate_btn"><?php echo lang_key("SEND"); ?></button>
									</span>
								</div>
									<!-- ./ input-group -->
								<div name="ncic_plate_return" id="ncic_plate_return" contenteditable="false" style="background-color: #eee; opacity: 1;  font-size: 15px; font-weight: bold;">
								</div>
								<!-- ./ ncic_plate_return -->
							</div>
						<!-- ./ x_content -->
						</div>
					<!-- ./ x_panel -->
					</div>
					<!-- ./ col-sm-6 col-md-4 col-xs-4 -->
					<div class="col-md-4 col-xs-4">
						<div class="card">
							<div class="card-header">
								<h2><?php echo lang_key("NCIC_WEAPON_LOOKUP"); ?></h2>
							</div>
							<!-- ./ x_title -->
							<div class="card-body">
								<div class="input-group">
									<input type="text" name="ncic_weapon" class="form-control" id="ncic_weapon" placeholder="John Doe"/>
									<span class="input-group-append">
										<button type="button" class="btn btn-primary" name="ncic_weapon_btn" id="ncic_weapon_btn"><?php echo lang_key("SEND"); ?></button>
									</span>
								</div>
								<!-- ./ input-group -->
								<div name="ncic_weapon_return" id="ncic_weapon_return" contenteditable="false" style="background-color: #eee; opacity: 1;  font-size: 15px; font-weight: bold;">
								</div>
								<!-- ./ ncic_name_return -->
							</div>
							<!-- ./ x_content -->
						</div>
						<!-- ./ x_panel -->
					</div>
					<!-- ./ col-md-4 col-sm-4 col-xs-4 -->
				</div>
				<!-- ./ row -->
			</div>
		</div>
		<!-- /.card-->
	</main>
	</div>
			
		<?php 
		require_once ( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/footer.inc.php");
		include_once ( ABSPATH . "/" . OCTHEMES . "/".THEME."/modals/cad.modals.inc.php");
		require_once ( ABSPATH . OCTHEMEINC ."/scripts.inc.php" ); ?>

		<!-- AUDIO TONES -->
			<audio id="recurringToneAudio" src="<?php echo BASE_URL; ?>oc-content/themes/<?php echo THEME; ?>/sounds/priority.mp3" preload="auto"></audio>
			<audio id="priorityToneAudio" src="<?php echo BASE_URL; ?>oc-content/themes/<?php echo THEME; ?>/sounds/Priority_Traffic_Alert.mp3" preload="auto"></audio>
			<audio id="panicToneAudio" src="<?php echo BASE_URL; ?>oc-content/themes/<?php echo THEME; ?>/sounds/Panic_Button.m4a" preload="auto"></audio>

					<script>
				 var vid = document.getElementById("recurringToneAudio");
				 vid.volume = 0.3;

	$(function() {
		$( "#ncic_name" ).autocomplete({
			source: "../<?php echo OCINC ?>/search_name.php"
		});
	});

	$(function() {
		$( "#ncic_plate" ).autocomplete({
			source: "../<?php echo OCINC ?>/search_plate.php"
		});
	});
	
	$(function() {
		$( "#ncic_weapon" ).autocomplete({
			source: "../<?php echo OCINC ?>/search_name.php"
		});
	});
	
		$(document).ready(function() {
				$('#ncic_warnings').DataTable({

				});
		});
		
		$(document).ready(function() {
				$('#ncic_citations').DataTable({

				});
		});
		
		$(document).ready(function() {
				$('#ncicArrests').DataTable({

				});
		});
		
		$(document).ready(function() {
				$('#ncic_warrants').DataTable({

				});
		});
		
		$(document).ready(function() {
				$('#rms_warnings').DataTable({

				});
		});
		
		$(document).ready(function() {
				$('#rms_citations').DataTable({

				});
		});
		
		$(document).ready(function() {
				$('#rms_arrests').DataTable({

				});
		});
		
		$(document).ready(function() {
				$('#rms_warrants').DataTable({

				});
		});
		
				 $(document).ready(function() {
						 $(function() {
								 $('#menu_toggle').click();
						 });

						 getCalls();
						 getAvailableUnits();
						 getUnAvailableUnits();
						 getDispatchers();
						 checkTones();
						 cadGetPersonBOLOS();
						 cadGetVehicleBOLOS();
						 getAOP();

				 });
				 
				 // PNotify Stuff
				 priorityNotification = new PNotify({
						 title: 'Priority Traffic',
						 text: 'Priority Traffic Only',
						 type: 'error',
						 hide: false,
						 auto_display: false,
						 styling: 'bootstrap3',
						 buttons: {
								 closer: false,
								 sticker: false
						 }
				 });
				 function testFunction(element)
				 {
					 statusInit = element.className;
					 status = statusInit.split(" ")[0];
					 //If a user has a space in their username, it'll cause some problems. First, we need to split the string by spaces which will generate
					 // an array. Then, we need to remove the first item from the array which is presumably an "action". Then, we join the array again via spaces
					 unit = statusInit.split(" ");
					 unit.shift();
					 unit = unit.join(' ');

					 console.log(unit);

					 $.ajax({
							 type: "POST",
							 url: "../<?php echo OCINC ?>/generalActions.php",
							 data: {
									 changeStatus: 'yes',
									 unit: unit,
									 status: status
							 },
							 success: function(response)
							 {
								 console.log(response);
								 if (response == "SUCCESS")
								 {
									 new PNotify({
										 title: 'Success',
										 text: 'Successfully modified user status',
										 type: 'success',
										 styling: 'bootstrap3'
									 });
								 }

							 },
							 error : function(XMLHttpRequest, textStatus, errorThrown)
							 {
								 console.log("Error");
							 }

						 });
				 }

				 function logoutUser(element)
				 {
					 var r = confirm("Are you sure you want to log this user out?");

					 if (r == true)
					 {
						 unit = element.className.split(" ");
						 unit.shift(); //Remove the nopadding class
						 unit.shift(); //Remove the logoutUser class
						 unit = unit.join(' '); //Rejoin the array
						 console.log(unit);

						 $.ajax({
								 type: "POST",
								 url: "../<?php echo OCINC ?>/generalActions.php",
								 data: {
										 logoutUser: 'yes',
										 unit: unit
								 },
								 success: function(response)
								 {
									 console.log(response);
									 if (response == "SUCCESS")
									 {
										 new PNotify({
											 title: 'Success',
											 text: 'Successfully logged out user',
											 type: 'success',
											 styling: 'bootstrap3'
										 });
									 }

								 },
								 error : function(XMLHttpRequest, textStatus, errorThrown)
								 {
									 console.log("Error");
								 }

							 });
						 }
						 else
						 {
							 //Do nothing
						 }
				 }
				 
				 function getAvailableUnits() {
					 $.ajax({
								 type: "GET",
								 url: "../<?php echo OCINC ?>/generalActions.php",
								 data: {
										 getAvailableUnits: 'yes'
								 },
								 success: function(response)
								 {
									 $('#availableUnits').html(response);

									 setTimeout(getAvailableUnits, 5000);


								 },
								 error : function(XMLHttpRequest, textStatus, errorThrown)
								 {
									 console.log("Error");
								 }

							 });
				 }


				 function getDispatchers() {
					 $.ajax({
								 type: "GET",
								 url: "../<?php echo OCINC ?>/generalActions.php",
								 data: {
										 getDispatchers: 'yes'
								 },
								 success: function(response)
								 {
									 $('#activeDispatchers').html(response);

									 setTimeout(getDispatchers, 5000);


								 },
								 error : function(XMLHttpRequest, textStatus, errorThrown)
								 {
									 console.log("Error");
								 }

							 });
				 }


				 function getAOP() {
					 $.ajax({
								 type: "GET",
								 url: "../<?php echo OCINC ?>/generalActions.php",
								 data: {
										 getAOP: 'yes'
								 },
								 success: function(response)
								 {
									 $('#getAOP').html(response);

									 setTimeout(getAOP, 5000);


								 },
								 error : function(XMLHttpRequest, textStatus, errorThrown)
								 {
									 console.log("Error");
								 }

							 });
				 }


				 function cadGetPersonBOLOS() {
					 $.ajax({
								 type: "GET",
								 url: "../<?php echo OCINC ?>/dispatchActions.php",
								 data: {
										 cadGetPersonBOLOS: 'yes'
								 },
								 success: function(response)
								 {
									 $('#cadpersonbolo').html(response);

									 setTimeout(cadGetPersonBOLOS, 5000);


								 },
								 error : function(XMLHttpRequest, textStatus, errorThrown)
								 {
									 console.log("Error");
								 }

							 });
				 }

				 function cadGetVehicleBOLOS() {
					 $.ajax({
								 type: "GET",
								 url: "../<?php echo OCINC ?>/dispatchActions.php",
								 data: {
										 cadGetVehicleBOLOS: 'yes'
								 },
								 success: function(response)
								 {
									 $('#cadvehiclebolo').html(response);

									 setTimeout(cadGetVehicleBOLOS, 5000);


								 },
								 error : function(XMLHttpRequest, textStatus, errorThrown)
								 {
									 console.log("Error");
								 }

							 });
				 }

				$(function(){
						$(document).on('click', '#edit_personbolo', function(e){
								e.preventDefault();
								var edit_id = $(this).data('id');
								$.ajax({
									url: '../<?php echo OCINC ?>/dispatchActions.php',
									type: 'POST',
									data: 'bolos_personid='+edit_id,
									dataType: 'json',
									cache: false
									})
									.done(function(data){
										$('#editPersonboloModal #firstName').val(data.firstName);
										$('#editPersonboloModal #lastName').val(data.lastName);
										$('#editPersonboloModal #physicalDescription').val(data.physicalDescription);
										$('.gender_picker').selectpicker('val', data.gender);
										$('#editPersonboloModal #reasonWanted').val(data.reasonWanted);
										$('#editPersonboloModal #lastSeen').val(data.lastSeen);
										$('#editPersonboloModal .Editdataid').val(data.id);
									});
							});
							$(document).on('click', '#edit_vehiclebolo', function(e){
								e.preventDefault();
								var edit_id = $(this).data('id');
								$.ajax({
									url: '../<?php echo OCINC ?>/dispatchActions.php',
									type: 'POST',
									data: 'bolos_vehicleid='+edit_id,
									dataType: 'json',
									cache: false
									})
									.done(function(data){
										$('#editVehicleBOLO .make').selectpicker('val', data.make);
										$('#editVehicleBOLO .model').selectpicker('val', data.model);
										$('#editVehicleBOLO .plate').val(data.plate);
										$('#editVehicleBOLO .primaryColor').val(data.primaryColor);
										$('#editVehicleBOLO .secondaryColor').val(data.secondaryColor);
										$('#editVehicleBOLO .lastSeen').val(data.lastSeen);
										$('#editVehicleBOLO .reasonWanted').val(data.reasonWanted);
										$('#editVehicleBOLO .EditVehicleId').val(data.id);
									});
							})
					});
			</script>
</body>

						<script type="text/javascript"
				src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
		</script>

</html>