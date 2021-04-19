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
    require_once('../../oc-config.php');
    require_once( ABSPATH . '/oc-functions.php');
    require_once( ABSPATH . '/oc-settings.php');
    require_once( ABSPATH . "/oc-includes/adminActions.php");
    require_once( ABSPATH . "/oc-includes/dataActions.php");

    if (empty($_SESSION['logged_in']))
    {
        header('Location:'.BASE_URL);
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
<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>


<body class="app header-fixed">

    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php require_once ( ABSPATH . OCTHEMEINC ."/admin/topbarNav.inc.php" ); ?>
      <?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/topProfile.inc.php"); ?>

    </header>

    <div class="app-body">
        <main class="main">
            <div class="breadcrumb" />
            <div class="container-fluid">
            <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                    <em class="fa fa-align-justify"></em> <?php echo lang_key("DEPARTMENT_MANAGER"); ?></div>
                <div class="card-body">
                    <?php echo $accessMessage;?>
                    <?php getDepartments();?>
                </div>
            </div>
        </main>
    </div>

            
			<?php require_once ( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/footer.inc.php"); ?>

    <!-- Edit Street Modal -->
    <div class="modal" id="editDepartmentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="editDepartmentModal">Edit Department</h4>
                </div>
                <!-- ./ modal-header -->
                <div class="modal-body">
                    <form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/dataActions.php" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 control-label">Department Name</label>
                            <div class="col-md-9">
                                <input data-lpignore='true' type="text" name="departmentName" class="form-control" id="departmentName" required />
                                <span class="fas fa-road form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <!-- ./ col-sm-9 -->
                        </div>
                        <!-- ./ form-group -->
                        <div class="form-group row">
                            <label class="col-md-3 control-label">Department Short Name</label>
                            <div class="col-md-9">
                                <input data-lpignore='true' type="text" name="departmentShortName" class="form-control" id="departmentShortName" required/>
                                <span class="fas fa-map form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <!-- ./ col-sm-9 -->
                        </div>
                        <!-- ./ form-group -->
                         <div class="form-group row">
                            <label class="col-md-3 control-label">Description Long Name</label>
                            <div class="col-md-9">
                                <input data-lpignore='true' type="text" name="departmentLongName" class="form-control" id="departmentLongName" required />
                                <span class="fas fa-road form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            <!-- ./ col-sm-9 -->
                        </div>
                        <!-- ./ form-group -->
                </div>
                <!-- ./ modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="hidden" name="departmentID" id="departmentID" aria-hidden="true">
                    <input type="submit" name="editDepartment" class="btn btn-primary" value="Edit Department" />
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
     require_once ( ABSPATH . OCTHEMEMOD . "/admin/globalModals.inc.php");
    require_once( ABSPATH . OCTHEMEINC ."/scripts.inc.php" ); ?>
</body>

        <script>
    $(document).ready(function() {
        $('#allDepartments').DataTable({});
    });
    </script>

    <script>
    $('#editDepartmentModal').on('show.bs.modal', function(e) {
        var $modal = $(this),
            departmentID = e.relatedTarget.id;

        $.ajax({
            cache: false,
            type: 'POST',
            url: '<?php echo BASE_URL; ?>/oc-includes/dataActions.php',
            data: {
                'getDepartmentDetails': 'yes',
                'departmentID': departmentID
            },
            success: function(result) {
                console.log(result);
                data = JSON.parse(result);

                $('input[name="departmentName"]').val(data['departmentName']);
                $('input[name="departmentShortName"]').val(data['departmentShortName']);
                $('input[name="departmentLongName"]').val(data['departmentLongName']);
                $('input[name="departmentEnabled"]').val(data['departmentEnabled']);
                $('input[name="departmentID"]').val(data['departmentID']);
            },

            error: function(exception) {
                alert('Exeption:' + exception);
            }
        });
    })
    </script>

</html>