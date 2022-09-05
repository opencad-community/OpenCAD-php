<?php

spl_autoload_register("classAutoLoader");
function classAutoLoader($className){
	$url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    
    if(strpos($url, "oc-content") !== false){
        $path = ABSPATH . "oc-includes/classes/";
    }elseif(strpos($url, "oc-includes") !== false){
        $path = "classes/";
    }elseif(strpos($url, "oc-api") !== false){
        $path = __DIR__ . "/../oc-includes/classes/";
    }elseif(strpos($url, "oc-admin") !== false){
        $path = "../oc-includes/classes/";
    } else{
        $path = ABSPATH . "oc-includes/classes/";
    }
    
    
	$extensions = ".class.php";

   require $path . $className . $extensions;
}