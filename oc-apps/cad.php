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
<?php include_once( ABSPATH . "/oc-includes/header.inc.php"); ?>


<body class="app header-fixed">

    <header class="app-header navbar">
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/images/tail.png" width="30" height="25" alt="OpenCAD Logo">
      </a>
      <?php include( ABSPATH . "oc-includes/topProfile.inc.php"); ?>
    </header>

      <div class="app-body">
        <main class="main">
        <div class="breadcrumb" />
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="card">
                      <div class="card-header">
          <i class="fa fa-align-justify"></i> <?php echo lang_key("ACCESS_REQUESTS"); ?></div>
              <div class="card-body">
<div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                           <div class="card-header">
                              <h2>Active Calls</h2>
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
                              <button class="btn btn-primary" name="new_call_btn" data-toggle="modal" data-target="#newCall">New Call</button>
                              <button class="btn btn-danger float-right" onClick="priorityTone('single')" value="0" id="priorityTone">10-3 Tone</button>
                              <button class="btn btn-danger float-right" onClick="priorityTone('recurring')" value="0" id="recurringTone">Priority Tone</button>
                              <button class="btn btn-danger float-right" onClick="priorityTone('panic')" value="0" id="panicTone">Panic Button</button>
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
                              <h2>Active BOLOs</h2>
                           </div>
                           <!-- ./ x_title -->
                                         <div class="card-conent">
                              <div id="noCallsAlertHolder">
							  <?php echo $boloMessage;?>
                           <div class="card-content">
                              <?php cadGetPersonBOLOS(); ?>
                           </div>
                           <div class="card-content">
                              <?php cadGetVehicleBOLOS(); ?>
                           </div>
                                 <span id="noCallsAlertSpan"></span>
                              </div>
                              <div id="live_calls"></div>
                           </div>
                           <!-- ./ x_content -->
                                                      <div class="card-footer">
                              <button class="btn btn-warning" name="new_call_btn" data-toggle="modal" data-target="#newPersonsBOLO">New Persons BOLO</button>
                              <button class="btn btn-warning" name="new_call_btn" data-toggle="modal" data-target="#newVehicleBOLO">New Vehicle BOLO</button>
                           </div>
                        </div>
                  </div>
                  </div>
                  <div class="row justify-content-center">
                <div class="col-md-4 col-xs-4">
                <div class="card w-1000">
                           <div class="card-header">
                              <h2>Active Dispatchers</h2>
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
                              <h2>Available Units</h2>
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
                              <h2>Unavailable Units</h2>
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
                              <h2>NCIC Name Lookup</h2>
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
                              <div name="ncic_name_return" id="ncic_name_return" contenteditable="false" style="background-color: #eee; opacity: 1; font-family: 'Courier New'; font-size: 15px; font-weight: bold;">
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
                              <h2>NCIC Plate Lookup</h2>
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
                              <div name="ncic_plate_return" id="ncic_plate_return" contenteditable="false" style="background-color: #eee; opacity: 1; font-family: 'Courier New'; font-size: 15px; font-weight: bold;">
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
                              <h2>NCIC Weapon Lookup</h2>
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
                              <div name="ncic_weapon_return" id="ncic_weapon_return" contenteditable="false" style="background-color: #eee; opacity: 1; font-family: 'Courier New'; font-size: 15px; font-weight: bold;">
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

      
        <footer class="app-footer">
        <div>
            <a href="https://opencad.io">OpenCAD</a>
            <span>&copy; 2017 <?php echo date("Y"); ?>.</span>
        </div>
        <div class="ml-auto">

        </div>
    
        </footer>

             <!-- modals -->
      <!-- Quick Guide Modal -->
      <div class="modal" id="quickGuide" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">CLI Quick Guide</h4>
               </div>
               <!-- ./ modal-header -->
               <div class="modal-body">
                  <form>
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Create a new call</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control" readonly="readonly" placeholder="action, callsign, calltype, 'location', 'notes'" />
                           <input type="text" class="form-control" readonly="readonly" placeholder="new, 5V-29, 10-11, 'Alta Street at Hawick Avenue', '4 door blue sedan occ 2x'" />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Change Unit Status</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control" readonly="readonly" placeholder="action, callsign, status" />
                           <input type="text" class="form-control" readonly="readonly" placeholder="status, 5V-29, 10-6" />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Assign Unit to Call</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control" readonly="readonly" placeholder="action, callId, callsign" />
                           <input type="text" class="form-control" readonly="readonly" placeholder="assign, 1234, 5V-29" />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">NCIC Lookup</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control" readonly="readonly" placeholder="action, name/plate" />
                           <input type="text" class="form-control" readonly="readonly" placeholder="ncic, 'John Doe'" />
                           <input type="text" class="form-control" readonly="readonly" placeholder="ncic, 'ABC123'" />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                  </form>
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
      <!-- ./ modal bs-example-modal-lg -->
      <div class="modal" id="rms" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Warning Viewer</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="citation_panel">
                  <div class="x_title">
                    <h2>RMS Warnings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php rms_warnings();?>
                  </div>
                  <!-- ./ x_content -->
                </div>
                <div class="x_panel" id="citation_panel">
                  <div class="x_title">
                    <h2>RMS Citations</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php rms_citations();?>
                  </div>
                  <!-- ./ x_content -->
                </div>
                <div class="x_panel" id="citation_panel">
                  <div class="x_title">
                    <h2>RMS Arrests</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php rms_arrests();?>
                  </div>
                  <!-- ./ x_content -->
                </div>
                <div class="x_panel" id="citation_panel">
                  <div class="x_title">
                    <h2>RMS Warrants</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php rms_warrants();?>
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
    <!-- ./ modal bs-example-modal-lg -->
      <!-- Assign User to Call Modal -->
      <div class="modal" id="assign" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Assign a User</h4>
               </div>
               <!-- ./ modal-header -->
               <div class="modal-body">
                  <form class="assignUnitForm" id="assignUnitForm">
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Assign Unit to Call</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker unit" data-live-search="true" name="unit" id="unit" title="Select a Unit">
                              <option name="callsign"></option>
                           </select>
                           <input type="hidden" value="" name="callId" />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ modal-body -->
                     <div class="modal-footer">
                        <input type="submit" name="assign_unit" class="btn btn-primary" value="Send"/>
                        <button id="closeAssign" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                     <!-- ./ modal-footer -->
                  </form>
               </div>
               <!-- ./ modal-body -->
            </div>
            <!-- ./ modal-content -->
         </div>
         <!-- ./ modal-dialog modal-lg -->
      </div>
      <!-- ./ modal bs-example-modal-lg -->
	<!-- AOP Modal -->
    <div class="modal" id="aop" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Create Person BOLO</h4>
          </div>
          <!-- ./ modal-header -->
		  <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">AOP</label>
                <div class="col-lg-10">
					<input name="aop" class="form-control" id="aop" placeholder="Set AOP"/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
          <div class="modal-footer">
                <input name="change_aop" type="submit" class="btn btn-primary" value="Send" />
               <button type="reset" class="btn btn-default" value="Reset">Reset</button>
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
    <!-- ./ modal bs-example-modal-lg -->
      <!-- New Call Modal -->
      <div class="modal" id="newCall" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">New Call</h4>
               </div>
               <!-- ./ modal-header -->
               <div class="modal-body">
                  <form class="newCallForm" id="newCallForm">
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Incident Type</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker" data-live-search="true" name="callType" title="Incident Type" required>
                              <?php getIncidentTypes();?>
                           </select>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <br/>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Address</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker" data-live-search="true" name="street1" id="street1" title="Street 1" required>
								<?php getStreet();?>
							</select>
							<select class="form-control selectpicker" data-live-search="true" name="street2" id="street2" title="Street 2/Cross/Postal" >
								<?php getStreet();?>
							</select>
								<input type="text" class="form-control" name="additionalLocation" placeholder="Any Additional Location Information" />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <br/>
                     <br/>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Narrative</label>
                        <div class="col-lg-10">
                           <textarea name="narrative" id="narrative" class="form-control" style="text-transform:uppercase" rows="5"></textarea>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
               </div>
               <!-- ./ modal-body -->
               <div class="modal-footer">
               <input type="submit" name="create_call" class="btn btn-primary" value="Send"/>
               <button type="reset" class="btn btn-default" value="Reset">Reset</button>
               <button id="newCallReset" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
               <!-- ./ modal-footer -->
               </form>
            </div>
            <!-- ./ modal-body -->
         </div>
         <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-lg -->
	<!-- New Person Bolo Modal -->
    <div class="modal" id="newPersonsBOLO" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Create Person BOLO</h4>
          </div>
          <!-- ./ modal-header -->
		  <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">First Name</label>
                <div class="col-lg-10">
					<input name="firstName" class="form-control" id="firstName" placeholder="First Name of the BOLOed subject."/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Last Name</label>
                <div class="col-lg-10">
					<input name="lastName" class="form-control" id="lastName" placeholder="Last Name of the BOLOed subject."/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Gender</label>
                <div class="col-lg-10">
					<select name="gender" class="form-control selectpicker" id="gender" title="Select a sex" data-live-search="true">
                    <option> </option>
                    <?php getGenders();?>
					</select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Physical Description</label>
                <div class="col-lg-10">
					<input name="physicalDescription" class="form-control" id="physicalDescription" placeholder="Physical description of the BOLOed subject."/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Reason Wanted</label>
                <div class="col-lg-10">
					<textarea name="reasonWanted" class="form-control" style="text-transform:uppercase" rows="5" id="reasonWanted" placeholder="Wanted reason of the BOLOed subject." required> </textarea>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Last Seen</label>
                <div class="col-lg-10">
					<input name="lastSeen" class="form-control" id="lastSeen" placeholder="Last observed location of the BOLOed subject."/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
          <div class="modal-footer">
                <input name="create_personbolo" type="submit" class="btn btn-primary" value="Send" />
               <button type="reset" class="btn btn-default" value="Reset">Reset</button>
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
    <!-- ./ modal bs-example-modal-lg -->
    <!-- Edit Person Bolo Modal -->
    <div class="modal" id="editPersonboloModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit Person BOLO</h4>
          </div>
          <!-- ./ modal-header -->
      <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">First Name</label>
                <div class="col-lg-10">
          <input name="firstName" class="form-control" id="firstName" placeholder="First Name of the BOLOed subject."/>
          <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Last Name</label>
                <div class="col-lg-10">
          <input name="lastName" class="form-control" id="lastName" placeholder="Last Name of the BOLOed subject."/>
          <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Gender</label>
                <div class="col-lg-10">
          <select name="gender" class="form-control selectpicker gender_picker" id="gender" title="Select a sex" data-live-search="true">
                    <option> </option>
                    <?php getGenders();?>
          </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Physical Description</label>
                <div class="col-lg-10">
          <input name="physicalDescription" class="form-control" id="physicalDescription" placeholder="Physical description of the BOLOed subject."/>
          <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Reason Wanted</label>
                <div class="col-lg-10">
          <textarea name="reasonWanted" class="form-control" style="text-transform:uppercase" rows="5" id="reasonWanted" placeholder="Wanted reason of the BOLOed subject." required> </textarea>
          <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Last Seen</label>
                <div class="col-lg-10">
          <input name="lastSeen" class="form-control" id="lastSeen" placeholder="Last observed location of the BOLOed subject."/>
          <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
          <div class="modal-footer">
                <input type="hidden" name="edit_personId" class="Editdataid">
                <input name="edit_personbolo" type="submit" class="btn btn-primary" value="Edit" />
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
    <!-- ./ modal bs-example-modal-lg -->
	<!-- New Vehicle Bolo Modal -->
    <div class="modal" id="newVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Create Vehicle BOLO</h4>
          </div>
          <!-- ./ modal-header -->
		  <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Make</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker" data-live-search="true" name="make" title="Vehicle Make">
                              <?php getVehicleMakes();?>
                           </select>
                        </div>
				</div>
              <!-- ./ form-group -->
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Model</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker" data-live-search="true" name="model" title="Vehicle Model">
                              <?php getVehicleModels();?>
                           </select>
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Plate</label>
                        <div class="col-lg-10">
                						<input type="text" class="form-control plate" name="plate" placeholder="The plate of the BOLO vehicle." />
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                        <label class="col-lg-2 control-label">Primary Color</label>
                        <div class="col-lg-10">
                						<input type="text" class="form-control primaryColor" name="primaryColor" placeholder="The primary color of the BOLO vehicle." />
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Secondary Color</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control secondaryColor" name="secondaryColor" placeholder="The secondary color, if any, of the BOLO vehicle." />                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                <!-- ./ col-sm-9 -->
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Reason Wanted</label>
                        <div class="col-lg-10">
                                <textarea name="reasonWanted" id="narrative" class="form-control reasonWanted" style="text-transform:uppercase" rows="5"></textarea>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Last Seen</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control lastSeen" name="lastSeen" placeholder="Last observed location of the BOLOed vehicle." />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
			</div>
          <div class="modal-footer">
              <input name="create_vehiclebolo" type="submit" class="btn btn-primary" value="Send" />
               <button type="reset" class="btn btn-default" value="Reset">Reset</button>
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
    <!-- ./ modal bs-example-modal-lg -->
    <!-- Edit Vehicle Bolo Modal -->
    <div class="modal" id="editVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit Vehicle BOLO</h4>
          </div>
          <!-- ./ modal-header -->
      <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Make</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker make" data-live-search="true" name="make" title="Vehicle Make" required>
                              <?php getVehicleMakes();?>
                           </select>
                        </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Model</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker model" data-live-search="true" name="model" title="Vehicle Model" required>
                              <?php getVehicleModels();?>
                           </select>
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Plate</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control plate" name="plate" placeholder="The plate of the BOLO vehicle." />
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                        <label class="col-lg-2 control-label">Primary Color</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control primaryColor" name="primaryColor" placeholder="The primary color of the BOLO vehicle." />
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Secondary Color</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control secondaryColor" name="secondaryColor" placeholder="The secondary color, if any, of the BOLO vehicle." />                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Reason Wanted</label>
                        <div class="col-lg-10">
                                <textarea name="reasonWanted" id="narrative" class="form-control reasonWanted" style="text-transform:uppercase" rows="5"></textarea>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Last Seen</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control lastSeen" name="lastSeen" placeholder="Last observed location of the BOLOed vehicle." />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
              <!-- ./ form-group -->
          <div class="modal-footer">
                <input type="hidden" name="edit_vehicleboloid" class="EditVehicleId">
                <input name="edit_vehiclebolo" type="submit" class="btn btn-primary" value="Edit" />
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
      <!-- Call Details Modal -->
      <div class="modal" id="callDetails" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">Call Details</h4>
            </div>
            <!-- ./ modal-header -->
            <div class="modal-body">
               <form class="callDetailsForm" id="callDetailsForm">
                  <div class="form-group">
                     <label class="col-lg-2 control-label">Incident ID</label>
                     <div class="col-lg-10">
                        <input type="text" id="call_id_det" name="call_id_det" class="form-control" disabled>
                     </div>
                     <!-- ./ col-sm-9 -->
                  </div>
                  <br/>
                  <!-- ./ form-group -->
                  <div class="form-group">
                     <label class="col-lg-2 control-label">Incident Type</label>
                     <div class="col-lg-10">
                        <input type="text" id="call_type_det" name="call_type_det" class="form-control" disabled>
                     </div>
                     <!-- ./ col-sm-9 -->
                  </div>
                  <br/>
                  <!-- ./ form-group -->
                  <div class="form-group">
                     <label class="col-lg-2 control-label">Main Street</label>
                     <div class="col-lg-10">
                        <input type="text" id="call_street1_det" name="call_street1_det" class="form-control" disabled>
                     </div>
                     <!-- ./ col-sm-9 -->
                  </div>
                  <br/>
                  <!-- ./ form-group -->
                  <div class="form-group">
                     <label class="col-lg-2 control-label">Cross Street</label>
                     <div class="col-lg-10">
                        <input type="text" id="call_street2_det" name="call_street2_det" class="form-control" disabled>
                     </div>
                     <!-- ./ col-sm-9 -->
                  </div>
                  <br/>
                  <!-- ./ form-group -->
                  <div class="form-group">
                     <label class="col-lg-2 control-label">Additional Location Info</label>
                     <div class="col-lg-10">
                        <input type="text" id="call_street3_det" name="call_street3_det" class="form-control" disabled>
                     </div>
                     <!-- ./ col-sm-9 -->
                  </div>
                     <br/>
                  <div class=" clearfix">
                     <br/><br/><br/><br/>
                     <!-- ./ form-group -->
                  <div  class="clearfix">
                     <br/><br/><br/><br/>
                     <!-- ./ form-group -->
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Narrative</label>
                        <div class="col-lg-10">
                           <div name="callNarrative" id="callNarrative" contenteditable="false" style="background-color: #eee; opacity: 1; border: 1px solid #ccc; padding: 6px 12px; font-size: 14px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"></div>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <br/>
                     <br/><br/><br/><br/>
                     <!-- ./ form-group -->
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Add Narrative</label>
                        <div class="col-lg-10">
                           <textarea name="narrative_add" id="narrative_add" class="form-control" style="text-transform:uppercase" rows="2" required></textarea>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <br/>
                  <!-- ./ modal-body -->
                  <br/>
                  <div class="modal-footer">
                     <input type="submit" id="addCallNarrative" class="btn btn-primary pull-left" value="Add Narrative" />
                     <button id="closeDetailsModal" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                  <!-- ./ modal-footer -->
               </form>
            </div>
            <!-- ./ modal-content -->
         </div>
         <!-- ./ modal-dialog modal-lg -->
      </div>
	  </div>
	  </div>
	  </div>
      <!-- ./ modal bs-example-modal-lg -->

      <!-- New Vehicle BOLO Modal -->
      <div class="modal" id="createVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Test</h4>
               </div>
               <!-- ./ modal-header -->
               <div class="modal-body">
                  <form class="newCallForm" id="newCallForm">
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Make</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker" data-live-search="true" name="make" title="Vehicle Make" required>
                              <?php getVehicleMakes();?>
                           </select>
                        </div>
                        <label class="col-lg-2 control-label">Vehicle Model</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker" data-live-search="true" name="Vehicle_Make" title="Vehicle Make" required>
                              <?php getVehicleModels();?>
                           </select>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <br/>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Primary Color</label>
                        <div class="col-lg-10">
                						<input type="text" class="form-control" name="Primary_Color" placeholder="The primary color of the BOLO vehicle." />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Secondary Color</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="Secondary_Color" placeholder="The secondary color, if any, of the BOLO vehicle." />                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <br/>
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Reason Wanted</label>
                        <div class="col-lg-10">
                                <textarea name="Reason_Wanted" id="narrative" class="form-control" style="text-transform:uppercase" rows="5"></textarea>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <br/>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Last Seen</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control" name="Last_Seen" placeholder="Last observed location of the BOLOed vehicle." />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
               </div>
               <!-- ./ modal-body -->
               <div class="modal-footer">
               <input type="submit" name="create_call" class="btn btn-primary" value="Send"/>
               <button type="reset" class="btn btn-default" value="Reset">Reset</button>
               <button id="newCallReset" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
               <!-- ./ modal-footer -->
               </form>
            </div>
            <!-- ./ modal-body -->
         </div>
         <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-lg -->

      </div>

       <!-- Edit Vehicle BOLO Modal -->

      <!-- Create Citation Modal -->
      <div class="modal" id="createCitation" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Citation Creator</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                <label class="col-lg-2 control-label">Civilian Name</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" required title="Select Civilian">
                    <?php getCivilianNamesOption();?>
                  </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Citation Name 1</label>
                <div class="col-lg-10">
					<input type="text" name="citation_name_1" id="citation_name_1" size="70" placeholder="Enter a citation" required />
					<input type="number" name="citation_fine_1" id="citation_fine_1" size="10" placeholder="Enter a fine amount" required />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
			  <p>Optional</p>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Citation Name 2</label>
                <div class="col-lg-10">
					<input type="text" name="citation_name_2" id="citation_name_2" size="70" placeholder="Enter a citation"  />
					<input type="number" name="citation_fine_2" id="citation_fine_2" placeholder="Enter a fine amount"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Citation Name 3</label>
                <div class="col-lg-10">
					<input type="text" name="citation_name_3" id="citation_name_3" size="70" placeholder="Enter a citation"  />
					<input type="number" name="citation_fine_3" id="citation_fine_3" placeholder="Enter a fine amount"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Citation Name 4</label>
                <div class="col-lg-10">
					<input type="text" name="citation_name_4" id="citation_name_4" size="70" placeholder="Enter a citation"  />
					<input type="number" name="citation_fine_4" id="citation_fine_4" placeholder="Enter a fine amount"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Citation Name 5</label>
                <div class="col-lg-10">
					<input type="text" name="citation_name_5" id="citation_name_5" size="70" placeholder="Enter a citation"  />
					<input type="number" name="citation_fine_5" id="citation_fine_5" placeholder="Enter a fine amount"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
                <input name="create_citation" type="submit" class="btn btn-primary" value="Create" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
          </div>
          <!-- ./ modal-footer -->
        </div>
        <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-lg -->
    </div>
    <!-- ./ modal bs-example-modal-lg -->
      <!-- View Citation Modal -->
      <div class="modal" id="viewCitation" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Citation Viewer</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="citation_panel">
                  <div class="x_title">
                    <h2>NCIC Citations</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php ncicGetCitations();?>
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
    <!-- ./ modal bs-example-modal-lg -->
      <!-- Create Warning Modal -->
      <div class="modal" id="createWarning" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Warning Creator</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                <label class="col-lg-2 control-label">Civilian Name</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" required title="Select Civilian">
                    <?php getCivilianNamesOption();?>
                  </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Warning Name 1</label>
                <div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_1" id="warning_name_1" placeholder="Enter a warning" required />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
			  <p>Optional</p>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Warning Name 2</label>
                <div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_2" id="warning_name_2" placeholder="Enter a warning"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Warning Name 3</label>
                <div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_3" id="warning_name_3" placeholder="Enter a warning"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Warning Name 4</label>
                <div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_4" id="warning_name_4" placeholder="Enter a warning"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Warning Name 5</label>
                <div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_5" id="warning_name_5" placeholder="Enter a warning"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
                <input name="create_warning" type="submit" class="btn btn-primary" value="Create" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
          </div>
          <!-- ./ modal-footer -->
        </div>
        <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-lg -->
    </div>
    <!-- ./ modal bs-example-modal-lg -->
      <div class="modal" id="createArrest" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">Arrest Report</h4>
            </div>
            <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                <label class="col-lg-2 control-label">Civilian Name</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" required title="Select Civilian">
                    <?php getCivilianNamesOption();?>
                  </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Arrest Reason 1</label>
                <div class="col-lg-10">
					<input type="text" name="arrest_reason_1" id="arrest_reason_1" size="70" placeholder="Enter a reason for arrest" required />
					<input type="number" name="arrest_fine_1" id="arrest_fine_1" size="10" placeholder="Enter a fine amount" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
			  <p>Optional</p>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Arrest Reason 2</label>
                <div class="col-lg-10">
					<input type="text" name="arrest_reason_2" id="arrest_reason_2" size="70" placeholder="Enter a reason for arrest"  />
					<input type="number" name="arrest_fine_2" id="arrest_fine_2" placeholder="Enter a fine amount"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Arrest Reason 3</label>
                <div class="col-lg-10">
					<input type="text" name="arrest_reason_3" id="arrest_reason_3" size="70" placeholder="Enter a reason for arrest"  />
					<input type="number" name="arrest_fine_3" id="arrest_fine_3" placeholder="Enter a fine amount"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Arrest Reason 4</label>
                <div class="col-lg-10">
					<input type="text" name="arrest_reason_4" id="arrest_reason_4" size="70" placeholder="Enter a reason for arrest"  />
					<input type="number" name="arrest_fine_4" id="arrest_fine_4" placeholder="Enter a fine amount"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Arrest Reason 5</label>
                <div class="col-lg-10">
					<input type="text" name="arrest_reason_5" id="arrest_reason_5" size="70" placeholder="Enter a reason for arrest"  />
					<input type="number" name="arrest_fine_5" id="arrest_fine_5" placeholder="Enter a fine amount"  />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
                <input name="create_arrest" type="submit" class="btn btn-primary" value="Create" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
          </div>
          <!-- ./ modal-footer -->
        </div>
        <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-lg -->
    </div>
    <!-- ./ modal bs-example-modal-lg -->
      <div class="modal" id="viewArrest" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Arrests Viewer</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="citation_panel">
                  <div class="x_title">
                    <h2>NCIC Arrests</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php ncicGetArrests();?>
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
    <!-- ./ modal bs-example-modal-lg -->
      <!-- View Warning Modal -->
      <div class="modal" id="viewWarning" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Warning Viewer</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="citation_panel">
                  <div class="x_title">
                    <h2>NCIC Warnings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php ncicGetWarnings();;?>
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
    <!-- ./ modal bs-example-modal-lg -->

      <!-- Create Warrant Modal -->
      <div class="modal" id="createWarrant" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Warrant Creator</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post">
                <div class="form-group row">
                <label class="col-lg-2 control-label">Civilian Name</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" required>
                    <option> </option>
                    <?php getCivilianNames();?>
                  </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Warrant Name</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker" name="warrant_name_sel" id="warrant_name_sel" data-live-search="true" title="Select a Warrant">
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
                      <option value="Firearm Discharge in City Limits">Firearm Discharge in City Limits</option>
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
                      <option value="FTA: Obstruction of Justice">FTA: Obstruction of Justice</option>
                      <option valu e="FTA: Verbal Abuse">FTA: Verbal Abuse</option>
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
                  <select class="form-control selectpicker" name="issuer" id="issuer" data-live-search="true" required>
                    <?php getAgenciesWarrants();?>
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
    <!-- ./ modal bs-example-modal-lg -->
      <!-- View Warrant Modal -->
      <div class="modal" id="viewWarrant" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
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
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php ncicGetWarrants();?>
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

    <?php    
    include_once ( ABSPATH . "oc-admin/oc-admin-includes/globalModals.inc.php");
    include_once ( ABSPATH . "oc-includes/jquery-colsolidated.inc.php"); ?>

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
        $('#ncic_arrests').DataTable({

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