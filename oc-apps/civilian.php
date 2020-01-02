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
                        <div class="card-body">
							<?php echo $nameMessage, $identityMessage;?>
							<?php ncicGetNames();?>
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


    <?php

    include ( ABSPATH . "/" . OCCONTENT . "/themes/". THEME . "/modals/civilian.modals.inc.php");
    include ( ABSPATH . "/oc-includes/jquery-colsolidated.inc.php"); ?>
  
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

</html>