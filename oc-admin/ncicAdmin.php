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

/**
 * ncicAdmin.php
 *
 * Admin page for managing NCIC entries
 *
 * @author     Shane G
 */

    session_start();

    // TODO: Verify user has permission to be on this page

    if (empty($_SESSION['logged_in']))
    {
        header('Location: ../index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
    }


    if(isset($_SESSION['admin']))
    {
      if ($_SESSION['admin'] == 'YES')
      {
          //Do nothing
      }
    }
    else
    {
      die("You do not have permission to be here. This has been recorded");
    }

    require_once(__DIR__ . '/../oc-config.php');
    require_once(__DIR__ . '/../oc-functions.php');

    include(__DIR__ . '/../actions/adminActions.php');
    include(__DIR__ . '/../actions/ncicAdminActions.php');

    $citationMessage = "";
    if(isset($_SESSION['citationMessage']))
    {
        $citationMessage = $_SESSION['citationMessage'];
        unset($_SESSION['citationMessage']);
    }

    $warrantMessage = "";
    if(isset($_SESSION['warrantMessage']))
    {
        $warrantMessage = $_SESSION['warrantMessage'];
        unset($_SESSION['warrantMessage']);
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

    $identityRequestMessage = "";
    if(isset($_SESSION['identityRequestMessage']))
    {
        $identityRequestMessage = $_SESSION['identityRequestMessage'];
        unset($_SESSION['identityRequestMessage']);
    }

?>

<!DOCTYPE html>
<html lang="en">
	<?php include "../oc-includes/header.inc.php"; ?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="javascript:void(0)" class="site_title"><i class="fa fa-tachometer"></i> <span><?php echo COMMUNITY_NAME;?> Admin</span></a>
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
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/oc-admin/admin.php">Dashboard</a></li>
                      <li><a href="/oc-admin/userManagement.php">User Management</a></li>
                      <li><a href="/oc-admin/callhistory.php">Call History</a></li>
                    </ul>
                  </li>
                  <li class="active"><a><i class="fa fa-database"></i> NCIC Editor <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu"  style="display: block;">
                      <li class="current-page"><a href="javascript:void(0)">NCIC Editor</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-key"></i> CAD Permissions <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/oc-admin/permissionManagement.php">Permissions Management</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <!-- ./ menu_section -->
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Go to Dashboard" href="/dashboard.php">
                <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="/actions/logout.php">
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
                    <img src="<?php echo get_avatar() ?>" alt=""><?php echo $name;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="../profile.php">My Profile</a></li>
                    <li><a href="https://github.com/ossified/openCad/issues">Help</a></li>
                    <li><a href="../actions/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                <h3>CAD NCIC Admin</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="name_panel">
                  <div class="x_title">
                    <h2>Civilian Identity Requests</h2>
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
                      <?php echo $identityRequestMessage;?>
                      <?php getIdentityRequests();?>
                  </div>
                  <!-- ./ x_content -->
                  <div class="x_footer">

                  </div>
                  <!-- ./ x_footer -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
            </div>
            <!-- ./ row -->

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="name_panel">
                  <div class="x_title">
                    <h2>NCIC Names DB</h2>
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
                     <?php echo $nameMessage;?>
                     <?php ncicGetNames();?>
                  </div>
                  <!-- ./ x_content -->
                  <div class="x_footer">
                    <button class="btn btn-primary" name="create_name_btn" type="submit" data-toggle="modal" data-target="#createNameModal">Create Name</button>
                  </div>
                  <!-- ./ x_footer -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
            </div>
            <!-- ./ row -->

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="plate_panel">
                  <div class="x_title">
                    <h2>NCIC Vehicle DB</h2>
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
                     <?php echo $plateMessage;?>
                     <?php ncicGetPlates();?>
                  </div>
                  <!-- ./ x_content -->
                  <div class="x_footer">
                    <button class="btn btn-primary" name="create_plate_btn" type="submit" data-toggle="modal" data-target="#createPlateModal">Create Plate</button>
                  </div>
                  <!-- ./ x_footer -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
            </div>
            <!-- ./ row -->

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="warrant_panel">
                  <div class="x_title">
                    <h2>NCIC Warrants DB</h2>
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

                     <?php echo $warrantMessage;?>
                     <?php ncic_warrants();?>
                  </div>
                  <!-- ./ x_content -->
                  <div class="x_footer">
                    <button class="btn btn-primary" name="create_warrant_btn" type="submit" data-toggle="modal" data-target="#createWarrantModal">Create Warrant</button>
                  </div>
                  <!-- ./ x_footer -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
            </div>
            <!-- ./ row -->

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="citation_panel">
                  <div class="x_title">
                    <h2>NCIC Citations DB</h2>
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
                     <?php echo $citationMessage;?>
                     <?php ncic_citations();?>
                  </div>
                  <!-- ./ x_content -->
                  <div class="x_footer">
                    <button class="btn btn-primary" name="create_citation_btn" type="submit" data-toggle="modal" data-target="#createCitationModal">Create Citation</button>
                  </div>
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

    <!-- modals -->
    <!-- Edit Name Modal -->
    <div class="modal fade" id="editNameModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">NCIC Name Editor</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="../actions/ncicAdminActions.php" method="post">
                <div class="form-group row">
                <label class="col-lg-2 control-label">Civilian Name</label>
                <div class="col-lg-10">

                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Citation Name</label>
                <div class="col-lg-10">

                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
                <input name="edit_name_btn" type="submit" class="btn btn-primary" value="Edit" />
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

    <!-- Create Citation Modal -->
    <div class="modal fade" id="createCitationModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Citation Creator</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="../actions/ncicAdminActions.php" method="post">
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
                <label class="col-lg-2 control-label">Citation Name</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker citation" data-live-search="true" name="citation_name" id="citation_name" title="Select Citation" required>
                    <?php getCitations();?>
                  </select>
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

    <!-- Create Warrant Modal -->
    <div class="modal fade" id="createWarrantModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Warrant Creator</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" action="../actions/ncicAdminActions.php" method="post">
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
                      <option value="1st Degree Murder 1">1st Degree Murder</option>
                      <option value="2nd Degree Murder 1">2nd Degree Murder</option>
                      <option value="3rd Degree Murder 1">3rd Degree Murder</option>
                      <option value="Attempted Murder 1">Attempted Murder</option>
                      <option value="Kidnapping 1">Kidnapping</option>
                      <option value="Attempted Kidnapping 1">Attempted Kidnapping</option>
                      <option value="Hostage Taking 1">Hostage Taking</option>
                      <option value="Bank/Fed Robbery 1">Bank/Fed Robbery</option>
                      <option value="Terroristic Activity 1">Terroristic Activity</option>
                      <option value="Terroristic Threats 1">Terroristic Threats</option>
                      <option value="JailBreak 1">JailBreak</option>
                      <option value="Robbery 1">Robbery</option>
                      <option value="Grand Theft Auto 1">Grand Theft Auto</option>
                      <option value="Burglary 1">Burglary</option>
                      <option value="Threatening an Official 1">Threatening an Official</option>
                      <option value="Sexual Assault 1">Sexual Assault</option>
                      <option value="Hate Crime 1">Hate Crime</option>
                      <option value="Assault 1">Assault</option>
                      <option value="Conspiracy 1">Conspiracy</option>
                      <option value="Drug Trafficking 1">Drug Trafficking</option>
                      <option value="Evasion/Fleeing/Eluding 1">Evasion/Fleeing/Eluding</option>
                      <option value="Felony Evading 1">Felony Evading</option>
                      <option value="Resisting Arrest 1">Resisting Arrest</option>
                      <option value="Firearm in City Limits 1">Firearm in City Limits</option>
                      <option value="Firearm by Felon 1">Firearm by Felon</option>
                      <option value="Unlicensed Firearm 1">Unlicensed Firearm</option>
                      <option value="Firearm Discharge in City Limits 1">Firearm Discharge in City Limits</option>
                      <option value="Illegal Weapon 1">Illegal Weapon</option>
                      <option value="Illegal Magazine 1">Illegal Magazine</option>
                      <option value="Concealed Carry Rifle 1">Concealed Carry Rifle</option>
                      <option value="Failure to Inform 1">Failure to Inform</option>
                    </optgroup>
                    <optgroup label="Non-Violent Warrants (30 day expiry)">
                      <option value="FTA: Lewd Conduct 2">FTA: Lewd Conduct</option>
                      <option value="FTA: DUI/DWI 2">FTA: DUI/DWI</option>
                      <option value="FTA: Fraud 2">FTA: Fraud</option>
                      <option value="FTA: Hit and Run 2">FTA: Hit and Run</option>
                      <option value="FTA: Speeding 2">FTA: Speeding</option>
                      <option value="FTA: Reckless Driving 2">FTA: Reckless Driving</option>
                      <option value="FTA: Obstruction of Justice 2">FTA: Obstruction of Justice</option>
                      <option value="FTA: Verbal Abuse 2">FTA: Verbal Abuse</option>
                      <option value="FTA: Bribery 2">FTA: Bribery</option>
                      <option value="FTA: Disorderly Conduct 2">FTA: Disorderly Conduct</option>
                      <option value="FTA: Drug Posession 2">FTA: Drug Posession</option>
                      <option value="FTA: Trespassing 2">FTA: Trespassing</option>
                      <option value="FTA: Excessive Noise 2">FTA: Excessive Noise</option>
                      <option value="FTA: Failure to Identify 2">FTA: Failure to Identify</option>
                      <option value="FTA: Stalking 2">FTA: Stalking</option>
                      <option value="FTA: Public Intoxication 2">FTA: Public Intoxication</option>
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

    <!-- Create Name Modal -->
    <div class="modal fade" id="createNameModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Name to Database</h4>
          </div>
          <!-- ./ modal-header -->
		  <div class="modal-body">
            <form role="form" action="../actions/ncicAdminActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">First Name</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="first_name" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Last Name</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="last_name" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Date of Birth</label>
                <div class="col-lg-10">
                <input type="text" class="form-control" name="dob" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Address</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="address" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Sex</label>
                <div class="col-lg-10">
                  <select class="form-control" name="sex" required>
                <option value="">  </option>
                <option value="Male"> Male </option>
                <option value="Female"> Female </option>
                </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Race</label>
                <div class="col-lg-10">
                <select class="form-control" name="race" required>
                <option value="">  </option>
                <option value="White"> White </option>
                <option value="Black or African American"> Black or African American </option>
                <option value="American Indian or Alaska Native"> American Indian or Alaska Native </option>
                <option value="Asian"> Asian </option>
                <option value="Native Hawaiian or Other Pacific Islander"> Native Hawaiian or Other Pacific Islander </option>
                <option value="Hispanic"> Asian </option>
                </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">License Status</label>
                  <div class="col-lg-10">
                    <select class="form-control" name="dl_status" required>
                <option value="">  </option>
                <option value="Valid"> Valid </option>
                <option value="Suspended"> Suspended </option>
                <option value="Expired"> Expired </option>
                </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Hair Color</label>
                <div class="col-lg-10">
                  <select class="form-control" name="hair_color" required>
                <option value="">  </option>
                <option value="Black"> Black </option>
                <option value="Blonde"> Blonde </option>
                <option value="Red"> Red </option>
                <option value="Brown"> Brown </option>
                <option value="Gray"> Gray </option>
                </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Build</label>
                <div class="col-lg-10">
                  <select class="form-control" name="build" required>
                <option value="">  </option>
                <option value="Skinny"> Skinny </option>
                <option value="Average"> Average </option>
                <option value="Overweight"> Overweight </option>
                <option value="Muscular"> Muscular </option>
                </select>
                </div>
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
    <!-- ./ modal fade bs-example-modal-lg -->

    <!-- Create Plate Modal -->
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
            <form role="form" action="../actions/ncicAdminActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">Registered Owner</label>
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
                <label class="col-lg-2 control-label">License Plate</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="veh_plate" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Vehicle Make</label>
                <div class="col-lg-10">
                <input type="text" class="form-control" name="veh_make" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Vehicle Modle</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="veh_model" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Vehicle Color</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="veh_color" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Insurance Status</label>
                <div class="col-lg-10">
                <select class="form-control" name="veh_insurance" required>
                <option value="">  </option>
                <option value="Valid"> Valid </option>
                <option value="Expired"> Expired </option>
                </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Vehicle Flags</label>
                  <div class="col-lg-10">
                    <select class="form-control" name="flags" required>
                <option value="">  </option>
                <option value="None"> None </option>
                <option value="Stolen"> Stolen </option>
                <option value="Wanted"> Wanted </option>
                <option value="Suspended Registration"> Suspended Registration </option>
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
              <div class="form-group row">
                <label class="col-lg-2 control-label">Vehicle's Registered State</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="veh_reg_state" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Hidden Notes</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="hidden_notes" />
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

    <?php include "../oc-includes/jquery-colsolidated.inc.php"; ?>
    <script>
		$(document).ready(function() {

			$('#ncic_names').DataTable({

			});

      $('#ncic_plates').DataTable({

			});

      $('#ncic_warrants').DataTable({

			});

      $('#ncic_citations').DataTable({

			});

		});
		</script>
  </body>
</html>
