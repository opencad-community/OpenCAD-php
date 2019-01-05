<?php
    session_start();
    $_SESSION['error_title'] = "Service Unavailable";
    $_SESSION['error'] = "This Service is currently Unavailable! Please come back in a view minutes, or contact your site administrator.";
    $_SESSION['error_blob'] = "Tip me over and pour me out.";

    header('Location: '.str_replace('static','',str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd())).'index.php');
?>