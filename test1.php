<?php


require_once("oc-includes/autoload.inc.php");
require_once("test.php");

// File name: test1.php
// Main file that is being called from browser
// Call class
$test = new Hooks\Hook();
// Run all functions that are within the bin file.
$test->run_func();
// This would be included in the oc-functions.php file as it's called in every file.




// // Function Array
// $arr = array(
//     array(
//         "FuncName" => "testFunc",
//         "PluginName" => "TestPlugin"
//     )
// );

// // Loop through array and execute the function
// foreach($arr as $data){
//     if(function_exists($data["FuncName"])){
//         call_user_func($data["FuncName"]);
//     }
// }


// // Function to be executed
// function testFunc(){
//     echo '<script type="text/javascript">',
//      'alert("test")',
//      '</script>'
// ;
// }