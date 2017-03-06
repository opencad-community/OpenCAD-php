<?php
    $iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
    $connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"]."/openCad/".$iniContents['main']['connection_file_location'];

    require($connectionsFileLocation);

    /* Gets the user count. Returns value */
    function getUserCount()
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
        if (!$link) { 
            die('Could not connect: ' .mysql_error());
        }
        
        $query = "SELECT COUNT(*) from users";

        $result=mysqli_query($link, $query);
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);

        return $row[0];        
    }
?>