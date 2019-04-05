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

    // HACK
    $civName = "";
    $civDob  = "";
    $civAddr = "";

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
    include(__DIR__ . './../actions/adminActions.php');
    include(__DIR__ . './../actions/ncicAdminActions.php');
    include("../actions/publicFunctions.php");

    if ( $_SESSION['admin_privilege'] == 3)
    {
      if ($_SESSION['admin_privilege'] == 'Administrator')
      {
          //Do nothing
      }
    }
    else if ( $_SESSION['admin_privilege'] == 2 && MODERATOR_NCIC_EDITOR == true )
    {
      if ($_SESSION['admin_privilege'] == 'Moderator')
      {
          //Do nothing
      }
    }
    else
    {
      permissionDenied();
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
                        <a href="javascript:void(0)" class="site_title"><i class="fas fa-lock"></i>
                            <span>Administrator</span></a>
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

                    <?php include(__DIR__ ."/oc-admin-includes/sidebarNav.inc.php"); ?>

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Go to Dashboard"
                            href="<?php echo BASE_URL; ?>/dashboard.php">
                            <span class="fas fa-clipboard-list" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen" onClick="toggleFullScreen()">
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
                                    <img src="<?php echo get_avatar() ?>" alt=""><?php echo $name;?>
                                    <span class="fas fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="<?php echo BASE_URL; ?>/profile.php"><i
                                                class="fas fa-user pull-right"></i>My Profile</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>/actions/logout.php"><i
                                                class="fas fa-sign-out-alt pull-right"></i> Log Out</a></li>
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

    <?php
    include (__DIR__ . "/oc-admin-includes/globalModals.inc.php");
    include (__DIR__ . "/../oc-includes/jquery-colsolidated.inc.php"); ?>

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
    $(function() {
        $(document).on('click', '#edit_nameBtn', function(e) {
            e.preventDefault();
            var edit_id = $(this).data('id');
            console.log();
            $.ajax({
                    url: '<?php echo BASE_URL; ?>/actions/ncicAdminActions.php',
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
            $.ajax({
                    url: '<?php echo BASE_URL; ?>/actions/ncicAdminActions.php',
                    type: 'POST',
                    data: 'edit_plateid=' + edit_id,
                    dataType: 'json',
                    cache: false
                })
                .done(function(data) {
                    $('.civilian_names_picker').selectpicker('val', data.name_id);
                    $('.veh_plate').val(data.veh_plate);
                    $('.veh_makemodelpicker').selectpicker('val', data.veh_make + ' ' + data
                        .veh_model);
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
    $(document).ready(function() {

        $('#pendingUsers').DataTable({
            paging: false,
            searching: false
        });

    });
    </script>
    <script type="text/javascript"
        src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
    </script>
</body>

</html>