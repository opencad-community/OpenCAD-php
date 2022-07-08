<?php


require_once('../oc-config.php');
require_once(ABSPATH . '/oc-functions.php');
require_once(ABSPATH . '/oc-settings.php');
require_once(ABSPATH . OCINC . "/apiAuth.php");

isAdminOrMod();
isSessionStarted();

if (isset($_GET['verifyWebhook'])){
    verifyNewWebhook();
}elseif(isset($_GET['updateWebhook'])){
    updateWebhook();
}elseif(isset($_POST['delete'])){
    deleteWebhook();
}elseif(isset($_POST['edit'])){
    editWebhook();
}
else{
    header("location: ".$_SERVER['HTTP_REFERER']);
    exit();
}

function updateWebhook(){
    $checkdetails = true;
    $title = $_POST["webhook_title"] ?? NULL;
    $json_data = $_POST["json_data"]?? NULL;
    $type = $_POST["webhook_settings"]?? NULL;
    $uri = $_POST["webhook_uri"]?? NULL;
    if(isset($_POST["webhook_activation"])){$settings = $_POST["webhook_activation"];$settings = implode("-", $settings);}else{NULL;};


    $webhook_data = new System\Webhook();

    if($checkdetails) {
        $uniqid = random_bytes(30);
        $uniqid = bin2hex($uniqid);
        if(empty($title) || empty($json_data) || empty($uri)){
            $_SESSION["webhook_error"] = lang_key("WEBHOOK_ERROR_EMPTYSTRING");
            header("location: " . BASE_URL . "/oc-admin/webhook.php?id=".$uniqid."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);
            exit();
        }
        
        if(!$_POST["webhook_activation"]){
            $_SESSION["webhook_error"] = lang_key("WEBHOOK_ERROR_EMPTYOPTION");
            header("location: " . BASE_URL . "/oc-admin/webhook.php?id=".$uniqid."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);
            exit();
        }
        
        if(!$webhook_data->verifyWebhookURI($uri)){
            $_SESSION["webhook_error"] = lang_key("WEBHOOK_ERROR_INVALIDURI");
            header("location: " . BASE_URL . "/oc-admin/webhook.php?id=".$uniqid."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);
            exit();
        }
        if(!$webhook_data->isJson($json_data)){
            $_SESSION["webhook_error"] = lang_key("WEBHOOK_ERROR_INCORRECTJSON");
            header("location: " . BASE_URL . "/oc-admin/webhook.php?id=".$uniqid."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);
            exit();
        }
    }
    
    // If all checks pass, then submit into the DB
    $webhook_data->updateWebook();

    $_SESSION["webhook_success"] = lang_key("WEBHOOK_SUCCESS_UPDATED");
    header("location: " . BASE_URL . "/oc-admin/webhook.php");

    exit();
}

function editWebhook(){
    $webhook_data = new System\Webhook();
    $config_data = new System\Config(); 
    $result = $webhook_data->getWebhookById($_POST["webhookId"]);
    foreach($result as $data){
        $title = $data["webhook_title"]; 
        $uri = $config_data->decrpytString($data["webhook_uri"]);
        $json_data =$data["webhook_json"];
        $settings = $data["webhook_settings"];
        $type = $data["webhook_type"];
        $id = $data["id"];
    }
    $uniqid = random_bytes(30);
    $uniqid = bin2hex($uniqid);
    header("location: " . BASE_URL . "/oc-admin/webhook.php?update=true&uid=".$uniqid."&id=".$id."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);

}

function deleteWebhook()
{
	$webhook_data = new System\Webhook();
    $id = htmlspecialchars($_POST['webhookId']);
    $webhook_data->deleteWebhook($id);
    $_SESSION["webhook_success"] = lang_key("WEBHOOK_SUCCESS_DELETED");
    header("location: " . $_SERVER['HTTP_REFERER']);
    exit();
    
}


function verifyNewWebhook()
{
    $checkdetails = true;
    $title = $_POST["webhook_title"] ?? NULL;
    $json_data = $_POST["json_data"]?? NULL;
    $type = $_POST["webhook_settings"]?? NULL;
    $uri = $_POST["webhook_uri"]?? NULL;
    if(isset($_POST["webhook_activation"])){$settings = $_POST["webhook_activation"];$settings = implode("-", $settings);}else{NULL;};


    $webhook_data = new System\Webhook();

    if($checkdetails) {
        $uniqid = random_bytes(30);
        $uniqid = bin2hex($uniqid);
        if(empty($title) || empty($json_data) || empty($uri)){
            $_SESSION["webhook_error"] = lang_key("WEBHOOK_ERROR_EMPTYSTRING");
            header("location: " . BASE_URL . "/oc-admin/webhook.php?id=".$uniqid."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);
            exit();
        }
        
        if(!$_POST["webhook_activation"]){
            $_SESSION["webhook_error"] = lang_key("WEBHOOK_ERROR_EMPTYOPTION");
            header("location: " . BASE_URL . "/oc-admin/webhook.php?id=".$uniqid."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);
            exit();
        }
        
        if(!$webhook_data->verifyWebhookURI($uri)){
            $_SESSION["webhook_error"] = lang_key("WEBHOOK_ERROR_INVALIDURI");
            header("location: " . BASE_URL . "/oc-admin/webhook.php?id=".$uniqid."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);
            exit();
        }
        if(!$webhook_data->isJson($json_data)){
            $_SESSION["webhook_error"] = lang_key("WEBHOOK_ERROR_INCORRECTJSON");
            header("location: " . BASE_URL . "/oc-admin/webhook.php?id=".$uniqid."&title=".$title."&uri=".$uri."&json=".$json_data."&settings=".$settings."&type=".$type);
            exit();
        }
    }
    
    // If all checks pass, then submit into the DB
    $webhook_data->submitWebhook();

    $_SESSION["webhook_success"] = lang_key("WEBHOOK_SUCCESS_SUBMITTED");
    header("location: " . BASE_URL . "/oc-admin/webhook.php");

    exit();
}
