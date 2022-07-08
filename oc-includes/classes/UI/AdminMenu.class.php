<?php

namespace UI;

class AdminMenu extends \Dbh
{

    public $MenuArray = array();

    public function get_admin_ui_items()
    {
        $MenuArray = $this->MenuArray;
        foreach($MenuArray as $data){
            return $data;
        }
    }

    /**
     * function add_admin_ui_item($name, $href, $icon);
     * 
     * Allows adding of admin menu Items
     * 
     * @param string $name Name of button
     * @param string $href Button Link
     * @param string $icon Name of FontAwesome icon
     * 
     */
    public function add_admin_ui_item($name, $href, $icon)
    {
        array_push($this->MenuArray, $name);
        return true;
    }
}
