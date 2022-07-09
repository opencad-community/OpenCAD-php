<?php

namespace Plugin;

require_once(__DIR__ ."/../../../oc-config.php");

class Plugin extends \Dbh{
    public function get_all_plugins(){
        return count( glob(ABSPATH . "/oc-content/plugins/*", GLOB_ONLYDIR) );
    }
}