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
checkKeyPermission($key, "ncicNames", $_SERVER["REQUEST_METHOD"]);


// Instantiate database and ncic object
$database = new Database();
$db = $database->getConnection();

// Initalize object

$ncicName = new ncicName($db);

$apiCalls = new updateApiCalls($db);


if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Query NCIC Names

    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if (strpos($url, 'search') !== false) {
        $name = urldecode(basename($url));

        $stmt = $ncicName->readbyName($name);

        if (!$stmt) {
            http_response_code(200);

            echo json_encode(array("Error" => "Name: $name is not found."));
            addApiCallCount();
            exit();
        }

        $num = $stmt->rowCount();
        if ($num > 0) {
            $ncicName_array = array();
            $ncicName_array["Records"] = array();
            $ncicName_array["Notice"] = array();

            // retrieve table contents
            // fetch seems faster than fetchAll?
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Extract Row
                // Converts $row["name"] to $name only
                extract($row);

                // Add items to array
                $ncicName_item = array(
                    "id"           => $id,
                    "submittedByName" => $submittedByName,
                    "names" => $name,
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
                    "deceased" => $deceased
                );
                array_push($ncicName_array["Records"], $ncicName_item);
            }
            $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

            array_push($ncicName_array["Notice"], $notice);
            // Set response code to 200 ok
            http_response_code(200);

            // Show NCICNames data in json
            echo json_encode($ncicName_array);

            addApiCallCount();

            exit();
        } else {
            http_response_code(200);
            echo json_encode(array("message" => "No NCIC Names found!"));
            addApiCallCount();
            exit();
        }


        if (basename($url) != "ncicnames") {
            $id = basename($url);

            $stmt = $ncicName->readbyId($id);

            if (!$stmt) {
                http_response_code(200);

                echo json_encode(array("Error" => "ID: $id is not found."));
                addApiCallCount();
                exit();
            }

            $num = $stmt->rowCount();
            if ($num > 0) {
                $ncicName_array = array();
                $ncicName_array["Records"] = array();
                $ncicName_array["Notice"] = array();

                // retrieve table contents
                // fetch seems faster than fetchAll?
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Extract Row
                    // Converts $row["name"] to $name only
                    extract($row);

                    // Add items to array
                    $ncicName_item = array(
                        "id"           => $id,
                        "submittedByName" => $submittedByName,
                        "names" => $name,
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
                        "deceased" => $deceased
                    );
                    array_push($ncicName_array["Records"], $ncicName_item);
                }
                $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

                array_push($ncicName_array["Notice"], $notice);
                // Set response code to 200 ok
                http_response_code(200);

                // Show NCICNames data in json
                echo json_encode($ncicName_array);

                addApiCallCount();

                exit();
            } else {
                http_response_code(200);
                echo json_encode(array("message" => "No NCIC Names found!"));
                addApiCallCount();
                exit();
            }
        }
    }

    $stmt = $ncicName->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $ncicName_array = array();
        $ncicName_array["Records"] = array();
        $ncicName_array["Notice"] = array();

        // retrieve table contents
        // fetch seems faster than fetchAll?
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Extract Row
            // Converts $row["name"] to $name only
            extract($row);

            // Add items to array
            $ncicName_item = array(
                "id"           => $id,
                "submittedByName" => $submittedByName,
                "names" => $name,
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
                "deceased" => $deceased
            );
            array_push($ncicName_array["Records"], $ncicName_item);
        }
        $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

        array_push($ncicName_array["Notice"], $notice);
        // Set response code to 200 ok
        http_response_code(200);

        // Show NCICNames data in json
        echo json_encode($ncicName_array);

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

    if (empty($_POST["submittedByName"]) || empty($_POST["submittedById"]) || empty($_POST["name"]) || empty($_POST["dob"]) || empty($_POST["address"]) || empty($_POST["gender"]) || empty($_POST["race"]) || empty($_POST["dlStatus"]) || empty($_POST["dlType"]) || empty($_POST["dlClass"]) || empty($_POST["dlIssuer"]) || empty($_POST["hairColor"]) || empty($_POST["build"]) || empty($_POST["weaponPermitStatus"]) || empty($_POST["weaponPermitType"]) || empty($_POST["weaponPermitIssuedBy"]) || empty($_POST["bloodType"]) || empty($_POST["organDonor"]) || empty($_POST["deceased"])) {
        http_response_code(200);
        echo json_encode(array("Error" => "Data is mssing!"));
        exit();
    }

    $submittedByName = htmlspecialchars($_POST["submittedByName"]);
    $submittedById = htmlspecialchars($_POST["submittedById"]);
    $name = htmlspecialchars($_POST["name"]);
    $dob = htmlspecialchars($_POST["dob"]);
    $address = htmlspecialchars($_POST["address"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $race = htmlspecialchars($_POST["race"]);
    $dlStatus = htmlspecialchars($_POST["dlStatus"]);
    $dlType = htmlspecialchars($_POST["dlType"]);
    $dlClass = htmlspecialchars($_POST["dlClass"]);
    $dlIssuer = htmlspecialchars($_POST["dlIssuer"]);
    $hairColor = htmlspecialchars($_POST["hairColor"]);
    $build = htmlspecialchars($_POST["build"]);
    $weaponPermitStatus = htmlspecialchars($_POST["weaponPermitStatus"]);
    $weaponPermitType = htmlspecialchars($_POST["weaponPermitType"]);
    $weaponPermitIssuedBy = htmlspecialchars($_POST["weaponPermitIssuedBy"]);
    $bloodType = htmlspecialchars($_POST["bloodType"]);
    $organDonor = htmlspecialchars($_POST["organDonor"]);
    $deceased = htmlspecialchars($_POST["deceased"]);

    try {
        $ncicName->post($submittedByName, $submittedById, $name, $dob, $address, $gender, $race, $dlStatus, $dlType, $dlClass, $dlIssuer, $hairColor, $build, $weaponPermitStatus, $weaponPermitType, $weaponPermitIssuedBy, $bloodType, $organDonor, $deceased);
        $ncicName_array = array();
        $ncicName_array["Records"] = array();
        $ncicName_array["Notice"] = array();

        // Add items to array
        $ncicName_item = array(
            "Success"               =>  array("The following data has successfully been added!"),
            "submittedByName"       =>  $submittedByName,
            "submittedById"         =>  $submittedById,
            "name"                  =>  $name,
            "dob"                   =>  $dob,
            "address"               =>  $address,
            "gender"                =>  $gender,
            "race"                  =>  $race,
            "dlStatus"              =>  $dlStatus,
            "dlType"                =>  $dlType,
            "dlClass"               =>  $dlClass,
            "dlIssuer"              =>  $dlIssuer,
            "hairColor"             =>  $hairColor,
            "build"                 =>  $build,
            "weaponPermitStatus"    =>  $weaponPermitStatus,
            "weaponPermitType"      =>  $weaponPermitType,
            "weaponPermitIssuedBy"  =>  $weaponPermitIssuedBy,
            "bloodType"             =>  $bloodType,
            "organDonor"            =>  $organDonor,
            "deceased"              =>  $deceased
        );
        array_push($ncicName_array["Records"], $ncicName_item);

        $notice = array("Notice" => "This is a very early version of the API, please expect bugs and for it not to be secure!");

        array_push($ncicName_array["Notice"], $notice);
        echo json_encode($ncicName_array);
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

        // $ncicName->update($id, $nameId, $arrestReason, $arrestFine, $issuedDate, $issuedBy);
        // exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if (basename($url) != "ncicnames") {
        $id = urldecode(basename($url));
        http_response_code(200);

        $deleteArrest = $ncicName->delete($id);
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
