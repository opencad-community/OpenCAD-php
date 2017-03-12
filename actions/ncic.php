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
    $name_arr = explode(" ", $name);

    $first_name = $name_arr[0];
    $last_name = $name_arr[1];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }
    
    $sql = "SELECT id, first_name, last_name, dob, address, sex, race, dl_status, hair_color, build FROM ncic_names WHERE first_name = \"$first_name\" and last_name = \"$last_name\"";

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
            $encode["first_name"] = $row[1];
            $encode["last_name"] = $row[2];
            $encode["dob"] = $row[3];
            $encode["address"] = $row[4];
            $encode["sex"] = $row[5];
            $encode["race"] = $row[6];
            $encode["dl_status"] = $row[7];
            $encode["hair_color"] = $row[8];
            $encode["build"] = $row[9];
            
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