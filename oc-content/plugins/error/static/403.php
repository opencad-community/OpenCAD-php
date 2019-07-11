<?php
    session_start();
    $_SESSION['error_title'] = "Forbidden";
    $_SESSION['error'] = "We are sorry, but you are not allowed to visit this page.";

    header('Location: '.str_replace('static','',str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd())).'index.php');
?>