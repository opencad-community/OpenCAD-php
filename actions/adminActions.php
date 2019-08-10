<?php
/**
 Open source CAD system for RolePlaying Communities.
 Copyright (C) 2017 Shane Gill
 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
 *
 */

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
if (isset($_GET['dept_id']) && isset($_GET['user_id']))
{
    deleteGroupItem();
}else if (isset($_POST['approveUser']))
{
    approveUser();
}else if (isset($_POST['editUserAccount']))
{
    editUserAccount();
}
else if (isset($_POST['editUserAccountRole']))
{
    editUserAccountRole();
} else if (isset($_POST['rejectUser']))
{
    rejectUser();
}else if (isset($_POST['suspendUser']))
{
    suspendUser();
}else if (isset($_POST['suspendUserWithReason']))
{
    suspendUserWithReason();
}else if (isset($_POST['reactivateUser']))
{
    reactivateUser();
}else if (isset($_POST['deleteUser']))
{
    delete_user();
}else if (isset($_POST['getUserDetails']))
{
    getUserDetails();
} else if (isset($_POST['getUserID']))
{
    getUserID();
}else if (isset($_POST['delete_callhistory']))
{
    delete_callhistory();
}
else if (isset($_POST['changeUserPassword']))
{
    changeUserPassword();
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

    if($myRank >= $hisRank && $myRank == 2){
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
    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET name = ?, email = ?, identifier = ? WHERE id = ?");

    if ($stmt->execute(array($userName, $userEmail, $userIdentifier, $userID))) {
        $pdo = null;
        header("Location: ".BASE_URL."/oc-admin/userManagement.php");
    } else {
        echo $userRole."<br><br>";
        echo "Error updating record: " . print_r($stmt->errorInfo(), true);
    }
    $pdo = null;
}

function editUserAccountRole()
{
	$userID 		= !empty($_POST['userID']) ? htmlspecialchars($_POST['userID']) : '';
    $userRole 		= !empty($_POST['userRole']) ? htmlspecialchars($_POST['userRole']) : '';

    session_start();
    $myRank = $_SESSION['admin_privilege'];
    $hisRank = _getRole($userID);

    if($myRank >= $hisRank && $myRank == 2){
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
 
    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET admin_privilege = ? WHERE id = ?");
    
    if ($stmt->execute(array($userRole, $userID))) {
        $pdo = null;
        header("Location: ".BASE_URL."/oc-admin/userManagement.php");
    } else {
        echo $userRole."<br><br>";
        echo "Error updating record: " . print_r($stmt->errorInfo(), true);
        print_r($_POST);
    }
    $pdo = null;
}

function delete_user()
{
    session_start();
    $uid = htmlspecialchars($_POST['uid']);
    $myRank = $_SESSION['admin_privilege'];
    $hisRank = _getRole($uid);

    if($myRank <= $hisRank && $myRank == 1){
        $_SESSION['accessMessage'] = '<div class="alert alert-error"><span>Error, you cannot delete this user account</span></div>';
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

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."users WHERE id = ?");
    if (!$stmt->execute(array($uid)))
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."user_departments WHERE user_id = ?");
    if (!$stmt->execute(array($uid)))
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $pdo = null;

    session_start();
    $_SESSION['userMessage'] = '<div class="alert alert-success"><span>Successfully removed user from database</span></div>';
    header("Location: ".BASE_URL."/oc-admin/userManagement.php#user_panel");
}

/* Gets the user count. Returns value */
function getUserCount()
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

    $result = $pdo->query("SELECT COUNT(*) from ".DB_PREFIX."users")->fetch(PDO::FETCH_NUM);
    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;
    return $result[0];
}

function getPendingUsers()
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

    $result = $pdo->query("SELECT id, name, email, identifier FROM ".DB_PREFIX."users WHERE approved = '0'");
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
        echo "<div class=\"alert alert-info\"><span>There are currently no access requests</span></div>";
    }
    else
    {
        echo '
            <table id="pendingUsers" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Identifier</th>
                <th>Groups</th>
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
                <td>' . $row[3] . '</td>
                <td>';

            getUserGroups($row[0]);

            echo ' </td>
                <td>
                    <form action="'.BASE_URL.'/actions/adminActions.php" method="post">
                    <input name="approveUser" type="submit" class="btn btn-xs btn-link" value="Approve" />
                    <input name="rejectUser" type="submit" class="btn btn-xs btn-link" value="Reject" />
                    <input name="uid" type="hidden" value=' . $row[0] . ' />
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

function getRole()
{
    $output = "";

    $output .= '<option value="1">User</option>';
    $output .= '<option value="2">Moderator</option>';
    $output .= '<option value="3">Administrator</option>';

    echo $output;
}

function _getRole($id)
{
    $userID = $id;

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT admin_privilege FROM ".DB_PREFIX."users WHERE id = ?");
    $result = $stmt->execute(array($userID));
    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    return $result;
}

/* Get from temp table */
function getUserGroups($uid)
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

    $stmt = $pdo->prepare("SELECT ".DB_PREFIX."departments.department_name FROM ".DB_PREFIX."user_departments_temp INNER JOIN ".DB_PREFIX."departments on ".DB_PREFIX."user_departments_temp.department_id=".DB_PREFIX."departments.department_id WHERE ".DB_PREFIX."user_departments_temp.user_id = ?");
    $resStatus = $stmt->execute(array(htmlspecialchars($uid)));

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    foreach ($stmt as $row)
    {
        echo $row[0] . "<br/>";
    }
    $pdo = null;
}

