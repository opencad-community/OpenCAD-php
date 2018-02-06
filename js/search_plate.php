<?php
include("../oc-config.php");

//connect with the database
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT * FROM ncic_plates WHERE veh_plate LIKE '%".$searchTerm."%' ORDER BY veh_plate ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['veh_plate'];
}
//return json data
echo json_encode($data);
?>