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

require_once('../oc-config.php' );
require_once( ABSPATH . "/oc-content/plugins/api_auth.php");

if (isset($_POST['ncicName'])){
    name();
}else if (isset($_POST['ncic_plate'])){
    plate();
}else if (isset($_POST['ncic_weapon'])){
    weapon();
}

function name()
{
    $name = htmlspecialchars($_POST['ncicName']);


    if(strpos($name, ' ') !== false) {

        try{
            $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        } catch(PDOException $ex)
        {
            $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
            $_SESSION['error_blob'] = $ex;
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }

        $stmt = $pdo->prepare("SELECT id, name, dob, address, gender, race, dlIssuer dlStatus, dlType, hairColor, build, weaponPermitStatus, deceased, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age FROM ".DB_PREFIX."ncicNames WHERE name = ?");
        $resStatus = $stmt->execute(array($name));
        $result = $stmt;

        if (!$resStatus)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }

        $encode = array();
        $num_rows = $result->rowCount();
        if($num_rows == 0)
        {
            $encode["noResult"] = "true";
        }
        else
        {

            foreach($result as $row)
            {
                $userId = $row[0];
                $encode["userId"] = $row[0];
                $encode["name"] = $row[1];
                $encode["dob"] = $row[2];
                $encode["age"] = $row[11];
                $encode["address"] = $row[3];
                $encode["sex"] = $row[4];
                $encode["race"] = $row[5];
                $encode["dlStatus"] = $row[6];
                $encode["dlType"] = $row[12];
                $encode["dlClass"] = $row[8];
                $encode["dlIssuer"] = $row[9];
                $encode["hairColor"] = $row[7];
                $encode["build"] = $row[8];
				$encode["weaponPermitStatus"] = $row[9];
				$encode["deceased"] = $row[10];
            }

            $stmt = $pdo->prepare("SELECT id, nameId, warrantName FROM ".DB_PREFIX."ncic_warrants WHERE nameId = ?");
            $resStatus = $stmt->execute(array($userId));
            $result = $stmt;

            if (!$resStatus)
            {
                $_SESSION['error'] = $stmt->errorInfo();
                header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
                die();
            }

            $num_rows = $result->rowCount();
            if($num_rows == 0)
            {
                $encode["noWarrants"] = "true";
            }
            else
            {
                $warrantIndex = 0;
                foreach($result as $row)
                {
                    $encode["warrantId"][$warrantIndex] = $row[0];
                    $encode["warrantName"][$warrantIndex] = $row[2];

                    $warrantIndex++;
                }
            }

            $stmt = $pdo->prepare("SELECT id, nameId, arrestReason FROM ".DB_PREFIX."ncicArrests WHERE nameId = ?");
            $resStatus = $stmt->execute(array($userId));
            $result = $stmt;

            if (!$resStatus)
            {
                $_SESSION['error'] = $stmt->errorInfo();
                header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
                die();
            }

            $num_rows = $result->rowCount();
            if($num_rows == 0)
            {
                $encode["noArrests"] = "true";
            }
            else
            {
                $arrestIndex = 0;
                foreach($result as $row)
                {
                    $encode["arrestId"][$arrestIndex] = $row[0];
                    $encode["arrestReason"][$arrestIndex] = $row[2];

                    $arrestIndex++;
                }
            }

            $stmt = $pdo->prepare("SELECT id, nameId, citationName FROM ".DB_PREFIX."ncic_citations WHERE nameId = ?");
            $resStatus = $stmt->execute(array($userId));
            $result = $stmt;

            if (!$resStatus)
            {
                $_SESSION['error'] = $stmt->errorInfo();
                header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
                die();
            }

            $num_rows = $result->rowCount();
            if($num_rows == 0)
            {
                $encode["noCitations"] = "true";
            }
            else
            {
                $citationIndex = 0;
                foreach($result as $row)
                {
                    $encode["citationId"][$citationIndex] = $row[0];
                    $encode["citationName"][$citationIndex] = $row[2];

                    $citationIndex++;
                }
            }
			
            $stmt = $pdo->prepare("SELECT id, nameId, warningName FROM ".DB_PREFIX."ncic_warnings WHERE nameId = ?");
            $resStatus = $stmt->execute(array($userId));
            $result = $stmt;

            if (!$resStatus)
            {
                $_SESSION['error'] = $stmt->errorInfo();
                header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
                die();
            }

            $num_rows = $result->rowCount();
            if($num_rows == 0)
            {
                $encode["noWarnings"] = "true";
            }
            else
            {
                $warningIndex = 0;
                foreach($result as $row)
                {
                    $encode["warningId"][$warningIndex] = $row['id'];
                    $encode["warningName"][$warningIndex] = $row['warningName'];

                    $warningIndex++;
                }
            }
        }
        echo json_encode($encode);
        $pdo = null;
    } else {
        $encode = array();
        $encode["noResult"] = "true";
        echo json_encode($encode);
    }
}

