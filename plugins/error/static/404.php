<?php
    session_start();
    $_SESSION['error_title'] = "Unknown Document!";
    $_SESSION['error'] = "The page you are trying to access, does not exist.";

    header('Location: '.str_replace('static','',str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd())).'index.php');
?>