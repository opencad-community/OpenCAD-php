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


    if ( $_SESSION['admin_privilege'] == 3)
    {
      if ($_SESSION['admin_privilege'] == 'Administrator')
      {
          //Do nothing
      }
    }
    else if ($_SESSION['admin_privilege'] == 2)
    {
      if ($_SESSION['admin_privilege'] == 'Moderator')
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
                          <label class="col-md-2 control-label"for="name">My Callsign</label>
                          <input  name="callsign" class="col-md-9 form-control" id="callsign1" type="text" value="<?php echo $_SESSION['identifier'];?>" readonly />
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group row">
                          <label class="col-md-2 control-label" for="callsign">My Status</label>
                          <input type="text" name="status" id="status" class="col-md-9 form-control" readonly />
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group row">
                          <label class="col-md-2 control-label" for="ccnumber">Status</label>
                              <select name="statusSelect" class="col-md-9 form-control selectpicker <?php echo $_SESSION['identifier'];?>" id="statusSelect" onChange="responderChangeStatus(this);" title="Select a Status">
                                 <option value="10-6">10-6/Busy</option>
                                 <option value="10-5">10-5/Meal Break</option>
                                 <option value="10-7">10-7/Unavailable</option>
                                 <option value="10-8">10-8/Available</option>
                                 <option value="10-23">10-23/Arrived on Scene</option>
                                 <option value="10-65">10-65/Transporting Prisoner</option>
                                 <option value="sig11">Signal 11</option>
                              </select>
                          </select>
                        </div>
                      </div>
                      </form>
                    </div>
                    <!-- /.row-->
                     </form>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="card">
                           <div class="card-header">
                              <h2>My Call</h2>
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
<!-- modals -->
<!-- Callsign Modal -->
<div class="modal" id="callsign" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" id="closeCallsign" data-dismiss="modal"><span aria-hidden="true">×</span>
         </button>
         <h4 class="modal-title" id="myModalLabel">Enter Your Callsign for This Patrol</h4>
      </div>
      <!-- ./ modal-header -->
      <div class="modal-body">
         <form class="callsignForm" id="callsignForm">
            <div class="form-group">
               <label class="col-md-2 control-label">Callsign</label>
               <div class="col-md-10">
                  <input type="text" id="callsign" name="callsign" class="form-control" />
               </div>
               <!-- ./ col-sm-9 -->
            </div>
            <!-- ./ form-group -->
      </div>
      <!-- ./ modal-body -->
      <div class="modal-footer">
      <input type="submit" name="setCallsign" class="btn btn-primary setcall_cls" value="Set Callsign"/>
      </div>
      <!-- ./ modal-footer -->
      </form>
   </div>
   <!-- ./ modal-content -->
</div>
<!-- ./ modal-dialog modal-md -->
</div>
<!-- ./ modal -->
<!-- Vehicle BOLO Board Modal -->
<div class="modal" id="vehicles-bolo-board" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" id="closeCallsign" data-dismiss="modal"><span aria-hidden="true">×</span>
         </button>
         <h4 class="modal-title" id="myModalLabel">Currently Active Vehicle BOLOs</h4>
      </div>
      <!-- ./ modal-header -->
      <div class="modal-body">
         <form class="callsignForm" id="callsignForm">
                     <div id="vehiclebolo">
                     </div>
               <!-- ./ col-sm-9 -->
            </div>
            <!-- ./ form-group -->
      </div>
      <!-- ./ modal-body -->
      </form>
   </div>
   <!-- ./ modal-content -->
</div>
<!-- ./ modal-dialog modal-md -->

<!-- Person BOLO Board Modal -->
<div class="modal" id="persons-bolo-board" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" id="closeCallsign" data-dismiss="modal"><span aria-hidden="true">×</span>
         </button>
         <h4 class="modal-title" id="myModalLabel">Currently Active Person BOLOs</h4>
      </div>
      <!-- ./ modal-header -->
      <div class="modal-body">
         <form class="callsignForm" id="callsignForm">
                     <div id="personbolo">
                     </div>
               <!-- ./ col-sm-9 -->
            </div>
            <!-- ./ form-group -->
      </div>
      <!-- ./ modal-body -->
      </form>
   </div>
   <!-- ./ modal-content -->
</div>
<!-- ./ modal-dialog modal-md -->

<!-- Call Details Modal -->
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
   <form role="form" action="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/oc-includes/responderActions.php" method="post">
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
      <input class="form-control" type="text" name="arrest_reason_1" id="arrest_reason_1" size="70" placeholder="Enter a reason for arrest" required />
      <input class="form-control" type="number" name="arrest_fine_1" id="arrest_fine_1" size="10" placeholder="Enter a fine amount" />
         </div>
         <!-- ./ col-sm-9 -->
      </div>
   <p>Optional</p>
      <div class="form-group row">
         <label class="col-lg-2 control-label">Arrest Reason 2</label>
         <div class="col-lg-10">
      <input class="form-control" type="text" name="arrest_reason_2" id="arrest_reason_2" size="70" placeholder="Enter a reason for arrest"  />
      <input class="form-control" type="number" name="arrest_fine_2" id="arrest_fine_2" placeholder="Enter a fine amount"  />
         </div>
         <!-- ./ col-sm-9 -->
      </div>
      <div class="form-group row">
         <label class="col-lg-2 control-label">Arrest Reason 3</label>
         <div class="col-lg-10">
      <input class="form-control" type="text" name="arrest_reason_3" id="arrest_reason_3" size="70" placeholder="Enter a reason for arrest"  />
      <input class="form-control" type="number" name="arrest_fine_3" id="arrest_fine_3" placeholder="Enter a fine amount"  />
         </div>
         <!-- ./ col-sm-9 -->
      </div>
      <div class="form-group row">
         <label class="col-lg-2 control-label">Arrest Reason 4</label>
         <div class="col-lg-10">
      <input class="form-control" type="text" name="arrest_reason_4" id="arrest_reason_4" size="70" placeholder="Enter a reason for arrest"  />
      <input class="form-control" type="number" name="arrest_fine_4" id="arrest_fine_4" placeholder="Enter a fine amount"  />
         </div>
         <!-- ./ col-sm-9 -->
      </div>
      <div class="form-group row">
         <label class="col-lg-2 control-label">Arrest Reason 5</label>
         <div class="col-lg-10">
      <input class="form-control" type="text" name="arrest_reason_5" id="arrest_reason_5" size="70" placeholder="Enter a reason for arrest"  />
      <input class="form-control" type="number" name="arrest_fine_5" id="arrest_fine_5" placeholder="Enter a fine amount"  />
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
<!-- Call Details Modal -->
<div class="modal" id="createCitation" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="myModalLabel">Citation Creation</h4>
   </div>
   <!-- ./ modal-header -->
   <div class="modal-body">
   <form role="form" action="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/oc-includes/responderActions.php" method="post">
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
      <input class="form-control" type="text" name="citation_name_1" id="citation_name_1" size="70" placeholder="Enter a citation" required />
      <input class="form-control" type="number" name="citation_fine_1" id="citation_fine_1" size="10" placeholder="Enter a fine amount" required />
         </div>
         <!-- ./ col-sm-9 -->
      </div>
   <p>Optional</p>
      <div class="form-group row">
         <label class="col-lg-2 control-label">Citation Name 2</label>
         <div class="col-lg-10">
      <input class="form-control" type="text" name="citation_name_2" id="citation_name_2" size="70" placeholder="Enter a citation"  />
      <input class="form-control" type="number" name="citation_fine_2" id="citation_fine_2" placeholder="Enter a fine amount"  />
         </div>
         <!-- ./ col-sm-9 -->
      </div>
      <div class="form-group row">
         <label class="col-lg-2 control-label">Citation Name 3</label>
         <div class="col-lg-10">
      <input class="form-control" type="text" name="citation_name_3" id="citation_name_3" size="70" placeholder="Enter a citation"  />
      <input class="form-control" type="number" name="citation_fine_3" id="citation_fine_3" placeholder="Enter a fine amount"  />
         </div>
         <!-- ./ col-sm-9 -->
      </div>
      <div class="form-group row">
         <label class="col-lg-2 control-label">Citation Name 4</label>
         <div class="col-lg-10">
      <input class="form-control" type="text" name="citation_name_4" id="citation_name_4" size="70" placeholder="Enter a citation"  />
      <input class="form-control" type="number" name="citation_fine_4" id="citation_fine_4" placeholder="Enter a fine amount"  />
         </div>
         <!-- ./ col-sm-9 -->
      </div>
      <div class="form-group row">
         <label class="col-lg-2 control-label">Citation Name 5</label>
         <div class="col-lg-10">
      <input class="form-control" type="text" name="citation_name_5" id="citation_name_5" size="70" placeholder="Enter a citation"  />
      <input class="form-control" type="number" name="citation_fine_5" id="citation_fine_5" placeholder="Enter a fine amount"  />
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
   <form role="form" action="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/oc-includes/responderActions.php" method="post">
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
               <input type="text" id="call_street2_det" name="call_street1_det" class="form-control" disabled>
            </div>
            <!-- ./ col-sm-9 -->
         </div>
         <br/>
         <!-- ./ form-group -->
         <div class="form-group">
            <label class="col-lg-2 control-label">Cross Street</label>
            <div class="col-lg-10">
               <input type="text" id="call_street3_det" name="call_street2_det" class="form-control" disabled>
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
         <div class="clearfix">
            <br/><br/><br/><br/>
            <!-- ./ form-group -->
            <div class="form-group">
               <label class="col-lg-2 control-label">Narrative</label>
               <div class="col-lg-10">
                  <div name="call_narrative" id="call_narrative" contenteditable="false" style="background-color: #eee; opacity: 1; border: 1px solid #ccc; padding: 6px 12px; font-size: 14px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"></div>
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
<!-- ./ modal bs-example-modal-lg -->
<div class="modal" id="rms" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
         </button>
   <h4 class="modal-title" id="myModalLabel">Warning Creator</h4>
   </div>
   <!-- ./ modal-header -->
   <div class="modal-body">
   <form role="form" action="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/oc-includes/responderActions.php" method="post">
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
      <!-- AUDIO TONES -->
      <audio id="recurringToneAudio" src="<?php echo BASE_URL; ?>oc-content/themes/<?php echo THEME; ?>/sounds/priority.mp3" preload="auto"></audio>
      <audio id="priorityToneAudio" src="<?php echo BASE_URL; ?>oc-content/themes/<?php echo THEME; ?>/sounds/Priority_Traffic_Alert.mp3" preload="auto"></audio>
      <audio id="panicToneAudio" src="<?php echo BASE_URL; ?>oc-content/themes/<?php echo THEME; ?>/sounds/Panic_Button.m4a" preload="auto"></audio>
<script>
var vid = document.getElementById("recurringToneAudio");
vid.volume = 0.3;
</script>
<?php
   if ($_SESSION['activeDepartment'] == 'fire')
   {
      echo '<audio id="newCallAudio" src="'.BASE_URL.'/oc-content/themes/'.THEME.'/sounds/Fire_Tones_Aligned.wav" preload="auto"></audio>';
   }
else
{
   echo '<audio id="newCallAudio" src="'.BASE_URL.'/oc-content/themes/'.THEME.'/sounds/New_Dispatch.mp3"  preload="auto"></audio>';
   }
   ?>
    <?php    
    include_once ( ABSPATH . "oc-admin/oc-admin-includes/globalModals.inc.php");
    include_once ( ABSPATH . "oc-includes/jquery-colsolidated.inc.php"); ?>
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
</script>
<script>
$(document).ready(function() {
$('#rms_warnings').DataTable({

});
});
</script>
<script>
$(document).ready(function() {
$('#rms_citations').DataTable({

});
});
</script>
<script>
$(document).ready(function() {
$('#rms_arrests').DataTable({

});
});
</script>
<script>
$(document).ready(function() {
$('#rms_warrants').DataTable({

});
});
</script>
<script>
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
      var callId = $('#call_id_det').val();

      $.ajax({
            type: "POST",
            url: "../<?php echo OCINC ?>/generalActions.php",
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
</script>
<script>
$(function() {
$( "#ncic_name" ).autocomplete({
source: "../<?php echo OCINC ?>/js/search_name.php"
});
});
</script>
<script>
$(function() {
$( "#ncic_plate" ).autocomplete({
source: "../<?php echo OCINC ?>/js/search_plate.php"
});
});
</script>
<script>
$(function() {
$( "#ncic_weapon" ).autocomplete({
source: "../<?php echo OCINC ?>/js/search_name.php"
});
});
</script>
<script>
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

</script>
<script>
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


</script>
<script>
function getCalls() {
      $.ajax({
            type: "GET",
            url: "../<?php echo OCINC ?>/generalActions.php",
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
</script>
<script>
function getMyCall() {
      $.ajax({
            type: "GET",
            url: "../<?php echo OCINC ?>/generalActions.php",
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
</script>
<script>
function mdtGetVehicleBOLOS() {
      $.ajax({
            type: "GET",
            url: "../<?php echo OCINC ?>/responderActions.php",
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
</script>
<script>
function mdtGetPersonBOLOS() {
      $.ajax({
            type: "GET",
            url: "../<?php echo OCINC ?>/responderActions.php",
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
</script>
<script>
$(function() {
      $('.callsignForm').submit(function(e) {
         e.preventDefault(); // avoid to execute the actual submit of the form.

         $.ajax({
            type: "POST",
            url: "../<?php echo OCINC ?>/responderActions.php",
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
</script>
<script>

function getStatus() {
$.ajax({
      type: "GET",
      url: "../<?php echo OCINC ?>/responderActions.php",
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
         else
         {

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

   <?php 
   /* To-Do: Transition to when BS5 is complete. */
   // $codes = file_get_contents( ABSPATH . '/oc-content/plugins/radioCodeReference/index.php'); echo $codes ?>

    <script>  
   $(document).ready(function () {
		jsPanel.create(
         {
			theme: 'dark',
			headerTitle: 'Radio Code Reference',
         position: 'center-bottom 0 0',
         headerControls: 'hide',
         contentOverflow: 'hidden',
			contentSize: {
				width: 780,
				height: 528
			},
         content: '<iframe src="<?php echo BASE_URL ?>/oc-content/plugins/radioCodeReference/index.php" scrolling="no" style="width:100%; height:530px;"></iframe>'
		});
   });
</script>
</html>