function plate()
{
    $plate = htmlspecialchars($_POST['vehPlate']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT ".DB_PREFIX."ncicPlates.*,".DB_PREFIX."ncicNames.name FROM ".DB_PREFIX."ncicPlates INNER JOIN ".DB_PREFIX."ncicNames ON ".DB_PREFIX."ncicNames.id=".DB_PREFIX."ncicPlates.nameId WHERE vehPlate = ?");
    $resStatus = $stmt->execute(array($plate));
    $result = $stmt;

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $encode = array();
    $num_rows = $result->rowCount();
    if($num_rows == 0)
    {
        $encode["noResult"] = "true";
    }
    else
    {
        foreach($result as $row)
        {

            $encode["vehPlate"] = $row['vehPlate'];
            $encode["vehMake"] = $row['vehMake'];
            $encode["vehModel"] = $row['vehModel'];
            $encode["vehPrimaryColor"] = $row['vehPrimaryColor'];
            $encode["vehSecondaryColor"] = $row['vehSecondaryColor'];
            $encode["veh_ro"] = $row['name'];
            $encode["vehInsurance"] = $row['vehInsurance'];
            $encode["flags"] = $row['flags'];
            $encode["vehRegState"] = $row['vehRegState'];
            $encode["notes"] = $row['notes'];
            $_SESSION["TestVar"] =  $row['vehRegState'];

        }
    }

    echo json_encode($encode);
}

function weapon()
{
    $name = htmlspecialchars($_POST['ncic_weapon']);
    $nameId = htmlspecialchars($_POST['ncic_weapon_id']);
    


    if(strpos($name, ' ') !== false) {

        try{
            $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        } catch(PDOException $ex)
        {
            $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
            $_SESSION['error_blob'] = $ex;
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }
    
        $stmt = $pdo->prepare("SELECT id, name, name, weapon, permit FROM ".DB_PREFIX."ncicNames WHERE name = ?");
        $resStatus = $stmt->execute(array($name));
        $result = $stmt;

        if (!$resStatus)
        {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
            die();
        }

        $encode = array();

        $num_rows = $result->rowCount();
        if($num_rows == 0)
        {
            $encode["noResult"] = "true";
        }
        else
        {
            foreach($result as $row)
            {
                $userId = $row['id'];
                $encode["userId"] = $row['submittedById'];
                $encode["firstName"] = $row['name'];
                $encode["weaponPermitStatus"] = $row['weaponPermitStatus'];

            }

            $stmt = $pdo->prepare("SELECT id, nameId, weaponType, weaponName FROM ".DB_PREFIX."ncic_weapons WHERE nameId = $userId");
            $resStatus = $stmt->execute(array($name));
            $result = $stmt;

            if (!$resStatus)
            {
                $_SESSION['error'] = $stmt->errorInfo();
                header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
                die();
            }

            $num_rows = $result->rowCount();
            if($num_rows == 0)
            {
                $encode["noWeapons"] = "true";
            }
            else
            {
                $warrantIndex = 0;
                foreach($result as $row)
                {
                    $encode["nameId"] = $row['nameId'];
                    $encode['weaponId'][$warrantIndex] = $row[id];
                    $encode['weaponName'][$warrantIndex] = "$row[weaponType] | $row[weaponName]";

                    $warrantIndex++;
                }
            }
		}
        echo json_encode($encode);
        $pdo = null;
    } else {
        $encode = array();
        $encode["noResult"] = "true";
        echo json_encode($encode);
    }
}

?>