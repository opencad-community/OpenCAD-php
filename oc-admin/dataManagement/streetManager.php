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
    session_start();
    require_once(__DIR__.'../../../oc-config.php');
    require_once(__DIR__.'../../../oc-functions.php');
    include(__DIR__ .'../../../actions/dataActions.php');

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
    else if ($_SESSION['admin_privilege'] == 2 && MODERAOTR_DATAMAN_STREETS == true)
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

    $successMessage = "";
    if(isset($_SESSION['successMessage']))
    {
        $successMessage = $_SESSION['successMessage'];
        unset($_SESSION['successMessage']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php include (__DIR__ ."../../../oc-includes/header.inc.php"); ?>

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

                    <?php include __DIR__."../../oc-admin-includes/sidebarNav.inc.php"; ?>

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
                            <h3>CAD Data Manager</h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- going to be utilized in v2 of Street Manager - PJF/10MAR19 
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>At A Glance</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fas fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fas fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title ->
                  <div class="x_content">
                      <div class="row tile_count">
                       
                      </div>
                      <!-- ./ row tile_count ->
                  </div>
                  <!-- ./ x_content ->
                </div>
                <!-- ./ x_panel ->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 --
            </div>
            <!-- ./ row ->
             going to be utilized in v2 of Street Manager - PJF/10MAR19 -->
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Street Manager</h2>
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
                                    <?php echo $successMessage;?>
                                    <?php getStreets();?>
                                </div>
                                <!-- ./ x_content -->
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

    <!-- Edit Street Modal -->
    <div class="modal fade" id="editStreetModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="editStreetModal">Edit Street</h4>
                </div>
                <!-- ./ modal-header -->
                <div class="modal-body">
                    <form role="form" method="post" action="<?php echo BASE_URL; ?>/actions/dataActions.php"
                        class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 control-label">Street/Postal Code</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" id="name" required />
                                <span class="fas fa-road form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <!-- ./ col-sm-9 -->
                        </div>
                        <!-- ./ form-group -->
                        <div class="form-group row">
                            <label class="col-md-3 control-label">County</label>
                            <div class="col-md-9">
                                <input type="text" name="county" class="form-control" id="county" required />
                                <span class="fas fa-map form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <!-- ./ col-sm-9 -->
                        </div>
                        <!-- ./ form-group -->
                </div>
                <!-- ./ modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="hidden" name="streetID" id="streetID" aria-hidden="true">
                    <input type="submit" name="editStreet" class="btn btn-primary" value="Edit Street" />
                </div>
                <!-- ./ modal-footer -->
                </form>
            </div>
            <!-- ./ modal-content -->
        </div>
        <!-- ./ modal-dialog modal-lg -->
    </div>
    <!-- ./ modal fade bs-example-modal-lg -->



    <?php 
	include(__DIR__ . "/../oc-admin-includes/globalModals.inc.php"); 
	include(__DIR__ . "../../../oc-includes/jquery-colsolidated.inc.php");?>

    <script>
    $(document).ready(function() {
        $('#allStreets').DataTable({});
    });
    </script>

    <script>
    $('#editStreetModal').on('show.bs.modal', function(e) {
        var $modal = $(this),
            streetID = e.relatedTarget.id;

        $.ajax({
            cache: false,
            type: 'POST',
            url: '<?php echo BASE_URL; ?>/actions/dataActions.php',
            data: {
                'getStreetDetails': 'yes',
                'streetID': streetID
            },
            success: function(result) {
                console.log(result);
                data = JSON.parse(result);

                $('input[name="name"]').val(data['name']);
                $('input[name="county"]').val(data['county']);
                $('input[name="streetID"]').val(data['streetID']);
            },

            error: function(exception) {
                alert('Exeption:' + exception);
            }
        });
    })
    </script>

    <script type="text/javascript"
        src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
    </script>
</body>

</html>