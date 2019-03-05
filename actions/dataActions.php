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
} 

/* FUNCTIONS */
function deleteGroupItem()
{
	$dept_id 		= !empty($_GET['dept_id']) ? $_GET['dept_id'] : '';
    $user_id 		= !empty($_GET['user_id']) ? $_GET['user_id'] : '';

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."user_departments WHERE user_id = ? AND department_id = ?");
	if ($stmt->execute(array($user_id, $dept_id))) {

		$show_record=getUserGroupsApproved($user_id);
        //$response = json_encode(array("show_record"=>$show_record));
        echo  $show_record;
    } else {
        echo "Error updating record: " . $stmt->errorInfo();
    }
    $pdo = null;
}

function editUserAccount()
{
	$userName 		= !empty($_POST['userName']) ? htmlspecialchars($_POST['userName']) : '';
	$userEmail 		= !empty($_POST['userEmail']) ? htmlspecialchars($_POST['userEmail']) : '';
	$userID 		= !empty($_POST['userID']) ? htmlspecialchars($_POST['userID']) : '';
	$userIdentifier = !empty($_POST['userIdentifier']) ? htmlspecialchars($_POST['userIdentifier']) : '';
	$userGroups 	= !empty($_POST['userGroups']) ? $_POST['userGroups'] : '';
    $userRole       = !empty($_POST['userRole']) ? htmlspecialchars($_POST['userRole']) : '';

    session_start();
    $myRank = $_SESSION['admin_privilege'];
    $hisRank = _getRole($userID);

    if($myRank <= $hisRank && $myRank == 2){
        $_SESSION['accessMessage'] = '<div class="alert alert-error"><span>Error, you cannot edit this user account</span></div>';
        sleep(1);
        header("Location:".BASE_URL."/oc-admin/userManagement.php");
        die();
    }

    if($userRole == 3 && $myRank == 2){
        $_SESSION['accessMessage'] = '<div class="alert alert-error"><span>Error, you cannot make yourself administrator</span></div>';
        sleep(1);
        header("Location:".BASE_URL."/oc-admin/userManagement.php");
        die();
    }

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

	if(!empty($userGroups))
	{
		foreach($userGroups as $key=>$val)
		{
            $val = htmlspecialchars($val);
			$stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."user_departments (user_id, department_id) VALUES (?, ?)");
            $stmt->execute(array($userID, $val));
		}
	}
    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET name = ?, email = ?, identifier = ?, admin_privilege = ? WHERE id = ?");

    if ($stmt->execute(array($userName, $userEmail, $userIdentifier, $userRole, $userID))) {
        $pdo = null;
        header("Location: ".BASE_URL."/oc-admin/userManagement.php");
    } else {
        echo $userRole."<br><br>";
        echo "Error updating record: " . print_r($stmt->errorInfo(), true);
    }
    $pdo = null;
}

function getRanks()
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

    $result = $pdo->query("SELECT * FROM ".DB_PREFIX."ranks");
    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    echo '
        <table id="ranks" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Rank ID</th>
            <th>Rank Name</th>
            <th>User Can Choose <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="This indicates whether or not regular users may select this rank for themselves"></i></th>
            </tr>
        </thead>
        <tbody>
    ';

    foreach($result as $row)
    {
        echo '
        <tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[1] . '</td>';

        switch ($row[2])
        {
            case "1":
                echo "<td>True</td>";
            break;
            case "0":
                echo "<td>False</td>";
            break;
        }

        echo '
        </tr>
        ';
    }

    echo '
        </tbody>
        </table>
    ';
    $pdo = null;
}

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

