<?php
    session_start();
    $error = "We could not identify the error, please retry your last action.";
    if(!empty($_SESSION['error']))
    {
        $error = htmlspecialchars($_SESSION['error']);
    }

    $error_blob = "none";
    if(!empty($_SESSION['error_blob'])){
        $error_blob = htmlspecialchars($_SESSION['error_blob']);
    }

    /** Search for specific keywords */
    if(strpos($error, "No address associated with hostname") !== false){
        $error = "The database server is not reachable, please check the database address in the configuration and try your last action again.";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../../oc-config.php"); ?>
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
                                    <h2>We are sorry! It looks as a error had occurred.</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    Description: <?php echo $error; ?>
                                </div>
                                <div class="x_content">
                                    PHP Exception: <?php echo $error_blob; ?>
                                </div>
                                <br><br>
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