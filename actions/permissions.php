<?php

$iniContents = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/properties/config.ini", true); //Gather from config.ini file
$connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"].$iniContents['main']['connection_file_location'];


function checkIfHeadAdmin()
{
    //Check if the permission is already set
    if (isset($_SESSION['headAdmin']))
    {
        if ($_SESSION['headAdmin'] == "true")
        {
            return true;
            exit();
        }
        else if ($_SESSION['headAdmin'] == "false")
        {
            return false;
            exit();
        }
    }

    $user_id = $_SESSION['id'];
    $department_id = '8'; // Table departments department_name = head administrators

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }
    
    $sql = 'SELECT * from user_departments WHERE user_id = "'.$user_id.'" AND department_id = "'.$department_id.'"';
    
    $result = mysqli_query($link, $sql);
    
    $num_rows = $result->num_rows;

    if ($num_rows == 0)
    {
        $_SESSION['headAdmin'] = "false";
        return false;
        exit();
    }
    else
    {
        $_SESSION['headAdmin'] = "true";
        return true;
        exit();
    }
}
?>