/* NOTE: This function will only build table for users with status 1 & 2. Unapproved users will not be included in this list */
function getUsers()
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

    $result = $pdo->query("SELECT id, street, county FROM ".DB_PREFIX."streets WHERE id = ?");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    echo '
        <table id="allUsers" class="table table-striped table-bordered">
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
            <td>' . $row[2] . '</td>
            <td>' . $row[3] . '</td>
            <td id="show_group">';

        getUserGroupsApproved($row[0]);
        echo '</td><td>';
    if ( DEMO_MODE == false) {
        echo '<form action="'.BASE_URL.'/actions/adminActions.php" method="post">';
        if ( ( MODERATOR_EDIT_USER == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        {
            echo '<button name="editUser" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editUserModal" class="btn btn-xs btn-link" >Edit</button>';
        } else {
            echo '<button name="editUser" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editUserModal" class="btn btn-xs btn-link" disabled >Edit</button>';
        }

        if ( ( MODERATOR_DELETE_USER == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        {
            echo '<input name="deleteUser" type="submit" class="btn btn-xs btn-link" onclick="deleteUser(' . $row[0] . ')" value="Delete" />';
        } else {
            echo '<input name="deleteUser" type="submit" class="btn btn-xs btn-link" onclick="deleteUser(' . $row[0] . ')" value="Delete" disabled />';
        }

        if ($row[5] == '2')
        {
            if ( ( MODERATOR_REACTIVATE_USER == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
            {
                echo '<input name="reactivateUser" type="submit" class="btn btn-xs btn-link" value="Reactivate" />';
            } else {
                echo '<input name="reactivateUser" type="submit" class="btn btn-xs btn-link" value="Reactivate" disabled />';
            }
        }
        else
        {
          if ( ( MODERATOR_SUSPEND_WITHOUT_REASON == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
          {
            echo '<input name="suspendUser" type="submit" class="btn btn-xs btn-link" value="Suspend without Reason" />';
          } else {
            echo '<input name="suspendUser" type="submit" class="btn btn-xs btn-link" value="Suspend without Reason" disabled />';
          }
          if ( ( MODERATOR_SUSPEND_WITH_REASON == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
          {
            echo '<input name="suspendUserWithReason" type="submit" class="btn btn-xs btn-link" method="post" value="Suspend With Reason: " /><input class="form-control" type="text" method="post" placeholder="Reason Here" name="suspend_reason" id="suspend_reason">';
          } else {
            echo '<input name="suspendUserWithReason" type="submit" class="btn btn-xs btn-link" method="post" value="Suspend With Reason: " disabled /><input class="form-control" type="text" method="post" placeholder="Reason Here" name="suspend_reason" id="suspend_reason" readonly>';
          }
        }
    } else {
        echo ' </td>
            <td>
            <form action="'.BASE_URL.'/actions/adminActions.php" method="post">
            <button name="editUser" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editUserModal" class="btn btn-xs btn-link" disabled >Edit</button>
            <input name="deleteUser" type="submit" class="btn btn-xs btn-link" onclick="deleteUser(' . $row[0] . ')" value="Delete" disabled />
            ';
        if ($row[5] == '2')
        {
            echo '<input name="reactivateUser" type="submit" class="btn btn-xs btn-link" value="Reactivate"  disabled/>';
        }
        else
        {
            echo '<input name="suspendUser" type="submit" class="btn btn-xs btn-link" value="Suspend without Reason" disabled />';
            echo '<input name="suspendUserWithReason" type="submit" class="btn btn-xs btn-link" method="post" value="Suspend With Reason: " disabled  /><input class="form-control" type="text" method="post" placeholder="Reason Here" name="suspend_reason" id="suspend_reason" readonly>';
        }
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

function getUserDetails()
{
    $userId = htmlspecialchars($_POST['userId']);
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT id, name, email, identifier, admin_privilege FROM ".DB_PREFIX."users WHERE ID = ?");
    $resStatus = $stmt->execute(array($userId));
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
        $encode["userId"] = $row[0];
        $encode["name"] = $row[1];
        $encode["email"] = $row[2];
        $encode["identifier"] = $row[3];
        $encode["role"] = $row[4];
    }

    //Pass the array and userID to getUserGroupsEditor which will return it
    getUserGroupsEditor($encode, $userId);
}

function getUserGroupsEditor($encode, $userId)
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

    $stmt = $pdo->prepare("SELECT ".DB_PREFIX."departments.department_name FROM ".DB_PREFIX."user_departments INNER JOIN ".DB_PREFIX."departments on ".DB_PREFIX."user_departments.department_id=".DB_PREFIX."departments.department_id WHERE ".DB_PREFIX."user_departments.user_id = ?");
    $resStatus = $stmt->execute(array($userId));
    $result = $stmt;

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $counter = 0;
    foreach($result as $row)
    {
        $encode["department"][$counter] = $row[0];
        $counter++;
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

    $result = $pdo->query("SELECT name, county FROM ".DB_PREFIX."streets");

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

    $stmt = $pdo->prepare("TRUNCATE TABLE ".DB_PREFIX.$dataType);
    $result = $stmt->execute();
    
    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $pdo = null;

    session_start();
    $_SESSION['adminMessage'] = '<div class="alert alert-success"><span>Successfully reset the '.strtoupper($dataType).' table.</span></div>';
    header("Location: ".BASE_URL."/oc-admin/admin.php#dataManager");
}
?>