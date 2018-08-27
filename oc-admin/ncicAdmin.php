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

    require_once(__DIR__ . '/../oc-config.php');
    require_once(__DIR__ . '/../oc-functions.php');

    include(__DIR__ . '/../actions/adminActions.php');
    include(__DIR__ . '/../actions/ncicAdminActions.php');



    if ( $_SESSION['admin_privilege'] == 2)
    {
      if ($_SESSION['admin_privilege'] == 'Administrator')
      {
          //Do nothing
      }
    }
    else if ( $_SESSION['admin_privilege'] == 1 && MODERATOR_NCIC_EDITOR == true )
    {
      if ($_SESSION['admin_privilege'] == 'Moderator')
      {
          //Do nothing
      }
    }
    else
    {
      die("You do not have permission to be here. This has been recorded");
    }


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
              <a href="javascript:void(0)" class="site_title"><i class="fas fa-lock"></i> <span>Administrator</span></a>
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
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Go to Dashboard" href="<?php echo BASE_URL; ?>/dashboard.php">
              <span class="fas fa-clipboard-list" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen" onClick="toggleFullScreen()">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo BASE_URL; ?>/actions/logout.php?responder=<?php echo $_SESSION['identifier'];?>">
              <span class="fas fa-sign-out-alt" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Need Help?" href="https://guides.opencad.io/">
              <span class="fas fa-info-circle" aria-hidden="true"></span>
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
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo get_avatar() ?>" alt=""><?php echo $name;?>
                    <span class="fas fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo BASE_URL; ?>/profile.php"><i class="fas fa-user pull-right"></i>My Profile</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/actions/logout.php"><i class="fas fa-sign-out-alt pull-right"></i> Log Out</a></li>
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
                    <h2>NCIC Names DB</h2>
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
                     <?php echo $nameMessage;?>
                     <?php ncicGetNames();?>
                  </div>
                  <!-- ./ x_content -->
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
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
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
                    <h2>NCIC Weapon DB</h2>
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
                     <?php echo $plateMessage;?>
                     <?php ncicGetWeapons();?>
                  </div>
                  <!-- ./ x_content -->
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
                    <h2>NCIC Warnings DB</h2>
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
                     <?php echo $citationMessage;?>
                     <?php ncic_warnings();?>
                  </div>
                  <!-- ./ x_content -->
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
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
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
                    <h2>NCIC Arrests DB</h2>
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
                     <?php echo $citationMessage;?>
                     <?php ncic_arrests();?>
                  </div>
                  <!-- ./ x_content -->
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
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
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
                  <!-- ./ x_footer -->
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
            <form role="form" action="<?php echo BASE_URL; ?>/actions/ncicAdminActions.php" method="post">
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
            <form role="form" action="<?php echo BASE_URL; ?>/actions/ncicAdminActions.php" method="post">
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
            <form role="form" action="<?php echo BASE_URL; ?>/actions/ncicAdminActions.php" method="post">
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

    <!-- Create Name Modal -->
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
            <form role="form" action="<?php echo BASE_URL; ?>/actions/civActions.php" class="editname_modalform" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">Name</label>
                <div class="col-lg-10">
          <input name="civNameReq" class="form-control" id="civNameReq" value="<?php echo $civName;?>" required/>
          <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Date of Birth</label>
                <div class="col-lg-10">
          <input type="text" name="civDobReq" class="form-control" id="datepicker2" maxlength="10" value="<?php echo $civDob;?>" required/>
          <span class="fas fa-calendar form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Address</label>
                <div class="col-lg-10">
          <input type="text" name="civAddressReq" class="form-control" id="civAddressReq" value="<?php echo $civAddr;?>" required/>
          <span class="fas fa-location-arrow form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Sex</label>
                <div class="col-lg-10">
          <select name="civSexReq" class="form-control selectpicker selectpicker3" id="civSexReq" title="Select a sex" data-live-search="true" required>
                    <?php getGenders();?>
          </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Race</label>
                <div class="col-lg-10">
          <select name="civRaceReq" class="form-control selectpicker civRaceReq_picker" id="civRaceReq" title="Select a race or ethnicity" required>
            <option val="indian">American Indian or Alaskan Native</option>
            <option val="asian">Asian</option>
            <option val="black">Black or African American</option>
            <option val="hispanic">Hispanic</option>
            <option val="hawaiian">Native Hawaiian or Other Pacific Islander</option>
            <option val="white">White</option>
          </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">License Status</label>
                  <div class="col-lg-10">
                    <select name="civDL" class="form-control selectpicker civDL_picker" id="civDL" title="Select a license status" required>
                <option value="Unobtained"> Unobtained </option>
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
        <select name="civHairReq" class="form-control selectpicker civHairReq_picker" id="civHairReq" title="Select a hair color" required>
          <option val="bld">Bald</option>
          <option val="blk">Black</option>
          <option val="bln">Blond or Strawberry</option>
          <option val="blu">Blue</option>
          <option val="bro">Brown</option>
          <option val="gry">Gray or Partially Gray</option>
          <option val="grn">Green</option>
          <option val="ong">Orange</option>
          <option val="pnk">Pink</option>
          <option val="ple">Purple</option>
          <option val="red">Red or Auburn</option>
          <option val="sdy">Sandy</option>
          <option val="whi">White</option>
          </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Build</label>
                <div class="col-lg-10">
          <select name="civBuildReq" class="form-control selectpicker civBuildReq_picker" id="civBuildReq" title="Select a build" required>
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
              <div class="form-group row">
                <label class="col-lg-2 control-label">Weapon Status</label>
                <div class="col-lg-10">
					<select name="civWepStat" class="form-control civWepStat_picker" id="civWepStat" title="Select a status" required>
						<option val="Obtained">Obtained</option>
						<option val="Unobtained">Unobtained</option>
						</select>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->

          </div>
              <div class="form-group row">
                <label class="col-lg-2 control-label">Deceased</label>
                <div class="col-lg-10">
					<select name="civDec" class="form-control civDec_picker" id="civDec" title="Are you deceased?" required>
						<option val="Yes">Yes</option>
						<option val="No">No</option>
						</select>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->

          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
                <input type="hidden" name="Edit_id" value="" class="Editdataid"/>
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

    <!-- Create Plate Modal -->
    <div class="modal fade" id="editPlateModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit Plate to Database</h4>
          </div>
          <!-- ./ modal-header -->
      <div class="modal-body">
            <form role="form" action="<?php echo BASE_URL; ?>/actions/ncicAdminActions.php" method="post">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                <label class="col-lg-2 control-label">Registered Owner</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker civilian_names_picker" name="civilian_names" id="civilian_names" data-live-search="true" required>
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
                  <input type="text" class="form-control veh_plate" name="veh_plate" required/>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Vehicle Make-Model</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker veh_makemodelpicker" name="veh_make_model" id="veh_make_model" data-live-search="true" required>
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
                  <select class="form-control selectpicker veh_pcolor_picker" name="veh_pcolor" data-live-search="true" required>
          <option val="">  </option>
          <?php getColors();?>
          </select>
          </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Vehicle Secondary Color</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker veh_scolor_picker" name="veh_scolor" data-live-search="true" required>
          <option val="">  </option>
          <?php getColors();?>
          </select>
          </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Insurance Status</label>
                <div class="col-lg-10">
                <select class="form-control veh_insurance_option" name="veh_insurance" id="insurance_edit" required>
                <option value="">  </option>
                <option value="VALID"> Valid </option>
                <option value="EXPIRED"> Expired </option>
                </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Vehicle Flags</label>
                  <div class="col-lg-10">
                    <select class="form-control flags_option" name="flags" required>
                <option value="">  </option>
                <option value="NONE"> None </option>
                <option value="STOLEN"> Stolen </option>
                <option value="WANTED"> Wanted </option>
                <option value="SUSPENDED REGISTRATION"> Suspended Registration </option>
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
          <option value"">  </option>
				  <option value"Alabama"> Alabama </option>
				  <option value"Alaska"> Alaska </option>
				  <option value"Arizona"> Arizona </option>
				  <option value"Arkansas"> Arkansas </option>
				  <option value"California"> California </option>
				  <option value"Colorado"> Colorado </option>
				  <option value"Connecticut"> Connecticut </option>
				  <option value"Delaware"> Delaware </option>
				  <option value"Florida"> Florida </option>
				  <option value"Georgia"> Georgia </option>
				  <option value"Hawaii"> Hawaii </option>
				  <option value"Idaho"> Idaho </option>
				  <option value"Illinois"> Illinois </option>
				  <option value"Indiana"> Indiana </option>
				  <option value"Iowa"> Iowa </option>
				  <option value"Kansas"> Kansas </option>
				  <option value"Kentucky"> Kentucky </option>
				  <option value"Louisiana"> Louisiana </option>
				  <option value"Maine"> Maine </option>
				  <option value"Maryland"> Maryland </option>
				  <option value"Massachusetts"> Massachusetts </option>
				  <option value"Michigan"> Michigan </option>
				  <option value"Minnesota"> Minnesota </option>
				  <option value"Mississippi"> Mississippi </option>
				  <option value"Missouri"> Missouri </option>
				  <option value"Montana"> Montana </option>
				  <option value"Nebraska"> Nebraska </option>
				  <option value"Nevada"> Nevada </option>
				  <option value"New Hampshire"> New Hampshire </option>
				  <option value"New Jersey"> New Jersey </option>
				  <option value"New Mexico"> New Mexico </option>
				  <option value"New York"> New York </option>
				  <option value"North Carolina"> North Carolina </option>
				  <option value"North Dakota"> North Dakota </option>
				  <option value"Ohio"> Ohio </option>
				  <option value"Oklahoma"> Oklahoma </option>
				  <option value"Oregon"> Oregon </option>
				  <option value"Pennsylvania"> Pennsylvania </option>
				  <option value"Rhode Island"> Rhode Island </option>
				  <option value"San Andreas"> San Andreas </option>
				  <option value"South Carolina"> South Carolina </option>
				  <option value"South Dakota"> South Dakota </option>
				  <option value"Tennessee"> Tennessee </option>
				  <option value"Texas"> Texas </option>
				  <option value"Utah"> Utah </option>
				  <option value"Vermont"> Vermont </option>
				  <option value"Virginia"> Virginia </option>
				  <option value"Washington"> Washington </option>
				  <option value"West Virginia"> West Virginia </option>
				  <option value"Wisconsin"> Wisconsin </option>
				  <option value"Wyoming"> Wyoming </option>
          </select>
          </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
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

      $('#ncic_arrests').DataTable({

			});

      $('#ncic_warnings').DataTable({

			});

		});
		</script>
  <script>
    $(function(){
      $(document).on('click', '#edit_nameBtn', function(e){
        e.preventDefault();
        var edit_id = $(this).data('id');
        console.log(edit_id);
        $.ajax({
          url: '<?php echo BASE_URL; ?>/actions/ncicAdminActions.php',
          type: 'POST',
          data: 'editid='+edit_id,
          dataType: 'json',
          cache: false
          })
          .done(function(data){
            $('#IdentityEditModal #civNameReq').val(data.name);
            $('#IdentityEditModal #datepicker2').datepicker({dateFormat: 'yy-mm-dd'}).datepicker('setDate', new Date(data.dob));
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
      $(document).on('click', '#edit_plateBtn', function(e){
        e.preventDefault();
        var edit_id = $(this).data('id');
        $.ajax({
          url: '<?php echo BASE_URL; ?>/actions/ncicAdminActions.php',
          type: 'POST',
          data: 'edit_plateid='+edit_id,
          dataType: 'json',
          cache: false
          })
          .done(function(data){
            $('.civilian_names_picker').selectpicker('val', data.name_id);
            $('.veh_plate').val(data.veh_plate);
            $('.veh_makemodelpicker').selectpicker('val', data.veh_make+' '+data.veh_model);
            $('.veh_pcolor_picker').selectpicker('val', data.veh_pcolor);
            $('.veh_scolor_picker').selectpicker('val', data.veh_scolor);
            $('#insurance_edit').val(data.veh_insurance);
            $('.flags_option').val(data.flags);
            $('.notes').val(data.notes);
            $('.veh_reg_state_option').val(data.veh_reg_state);
            $('.editplateid').val(data.id);
          });
      });
    })
  </script>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
  </script>
  <script>
  $(document).ready(function() {

    $('#pendingUsers').DataTable({
      paging: false,
      searching: false
    });

  });
  </script>
  <script type="text/javascript" src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1"></script>
  </body>
</html>
