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
$ncicPlates = new ncicPlates($db);

// Query NCIC Names
if (isset($_GET["search"]) && !empty($_GET["search"])) {
    $search = htmlspecialchars($_GET["search"]);
    $stmt = $ncicPlates->search($search);
    $num = $stmt->rowCount();

    if ($num > 0) {
        $ncicPlates_array = array();
        $ncicPlates_array["Records"] = array();
        $ncicPlates_array["Notice"] = array();

        // retrieve table contents
        // fetch seems faster than fetchAll?
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Extract Row
            // Converts $row["name"] to $name only
            extract($row);

            // Add items to array
            $ncicPlates_item = array(
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

                "nameId" => $nameId,
                "vehPlate" => $vehPlate,
                "vehMake" => $vehMake,
                "vehModel" => $vehModel,
                "vehPrimaryColor" => $vehPrimaryColor,
                "vehInsurance" => $vehInsurance,
                "vehInsuranceType" => $vehInsuranceType,
                "flags" => $flags,
                "vehRegState" => $vehRegState,
                "notes" => $notes,

            );
            $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");
            array_push($ncicPlates_array["Records"], $ncicPlates_item);
        }

        array_push($ncicPlates_array["Notice"], $notice);
        // Set response code to 200 ok
        http_response_code(200);

        // Show NCICNames data in json
        echo json_encode($ncicPlates_array);
        exit();
    } else {

        // no products were found!

        http_response_code(200);
        echo json_encode(array("message" => "No NCIC Plate found!"));
        exit();

    }
}

$stmt = $ncicPlates->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $ncicPlates_array = array();
    $ncicPlates_array["Records"] = array();
    $ncicPlates_array["Notice"] = array();

    // retrieve table contents
    // fetch seems faster than fetchAll?
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract Row
        // Converts $row["name"] to $name only
        extract($row);

        // Add items to array
        $ncicPlates_item = array(
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

            "nameId" => $nameId,
            "vehPlate" => $vehPlate,
            "vehMake" => $vehMake,
            "vehModel" => $vehModel,
            "vehPrimaryColor" => $vehPrimaryColor,
            "vehInsurance" => $vehInsurance,
            "vehInsuranceType" => $vehInsuranceType,
            "flags" => $flags,
            "vehRegState" => $vehRegState,
            "notes" => $notes,

        );
        $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");
        array_push($ncicPlates_array["Records"], $ncicPlates_item);
    }

    array_push($ncicPlates_array["Notice"], $notice);
    // Set response code to 200 ok
    http_response_code(200);

    // Show NCICNames data in json
    echo json_encode($ncicPlates_array);
} else {

    // no products were found!

    http_response_code(200);
    echo json_encode(array("message" => "No NCIC Plates found!"));
}
