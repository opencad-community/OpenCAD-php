<?php
/*
    Copyright (C) 2008 Sergey Tsalkov (stsalkov@gmail.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once(__DIR__ . "/../../oc-config.php");
include_once( __DIR__ . "/../../oc-functions.php");
include_once( __DIR__ . "/../../oc-settings.php");
require_once( __DIR__ . "/../apiAuth.php");

class Dbh {

  protected function connect(){
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        return $pdo;
    } catch(PDOException $ex)
    {
        throw new Exception("0xe133fd5eb502 Error Occured: " . $ex->getMessage());
        die();
    }
  }
}