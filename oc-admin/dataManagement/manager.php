<?php

/**
 * Open source CAD system for RolePlaying Communities.
 * Copyright (C) 2022 OpenCAD Project
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
 */

if (session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
require_once('../../oc-config.php');
require_once(ABSPATH . '/oc-functions.php');
require_once(ABSPATH . '/oc-settings.php');
require_once(ABSPATH . "/oc-includes/adminActions.inc.php");
require_once(ABSPATH . "/oc-includes/dataActions.inc.php");

if (empty($_SESSION['logged_in'])) {
    permissionDenied();
} else {
    $name = $_SESSION['name'];
}

isAdminOrMod();

if (isset($_GET["type"])) {
    if ($_GET["type"] == "citationManager") {
        $manager = "CITATIONTYPE_MANAGER";
        $modalName = "Citation";
        $modalId = "editCitationTypeModal";
        $modalSubmit = "editCitationType";
        $modalBox = "Citation Description";
        $modalBoxData = "citationDescription";
        $modalBox1 = "Citation Fine (Reccomended)";
        $modalBox1Data = "citationFine";
        $ajaxType = "allCitationTypes";
        $ajaxGetDetails = "getCitationTypeDetails";
        $ajaxId = "id";
    } elseif ($_GET["type"] == "departmentManager") {
        // TODO
        $manager = "DEPARTMENT_MANAGER";
        $threeOptions = true;
        $modalName = "Department";
        $modalId = "editDepartmentModal";
        $modalSubmit = "editDepartment";
        $modalBox = "Department Name";
        $modalBoxData = "departmentName";
        $modalBox1 = "Department Short Name";
        $modalBox1Data = "departmentShortName";
        $modalBox2 = "Department Long Name";
        $modalBox2Data = "departmentLongName";
        $ajaxType = "allDepartments";
        $ajaxGetDetails = "getDepartmentDetails";
        $ajaxId = "departmentID";
    } elseif ($_GET["type"] == "incidentManager") {
        $manager = "INCIDENTTYPE_MANAGER";
        $modalName = "Incident";
        $modalId = "editIncidentTypeModal";
        $modalSubmit = "editIncidentType";
        $modalBox = "Incident Code";
        $modalBoxData = "incident_code";
        $modalBox1 = "Incident Name";
        $modalBox1Data = "incident_name";
        $ajaxType = "allIncidentTypes";
        $ajaxGetDetails = "getIncidentTypeDetails";
        $ajaxId = "incidentTypeID";
    } elseif ($_GET["type"] == "radioCodesManager") {
        $manager = "RADIOCODE_MANAGER";
        $modalName = "Radio";
        $modalId = "editRadioCodeModal";
        $modalSubmit = "editRadioCode";
        $modalBox = "Radio Code";
        $modalBoxData = "code";
        $modalBox1 = "Radio Code Description";
        $modalBox1Data = "codeDescription";
        $ajaxType = "allRadioCodes";
        $ajaxGetDetails = "getRadioCodeDetails";
        $ajaxId = "id";
    } elseif ($_GET["type"] == "streetManager") {
        $manager = "STREET_MANAGER";
        $modalName = "Street";
        $modalId = "editStreetModal";
        $modalSubmit = "editStreet";
        $modalBox = "Street/Postal Code";
        $modalBoxData = "name";
        $modalBox1 = "County";
        $modalBox1Data = "county";
        $ajaxType = "allStreets";
        $ajaxGetDetails = "getStreetDetails";
        $ajaxId = "streetID";
    } elseif ($_GET["type"] == "vehicleManager") {
        $manager = "VEHICLE_MANAGER";
        $modalName = "Vehicle";
        $modalId = "editVehicleModal";
        $modalSubmit = "editVehicle";
        $modalBox = "Vehicle Make";
        $modalBoxData = "make";
        $modalBox1 = "Vehicle Model";
        $modalBox1Data = "model";
        $ajaxType = "allVehicles";
        $ajaxGetDetails = "getVehicleDetails";
        $ajaxId = "vehicleID";
    } elseif ($_GET["type"] == "warningManager") {
        // TO DO
        $manager = "WARNINGTYPE_MANAGER";
        $modalName = "Warning";
        $modalId = "editWarningTypeModal";
        $modalSubmit = "editWarningType";
        $modalBox = "Warning Description";
        $modalBoxData = "warningDescription";
        $ajaxType = "allStreets";
        $ajaxGetDetails = "getWarningTypeDetails";
        $ajaxId = "warningTypeID";
    } elseif ($_GET["type"] == "warrantManager") {
        $manager = "WARRANTTYPE_MANAGER";
        $modalName = "Warrant";
        $modalId = "editWarrantTypeModal";
        $modalSubmit = "editWarrantType";
        $modalBox = "Warrant Description";
        $modalBoxData = "warrantDescription";
        $modalBox1 = "Violent";
        $modalBox1Data = "warrantViolent";
        $ajaxType = "allWarrantTypes";
        $ajaxGetDetails = "getWarrantTypeDetails";
        $ajaxId = "warrantTypeID";
    } elseif ($_GET["type"] == "weaponManager") {
        $manager = "WEAPON_MANAGER";
        $modalName = "Weapon";
        $modalId = "editWeaponModal";
        $modalSubmit = "editWeapon";
        $modalBox = "Weapon Type";
        $modalBoxData = "weaponType";
        $modalBox1 = "Weapon Name";
        $modalBox1Data = "weaponName";
        $ajaxType = "allWeapons";
        $ajaxGetDetails = "getWeaponDetails";
        $ajaxId = "weaponID";
    } else {
        $manager = "CITATIONTYPE_MANAGER";
    }
} else {
    $manager = "CITATIONTYPE_MANAGER";
}

$accessMessage = "";
if (isset($_SESSION['accessMessage'])) {
    $accessMessage = $_SESSION['accessMessage'];
    unset($_SESSION['accessMessage']);
}
$adminMessage = "";
if (isset($_SESSION['adminMessage'])) {
    $adminMessage = $_SESSION['adminMessage'];
    unset($_SESSION['adminMessage']);
}

$successMessage = "";
if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include(ABSPATH . "/" . OCTHEMES . "/" . THEME . "/includes/header.inc.php"); ?>

<body class="app header-fixed">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php require_once(ABSPATH . OCTHEMEINC . "/admin/topbarNav.inc.php"); ?>
        <?php include(ABSPATH . "/" . OCTHEMES . "/" . THEME . "/includes/topProfile.inc.php"); ?>
    </header>

    <div class="app-body">
        <main class="main">
            <div class="breadcrumb">
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <div class="card">
                            <div class="card-header">
                                <em class="fa fa-align-justify"></em> <?php echo lang_key($manager); ?>
                            </div>
                            <div class="card-body">
                                <?php echo $accessMessage;
                                if ($manager == "CITATIONTYPE_MANAGER") {
                                    getCitationTypes();
                                } elseif ($manager == "DEPARTMENT_MANAGER") {
                                    getDepartments();
                                } elseif ($manager == "INCIDENTTYPE_MANAGER") {
                                    getIncidentTypes();
                                } elseif ($manager == "RADIOCODE_MANAGER") {
                                    getRadioCodes();
                                } elseif ($manager == "STREET_MANAGER") {
                                    getStreets();
                                } elseif ($manager == "VEHICLE_MANAGER") {
                                    getVehicles();
                                } elseif ($manager == "WARRANTTYPE_MANAGER") {
                                    getWarrantTypes();
                                } elseif ($manager == "WARNINGTYPE_MANAGER") {
                                    getWarningTypes();
                                } elseif ($manager == "WEAPON_MANAGER") {
                                    getWeapons();
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>

    <?php require_once(ABSPATH . "/" . OCTHEMES . "/" . THEME . "/includes/footer.inc.php"); ?>

    <!-- Edit Modal -->
    <div class="modal" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="<?php echo $modalId; ?>">Edit <?php echo $modalName; ?> Type</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- ./ modal-header -->
                <div class="modal-body">
                    <form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/dataActions.inc.php" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 control-label"><?php echo $modalBox; ?></label>
                            <div class="col-md-9">
                                <input data-lpignore='true' type="text" name="<?php echo $modalBoxData;?>" class="form-control" id="<?php echo $modalBoxData;?>" required />
                            </div>
                            <!-- ./ col-sm-9 -->
                        </div>
                        <!-- ./ form-group -->
                        <div class="form-group row">
                            <label class="col-md-3 control-label"><?php echo $modalBox1; ?></label>
                            <div class="col-md-9">
                                <input data-lpignore='true' type="text" name="<?php echo $modalBox1Data;?>" class="form-control" id="<?php echo $modalBox1Data;?>" />
                            </div>
                            <!-- ./ col-sm-9 -->
                        </div>
                        <!-- ./ form-group -->
                        <?php if(isset($threeOptions)){if($threeOptions){?>
                            <div class="form-group row">
                            <label class="col-md-3 control-label"><?php echo $modalBox2; ?></label>
                            <div class="col-md-9">
                                <input data-lpignore='true' type="text" name="<?php echo $modalBox2Data;?>" class="form-control" id="<?php echo $modalBox2Data;?>" />
                            </div>
                            <!-- ./ col-sm-9 -->
                        </div>
                        <?php }}?>
                </div>
                <!-- ./ modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="hidden" name="<?php echo $ajaxId; ?>" id="<?php echo $ajaxId; ?>" aria-hidden="true">
                    <input type="submit" name="<?php echo $modalSubmit; ?>" class="btn btn-primary" value="Edit <?php echo $modalName;?> Type" />
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
    require_once(ABSPATH . OCTHEMEMOD . "/admin/globalModals.inc.php");
    require_once(ABSPATH . OCTHEMEINC . "/scripts.inc.php"); ?>

    <script>
        $(document).ready(function() {
            $('#<?php echo $ajaxType ?>').DataTable({
                "paging": true,
                "pageLength": 10,
                "lengthMenu": [10, 20, 40, 60, 80, 100],
            });
        });
    </script>

    <script>
        $('#<?php echo $modalId ?>').on('show.bs.modal', function(e) {
            var $modal = $(this),
                <?php echo $ajaxId;?> = e.relatedTarget.id;

            $.ajax({
                cache: false,
                type: 'POST',
                url: '<?php echo BASE_URL; ?>/oc-includes/dataActions.inc.php',
                data: {
                    '<?php echo $ajaxGetDetails ?>': 'yes',
                    '<?php echo $ajaxId; ?>': <?php echo $ajaxId; ?>
                },
                success: function(result) {
                    console.log(result);
                    data = JSON.parse(result);

                    $('input[name="<?php echo $modalBoxData;?>"]').val(data['<?php echo $modalBoxData;?>']);
                    <?php if(isset($threeOptions)){if($threeOptions){
                        echo "$('input[name=".$modalBox2Data."]').val(data['".$modalBox2Data."']);";
                    }}?>
                    $('input[name="<?php echo $modalBox1Data;?>"]').val(data['<?php echo $modalBox1Data;?>']);
                    $('input[name="<?php echo $ajaxId;?>"]').val(data['<?php echo $ajaxId;?>']);
                },

                error: function(exception) {
                    alert('Exeption:' + exception);
                }
            });
        })
    </script>
</body>

</html>