<?php
require_once("../../../../oc-config.php");

if (isset($_SERVER["HTTP_REFERER"])) {
    if ($_SERVER["HTTP_REFERER"] == str_contains($_SERVER["HTTP_REFERER"], "oc-apps/cad.php")) {
    } else {
        throw_new_error("Unknown Document!", "The page you are trying to access, does not exist.");
    }
} else {
    throw_new_error("Unknown Document!", "The page you are trying to access, does not exist.");
}
