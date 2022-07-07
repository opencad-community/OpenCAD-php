<?php

use Support\Support;

require_once("../../../oc-config.php");
require_once(ABSPATH . "/oc-functions.php");
require_once(ABSPATH . "/oc-includes/autoload.inc.php");

isSessionStarted();
$support_data = new System\Support();

if (isset($_POST["gh_key_BTN"])) {
    $key = $_POST["gh_key"];

    if ($support_data->checkRow()) {
        $_SESSION["support_error"] = lang_key("SUPPORT_ERROR_GH_KEY_EXISTS");
        header("location: " . BASE_URL . "/oc-admin/support.php?create=error");
        exit();
    }

    $checkKey = $support_data->checkKey($key);
    if (strpos($checkKey, "Bad credentials")) {
        $_SESSION["support_error"] = lang_key("SUPPORT_ERROR_GH_KEY_INCORRECT");
        header("location: " . BASE_URL . "/oc-admin/support.php?create=error");
        exit();
    } else {
        $_SESSION["support_success"] = lang_key("SUPPORT_SUCCESS_GH_KEY_CREATE");
        $support_data->createKey($key);
        header("location: " . BASE_URL . "/oc-admin/support.php?create=success");
        exit();
    }

    header("location: " . BASE_URL . "/oc-admin/support.php?error=unknown");
}

if (isset($_POST["gh_bug_submit"])) {
    $title = $_POST["title_bug"] ?? NULL;
    $describe = $_POST["describe_bug"] ?? NULL;
    $reproduce = $_POST["reproduce_bug"] ?? NULL;
    $expected = $_POST["expected_bug"] ?? NULL;
    $screenshot = $_POST["screenshot_bug"] ?? NULL;
    $desktop = $_POST["desktop_bug"] ?? NULL;
    $smartphone = $_POST["smartphone_bug"] ?? NULL;
    $server = $_POST["server_bug"] ?? NULL;
    $additional = $_POST["additional_bug"] ?? NULL;

    $key = $support_data->getKey();
    $key = $support_data->decrpytKey($key["value"]);

    $array = array("title" => $title, "body" => "Description:\n $describe\n\nReproduce:\n $reproduce\n\nExpected Behaviour:\n $expected\n\nScreenshot Links:\n $screenshot\n\nDesktop Information:\n $desktop\n\nSmartphone Information:\n $smartphone\n\nServer Information:\n $server\n\nAdditional Information:\n $additional\n\n###### This issue was automatically generated within the OpenCAD 1.0 support plugin.");
    $array = json_encode($array);
    $submit = $support_data->submitBug($key, $array);

    $issueNum = $submit["number"];
    $issueURL = $submit["url"];

    $issueURL = str_replace('api.', '', $issueURL);
    $issueURL = str_replace('repos/', '', $issueURL);


    $_SESSION["support_success"] = lang_key("SUPPORT_SUCCESS_GH_ISSUE_CREATED");

    header("location: " . BASE_URL . "/oc-admin/support.php?success=createdIssue&id=" . $issueNum . "&link=" . $issueURL);

    exit();
}


header("location: " . BASE_URL . "/oc-admin/admin.php");
