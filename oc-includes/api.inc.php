<?php

require_once('../oc-config.php');
require_once(ABSPATH . '/oc-functions.php');
require_once(ABSPATH . '/oc-settings.php');

isSessionStarted();
if(isset($_POST['delete'])){
    deleteAPIKey();
}

function deleteAPIKey(){
    $api_data = new API\APIManager();

    $id = htmlspecialchars($_POST['apiID']);

    $api_data->deleteAPI($id);
    $_SESSION["api_success"] = lang_key("API_SUCCESS_DELETED");
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if(!isset($_POST["API_title"])){
    $_SESSION["api_error"] = lang_key("API_ERROR_TITLEREQUIRED");
    header("location: " . BASE_URL . "/oc-admin/api.php");
    exit();
}

if (isset($_POST["API_perms"])) {
    $settings = $_POST["API_perms"];
    $settings = implode("-", $settings);
} else {
    $_SESSION["api_error"] = lang_key("API_ERROR_PERMISSIONREQUIRED");
    header("location: " . BASE_URL . "/oc-admin/api.php?title=" . $title);
    exit();
};

$title = $_POST["API_title"];
$key = $_POST["API_key"];

if(strpos($settings, "allowPOST") !== false || strpos($settings, "allowGET") !== false || strpos($settings, "allowDELETE") !== false || strpos($settings, "allowPUT") !== false ){
} else{
    $_SESSION["api_error"] = lang_key("API_ERROR_METHODREQUIRED");
    header("location: " . BASE_URL . "/oc-admin/api.php?title=" . $title);
    exit();
}

if(strpos($settings, "ncicArrests") !== false || strpos($settings, "ncicWeapons") !== false || strpos($settings, "ncicWarnings") !== false || strpos($settings, "ncicCitations") !== false || strpos($settings, "ncicWarrants") !== false || strpos($settings, "ncicPlates") !== false ){
} else{
    $_SESSION["api_error"] = lang_key("API_ERROR_PERMISSIONREQUIRED");
    header("location: " . BASE_URL . "/oc-admin/api.php?title=" . $title);
    exit();
}

// Checks passed, insert into DB
$api_data = new API\APIManager();
$api_data->insertKey();

$_SESSION["api_success"] = lang_key("API_SUCCESS_SUBMITTED");
header("location: " . BASE_URL . "/oc-admin/api.php?title=" . $title);
exit();