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

require_once(__DIR__ . "/../oc-config.php");

/*
    Returns information on name run through NCIC.
    TODO: Add a check here to check the admin panel to determine if Randomized names are allowed
*/
/**
 * Patch notes:
 * Adding the `else` to make a `else if` prevents the execution
 * of multiple functions at the same time by the same client
 *
 * Running multiple functions at the same time doesnt seem to
 * be a needed feature.
 */
if (isset($_POST['ncic_name'])){
    name();
}else if (isset($_POST['ncic_plate'])){
    plate();
}else if (isset($_POST['ncic_weapon'])){
    weapon();
}

function name()
{
    $name = htmlspecialchars($_POST['ncic_name']);


    if(strpos($name, ' ') !== false) {

        try{
            $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        } catch(PDOException $ex)
        {
            die('Could not connect: ' . $ex);
        }

        $stmt = $pdo->prepare("SELECT id, name, dob, address, gender, race, dl_status, hair_color, build, weapon_permit, deceased, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age FROM ncic_names WHERE name = ?");
        $resStatus = $stmt->execute(array($name));
        $result = $stmt;

        if (!$resStatus)
        {
            die($stmt->errorInfo());
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
                $encode["address"] = $row[3];
                $encode["sex"] = $row[4];
                $encode["race"] = $row[5];
                $encode["dl_status"] = $row[6];
                $encode["hair_color"] = $row[7];
                $encode["build"] = $row[8];
                $encode["age"] = $row[11];
				$encode["weapon_permit"] = $row[9];
				$encode["deceased"] = $row[10];
            }

            $stmt = $pdo->prepare("SELECT id, name_id, warrant_name FROM ncic_warrants WHERE name_id = ?");
            $resStatus = $stmt->execute(array($userId));
            $result = $stmt;

            if (!$resStatus)
            {
                die($stmt->errorInfo());
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
                    $encode["warrant_name"][$warrantIndex] = $row[2];

                    $warrantIndex++;
                }
            }

            $stmt = $pdo->prepare("SELECT id, name_id, arrest_reason FROM ncic_arrests WHERE name_id = ?");
            $resStatus = $stmt->execute(array($userId));
            $result = $stmt;

            if (!$resStatus)
            {
                die($stmt->errorInfo());
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
                    $encode["arrest_reason"][$arrestIndex] = $row[2];

                    $arrestIndex++;
                }
            }

            $stmt = $pdo->prepare("SELECT id, name_id, citation_name FROM ncic_citations WHERE name_id = ?");
            $resStatus = $stmt->execute(array($userId));
            $result = $stmt;

            if (!$resStatus)
            {
                die($stmt->errorInfo());
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
                    $encode["citation_name"][$citationIndex] = $row[2];

                    $citationIndex++;
                }
            }
			
            $stmt = $pdo->prepare("SELECT id, name_id, warning_name FROM ncic_warnings WHERE name_id = ?");
            $resStatus = $stmt->execute(array($userId));
            $result = $stmt;

            if (!$resStatus)
            {
                die($stmt->errorInfo());
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
                    $encode["warningId"][$warningIndex] = $row[0];
                    $encode["warning_name"][$warningIndex] = $row[2];

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
    $plate = htmlspecialchars($_POST['ncic_plate']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        die('Could not connect: ' . $ex);
    }

    $stmt = $pdo->prepare("SELECT ncic_plates.*, ncic_names.name FROM ncic_plates INNER JOIN ncic_names ON ncic_names.id=ncic_plates.name_id WHERE veh_plate = ?");
    $resStatus = $stmt->execute(array($plate));
    $result = $stmt;

    if (!$resStatus)
    {
        die($stmt->errorInfo());
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

            $encode["plate"] = $row[2];
            $encode["veh_make"] = $row[3];
            $encode["veh_model"] = $row[4];
            $encode["veh_pcolor"] = $row[5];
            $encode["veh_scolor"] = $row[6];
            $encode["veh_ro"] = $row[12];
            $encode["veh_insurance"] = $row[7];
            $encode["flags"] = $row[8];
            $encode["veh_reg_state"] = $row[9];
            $encode["notes"] = $row[10];

        }
    }

    echo json_encode($encode);
}

function firearm()
{

}

function weapon()
{
    $name = htmlspecialchars($_POST['ncic_weapon']);


    if(strpos($name, ' ') !== false) {

        try{
            $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        } catch(PDOException $ex)
        {
            die('Could not connect: ' . $ex);
        }
    
        $stmt = $pdo->prepare("SELECT id, name, weapon_permit FROM ncic_names WHERE name = ?");
        $resStatus = $stmt->execute(array($name));
        $result = $stmt;

        if (!$resStatus)
        {
            die($stmt->errorInfo());
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
                $encode["first_name"] = $row[1];
				$encode["weapon_permit"] = $row[2];
            }

            $stmt = $pdo->prepare("SELECT id, name_id, weapon_type, weapon_name FROM ncic_weapons WHERE name_id = ?");
            $resStatus = $stmt->execute(array($name));
            $result = $stmt;

            if (!$resStatus)
            {
                die($stmt->errorInfo());
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
                    $encode["weaponId"][$warrantIndex] = $row[0];
                    $encode["weapon_name"][$warrantIndex] = "$row[2] | $row[3]";

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