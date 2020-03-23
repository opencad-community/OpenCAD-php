<?php
/**
 * Open source CAD system for RolePlaying Communities.
 * Copyright (C) 2018-2019 Thomas Obernosterer
 * 
 * This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 * 
 * This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
 * 
 * 
 * File origin: ATVG-CAD v1.3.0.0 by ATVG-Studios
**/

if(ENABLE_API_SECURITY === true)
{
    if(session_id() == '' || !isset($_SESSION)) {
        // session isn't started
        session_start();
        }
    if(hash('md5', session_id().getApiKey()) !== $_COOKIE['aljksdz7'])
    {
        $headers = $_SERVER['PHP_AUTH_DIGEST'];
        if(isset($headers['Authorization']))
        {
            if(substr($headers['Authorization'], 0, 5) === "Basic")
            {
                if(base64_decode(str_replace('Basic', '', $headers['Authorization'])) !== "api:".getApiKey())
                {
                    header('HTTP/1.1 403 Unauthorized');
                    die();
                }
            }else
            {
                header('HTTP/1.1 403 Unauthorized');
                die();
            }
        }else
        {
            header('HTTP/1.1 403 Unauthorized');
            die();
        }
    }
}