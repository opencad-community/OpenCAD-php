<?php
include("../oc-config.php");

//connect with the database
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT * FROM ncic_names WHERE name LIKE '%".$searchTerm."%' ORDER BY name ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['name'];
}
//return json data
echo json_encode($data);
?>