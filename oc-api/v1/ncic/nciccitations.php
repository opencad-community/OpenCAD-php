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
checkKeyPermission($key, "ncicCitations", $_SERVER["REQUEST_METHOD"]);


// Instantiate database and ncic object
$database = new Database();
$db = $database->getConnection();

// Initalize object

$ncicCitations = new ncicCitations($db);

$apiCalls = new updateApiCalls($db);

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if (strpos($url, '/nciccitations/name') !== false) {
        $name = urldecode(basename($url));

        $stmt = $ncicCitations->readbyName($name);
        if (!$stmt) {
            http_response_code(200);

            echo json_encode(array("Error" => "Name: $name is not found."));
            addApiCallCount();
            exit();
        }

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
                array_push($ncicCitations_array["Records"], $ncicCitations_item);
            }
            $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

            array_push($ncicCitations_array["Notice"], $notice);
            // Set response code to 200 ok
            http_response_code(200);

            // Show NCICNames data in json
            echo json_encode($ncicCitations_array);

            addApiCallCount();

            exit();
        } else {
            http_response_code(200);
            echo json_encode(array("message" => "No NCIC Arrests found!"));
            addApiCallCount();
            exit();
        }
    }

    if (basename($url) !== false) {
        $id = urldecode(basename($url));

        $stmt = $ncicCitations->readbyId($id);

        if (!$stmt) {
            http_response_code(200);

            echo json_encode(array("Error" => "ID: $id is not found."));
            addApiCallCount();
            exit();
        }

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
                array_push($ncicCitations_array["Records"], $ncicCitations_item);
            }
            $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

            array_push($ncicCitations_array["Notice"], $notice);
            // Set response code to 200 ok
            http_response_code(200);

            // Show NCICNames data in json
            echo json_encode($ncicCitations_array);

            addApiCallCount();

            exit();
        } else {
            http_response_code(200);
            echo json_encode(array("message" => "No NCIC Arrests found!"));
            addApiCallCount();
            exit();
        }
    }

    if (basename($url == "nciccitations")) {
        $stmt = $ncicCitations->read();
        if (!$stmt) {
            http_response_code(200);

            echo json_encode(array("Error" => "Name: $name is not found."));
            addApiCallCount();
            exit();
        }

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
                array_push($ncicCitations_array["Records"], $ncicCitations_item);
            }
            $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

            array_push($ncicCitations_array["Notice"], $notice);
            // Set response code to 200 ok
            http_response_code(200);

            // Show NCICNames data in json
            echo json_encode($ncicCitations_array);

            addApiCallCount();

            exit();
        }

        if (basename($url) != "nciccitations") {
            $id = basename($url);

            $stmt = $ncicCitations->readbyId($id);

            if (!$stmt) {
                http_response_code(200);

                echo json_encode(array("Error" => "ID: $id is not found."));
                addApiCallCount();
                exit();
            }

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
                    array_push($ncicCitations_array["Records"], $ncicCitations_item);
                }
                $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

                array_push($ncicCitations_array["Notice"], $notice);
                // Set response code to 200 ok
                http_response_code(200);

                // Show NCICNames data in json
                echo json_encode($ncicCitations_array);

                addApiCallCount();

                exit();
            } else {
                http_response_code(200);
                echo json_encode(array("message" => "No NCIC Citations found!"));
                addApiCallCount();
                exit();
            }
        }

        if (isset($_GET["name"]) || !empty($_GET["name"])) {
            $name = htmlspecialchars($_GET["name"]);

            $stmt = $ncicCitations->readbyName($name);

            if (!$stmt) {
                http_response_code(200);

                echo json_encode(array("Error" => "Name: $name is not found."));
                addApiCallCount();
                exit();
            }

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
                    array_push($ncicCitations_array["Records"], $ncicCitations_item);
                }
                $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

                array_push($ncicCitations_array["Notice"], $notice);
                // Set response code to 200 ok
                http_response_code(200);

                // Show NCICNames data in json
                echo json_encode($ncicCitations_array);

                addApiCallCount();

                exit();
            } else {
                http_response_code(200);
                echo json_encode(array("message" => "No NCIC Citations found!"));
                addApiCallCount();
                exit();
            }
        }
    } else {
        http_response_code(200);
        echo json_encode(array("message" => "No NCIC Citations found!"));
        addApiCallCount();
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    http_response_code(200);

    if (empty($_POST["$status"]) || empty($_POST["nameId"]) || empty($_POST["citationName"]) || empty($_POST["citationFine"]) || empty($_POST["issuedDate"]) || empty($_POST["issuedBy"])) {
        http_response_code(200);
        echo json_encode(array("Error" => "Data is mssing!"));
        exit();
    }

    $status = htmlspecialchars($_POST["status"]);
    $nameId = htmlspecialchars($_POST["nameId"]);
    $citationName = htmlspecialchars($_POST["citationName"]);
    $citationFine = htmlspecialchars($_POST["citationFine"]);
    $issuedDate = htmlspecialchars($_POST["issuedDate"]);
    $issuedBy = htmlspecialchars($_POST["issuedBy"]);
    try {
        $ncicCitations->post($status, $nameId, $citationName, $citationFine, $issuedDate, $issuedBy);
        $ncicCitations_array = array();
        $ncicCitations_array["Records"] = array();
        $ncicCitations_array["Notice"] = array();

        // Add items to array
        $ncicCitations_item = array(
            "Success"       => array("The following data has successfully been added!"),
            "status"        => $status,
            "nameId"        => $nameId,
            "citationName"  => $citationName,
            "citationFine"  => $citationFine,
            "issuedDate"    => $issuedDate,
            "issuedBy"      => $issuedBy
        );
        array_push($ncicCitations_array["Records"], $ncicCitations_item);

        $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

        array_push($ncicCitations_array["Notice"], $notice);
        echo json_encode($ncicCitations_array);
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

        // $ncicCitations->update($id, $nameId, $arrestReason, $arrestFine, $issuedDate, $issuedBy);
        // exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (basename($url) != "nciccitations") {
        $id = urldecode(basename($url));
        http_response_code(200);
        
        $deleteArrest = $ncicCitations->delete($id);
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