/* Get from perm table */
function getUserGroupsApproved($uid)
{
    $uid = htmlspecialchars($uid);
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT ".DB_PREFIX."departments.department_name,".DB_PREFIX."departments.department_id FROM ".DB_PREFIX."user_departments INNER JOIN ".DB_PREFIX."departments on ".DB_PREFIX."user_departments.department_id=".DB_PREFIX."departments.department_id WHERE ".DB_PREFIX."user_departments.user_id = ?");
    $resStatus = $stmt->execute(array($uid));

    if (!$resStatus)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    if ( DEMO_MODE == false ) {
        foreach($stmt as $row)
        {
            if ( ( MODERATOR_REMOVE_GROUP == true ) )
            {
                echo "&nbsp;<i class='fas fa-user-times delete_group' style='font-size:16px;color:red;' data-dept-id=".$row[1]." data-user-id=".$uid."></i>" . $row[0] . "<br/>";
            } else { 
            }
        }
    } else {
        foreach($result as $row)
        {
            echo $row[0] . "<br/>";
        }
    }
}

function approveUser()
{
    $uid = htmlspecialchars($_POST['uid']);
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."user_departments SELECT u.* FROM ".DB_PREFIX."user_departments_temp u WHERE user_id = ?");
    $result = $stmt->execute(array($uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."user_departments_temp WHERE user_id = ?");
    $result = $stmt->execute(array($uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET approved = '1' WHERE id = ?");
    $result = $stmt->execute(array($uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    session_start();
    $_SESSION['accessMessage'] = '<div class="alert alert-success"><span>Successfully approved user access</span></div>';

    sleep(1);
    header("Location:".BASE_URL."/oc-admin/admin.php");

}

function rejectUser()
{
    $uid = htmlspecialchars($_POST['uid']);
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."user_departments_temp where user_id = ?");
    $result = $stmt->execute(array($uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."users where id = ?");
    $result = $stmt->execute(array($uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    session_start();
    $_SESSION['accessMessage'] = '<div class="alert alert-danger"><span>Successfully rejected user access</span></div>';

    sleep(1);
    header("Location:".BASE_URL."/oc-admin/admin.php");

}

function getGroupCount($gid)
{
    $gid = htmlspecialchars($gid);
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) from ".DB_PREFIX."user_departments WHERE department_id = ?");
    $stmt->execute(array($gid));
    $result = $stmt->fetch(PDO::FETCH_NUM);

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $pdo = null;
    return $result[0];
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

    $result = $pdo->query("SELECT id, name, email, admin_privilege, identifier, approved FROM ".DB_PREFIX."users WHERE approved = '1' OR approved = '2'");

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
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Identifier</th>
            <th>Groups</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ';

    foreach($result as $row)
    {

        if ( $row[3] == 2 )
        {
          $roleIs = "Moderator";
        }
        else if ( $row[3] == 3 )
        {
          $roleIs = "Administrator";
        }
        else {
          $roleIs = "User";
        }
        echo '
        <tr>
            <td>' . $row['name'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $roleIs . '</td>
            <td>' . $row['identifier'] . '</td>
            <td id="show_group">';

        getUserGroupsApproved($row[0]);
        echo '</td><td>';
    if ( DEMO_MODE == false) {
        echo '<form action="'.BASE_URL.'/actions/adminActions.php" method="post">';
        if ( ( MODERATOR_EDIT_USER == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        {
            echo '<button name="editUser" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editUserModal" class="btn btn-xs btn-link" >Edit</button>';
            echo '<button name="changeUserPassword" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#changeUserPassword" class="btn btn-xs btn-link" >Change Password</button>';
            echo '<button name="editUserRole" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editUserRoleModal" class="btn btn-xs btn-link" >Change Role</button>';
        } else {
            echo '<button name="editUser" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editUserModal" class="btn btn-xs btn-link" disabled >Edit</button>';
            echo '<button name="changeUserPassword" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#changeUserPassword" class="btn btn-xs btn-link" disabled >Change Password</button>';
            echo '<button name="editUserRole" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editUserRoleModal" class="btn btn-xs btn-link" disabled >Change Role</button>';
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

//Function to suspend a user account
// TODO: Add reason, duration
function suspendUser()
{
    session_start();
    $uid = htmlspecialchars($_POST['uid']);
    $myRank = $_SESSION['admin_privilege'];
    $hisRank = _getRole($uid);

    if($myRank <= $hisRank && $myRank == 2){
        $_SESSION['accessMessage'] = '<div class="alert alert-error"><span>Error, you cannot suspend this user account</span></div>';
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

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET approved = '2' WHERE id = ?");
    $result = $stmt->execute(array($uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $_SESSION['accessMessage'] = '<div class="alert alert-success"><span>Successfully suspended user account</span></div>';

    sleep(1);
    header("Location:".BASE_URL."/oc-admin/userManagement.php");
}

/* Function to Suspend a user with a Reason */

function suspendUserWithReason()
{
    session_start();
    $uid = htmlspecialchars($_POST['uid']);
    $suspend_reason = htmlspecialchars($_POST['suspend_reason']);
    $myRank = $_SESSION['admin_privilege'];
    $hisRank = _getRole($uid);

    if($myRank <= $hisRank && $myRank == 1){
        $_SESSION['accessMessage'] = '<div class="alert alert-error"><span>Error, you cannot suspend this user account</span></div>';
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

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET approved = '2' WHERE id = ?");
    $result = $stmt->execute(array($uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET suspend_reason = (?) WHERE id = ?");
    $result = $stmt->execute(array($suspend_reason,$uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    session_start();
    $_SESSION['accessMessage'] = '<div class="alert alert-success"><span>Successfully suspended user account with reason</span></div>';

    sleep(1);
    header("Location:".BASE_URL."/oc-admin/userManagement.php");
}


function reactivateUser()
{
    $uid = htmlspecialchars($_POST['uid']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET approved = '1' WHERE id = ?");
    $result = $stmt->execute(array($uid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    session_start();
    $_SESSION['accessMessage'] = '<div class="alert alert-success"><span>Successfully reactivated user account</span></div>';

    sleep(1);
    header("Location:".BASE_URL."/oc-admin/userManagement.php");
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
        $encode["userId"] = $row['id'];
        $encode["name"] = $row['name'];
        $encode["email"] = $row['email'];
        $encode["identifier"] = $row['identifier'];
        $encode["role"] = $row['admin_privilege'];
    }

    //Pass the array and userID to getUserGroupsEditor which will return it
    getUserGroupsEditor($encode, $userId);
}

function getUserID()
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

    $stmt = $pdo->prepare("SELECT id FROM ".DB_PREFIX."users WHERE ID = ?");
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
        $encode["userId"] = $row['id'];    }

    echo json_encode($encode);
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



function getCodes()
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

    $result = $pdo->query("SELECT code_id, code_name FROM ".DB_PREFIX."codes");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    echo '
        <table id="codes" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Code ID</th>
            <th>Code Name</th>
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

function getCallHistory()
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

    $result = $pdo->query("SELECT * FROM ".DB_PREFIX."call_history");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    $num_rows = $result->rowCount();

    if ($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are currently no archived calls</span></div>";
    }
    else
    {
        echo '
        <table id="call_history" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Call ID</th>
            <th>Call Type</th>
            <th>Primary Unit</th>
            <th>Street 1</th>
            <th>Street 2</th>
            <th>Street 3</th>
            <th>Narrative</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ';

        foreach($result as $row)
        {
            echo '
        <tr>
            <td>' . $row['call_id'] . '</td>
            <td>' . $row['call_type'] . '</td>
            <td>' . $row['call_primary'] . '</td>
            <td>' . $row['call_street1'] . '</td>
            <td>' . $row['call_street2'] . '</td>
            <td>' . $row['call_street3'] . '</td>
            <td>' . $row['call_narrative'] . '</td>
            <td>
                <form action="'.BASE_URL.'/actions/adminActions.php" method="post">
                <input name="delete_callhistory" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete"/>
                <input name="call_id" type="hidden" value=' . $row[0] . ' />
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

function delete_callhistory()
{
    $callid = htmlspecialchars($_POST['call_id']);

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."call_history WHERE call_id = ?");
    $result = $stmt->execute(array($callid));

    if (!$result)
    {
        $_SESSION['error'] = $stmt->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

    session_start();
    $_SESSION['historyMessage'] = '<div class="alert alert-success"><span>Successfully removed archived call</span></div>';
    header("Location: ".BASE_URL."/oc-admin/callhistory.php#history_panel");
}

function changeUserPassword()
{
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $userID 		= !empty($_POST['userID']) ? htmlspecialchars($_POST['userID']) : '';

    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $id = $_SESSION['id'];
    $newpassword = htmlspecialchars($_POST['password']);
    $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET password = ? WHERE id = ?");
    $result = $stmt->execute(array($hashed_password, $userID));

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $_SESSION['profileUpdate'] = '<div class="alert alert-success"><span>Password changed successfully</span></div>';

    $pdo = null;

    sleep(1);
    header("Location:".BASE_URL."/oc-admin/userManagement.php");
    sleep(1);
    //Seconds to wait
    /*echo $_SESSION['profileUpdate'];
    header("Location: ".BASE_URL."/profile.php");*/
}
?>