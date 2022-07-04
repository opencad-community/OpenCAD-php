<?php

include_once("../../../oc-config.php");
include_once("../config/functions.inc.php");
include_once("../config/database.inc.php");
include_once("../objects/NCIC.php");

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Check API Key

checkApiKey();

// Instantiate database and ncic object
$database = new Database();
$db = $database->getConnection();

// Initalize object
$ncicCitations = new ncicCitations($db);

// Query NCIC Names

$stmt = $ncicCitations->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $ncicCitations_array = array();
    $ncicCitations_array["Records"] = array();
    $ncicCitations_array["Notice"] = array();

    // retrieve table contents
    // fetch seems faster than fetchAll?
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract Row
        // Converts $row["name"] to $name only
        extract($row);

        // Add items to array
        $ncicCitations_item = array(
            "usersCADName" => $submittedByName,
            "usersCivName" => $name,
            "dob" =>  $dob,
            "address" =>  $address,
            "gender" =>  $gender,
            "race" =>  $race,
            "dlStatus" => $dlStatus,
            "dlType" => $dlType,
            "dlClass" => $dlClass,
            "dlIssuer" => $dlIssuer,
            "hairColor" => $hairColor,
            "build" => $build,
            "weaponPermitStatus" => $weaponPermitStatus,
            "weaponPermitType" => $weaponPermitType,
            "weaponPermitIssueBy" => $weaponPermitIssuedBy,
            "bloodType" => $bloodType,
            "organDoner" => $organDonor,
            "deceased" => $deceased,
            "status" => $status,
            "nameId" => $nameId,
            "citationName" => $citationName,
            "citationFine" => $citationFine,
            "issuedDate" => $issuedDate,
            "issuedBy" => $issuedBy
        );
        $notice = array("Notice"=> "This is a very early version of the API, please expect bugs and for it not to be secure!");
        array_push($ncicCitations_array["Records"], $ncicCitations_item);
    }
    
    array_push($ncicCitations_array["Notice"], $notice);
    // Set response code to 200 ok
    http_response_code(200);

    // Show NCICNames data in json
    echo json_encode($ncicCitations_array);
} else {

    // no products were found!

    http_response_code(200);
    echo json_encode(array("message" => "No NCIC Citations found!"));
} 

