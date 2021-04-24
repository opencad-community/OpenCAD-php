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
		<?php require_once ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>
	<body class="app header-fixed">
		<header class="app-header navbar">
			<a rel="noopener" class="navbar-brand" href="#"><img class="navbar-brand-full" src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/images/logo_brand.png" width="30" height="25" alt="<?php echo COMMUNITY_NAME; ?> Logo"></a>
			<button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
				<span class="navbar-toggler-icon"></span>
			</button>
			<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/topProfile.inc.php"); ?>
		</header>
		<div class="app-body">
			<div class="sidebar">
				<nav class="sidebar-nav">
					<ul class="nav">
						<?php echo $civilianTitle; ?>
					<ul>
						<?php echo $dispatchButton;?>
						<?php echo $civilianButton; ?>
					</ul>
						<?php echo $leoTitle; ?>
					<ul>
						<?php echo $sheriffButton;?>
						<?php echo $highwayButton;?>
						<?php echo $stateButton;?>
						<?php echo $policeButton;?>
					</ul>
					<?php echo $firstResponderTitle; ?>
					<ul>
						<?php echo $fireButton;?>
						<?php echo $emsButton;?>
					</ul>
					</ul>
				</nav>
			</div>
			<main class="main">
				<div class="breadcrumb" />
				<div class="container-fluid">
					<div class="animated fadeIn">
						<div class="card">
							<div class="card-header">
								<h1><?php echo lang_key("MDT_CONSOLE"); ?>
								<button class="btn btn-primary btn-lg float-right" name="aop" data-toggle="modal" data-target="#aop" id="getAOP"></button></h1>
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
										</div>
										<div id="live_calls"></div>
									</div>
									<!-- ./ x_content -->
									<div class="card-footer">
										<button class="btn btn-primary" name="new_call_btn" data-toggle="modal" data-target="#newCall"><?php echo lang_key("NEW_CALL"); ?></button>
										<button class="btn btn-danger float-right" onClick="priorityTone('single')" value="0" id="priorityTone"><?php echo lang_key("STOP_TRANSMITTING"); ?></button>
										<button class="btn btn-danger float-right" onClick="priorityTone('recurring')" value="0" id="recurringTone"><?php echo lang_key("PRIORITY_SIGNAL"); ?></button>
										<button class="btn btn-danger float-right"  onClick="priorityTone('panic')" value="0" id="panicTone"><?php echo lang_key("PANIC_BUTTON"); ?></button>
									</div>
								</div>
								<!-- ./ card -->
							</div>
							<!-- ./ col-md-12 col-sm-12 col-xs-12 -->
						</div>
						<!-- / row -->
						<div class="row justify-content-center">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="card w-1000">
									<div class="card-header">
										<h2>My Status</h2>
										<div class="clearfix"></div>
									</div>
									<!-- ./ x_title -->
									<div class="card-body">
										<form id="myStatusForm">
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group row">
														<label class="col-md-2 control-label"for="name"><?php echo lang_key("MY_CALLSIGN"); ?></label>
														<input  name="callsign" class="col-md-9 form-control" id="callsign1" type="text" value="<?php echo $_SESSION['identifier'];?>" aria-label="<?php echo lang_key("MYCALLSIGN"); ?>" readonly />
													</div>
												</div>
											</div>
											<!-- /.row-->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group row">
														<label class="col-md-2 control-label" for="callsign"><?php echo lang_key("MY_STATUS"); ?></label>
														<input type="text" name="status" id="status" class="col-md-9 form-control" readonly />
													</div>
												</div>
											</div>
											<!-- /.row-->
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group row">
														<label class="col-md-2 control-label" for="ccnumber"><?php echo lang_key("STATUS"); ?></label>
														<select name="statusSelect" class="form-control col-md-9 <?php echo $_SESSION['identifier'];?>" id="statusSelect" onChange="responderChangeStatus(this);" title="Select a Status">
															<option value="10-6">10-6/Busy</option>
															<option value="10-5">10-5/Meal Break</option>
															<option value="10-7">10-7/Unavailable</option>
															<option value="10-8">10-8/Available</option>
															<option value="10-23">10-23/Arrived on Scene</option>
															<option value="10-65">10-65/Transporting Prisoner</option>
															<option value="sig11">Signal 11</option>
														</select>
													</div>
												</div>
											</div>
										</form>
										<!-- /.row-->
									</div>
								</div>
							</div>
							<!-- /.col-->
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="card">
									<div class="card-header">
										<h2><?php echo lang_key("MY_CALL"); ?></h2>
									</div>
									<!-- ./ x_title -->
									<div class="card-content">
										<div id="mycall">
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
									<h3><?php echo lang_key("NCIC_NAME_LOOKUP"); ?></h3>
									<div class="clearfix"></div>
								</div>
								<!-- ./ x_title -->
								<div class="card-body">
									<div class="input-group">
										<input id="ncic_name" type="text" class="form-control" placeholder="John Doe" name="ncic_name"/>
										<span class="input-group-append">
											<button class="btn btn-primary" type="button" name="ncic_name_btn" id="ncic_name_btn">Send</button>
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
									<h3><?php echo lang_key("NCIC_PLATE_LOOKUP"); ?></h3>
								</div>
								<!-- ./ x_title -->
								<div class="card-body">
									<div class="input-group">
										<input type="text" name="ncic_plate" class="form-control" id="ncic_plate" placeholder="License Plate, (ABC123)"/>
										<span class="input-group-append">
											<button type="button" class="btn btn-primary" id="ncic_plate_btn">Send</button>
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
								<h3><?php echo lang_key("NCIC_WEAPON_LOOKUP"); ?></h3>
							</div>
							<!-- ./ x_title -->
							<div class="card-body">
								<div class="input-group">
									<input type="text" name="ncic_weapon" class="form-control" id="ncic_weapon" placeholder="John Doe"/>
										<span class="input-group-append">
											<button type="button" class="btn btn-primary" name="ncic_weapon_btn" id="ncic_weapon_btn">Send</button>
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
	</div>
	<?php require_once ( ABSPATH .  OCTHEMEINC . "/footer.inc.php"); ?>
	<!-- modals -->
	<?php require_once ( ABSPATH . OCTHEMEINC ."/scripts.inc.php" );?>
	<?php require_once (ABSPATH .  OCTHEMEMOD . "/mdt.modals.inc.php")?>
	<!-- AUDIO TONES -->
	<audio id="recurringToneAudio" src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/sounds/priority.mp3" preload="auto"></audio>
	<audio id="priorityToneAudio" src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/sounds/Priority_Traffic_Alert.mp3" preload="auto"></audio>
	<audio id="panicToneAudio" src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/sounds/Panic_Button.m4a" preload="auto"></audio>
