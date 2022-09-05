<?php

include_once("../objects/MISC.php");
include_once("database.inc.php");
include_once(__DIR__ . "/../../../oc-includes/autoload.inc.php");

function getAPIKeyFromRequest()
{
    $headers = apache_request_headers();
    if (isset($headers["oc-apikey"])) {
        return $headers["oc-apikey"];
    } elseif (isset($_GET["oc-apikey"])) {
        return $_GET["oc-apikey"];
    } else {
        echo UnauthorizedApiKey();
        exit();
    }
}

function checkApiKey($key)
{
    if (!isKeyCorrect($key)) {
        UnauthorizedApiKey();
        exit();
    } else {
        return true;
    }
}

function isKeyCorrect($key)
{
    $api_data = new API\APIManager();

    $allKeys = $api_data->getAPIsByKey($key);
    // Check is key exists in DB
    if (!$allKeys) {
        UnauthorizedApiKey();
        exit();
    } else {
        foreach ($allKeys as $data) {
            if ($key === $data["value"]) {
                // Exists
                return true;
                exit();
            } else {
                // Doesn't Exist
                echo UnauthorizedApiKey();
                exit();
            }
        }
    }
    echo UnauthorizedApiKey();
    exit();
}

function checkKeyPermission($key, $perm, $method)
{
    $api_data = new API\APIManager();

    $Checkedkey = $api_data->getAPIKeyPermission($key);
    foreach ($Checkedkey as $data) {
        if (strpos($data["permissions"], $perm) !== false) {
            if (strpos($data["permissions"], $method) !== false) {
                return true;
                exit();
            } else {
                UnauthorizedApiKey();
                exit();
            }
            exit();
        } else {
            UnauthorizedApiKey();
            exit();
        }
    }
    exit();
}

function UnauthorizedApiKey()
{
    http_response_code(401);
    sendMsg("Error", "401 Unauthorized");
    exit();
}

function sendMsg($title, $msg)
{
    echo json_encode(array("$title" => "$msg"));
    exit();
}

function addApiCallCount()
{
    $database = new Database();
    $db = $database->getConnection();

    $apiCalls = new updateApiCalls($db);

    $count = $apiCalls->getAPICount();
    $apiCalls->addAPICount($count);
}
