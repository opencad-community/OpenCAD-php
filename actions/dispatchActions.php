<?php

$iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
$connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"]."/openCad/".$iniContents['main']['connection_file_location'];

require($connectionsFileLocation);


if (isset($_GET['term'])) {
    $data = array();

    $term = $_GET['term'];
    //echo json_encode($term);
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }
    
    $query = "SELECT * from streets WHERE name LIKE \"%$term%\"";

    $result=mysqli_query($link, $query);
    
    while($row = $result->fetch_assoc())
    {
        $data[] = $row['name'];        
    }

    echo json_encode($data);


}

function addCall()
{
    echo "OK";
}
?>