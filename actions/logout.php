<?php 
/**
   Open source CAD system for RolePlaying Communities. 
   Copyright (C) 2017 Shane Gill

   This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

   This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
**/

    session_start();
    session_unset();
    session_destroy();

    header("Location: ../index.php");
    exit();
?>