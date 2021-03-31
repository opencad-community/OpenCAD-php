<?php
    session_start();
    $_SESSION['error_title'] = "Bad Gateway";
    $_SESSION['error'] = "The content resource is not available! Please contect your site administrator.";

    header('Location: '.str_replace('static','',str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd())).'index.php');
?>