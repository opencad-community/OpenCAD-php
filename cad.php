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
    include("./oc-config.php");
    include("./actions/api.php");
    include("./actions/dispatchActions.php");
    session_start();

    // TODO: Verify user has permission to be on this page

    if (empty($_SESSION['logged_in']))
    {
        header('Location: ./index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
    }

    if(isset($_SESSION['dispatch']))
    {

      if ($_SESSION['dispatch'] == 'YES')
      {
    setDispatcher("2");
      }
    }
    else
    {
      die("You do not have permission to be here. Request access to dispatch through your administration.");
    }
    
    $citationMessage = "";
    if(isset($_SESSION['citationMessage']))
    {
        $citationMessage = $_SESSION['citationMessage'];
        unset($_SESSION['citationMessage']);
    }
    $arrestMessage = "";
    if(isset($_SESSION['arrestMessage']))
    {
        $arrestMessage = $_SESSION['arrestMessage'];
        unset($_SESSION['arrestMessage']);
    }
    $warningMessage = "";
    if(isset($_SESSION['warningMessage']))
    {
        $citationMessage = $_SESSION['warningMessage'];
        unset($_SESSION['warningMessage']);
    }

    $warrantMessage = "";
    if(isset($_SESSION['warrantMessage']))
    {
        $warrantMessage = $_SESSION['warrantMessage'];
        unset($_SESSION['warrantMessage']);
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
   <?php include "./oc-includes/header.inc.php"; ?>
   <body class="nav-md">
      <div class="container body">
         <div class="main_container">
            <div class="col-md-3 left_col">
               <div class="left_col scroll-view">
                  <div class="navbar nav_title" style="border: 0;">
                     <a href="javascript:void(0)" class="site_title"><i class="fa fa-tachometer"></i> <span><?php echo COMMUNITY_NAME;?> Dispatch</span></a>
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
                              <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu" style="display: block;">
                                 <li class="current-page"><a href="javascript:void(0)">Dashboard</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-clock-o"></i> Stopwatch <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a href="https://www.timeanddate.com/stopwatch/" target="_blank">Stopwatch</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-book"></i> Warnings <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a type="button" data-toggle="modal" data-target="#createWarning" > Create Warning</a></li>
                                 <li><a type="button" data-toggle="modal" data-target="#viewWarning" > View Warnings</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-book"></i> Citations <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a type="button" data-toggle="modal" data-target="#createCitation" > Create Citation</a></li>
                                 <li><a type="button" data-toggle="modal" data-target="#viewCitation" > View Citations</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-warning"></i> Arrest Report <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a type="button" data-toggle="modal" data-target="#createArrest" > Create Arrest Report</a></li>
                                 <li><a type="button" data-toggle="modal" data-target="#viewArrest" > View Arrests</a></li>
                              </ul>
                           </li>
                           <li>
                              <a><i class="fa fa-warning"></i> Warrants <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                 <li><a type="button" data-toggle="modal" data-target="#createWarrant" > Create Warrants</a></li>
                                 <li><a type="button" data-toggle="modal" data-target="#viewWarrant" > View Warrants</a></li>
                              </ul>
                           </li>
                           <li>
                                 <a type="button" data-toggle="modal" data-target="#rms" > Report Management System</a>
                           </li>
                        </ul>
                     </div>
                     <!-- ./ menu_section -->
                  </div>
                  <!-- /sidebar menu -->
                  <!-- /menu footer buttons -->
                  <div class="sidebar-footer hidden-small">
                     <!--
                        —— Left in for user settings. To be introduced later. Probably after RC1. ——
                        <a data-toggle="tooltip" data-placement="top">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>-->
                     <a data-toggle="tooltip" data-placement="top" title="FullScreen" onClick="toggleFullScreen()">
                     <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                     </a>
                     <a data-toggle="tooltip" data-placement="top" title="Go to Dashboard" href="<?php echo BASE_URL; ?>/dashboard.php">
                     <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                     </a>
                     <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>">
                     <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
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
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                     </div>
                     <ul class="nav navbar-nav navbar-right">
                        <li class="">
                           <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                           <img src="<?php echo get_avatar() ?>" alt=""><?php $_SESSION['name']; ?>
                           <span class=" fa fa-angle-down"></span>
                           </a>
                           <ul class="dropdown-menu dropdown-usermenu pull-right">
                              <li><a href="<?php echo BASE_URL; ?>/profile.php">My Profile</a></li>
                              <li><a href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                        <h3>CAD Console</h3>
                        <p>(Not <?php echo $name;?>?, <a href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>">Log Out</a>)
                        <?php echo $citationMessage;?>
                        <?php echo $warrantMessage;?>
						<?php echo $warningMessage;?>
                     </div>
                     <!-- ./ title_left -->
                  </div>
                  <!-- ./ page-title -->
                  <?php /* hiding for now
                     <div class="clearfix"></div>
                     <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                         <div class="x_panel">
                           <div class="x_title">
                             <h2>Command Line Interface</h2>
                             <ul class="nav navbar-right panel_toolbox">
                               <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                               <li><a data-toggle="modal" href="#quickGuide"><i class="fa fa-question-circle"></i></a></li>
                             </ul>
                             <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                               <div class="col-md-12">
                                 <div class="input-group">
                                     <input type="text" name="cli" class="form-control" id="cli" placeholder="Coming Soon!"/>
                                     <span class="input-group-btn">
                                         <button type="button" class="btn btn-primary" disabled>Send</button>
                                     </span>
                                 </div>
                                 <!-- ./ input-group -->
                               </div>
                               <!-- ./ col-md-12 -->
                           </div>
                           <!-- ./ x_content -->
                         </div>
                         <!-- ./ x_panel -->
                       </div>
                       <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
                     </div>
                     <!-- ./ row -->
                     */?>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>Active Calls</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                              <div id="noCallsAlertHolder">
                                 <?php //getActiveCalls();?>
                                 <span id="noCallsAlertSpan"></span>
                              </div>
                              <div id="live_calls"></div>
                           </div>
                           <!-- ./ x_content -->
                           <div class="x_footer">
                              <button class="btn btn-primary" name="new_call_btn" data-toggle="modal" data-target="#newCall">New Call</button>
                              <button class="btn btn-danger pull-right" onClick="priorityTone('single')" value="0" id="priorityTone">10-3 Tone</button>
                              <button class="btn btn-danger pull-right" onClick="priorityTone('recurring')" value="0" id="recurringTone">Priority Tone</button>
                              <button class="btn btn-danger pull-right" onClick="priorityTone('panic')" value="0" id="panicTone">Panic Button</button>
                           </div>
                        </div>
                        <!-- ./ x_panel -->
                     </div>
                     <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>Active BOLOs</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                              <div id="noCallsAlertHolder">
							  <?php echo $boloMessage;?>
                           <div class="x_content">
                              <div id="cadpersonbolo"></div>
                           </div>
                           <div class="x_content">
                              <div id="cadvehiclebolo"></div>
                           </div>
                                 <span id="noCallsAlertSpan"></span>
                              </div>
                              <div id="live_calls"></div>
                           </div>
                           <!-- ./ x_content -->
                           <div class="x_footer">
                              <button class="btn btn-warning" name="new_call_btn" data-toggle="modal" data-target="#newPersonsBOLO">New Persons BOLO</button>
                              <button class="btn btn-warning" name="new_call_btn" data-toggle="modal" data-target="#newVehicleBOLO">New Vehicle BOLO</button>
                           </div>
                        </div>
                        <!-- ./ x_panel -->
                     </div>
                     <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
                  </div>
                  <!-- ./ row -->
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-2 col-sm-2 col-xs-2">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>Active Dispatchers</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                              <div id="activeDispatchers"></div>
                           </div>
                           <!-- ./ x_content -->
                        </div>
                        </div>
                        <!-- ./ x_panel -->
                     <!-- ./ col-md-2 col-sm-2 col-xs-2 -->
                     <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>Available Units</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                              <div id="availableUnits"></div>
                           </div>
                           <!-- ./ x_content -->
                        </div>
                        <!-- ./ x_panel -->
                     </div>
                     <!-- ./ col-md-5 col-sm-5 col-xs-5 -->
                     <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>Unavailable Units</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                              <div id="unAvailableUnits">
                              </div>
                           </div>
                           <!-- ./ x_content -->
                        </div>
                        <!-- ./ x_panel -->
                     </div>
                     <!-- ./ col-md-5 col-sm-5 col-xs-5 -->
                  </div>
                  <!-- ./ row -->
                  <div class="clearfix"></div>
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>NCIC Name Lookup</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                              <div class="input-group">
                                 <input id="ncic_name" type="text" class="form-control" placeholder="John Doe" name="ncic_name"/>
                                 <span class="input-group-btn">
                                 <button type="button" class="btn btn-primary" name="ncic_name_btn" id="ncic_name_btn">Send</button>
                                 </span>
                              </div>
                              <!-- ./ input-group -->
                              <div name="ncic_name_return" id="ncic_name_return" contenteditable="false" style="background-color: #eee; opacity: 1; font-family: 'Courier New'; font-size: 15px; font-weight: bold;">
                                 <!--<textarea class="form-control" style="resize:none;" id="ncic_name_return" name="ncic_name_return" readonly="readonly"></textarea> -->
                              </div>
                              <!-- ./ ncic_name_return -->
                           </div>
                           <!-- ./ x_content -->
                        </div>
                        <!-- ./ x_panel -->
                     </div>
                     <!-- ./ col-md-4 col-sm-4 col-xs-4 -->
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>NCIC Plate Lookup</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                              <div class="input-group">
                                 <input type="text" name="ncic_plate" class="form-control" id="ncic_plate" placeholder="License Plate, (ABC123)"/>
                                 <span class="input-group-btn">
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
                     <!-- ./ col-md-4 col-sm-4 col-xs-4 -->
                     <!-- NCIC Firearm lookup will return in a later RC -->
                     <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="x_panel">
                           <div class="x_title">
                              <h2>NCIC Weapon Lookup</h2>
                              <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           <!-- ./ x_title -->
                           <div class="x_content">
                              <div class="input-group">
                                 <input type="text" name="ncic_weapon" class="form-control" id="ncic_weapon" placeholder="John Doe"/>
                                 <span class="input-group-btn">
                                 <button type="button" class="btn btn-primary" name="ncic_weapon_btn" id="ncic_weapon_btn">Send</button>
                                 </span>
                              </div>
                              <!-- ./ input-group -->
                              <div name="ncic_weapon_return" id="ncic_weapon_return" contenteditable="false" style="background-color: #eee; opacity: 1; font-family: 'Courier New'; font-size: 15px; font-weight: bold;">
                                 <!--<textarea class="form-control" style="resize:none;" id="ncic_name_return" name="ncic_name_return" readonly="readonly"></textarea> -->
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
         <!-- "" -->
      </div>
      <!-- /page content -->
      <!-- footer content -->
      <footer>
         <div class="pull-right">
            <?php echo COMMUNITY_NAME;?> CAD Console
         </div>
         <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
      </div>
      </div>
      <!-- modals -->
      <!-- Quick Guide Modal -->
      <div class="modal fade" id="quickGuide" tabindex="-1" role="dialog" aria-hidden="true">
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
      <!-- ./ modal fade bs-example-modal-lg -->
      <div class="modal fade" id="rms" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
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
    <!-- ./ modal fade bs-example-modal-lg -->
      <!-- Assign User to Call Modal -->
      <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-hidden="true">
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
      <!-- ./ modal fade bs-example-modal-lg -->
      <!-- New Call Modal -->
      <div class="modal fade" id="newCall" tabindex="-1" role="dialog" aria-hidden="true">
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
                           <select class="form-control selectpicker" data-live-search="true" name="call_type" title="Incident Type" required>
                              <?php getIncidentType();?>
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
    <div class="modal fade" id="newPersonsBOLO" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Create Person BOLO</h4>
          </div>
          <!-- ./ modal-header -->
		  <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">First Name</label>
                <div class="col-lg-10">
					<input name="first_name" class="form-control" id="first_name" placeholder="First Name of the BOLOed subject."/>
					<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Last Name</label>
                <div class="col-lg-10">
					<input name="last_name" class="form-control" id="last_name" placeholder="Last Name of the BOLOed subject."/>
					<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
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
					<input name="physical_description" class="form-control" id="physical_description" placeholder="Physical description of the BOLOed subject."/>
					<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Reason Wanted</label>
                <div class="col-lg-10">
					<textarea name="reason_wanted" class="form-control" style="text-transform:uppercase" rows="5" id="reason_wanted" placeholder="Wanted reason of the BOLOed subject." required> </textarea>
					<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Last Seen</label>
                <div class="col-lg-10">
					<input name="last_seen" class="form-control" id="last_seen" placeholder="Last observed location of the BOLOed subject."/>
					<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
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
    <!-- ./ modal fade bs-example-modal-lg -->
    <!-- Edit Person Bolo Modal -->
    <div class="modal fade" id="editPersonboloModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit Person BOLO</h4>
          </div>
          <!-- ./ modal-header -->
      <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">First Name</label>
                <div class="col-lg-10">
          <input name="first_name" class="form-control" id="first_name" placeholder="First Name of the BOLOed subject."/>
          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Last Name</label>
                <div class="col-lg-10">
          <input name="last_name" class="form-control" id="last_name" placeholder="Last Name of the BOLOed subject."/>
          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
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
          <input name="physical_description" class="form-control" id="physical_description" placeholder="Physical description of the BOLOed subject."/>
          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Reason Wanted</label>
                <div class="col-lg-10">
          <textarea name="reason_wanted" class="form-control" style="text-transform:uppercase" rows="5" id="reason_wanted" placeholder="Wanted reason of the BOLOed subject." required> </textarea>
          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                <label class="col-lg-2 control-label">Last Seen</label>
                <div class="col-lg-10">
          <input name="last_seen" class="form-control" id="last_seen" placeholder="Last observed location of the BOLOed subject."/>
          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
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
    <!-- ./ modal fade bs-example-modal-lg -->
	<!-- New Vehicle Bolo Modal -->
    <div class="modal fade" id="newVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Create Vehicle BOLO</h4>
          </div>
          <!-- ./ modal-header -->
		  <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Make</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker" data-live-search="true" name="vehicle_make" title="Vehicle Make" required>
                              <?php getVehicleMakes();?>
                           </select>
                        </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Model</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker" data-live-search="true" name="vehicle_model" title="Vehicle Model" required>
                              <?php getVehicleModels();?>
                           </select>
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Plate</label>
                        <div class="col-lg-10">
                						<input type="text" class="form-control vehicle_plate" name="vehicle_plate" placeholder="The plate of the BOLO vehicle." />
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                        <label class="col-lg-2 control-label">Primary Color</label>
                        <div class="col-lg-10">
                						<input type="text" class="form-control primary_color" name="primary_color" placeholder="The primary color of the BOLO vehicle." />
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Secondary Color</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control secondary_color" name="secondary_color" placeholder="The secondary color, if any, of the BOLO vehicle." />                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Reason Wanted</label>
                        <div class="col-lg-10">
                                <textarea name="reason_wanted" id="narrative" class="form-control reason_wanted" style="text-transform:uppercase" rows="5"></textarea>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Last Seen</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control last_seen" name="last_seen" placeholder="Last observed location of the BOLOed vehicle." />
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
              <!-- ./ form-group -->
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
    <!-- ./ modal fade bs-example-modal-lg -->
    <!-- Edit Vehicle Bolo Modal -->
    <div class="modal fade" id="editVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit Vehicle BOLO</h4>
          </div>
          <!-- ./ modal-header -->
      <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/dispatchActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Make</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker vehicle_make" data-live-search="true" name="vehicle_make" title="Vehicle Make" required>
                              <?php getVehicleMakes();?>
                           </select>
                        </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Model</label>
                        <div class="col-lg-10">
                           <select class="form-control selectpicker vehicle_model" data-live-search="true" name="vehicle_model" title="Vehicle Model" required>
                              <?php getVehicleModels();?>
                           </select>
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                <div class="form-group row">
                        <label class="col-lg-2 control-label">Vehicle Plate</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control vehicle_plate" name="vehicle_plate" placeholder="The plate of the BOLO vehicle." />
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                        <label class="col-lg-2 control-label">Primary Color</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control primary_color" name="primary_color" placeholder="The primary color of the BOLO vehicle." />
                        </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Secondary Color</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control secondary_color" name="secondary_color" placeholder="The secondary color, if any, of the BOLO vehicle." />                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Reason Wanted</label>
                        <div class="col-lg-10">
                                <textarea name="reason_wanted" id="narrative" class="form-control reason_wanted" style="text-transform:uppercase" rows="5"></textarea>
                        </div>
                        <!-- ./ col-sm-9 -->
                     </div>
              <!-- ./ form-group -->
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Last Seen</label>
                        <div class="col-lg-10">
                           <input type="text" class="form-control last_seen" name="last_seen" placeholder="Last observed location of the BOLOed vehicle." />
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
      <div class="modal fade" id="callDetails" tabindex="-1" role="dialog" aria-hidden="true">
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
	  </div>
	  </div>
	  </div>
      <!-- ./ modal fade bs-example-modal-lg -->
      
      <!-- New Vehicle BOLO Modal -->
      <div class="modal fade" id="createVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
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
                           <select class="form-control selectpicker" data-live-search="true" name="vehicle_make" title="Vehicle Make" required>
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
      <div class="modal fade" id="createCitation" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Citation Creator</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/dispatchActions.php" method="post">
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
    <!-- ./ modal fade bs-example-modal-lg -->
      <!-- View Citation Modal -->
      <div class="modal fade" id="viewCitation" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php ncic_citations();?>
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
    <!-- ./ modal fade bs-example-modal-lg -->
      <!-- Create Warning Modal -->
      <div class="modal fade" id="createWarning" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Warning Creator</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/dispatchActions.php" method="post">
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
    <!-- ./ modal fade bs-example-modal-lg -->
      <div class="modal fade" id="createArrest" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">Arrest Report</h4>
            </div>
            <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/dispatchActions.php" method="post">
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
    <!-- ./ modal fade bs-example-modal-lg -->
      <div class="modal fade" id="viewArrest" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php ncic_arrests();?>
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
    <!-- ./ modal fade bs-example-modal-lg -->
      <!-- View Warning Modal -->
      <div class="modal fade" id="viewWarning" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                     <?php ncic_warnings();?>
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
    <!-- ./ modal fade bs-example-modal-lg -->
	
      <!-- Create Warrant Modal -->
      <div class="modal fade" id="createWarrant" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
                  </button>
            <h4 class="modal-title" id="myModalLabel">Warrant Creator</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/dispatchActions.php" method="post">
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
                  <select class="form-control selectpicker" name="issuing_agency" id="issuing_agency" data-live-search="true" required>
                    <option> </option>
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
    <!-- ./ modal fade bs-example-modal-lg -->
      <!-- View Warrant Modal -->
      <div class="modal fade" id="viewWarrant" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
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
    <!-- ./ modal fade bs-example-modal-lg -->
      <!-- AUDIO TONES -->
      <audio id="recurringToneAudio" src="<?php echo BASE_URL; ?>/sounds/priority.mp3" preload="auto"></audio>
      <audio id="priorityToneAudio" src="<?php echo BASE_URL; ?>/sounds/Priority_Traffic_Alert.mp3" preload="auto"></audio>
      <audio id="panicToneAudio" src="<?php echo BASE_URL; ?>/sounds/Panic_Button.m4a" preload="auto"></audio>
      <?php include "./oc-includes/jquery-colsolidated.inc.php"; ?>
      <script>
         var vid = document.getElementById("recurringToneAudio");
         vid.volume = 0.3;
      </script>
</style>

      <script>
  $(function() {
    $( "#ncic_name" ).autocomplete({
      source: "<?php echo BASE_URL; ?>/js/search_name.php"
    });
  });
  </script>
      <script>
  $(function() {
    $( "#ncic_plate" ).autocomplete({
      source: "<?php echo BASE_URL; ?>/js/search_plate.php"
    });
  });
  </script>
      <script>
  $(function() {
    $( "#ncic_weapon" ).autocomplete({
      source: "<?php echo BASE_URL; ?>/js/search_name.php"
    });
  });
  </script>
    <script>
    $(document).ready(function() {
        $('#ncic_warnings').DataTable({

        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#ncic_citations').DataTable({

        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#ncic_arrests').DataTable({

        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#ncic_warrants').DataTable({

        });
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

             getCalls();
             getAvailableUnits();
             getUnAvailableUnits();
             getDispatchers();
             checkTones();
             cadGetPersonBOLOS();
             cadGetVehicleBOLOS();

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
               url: "<?php echo BASE_URL; ?>/actions/api.php",
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
      </script>
      <script>
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
                 url: "<?php echo BASE_URL; ?>/actions/api.php",
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
      </script>
      <script>
         function getAvailableUnits() {
           $.ajax({
                 type: "GET",
                 url: "<?php echo BASE_URL; ?>/actions/api.php",
                 data: {
                     getAvailableUnits: 'yes'
                 },
                 success: function(response)
                 {
                   $('#availableUnits').html(response);

                   // SG - Removed until node/real-time data setup
                   /*$('#activeUsers').DataTable({
                     searching: false,
                     scrollY: "200px",
                     lengthMenu: [[4, -1], [4, "All"]]
                });*/
                   setTimeout(getAvailableUnits, 5000);


                 },
                 error : function(XMLHttpRequest, textStatus, errorThrown)
                 {
                   console.log("Error");
                 }

               });
         }


      </script>
      <script>
         function getDispatchers() {
           $.ajax({
                 type: "GET",
                 url: "<?php echo BASE_URL; ?>/actions/api.php",
                 data: {
                     getDispatchers: 'yes'
                 },
                 success: function(response)
                 {
                   $('#activeDispatchers').html(response);

                   // SG - Removed until node/real-time data setup
                   /*$('#activeUsers').DataTable({
                     searching: false,
                     scrollY: "200px",
                     lengthMenu: [[4, -1], [4, "All"]]
                });*/
                   setTimeout(getDispatchers, 5000);


                 },
                 error : function(XMLHttpRequest, textStatus, errorThrown)
                 {
                   console.log("Error");
                 }

               });
         }


      </script>
      <script>
         function cadGetPersonBOLOS() {
           $.ajax({
                 type: "GET",
                 url: "<?php echo BASE_URL; ?>/actions/dispatchActions.php",
                 data: {
                     cadGetPersonBOLOS: 'yes'
                 },
                 success: function(response)
                 {
                   $('#cadpersonbolo').html(response);

                   // SG - Removed until node/real-time data setup
                   /*$('#activeUsers').DataTable({
                     searching: false,
                     scrollY: "200px",
                     lengthMenu: [[4, -1], [4, "All"]]
                });*/
                   setTimeout(cadGetPersonBOLOS, 5000);


                 },
                 error : function(XMLHttpRequest, textStatus, errorThrown)
                 {
                   console.log("Error");
                 }

               });
         }


      </script>
      <script>
         function cadGetVehicleBOLOS() {
           $.ajax({
                 type: "GET",
                 url: "<?php echo BASE_URL; ?>/actions/dispatchActions.php",
                 data: {
                     cadGetVehicleBOLOS: 'yes'
                 },
                 success: function(response)
                 {
                   $('#cadvehiclebolo').html(response);

                   // SG - Removed until node/real-time data setup
                   /*$('#activeUsers').DataTable({
                     searching: false,
                     scrollY: "200px",
                     lengthMenu: [[4, -1], [4, "All"]]
                });*/
                   setTimeout(cadGetVehicleBOLOS, 5000);


                 },
                 error : function(XMLHttpRequest, textStatus, errorThrown)
                 {
                   console.log("Error");
                 }

               });
         }


      </script>
      <script>
        $(function(){
            $(document).on('click', '#edit_personbolo', function(e){
                e.preventDefault();
                var edit_id = $(this).data('id');
                $.ajax({
                  url: '<?php echo BASE_URL; ?>/actions/dispatchActions.php',
                  type: 'POST',
                  data: 'bolos_personid='+edit_id,
                  dataType: 'json',
                  cache: false
                  })
                  .done(function(data){
                    $('#editPersonboloModal #first_name').val(data.first_name);
                    $('#editPersonboloModal #last_name').val(data.last_name);
                    $('#editPersonboloModal #physical_description').val(data.physical_description);
                    $('.gender_picker').selectpicker('val', data.gender);
                    $('#editPersonboloModal #reason_wanted').val(data.reason_wanted);
                    $('#editPersonboloModal #last_seen').val(data.last_seen);
                    $('#editPersonboloModal .Editdataid').val(data.id);
                  });
              });
              $(document).on('click', '#edit_vehiclebolo', function(e){
                e.preventDefault();
                var edit_id = $(this).data('id');
                $.ajax({
                  url: '<?php echo BASE_URL; ?>/actions/dispatchActions.php',
                  type: 'POST',
                  data: 'bolos_vehicleid='+edit_id,
                  dataType: 'json',
                  cache: false
                  })
                  .done(function(data){
                    $('#editVehicleBOLO .vehicle_make').selectpicker('val', data.vehicle_make);
                    $('#editVehicleBOLO .vehicle_model').selectpicker('val', data.vehicle_model);
                    $('#editVehicleBOLO .vehicle_plate').val(data.vehicle_plate);
                    $('#editVehicleBOLO .primary_color').val(data.primary_color);
                    $('#editVehicleBOLO .secondary_color').val(data.secondary_color);
                    $('#editVehicleBOLO .last_seen').val(data.last_seen);
                    $('#editVehicleBOLO .reason_wanted').val(data.reason_wanted);
                    $('#editVehicleBOLO .EditVehicleId').val(data.id);
                  });
              })
          });
      </script>
   </body>
</html>
