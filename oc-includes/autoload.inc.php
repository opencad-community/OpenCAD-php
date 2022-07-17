<?php

spl_autoload_register("classAutoLoader");
function classAutoLoader($className){
	$url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    
    if(strpos($url, "oc-content") !== false){
        $path = ABSPATH . "oc-includes/classes/";
    }elseif(strpos($url, "oc-includes") !== false){
        $path = __DIR__ . "/classes/";
    }elseif(strpos($url, "oc-api") !== false){
        $path = __DIR__ . "/../oc-includes/classes/";
    }elseif(strpos($url, "oc-admin") !== false){
        $path = __DIR__ . "/../oc-includes/classes/";
    } else{
        $path = __DIR__ . "/oc-includes/classes/";
    }
    
    
	$extensions = ".class.php";

   require $path . $className . $extensions;
}