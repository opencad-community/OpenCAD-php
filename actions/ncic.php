<?php

$iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
$connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"]."/openCad/".$iniContents['main']['connection_file_location'];

require($connectionsFileLocation);

/*
    Returns information on name run through NCIC. 
    TODO: Add a check here to check the admin panel to determine if Randomized names are allowed
*/
if (isset($_POST['ncic_name'])){
    name();
}

function name()
{
    $name = $_POST['ncic_name'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
    
    $sql = "SELECT id, name, dob, address FROM ncic_names WHERE name = \"$name\"";

    $result=mysqli_query($link, $sql);

    $encode = array();
    
    $num_rows = $result->num_rows;
    if($num_rows == 0)
    {
        $encode["noResult"] = "true";
    }
    else
    {
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            $encode["userId"] = $row[0];
            $encode["name"] = $row[1];
            $encode["dob"] = $row[2];
            $encode["address"] = $row[3];
            
        }
    }

    echo json_encode($encode);
    mysqli_close($link);
}

function plate()
{

}

function firearm()
{

}

?>