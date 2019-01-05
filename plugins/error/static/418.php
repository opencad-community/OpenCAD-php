<?php
    session_start();
    $_SESSION['error_title'] = " I’m a teapot.";
    $_SESSION['error'] = "The requested entity body is short and stout.";
    $_SESSION['error_blob'] = "Tip me over and pour me out.";

    header('Location: '.str_replace('static','',str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd())).'index.php');
?>