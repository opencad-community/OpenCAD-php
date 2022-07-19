<?php

// Global array which will hold all of our hooks
// We will reference this array in each function to add/remove/call our hooks
// The code below should also be seen by any callbacks we write for the system later.
$hooks = [];

// Below are global functions that can be seen from OC Code
// The add_hook method will allow us to attach a function (callback) to a given event name 
function add_hook($event_name, $callback) {
    global $hooks;

    if ($callback !== null) {
        if ($callback) {
          // We can set up multiple callbacks under a single event name
            $hooks[$event_name][] = $callback;
        }
    }
}

// Super easy to implement, we remove the given hook by its name
function remove_hook($event_name) {
    global $hooks;

    unset($hooks[$event_name]);
}

// When we want to trigger our callbacks, we can call this function 
// with its name and any parameters we want to pass.
function do_hook($event_name, ...$params) {
    global $hooks;

    if (isset($hooks[$event_name])) {
      // Loop through all the callbacks on this event name and call them (if defined that is)
      // As we call each callback, we given it our parameters.
        foreach ($hooks[$event_name] as $function) {
            if (function_exists($function)) {
                call_user_func($function, ...$params);
            }
        }
    }
}
