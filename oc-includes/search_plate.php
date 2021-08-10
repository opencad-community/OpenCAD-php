<?php
include("../oc-config.php");

//connect with the database
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT * FROM ".DB_PREFIX."ncicPlates WHERE vehPlate LIKE '%".$searchTerm."%' ORDER BY vehPlate ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['vehPlate'];
}
//return json data
echo json_encode($data);
?>