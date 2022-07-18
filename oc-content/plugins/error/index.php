<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["errorMsg"]) && isset($_SESSION["errorTitle"]) && $_SESSION["errorTitle"] == "Outdated PHP Version") {

    $errorTitle = $_SESSION["errorTitle"];
    $errorMsg = $_SESSION["errorMsg"];
    unset($_SESSION["errorTitle"]);
    unset($_SESSION["errorMsg"]);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>OpenCAD</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

        <!-- Font Awesome Icon -->
        <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />

    </head>

    <body>
        <div id="notfound">
            <div class="notfound-bg"></div>
            <div class="notfound">
                <div class="notfound-404">
                    <h1><?php echo $errorTitle; ?></h1>
                </div>
                <h2><?php echo $errorMsg; ?></h2>
            </div>
        </div>

    <?php
    exit();
}


require_once("../../../oc-config.php");
require_once(ABSPATH . "oc-functions.php");

isSessionStarted();

if (isset($_SESSION["errorMsg"]) && isset($_SESSION["errorTitle"])) {
    $errorTitle = $_SESSION["errorTitle"];
    $errorMsg = $_SESSION["errorMsg"];
    unset($_SESSION["errorTitle"]);
    unset($_SESSION["errorMsg"]);
} else {
    header("Location: " . BASE_URL . "/index.php");
}

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>OpenCAD | <?php echo (COMMUNITY_NAME); ?></title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

        <!-- Font Awesome Icon -->
        <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />

    </head>

    <body>
        <?php if ($errorTitle === "Permission Denied") { ?>
            <div id="notfound">
                <div class="notfound-bg"></div>
                <div class="notfound">
                    <div class="notfound-404">
                        <h1><?php echo $errorTitle; ?></h1>
                    </div>
                    <h2><?php echo $errorMsg; ?></h2>
                    <a href="<?php echo (BASE_URL); ?>/index.php" class="home-btn">Go Home</a>
                </div>
            </div>
        <?php } ?>
        <div id="notfound">
            <div class="notfound-bg"></div>
            <div class="notfound">
                <div class="notfound-404">
                    <h1><?php echo $errorTitle; ?></h1>
                </div>
                <h2>we are sorry, we have detected a problem! Please review the error code below.</h2>
                <h2><?php echo $errorMsg; ?></h2>
                <a href="<?php echo (BASE_URL); ?>/index.php" class="home-btn">Go Home</a>
                <a href="https://github.com/opencad-app/OpenCAD-php/issues/new?assignees=&labels=&template=bug_report.md&title=" class="contact-btn">Report Issue</a>
            </div>
        </div>
    </body>

    </html>