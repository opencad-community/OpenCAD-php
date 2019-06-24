<?php
    /**
     * Open source CAD system for RolePlaying Communities.
     * Copyright (C) 2018-2019 Thomas Obernosterer
     * 
     *  This program is free software: you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation, either version 3 of the License, or
     *  (at your option) any later version.
     * 
     * This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
     * 
     * 
     * File origin: ATVG-CAD v1.3.0.0 by ATVG-Studios
    **/

    session_start();
    $error_title = "We are sorry! It looks as a error had occurred.";
    if(!empty($_SESSION['error_title']))
    {
        $error_title = htmlspecialchars($_SESSION['error_title']);
    }

    $error = "We could not identify the error, please retry your last action.";
    if(!empty($_SESSION['error']))
    {
        if(!is_string($_SESSION['error']))
            $error = print_r($_SESSION['error'], true);
        else
            $error = htmlspecialchars($_SESSION['error']);
    }

    $error_blob = null;
    if(!empty($_SESSION['error_blob'])){
        $error_blob = htmlspecialchars($_SESSION['error_blob']);
    }

    /** Search for specific keywords */

    define('DBE_UNKNOWN_HOST', "No address associated with hostname");
    define('DBE_ACCESS_DENIED', "Access denied for user");

    if(strpos($error, DBE_UNKNOWN_HOST) !== false){
        $error = "The database server is not reachable, please check the database address in the configuration and try your last action again.";
    }else if(strpos($error, DBE_ACCESS_DENIED) !== false){
        $error = "The configuration file 'oc-config', does not contain proper configuration of the Database Details. Please check your configuration.";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $_NOLOAD['oc-functions'] = 'true'; include_once("../../oc-config.php"); ?>
    <link rel="icon" href="<?php echo BASE_URL; ?>/images/favicon.ico" />
    <link href="<?php echo BASE_URL; ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
    <link href="<?php echo BASE_URL; ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/css/custom.css" rel="stylesheet">
    <style>
        .wrapper{
            overflow:hidden;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div role="main">
                <div class="wrapper">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" id="codeList">
                                <div class="x_title">
                                    <h2><?php echo $error_title; ?></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    Description: <?php echo $error; ?>
                                </div>
                                <?php if(!empty($error_blob)) { ?> 
                                <div class="x_content">
                                    PHP Exception: <?php echo $error_blob; ?>
                                </div>
                                <br><br>
                                <?php } ?>
                                <div class="x_content">
                                    If this error persists, please open up a <a href="https://jira.opencad.io/secure/CreateIssue!default.jspa">ticket</a>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
