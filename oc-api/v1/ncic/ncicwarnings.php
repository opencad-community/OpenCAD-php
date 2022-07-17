<?php

include_once("../../../oc-config.php");
include_once("../config/functions.inc.php");
include_once("../config/database.inc.php");
include_once("../objects/NCIC.php");
include_once("../objects/MISC.php");

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Check API Key

$key = getAPIKeyFromRequest();
checkApiKey($key);
checkKeyPermission($key, "ncicWarnings");


// Instantiate database and ncic object
$database = new Database();
$db = $database->getConnection();

// Initalize object

$ncicWarning = new ncicWarning($db);

$apiCalls = new updateApiCalls($db);

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if (strpos($url, 'ncicwarnings/name') !== false) {
        $name = urldecode(basename($url));

        $stmt = $ncicWarning->readbyName($name);

        if (!$stmt) {
            http_response_code(200);

            echo json_encode(array("Error" => "Name: $name is not found."));
            addApiCallCount();
            exit();
        }

        $num = $stmt->rowCount();
        if ($num > 0) {
            $ncicWarning_array = array();
            $ncicWarning_array["Records"] = array();
            $ncicWarning_array["Notice"] = array();

            // retrieve table contents
            // fetch seems faster than fetchAll?
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Extract Row
                // Converts $row["name"] to $name only
                extract($row);

                // Add items to array
                $ncicWarning_item = array(
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
                    "warningName" =>  $warningName,
                    "issuedDate" =>  $issuedDate,
                    "issuedBy" =>  $issuedBy,
                    "nameId" =>  $nameId,
                    "issuedDate" =>  $issuedDate,
                    "status" =>  $status,
                );
                array_push($ncicWarning_array["Records"], $ncicWarning_item);
            }
            $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

            array_push($ncicWarning_array["Notice"], $notice);
            // Set response code to 200 ok
            http_response_code(200);

            // Show ncicWarnings data in json
            echo json_encode($ncicWarning_array);

            addApiCallCount();

            exit();
        } else {
            http_response_code(200);
            echo json_encode(array("message" => "No NCIC Names found!"));
            addApiCallCount();
            exit();
        }
    }

    if (basename($url) != "ncicwarnings") {
        $id = basename($url);

        $stmt = $ncicWarning->readbyId($id);

        if (!$stmt) {
            http_response_code(200);

            echo json_encode(array("Error" => "ID: $id is not found."));
            addApiCallCount();
            exit();
        }

        $num = $stmt->rowCount();
        if ($num > 0) {
            $ncicWarning_array = array();
            $ncicWarning_array["Records"] = array();
            $ncicWarning_array["Notice"] = array();

            // retrieve table contents
            // fetch seems faster than fetchAll?
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Extract Row
                // Converts $row["name"] to $name only
                extract($row);

                // Add items to array
                $ncicWarning_item = array(
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
                    "warningName" =>  $warningName,
                    "issuedDate" =>  $issuedDate,
                    "issuedBy" =>  $issuedBy,
                    "nameId" =>  $nameId,
                    "issuedDate" =>  $issuedDate,
                    "status" =>  $status,
                );
                array_push($ncicWarning_array["Records"], $ncicWarning_item);
            }
            $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

            array_push($ncicWarning_array["Notice"], $notice);
            // Set response code to 200 ok
            http_response_code(200);

            // Show ncicWarnings data in json
            echo json_encode($ncicWarning_array);

            addApiCallCount();

            exit();
        } else {
            http_response_code(200);
            echo json_encode(array("message" => "No NCIC Names found!"));
            addApiCallCount();
            exit();
        }
    }

    $stmt = $ncicWarning->read();
    if (!$stmt) {
        http_response_code(200);

        echo json_encode(array("Error" => "Name: $name is not found."));
        addApiCallCount();
        exit();
    }

    $num = $stmt->rowCount();

    if ($num > 0) {
        $ncicWarning_array = array();
        $ncicWarning_array["Records"] = array();
        $ncicWarning_array["Notice"] = array();

        // retrieve table contents
        // fetch seems faster than fetchAll?
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Extract Row
            // Converts $row["name"] to $name only
            extract($row);

            // Add items to array
            $ncicWarning_item = array(
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
                "warningName" =>  $warningName,
                "issuedDate" =>  $issuedDate,
                "issuedBy" =>  $issuedBy,
                "nameId" =>  $nameId,
                "issuedDate" =>  $issuedDate,
                "status" =>  $status,
            );
            array_push($ncicWarning_array["Records"], $ncicWarning_item);
        }
        $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

        array_push($ncicWarning_array["Notice"], $notice);
        // Set response code to 200 ok
        http_response_code(200);

        // Show ncicWarnings data in json
        echo json_encode($ncicWarning_array);

        addApiCallCount();

        exit();
    } else {
        http_response_code(200);
        echo json_encode(array("message" => "No NCIC Names found!"));
        addApiCallCount();
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    http_response_code(200);

    if (empty($_POST["status"]) || empty($_POST["nameId"]) || empty($_POST["warningName"]) || empty($_POST["issuedDate"]) || empty($_POST["issuedBy"])){
        http_response_code(200);
        echo json_encode(array("Error" => "Data is mssing!"));
        exit();
    }

    $status = htmlspecialchars($_POST["status"]);
    $nameId = htmlspecialchars($_POST["nameId"]);
    $warningName = htmlspecialchars($_POST["warningName"]);
    $issuedDate = htmlspecialchars($_POST["issuedDate"]);
    $issuedBy = htmlspecialchars($_POST["issuedBy"]);

    try {
        $ncicWarning->post($status, $nameId, $warningName, $issuedDate, $issuedBy);
        $ncicWarning_array = array();
        $ncicWarning_array["Records"] = array();
        $ncicWarning_array["Notice"] = array();

        // Add items to array
        $ncicWarning_item = array(
            "Success"               =>  array("The following data has successfully been added!"),
            "warningName" =>  $warningName,
            "issuedDate" =>  $issuedDate,
            "issuedBy" =>  $issuedBy,
            "nameId" =>  $nameId,
            "issuedDate" =>  $issuedDate,
            "status" =>  $status,
        );
        array_push($ncicWarning_array["Records"], $ncicWarning_item);

        $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

        array_push($ncicWarning_array["Notice"], $notice);
        echo json_encode($ncicWarning_array);
        addApiCallCount();
        exit();
    } catch (Exception $e) {
        throw new Exception($e);
        addApiCallCount();
        die();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "PUT") {
    http_response_code(200);

    if (!isset($_GET["id"]) || empty($_GET["id"])) {
        http_response_code(200);
        echo json_encode(array("Error" => "ID is not found."));
        addApiCallCount();
        exit();
    }

    if (isset($_GET["id"]) || !empty($_GET["id"])) {
        $id = $_GET["id"];

        echo "This feature is still under development. Please bare with us whilst we make it happen.";
        echo "Please follow our progress on our GitHub: 'https://github.com/opencad-app/OpenCAD-php'";
        addApiCallCount();
        exit();

        // $nameId = htmlspecialchars($_POST["nameId"]);
        // $arrestReason = htmlspecialchars($_POST["arrestReason"]);
        // $arrestFine = htmlspecialchars($_POST["arrestFine"]);
        // $issuedDate = htmlspecialchars($_POST["issuedDate"]);
        // $issuedBy = htmlspecialchars($_POST["issuedBy"]);

        // $ncicWarning->update($id, $nameId, $arrestReason, $arrestFine, $issuedDate, $issuedBy);
        // exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (basename($url) != "ncicWarning") {
        $id = urldecode(basename($url));
        http_response_code(200);

        $deleteArrest = $ncicWarning->delete($id);
        if ($deleteArrest === False) {
            http_response_code(200);
            echo json_encode(array("Error" => "ID: $id is unknown!"));
            addApiCallCount();
            exit();
        } else {
            http_response_code(200);
            echo json_encode(array("Success" => "Deleted Entry $id"));
            addApiCallCount();
            exit();
        }
        exit();
    }
} else {
    addApiCallCount();
    http_response_code(405);
    echo json_encode(array("Error" => "Method Not Allowed"));
    exit();
}
