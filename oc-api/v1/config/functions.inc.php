<?php

function checkApiKey()
{
    $headers = apache_request_headers();
    if (isset($headers["oc-apikey"])) {
        $key = $headers["oc-apikey"];
        isKeyCorrect($key);
    } elseif (isset($_GET["oc-apikey"])) {
        $key = $headers["oc-apikey"];
        isKeyCorrect($key);
    } else {
        echo UnauthorizedApiKey();
        exit();
    }
}

function isKeyCorrect($key){
    if($key != getApiKey() || empty($key)){
        echo UnauthorizedApiKey();
    }else{
        return true;
    }
}

function UnauthorizedApiKey(){
    http_response_code(401);
    sendMsg("Error", "401 Unauthorized");
    exit();
}

function sendMsg($title, $msg){
    echo json_encode(array("$title" => "$msg"));
    exit();
}