<script>
var vid = document.getElementById("recurringToneAudio");
vid.volume = 0.3;
</script>
<?php
   if ($_SESSION['activeDepartment'] == 'fire')
   {
	  
   }
else
{
   
   }
   ?>
<script type="text/javascript">
// Parse the URL parameter
function getParameterByName(name, url) {
if (!url) url = window.location.href;
name = name.replace(/[\[\]]/g, "\\$&");
var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
   results = regex.exec(url);
if (!results) return null;
if (!results[2]) return '';
return decodeURIComponent(results[2].replace(/\+/g, " "));
}
// Give the parameter a variable name
var dynamicContent = "<?php echo $_SESSION['activeDepartment'];?>"

$(document).ready(function() {

// Check if the URL parameter is police
if (dynamicContent == 'police' || dynamicContent == 'highway' || dynamicContent == 'state' || dynamicContent == 'sheriff') {
$('#lawenforcement').show();
$('#ncic').show();
}
else if (dynamicContent == 'fire' ||  dynamicContent == 'ems') {
$('#firstResponder').show();
}
else if (dynamicContent == 'roadsideAssist') {
$('#roadsideAssist').show();
}
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

	  //$('#callsign').modal('show');
	  getCalls();
	  getStatus();
	  checkTones();
	  getMyCall();
	  mdtGetVehicleBOLOS();
	  mdtGetPersonBOLOS();
   getAOP();

	  $('#enroute_btn').click(function(evt) {
	  console.log(evt);
	  var callId = $('#callId_det').val();

	  $.ajax({
			type: "POST",
			url: "<?php echo "/" . OCINC ?>/generalActions.php",
			data: {
			   quickStatus: 'yes',
			   event: 'enroute',
			   callId: callId
			},
			success: function(response)
			{
			console.log(response);

			new PNotify({
			   title: 'Success',
			   text: 'Successfully updated narrative',
			   type: 'success',
			   styling: 'bootstrap3'
			});
			},
			error : function(XMLHttpRequest, textStatus, errorThrown)
			{
			console.log("Error");
			}

		 });
	  });

});
$(function() {
$( "#ncic_name" ).autocomplete({
source: "<?php echo "/" . OCINC ?>/search_name.php"
});
});
$(function() {
$( "#ncic_plate" ).autocomplete({
source: "<?php echo "/" . OCINC ?>/search_plate.php"
});
});
</script>
<script>
$(function() {
$( "#ncic_weapon" ).autocomplete({
source: "<?php echo "/" . OCINC ?>/search_name.php"
});
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
function getAOP() {
   $.ajax({
		 type: "GET",
		 url: "<?php echo "/" . OCINC ?>/generalActions.php",
		 data: {
			getAOP: 'yes'
		 },
		 success: function(response)
		 {
			$('#getAOP').html(response);

			// SG - Removed until node/real-time data setup
			/*$('#activeUsers').DataTable({
			searching: false,
			scrollY: "200px",
			lengthMenu: [[4, -1], [4, "All"]]
		 });*/
			setTimeout(getAOP, 5000);


		 },
		 error : function(XMLHttpRequest, textStatus, errorThrown)
		 {
			console.log("Error");
		 }

	  });
}
function getCalls() {
	  $.ajax({
			type: "GET",
			url: "<?php echo "/" . OCINC ?>/generalActions.php",
			data: {
			   getCalls: 'yes',
			   responder: 'yes'
			},
			success: function(response)
			{
			$('#live_calls').html(response);
			setTimeout(getCalls, 5000);

			},
			error : function(XMLHttpRequest, textStatus, errorThrown)
			{
			console.log("Error");
			}

		 });
   }
function getMyCall() {
	  $.ajax({
			type: "GET",
			url: "<?php echo "/" . OCINC ?>/generalActions.php",
			data: {
			   getMyCall: 'yes',
			   responder: 'yes'
			},
			success: function(response)
			{
			$('#mycall').html(response);
			setTimeout(getMyCall, 5000);

			},
			error : function(XMLHttpRequest, textStatus, errorThrown)
			{
			console.log("Error");
			}

		 });
   }
function mdtGetVehicleBOLOS() {
	  $.ajax({
			type: "GET",
			url: "<?php echo "/" . OCINC ?>/responderActions.php",
			data: {
			   mdtGetVehicleBOLOS: 'yes',
			   responder: 'yes'
			},
			success: function(response)
			{
			$('#vehiclebolo').html(response);
			setTimeout(mdtGetVehicleBOLOS, 5000);

			},
			error : function(XMLHttpRequest, textStatus, errorThrown)
			{
			console.log("Error");
			}

		 });
   }
function mdtGetPersonBOLOS() {
	  $.ajax({
			type: "GET",
			url: "<?php echo "/" . OCINC ?>/responderActions.php",
			data: {
			   mdtGetPersonBOLOS: 'yes',
			   responder: 'yes'
			},
			success: function(response)
			{
			$('#personbolo').html(response);
			setTimeout(mdtGetPersonBOLOS, 5000);

			},
			error : function(XMLHttpRequest, textStatus, errorThrown)
			{
			console.log("Error");
			}

		 });
   }
</script>
<script>
$('#callsign').on('shown.bs.modal', function(e) {
	  $('#callsign').find('input[name="callsign"]').val('<?php echo $_SESSION['identifier'];?>');
});

$(function() {
	  $('.callsignForm').submit(function(e) {
		 e.preventDefault(); // avoid to execute the actual submit of the form.

		 $.ajax({
			type: "POST",
			url: "<?php echo "/" . OCINC ?>/responderActions.php",
			data: {
			   updateCallsign: 'yes',
			   details: $("#"+this.id).serialize()
			},
			success: function(response)
			{

			if (response.match("^Duplicate"))
			{
				  var call2 = $('#callsign').find('input[name="callsign"]').val();
				  if (call2 == "<?php echo $_SESSION['identifier'];?>")
				  {
					 $('#closeCallsign').trigger('click');

					 new PNotify({
						title: 'Success',
						text: 'Successfully set your callsign',
						type: 'success',
						styling: 'bootstrap3'
					 });

					 return false;

				  }
				  else
				  {
					 $('#closeCallsign').trigger('click');

					 new PNotify({
					 title: 'Error',
					 text: 'That callsign is already in use',
					 type: 'error',
					 styling: 'bootstrap3'
					 });
				  }

			}

			if (response == "SUCCESS")
			{

			   $('#closeCallsign').trigger('click');

			   new PNotify({
				  title: 'Success',
				  text: 'Successfully set your callsign',
				  type: 'success',
				  styling: 'bootstrap3'
			   });

			   var call1 = $('#callsign').find('input[name="callsign"]').val();

			   $('#callsign1').val(call1);
			   }

			},
			error : function(XMLHttpRequest, textStatus, errorThrown)
			{
			console.log("Error");
			}

		 });

	  });
   });

function getStatus() {
$.ajax({
	  type: "GET",
	  url: "<?php echo "/" . OCINC ?>/responderActions.php",
	  data: {
		 getStatus: 'yes'
	  },
	  success: function(response)
	  {
		 console.log(response);

		 if (response.match("^10-7 | Unavailable"))
		 {
			var currentStatus = $('#status').val();
			if (currentStatus == "10-7 | Unavailable | On Call")
			{
			   //do nothing
			}
			else if(currentStatus == '10-7 | Unavailable')
		 {

		 }
		 else
		 {

			document.getElementById('newCallAudio').play();
			new PNotify({
			   title: 'New Call!',
			   text: 'You\'ve been assigned a new call!',
			   type: 'success',
			   styling: 'bootstrap3'
			});
			getMyCallDetails();

			}


		 }
		 else if (response.match("^<br>"))
		 {
			console.log("LOGGED OUT");
			window.location.href = '<?php echo BASE_URL .'/'. OCINC; ?>/logout.php';
		 }


	  $('#status').val(response);
	  setTimeout(getStatus, 5000);
	  },
	  error : function(XMLHttpRequest, textStatus, errorThrown)
	  {
   console.log("Error");
	  }

});
}

$('.setcall_cls').click(function (){
getStatus();
});

function getMyCallDetails()
{
   console.log("Got here");
}
</script>


</html>