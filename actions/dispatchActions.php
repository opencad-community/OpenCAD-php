<?php

$iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
$connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"]."/openCad/".$iniContents['main']['connection_file_location'];

require($connectionsFileLocation);

if (isset($_POST['clearCall']))
{
    clearCall();
}

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
    echo var_dump($_POST);
}

function clearCall()
{
    $callIdString = $_POST['callId']; // Prints like "cid=#" NOT just #
    $callIdArr = explode("=", $callIdString);
    $callId = $callIdArr[1];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "DELETE FROM calls WHERE call_id = ?";
        
    try {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $callId);
        $result = mysqli_stmt_execute($stmt);
        
        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }



}
?>