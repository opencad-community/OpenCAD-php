<?php

namespace Hooks;

require_once(__DIR__ . "/../../../oc-config.php");
class Hook extends \Dbh{
    
    // I don't know how it works so don't ask.
    public $HookArray;

    public function __construct()
    {
        $this->HookArray = [];
    }
    public function add_func($funcName){
        
        if(is_array($this->HookArray)){
            array_push($this->HookArray, $funcName);
            file_put_contents(ABSPATH . 'oc-includes/classes/Hooks/data.bin', serialize($this->HookArray));
            return $this->HookArray;
        }else{
            echo "no";
        }
    }

    public function get_func(){
        return unserialize(file_get_contents(ABSPATH . 'oc-includes/classes/Hooks/data.bin'));
    }

    public function run_func(){
        $func = $this->get_func();
        foreach($func as $data){
            if(function_exists($data)){
                call_user_func($data);
            }
        }
    }
}