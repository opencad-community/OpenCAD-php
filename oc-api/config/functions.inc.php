<?php

function checkApiKey(){

    if(!isset($_GET["oc-apikey"]) || $_GET["oc-apikey"] != getApiKey() || empty($_GET["oc-apikey"])){
        echo UnauthorizedApiKey();
        exit();
    } else{
        return true;
    }
}

function UnauthorizedApiKey(){
    
    http_response_code(201);
    $json = json_encode(array("Error" => "401 Unauthorized"));
    return $json;

}