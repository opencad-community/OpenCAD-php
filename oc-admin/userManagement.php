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

    if ( $_SESSION['admin_privilege'] == 2)
    {
      if ($_SESSION['admin_privilege'] == 'Administrator')
      {
          //Do nothing
      }
    }
    else if ($_SESSION['admin_privilege'] == 1)
    {
      if ($_SESSION['admin_privilege'] == 'Moderator')
      {
          // Do Nothing
      }
    }
    else
    {
      die("You do not have permission to be here. This has been recorded");

    }

    require_once(__DIR__ . '/../oc-config.php');
    require_once(__DIR__ . '/../oc-functions.php');
    include(__DIR__ . '/../actions/adminActions.php');

    $accessMessage = "";
    if(isset($_SESSION['accessMessage']))
    {
        $accessMessage = $_SESSION['accessMessage'];
        unset($_SESSION['accessMessage']);
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
                <h3>CAD User Management</h3>
              </div>
            </div>

            <div class="clearfix"></div>

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
                  <!-- ./ x_title -->
                  <div class="x_content">
                      <div class="row tile_count">
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fas fa-user"></i> Communications</span>
                          <div class="count"><?php echo getGroupCount("1");?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fas fa-user"></i> State</span>
                          <div class="count"><?php echo getGroupCount("2");?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fas fa-user"></i> Highway Patrol</span>
                          <div class="count"><?php echo getGroupCount("3");?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fas fa-user"></i> Sheriff</span>
                          <div class="count"><?php echo getGroupCount("4");?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fas fa-user"></i> Police</span>
                          <div class="count"><?php echo getGroupCount("5");?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fas fa-user"></i> Fire</span>
                          <div class="count"><?php echo getGroupCount("6");?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fas fa-user"></i> EMS</span>
                          <div class="count"><?php echo getGroupCount("7");?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                          <span class="count_top"><i class="fas fa-user"></i> Civilian</span>
                          <div class="count"><?php echo getGroupCount("8");?></div>
                        </div>
                        <!-- ./ col-md-2 col-sm-4 col-xs-6 tile_stats_count -->
                      </div>
                      <!-- ./ row tile_count -->
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
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Account Management</h2>
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
                      <?php echo $accessMessage;?>
                      <?php getUsers();?>
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

    <!-- modals -->
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
            <div class="clearifx">
            <div class="speparator">
              <h5><strong>ALWAYS</strong> select proper user role before saving.</h5>
            </div>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form role="form" method="post" action="<?php echo BASE_URL; ?>/actions/adminActions.php" class="form-horizontal" >
              <div class="form-group row">
                <label class="col-md-3 control-label">Name</label>
                <div class="col-md-9">
                  <input name="userName" class="form-control" id="userName" />
                  <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                  <input type="email" name="userEmail" class="form-control" id="userEmail" />
                  <span class="fas fa-envelope form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-md-3 control-label">Identifier</label>
                <div class="col-md-9">
                  <input type="text" name="userIdentifier" class="form-control" id="userIdentifier" />
                  <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-md-3 control-label">User Groups</label>
                <div class="col-md-9">
                  <select name="userGroups[]" class="selectpicker form-control" id="userGroups" multiple>
                      <?php getDepartments();?>
                  </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-md-3 control-label">User Role</label>
                <div class="col-md-9">
                  <select name="userRole" class="selectpicker form-control" id="userRole">
                      <?php getRole() ?>
                  </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<input type="hidden" name="userID" id="userID">
            <input type="submit" name="editUserAccount" class="btn btn-primary" value="Update User"/>
          </div>
          <!-- ./ modal-footer -->
          </form>
        </div>
        <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-lg -->
    </div>
    <!-- ./ modal fade bs-example-modal-lg -->

    <!-- jQuery -->
    <script src="<?php echo BASE_URL; ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo BASE_URL; ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo BASE_URL; ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo BASE_URL; ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Datatables -->
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo BASE_URL; ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <!-- Bootstrap Select -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#allUsers').DataTable({

        });
    });
    </script>

    <script>
    $('#editUserModal').on('show.bs.modal', function(e) {
      var $modal = $(this), userId = e.relatedTarget.id;

      $.ajax({
          cache: false,
          type: 'POST',
          url: '<?php echo BASE_URL; ?>/actions/adminActions.php',
          data: {'getUserDetails': 'yes',
                  'userId' : userId},
          success: function(result)
          {
            console.log(result);
            data = JSON.parse(result);

            $('input[name="userName"]').val(data['name']);
            $('input[name="userEmail"]').val(data['email']);
            $('input[name="userIdentifier"]').val(data['identifier']);

			$('input[name="userID"]').val(data['userId']);

            for (var i=0; i<data['department'].length; i++)
            {
              $('select[name="userGroups"] option[value="'+data['department'][i]+'"]').val(1);
              //console.log(option);
            }
            for (var i=0; i<data['role'].length; i++)
            {
              $('select[name="userRole"] option[value="'+data['role'][i]+'"]').val(1);
              //console.log(option);
            }

            $('select[name="userGroups"]').selectpicker('refresh');
            $('select[name="userRole"]').selectpicker('refresh');


          },

          error:function(exception){alert('Exeption:'+exception);}
        });
    });


	$(".delete_group").click(function(){
	var dept_id=$(this).attr("data-dept-id");
	var user_id=$(this).attr("data-user-id");
	if(confirm("Are you sure to delete the selected Group?"))
		{
			$.ajax({
			cache: false,
			type: 'GET',
			url: '<?php echo BASE_URL; ?>/actions/adminActions.php',
			data	: 'dept_id='+dept_id+'&user_id='+user_id,
			success: function(result)
			{
				 //obj = jQuery.parseJSON(result);

					$("#show_group").html(result);
					window.location.href= '<?php echo BASE_URL; ?>/oc-admin/userManagement.php';

			}

			});
		}
	});
    </script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo BASE_URL; ?>/js/custom.js"></script>
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
