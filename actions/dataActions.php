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
include_once(__DIR__ . "/../plugins/api_auth.php");

/*
This file handles all actions for admin.php script
*/

/* Handle POST requests */

/**
 * Patch notes:
 * Adding the `else` to make a `else if` prevents the execution
 * of multiple functions at the same time by the same client
 *
 * Running multiple functions at the same time doesnt seem to
 * be a needed feature.
 */

if (isset($_POST['resetData']))
{
    resetData();
}  

if (isset($_POST['editStreet']))
{
    editStreet();
} if (isset($_POST['editVehicles']))
{
    editVehicle();
} if (isset($_POST['editVehicle']))
{
    deleteStreet();
} if (isset($_POST['deleteStreet']))
{
    deleteStreet();
} else if (isset($_POST['deleteVehicle']))
{
    deleteVehicle();
} else if (isset($_POST['deleteWeapon']))
{
    deleteWeapons();
} else if (isset($_POST['getStreets']))
{
    getStreets();
} else if (isset($_POST['getVehicles']))
{
    getVehicles();
} else if (isset($_POST['getWeapons']))
{   
    getWeapons();
} else if (isset($_POST['getStreetDetails']))
{
    getStreetDetails();
}

/* FUNCTIONS */
function editStreet()
{
	$id		    = !empty($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
	$name 		= !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
	$county 	= !empty($_POST['county']) ? htmlspecialchars($_POST['county']) : '';


    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    
    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."streets SET name = ?, county = ? WHERE id = ?");

    if ($stmt->execute(array($id, $name, $county))) {
        $pdo = null;

        //Let the user know their information was updated
        $_SESSION['successMessage'] = '<div class="alert alert-success"><span>Street updated successfully.</span></div>';
        error_log();
        header("Location: ".BASE_URL."/oc-admin/dataManagement/streetManagement.php");
    } else {
        echo "Error updating record: " . print_r($stmt->errorInfo(), true);
    }
    $pdo = null;
}




/**#@+
* function deleteStreet()
* Delete a given street from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteStreet()
{
    session_start();
    $uid = htmlspecialchars($_POST['id']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."streets WHERE id = ?");
    if (!$stmt->execute(array($id)))
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $pdo = null;

    session_start();
    $_SESSION['userMessage'] = '<div class="alert alert-success"><span>Successfully removed street from database</span></div>';
    header("Location: ".BASE_URL."/oc-admin/dataManagement/streetManagement.php#user_panel");
}

/**#@+
* function getStreets()
* Fetches all streets from the streets table with their resepective IDs and
* counties. It then build the table and includes functions such as Edit and Delete
* These functions are handled by editStreet(); and deleteStreet(); 
*
* @since OpenCAD 0.2.6
*
**/
function getStreets()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT * FROM ".DB_PREFIX."streets");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $num_rows = $result->rowCount();
    $pdo = null;


    if ($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are no streets in the database.</span></div>";
        
    } else {
        echo '
            <table id="allStreets" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Street</th>
                <th>County</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        foreach($result as $row)
        {
            echo '
            <tr>
                <td>' . $row[1] . '</td>
                <td>' . $row[2] . '</td>
                <td>';
        if ( DEMO_MODE == false) {
            echo '<form action="'.BASE_URL.'/actions/dataActions.php" method="post">';
            if ( ( MODERATOR_EDIT_STREET == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
            {
                echo '<button name="editStreet" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editStreetModal" class="btn btn-xs btn-link" >Edit</button>';
            } else {
                echo '<button name="editStreet" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editStreetModal" class="btn btn-xs btn-link" disabled >Edit</button>';
            }

            if ( ( MODERATOR_DELETE_STREET == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
            {
                echo '<input name="deleteStreet" type="submit" class="btn btn-xs btn-link" onclick="deleteStreet(' . $row[0] . ')" value="Delete" />';
            } else {
                echo '<input name="deleteStreet" type="submit" class="btn btn-xs btn-link" onclick="deleteStreet(' . $row[0] . ')" value="Delete" disabled />';
            }
        } else {
            echo ' </td>
                <td>
                <form action="'.BASE_URL.'/actions/dataActions.php" method="post">
                <button name="editStreet" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editStreetModal" class="btn btn-xs btn-link" disabled >Edit</button>
                <input name="deleteStreet" type="submit" class="btn btn-xs btn-link" onclick="deleteStreet(' . $row[0] . ')" value="Delete" disabled />
                ';
            }
        
        echo '<input name="uid" type="hidden" value=' . $row[0] . ' />
            </form>
            </td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    }
}

/**#@+
* function getStreetDetails();
* Fetches details for a given edit modal in Street Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getStreetDetails()
{
    $streetID = htmlspecialchars($_POST['streetID']);
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."streets WHERE id = ?");
    $resStatus = $stmt->execute(array($streetID));
    $result = $stmt;

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $encode = array();
    foreach($result as $row)
    {
        $encode["streetID"] = $row[0];
        $encode["name"] = $row[1];
        $encode["county"] = $row[2];
    }
    
    echo json_encode($encode);

}

function getStreetNames()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT id, name, county FROM ".DB_PREFIX."streets");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    echo '
        <table id="streets" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Name</th>
            <th>County</th>
            </tr>
        </thead>
        <tbody>
    ';

    foreach($result as $row)
    {
        echo '
        <tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[1] . '</td>
        </tr>
        ';
    }

    echo '
        </tbody>
        </table>
    ';
}

function resetData()
{
	$dataType 		= !empty($_POST['dataType']) ? $_POST['dataType'] : '';

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    if ($_POST ="allData") 
    {
        $tables = array(
                "user_departments",
                "user_departments_temp",
                "active_users",
                "aop",
                "bolos_persons",
                "bolos_vehicles",
                "calls",
                "calls_users",
                "call_history",
                "call_list",
                "call_citations",
                "civilian_names",
                "colors",
                "departments",
                "dispatchers",
                "incident_type",
                "ncic_arrests",
                "ncic_citations",
                "ncic_names",
                "ncic_plates",
                "ncic_warnings",
                "ncic_warrants",
                "ncic_weapons",
                "statuses",
                "streets",
                "tones",
                "vehicles",
                "weapons"
        );
        foreach ( $tables as $value ) 
        {
            $stmt = $pdo->prepare("TRUNCATE TABLE ".DB_PREFIX.$value);
        };
    } else {
        $stmt = $pdo->prepare("TRUNCATE TABLE ".DB_PREFIX.$dataType);
    }

    $result = $stmt->execute();
    
    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $pdo = null;

    session_start();
    $_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully reset the '.strtoupper($dataType).' table.</span></div>';
    header("Location: ".BASE_URL."/oc-admin/admin.php#dataManager");
}
?>