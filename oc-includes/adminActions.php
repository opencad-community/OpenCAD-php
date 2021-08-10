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
 * @package OpenCAD
 * 
 */


require_once(__DIR__ . "/../oc-config.php");
include_once( ABSPATH . "/oc-functions.php");
include_once( ABSPATH . "/oc-content/plugins/api_auth.php");

/*
This file handles all actions for admin.php script
*/

/* Handle POST requests */

if (isset($_GET['dept_id']) && isset($_GET['userId']))
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
} else if (isset($_POST['getUserId']))
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
	$userId 		= !empty($_GET['userId']) ? $_GET['userId'] : '';

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location:'.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."userDepartments WHERE userId = ? AND departmentId = ?");
	if ($stmt->execute(array($userId, $dept_id))) {

		$show_record=getUserGroupsApproved($userId);
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
	$userId 		= !empty($_POST['userId']) ? htmlspecialchars($_POST['userId']) : '';
	$userIdentifier = !empty($_POST['userIdentifier']) ? htmlspecialchars($_POST['userIdentifier']) : '';
	$userGroups 	= !empty($_POST['userGroups']) ? $_POST['userGroups'] : '';
	$userRole       = !empty($_POST['userRole']) ? htmlspecialchars($_POST['userRole']) : '';

	session_start();
	$myRank = $_SESSION['adminPrivilege'];
	$hisRank = _getRole($userId);

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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

   
	if(!empty($userGroups))
	{
		foreach($userGroups as $key=>$val)
		{
			$val = htmlspecialchars($val);
			$stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."userDepartments (userId, departmentId) VALUES (?, ?)");
			$stmt->execute(array($userId, $val));
		}
	}
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET name = ?, email = ?, identifier = ? WHERE id = ?");

	if ($stmt->execute(array($userName, $userEmail, $userIdentifier, $userId))) {
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
	$userId 		= !empty($_POST['userId']) ? htmlspecialchars($_POST['userId']) : '';
	$userRole 		= !empty($_POST['userRole']) ? htmlspecialchars($_POST['userRole']) : '';

	session_start();
	$myRank = $_SESSION['adminPrivilege'];
	$hisRank = _getRole($userId);

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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
 
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET adminPrivilege = ? WHERE id = ?");
	
	if ($stmt->execute(array($userRole, $userId))) {
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
	$myRank = $_SESSION['adminPrivilege'];
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."users WHERE id = ?");
	if (!$stmt->execute(array($uid)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."userDepartments WHERE userId = ?");
	if (!$stmt->execute(array($uid)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['userMessage'] = '<div class="alert alert-success"><span>Successfully removed user from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/userManagement.php#user_panel");
}

function getPendingUsers()
{
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $pdo->query("SELECT id, name, email, identifier FROM ".DB_PREFIX."users WHERE approved = '0'");
	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
				<td>' . $row["name"] . '</td>
				<td>' . $row["email"] . '</td>
				<td>' . $row["identifier"] . '</td>
				<td>';

			getUserGroups($row[0]);

			echo ' </td>
				<td>
					<form action="'.BASE_URL.'/oc-includes/adminActions.php" method="post">
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

function getPendingUsersReadOnly()
{
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $pdo->query("SELECT id, name, email, identifier FROM ".DB_PREFIX."users WHERE approved = '0'");
	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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

			echo ' </td>';
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
	$userId = $id;

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT adminPrivilege FROM ".DB_PREFIX."users WHERE id = ?");
	$result = $stmt->execute(array($userId));
	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT ".DB_PREFIX."departments.departmentName FROM ".DB_PREFIX."userdepartmentsTemp INNER JOIN ".DB_PREFIX."departments on ".DB_PREFIX."userdepartmentsTemp.departmentId=".DB_PREFIX."departments.departmentId WHERE ".DB_PREFIX."userdepartmentsTemp.userId = ?");
	$resStatus = $stmt->execute(array(htmlspecialchars($uid)));

	if (!$resStatus)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT ".DB_PREFIX."departments.departmentName,".DB_PREFIX."departments.departmentId FROM ".DB_PREFIX."userDepartments INNER JOIN ".DB_PREFIX."departments on ".DB_PREFIX."userDepartments.departmentId=".DB_PREFIX."departments.departmentId WHERE ".DB_PREFIX."userDepartments.userId = ?");
	$resStatus = $stmt->execute(array($uid));

	if (!$resStatus)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	if ( DEMO_MODE == false ) {
		foreach($stmt as $row)
		{
			if ( ( MODERATOR_REMOVE_GROUP == true ) )
			{
				echo "&nbsp;<em class='fas fa-user-times delete_group' style='font-size:16px;color:red;' data-dept-id=".$row[1]." data-user-id=".$uid."></em>" . $row[0] . "<br/>";
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("INSERT INTO ".DB_PREFIX."userDepartments SELECT u.* FROM ".DB_PREFIX."userdepartmentsTemp u WHERE userId = ?");
	$result = $stmt->execute(array($uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."userdepartmentsTemp WHERE userId = ?");
	$result = $stmt->execute(array($uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET approved = '1' WHERE id = ?");
	$result = $stmt->execute(array($uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."userdepartmentsTemp where userId = ?");
	$result = $stmt->execute(array($uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."users where id = ?");
	$result = $stmt->execute(array($uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT COUNT(*) from ".DB_PREFIX."userDepartments WHERE departmentId = ?");
	$stmt->execute(array($gid));
	$result = $stmt->fetch(PDO::FETCH_NUM);

	if (!$result || $result[0] == 0)
	{
		$pdo = null;
		echo "N/A";
		
	} else {
		$pdo = null;
		return $result[0];
	}

}


function getGroupName($gid)
{
	$gid = htmlspecialchars($gid);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT departmentName from ".DB_PREFIX."departments WHERE departmentId = ?");
	$stmt->execute(array($gid));
	$result = $stmt->fetch(PDO::FETCH_NUM);

	if (!$result || $result[0] == "0")
	{
		$pdo = null;
		echo "No Department Found";
		
	} else {
		$pdo = null;
		return $result[0];
	}
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT id, name, email, adminPrivilege, civilianPrivilege, identifier, approved FROM ".DB_PREFIX."users WHERE approved = '1' OR approved = '2'");    
	$resStatus = $stmt->execute();
	$result = $stmt;

	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	echo '
		<table id="allUsers" class="table table-striped table-bordered" aria-label="Manage all users">
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

		if ( $row[4] == 2 )
		{
			$civState =  "(Civilian)";
		} else { $civState = ""; }
		
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
			<td>' . $row["name"] . '</td>
			<td>' . $row['email'] . '</td>
			<td>' . $roleIs . ' '.$civState.'</td>
			<td>' . $row['identifier'] . '</td>
			<td id="show_group">';

		getUserGroupsApproved($row[0]);
		echo '</td><td>';
	if ( DEMO_MODE == false) {
		echo '<form action="'.BASE_URL.'/oc-includes/adminActions.php" method="post">';
		if ( ( MODERATOR_EDIT_USER == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
		{
			echo '<button name="editUser" type="button" data-toggle="modal" id="' . $row['id'] . '" data-target="#editUserModal" class="btn btn-xs btn-link" aria-label=" Edit user: '. $row['name'] .'">Edit</button>';
			echo '<button name="changeUserPassword" type="button" data-toggle="modal" id="' .  $row['id'] . '" data-target="#changeUserPassword" class="btn btn-xs btn-link" aria-label="Change user\'s password: '. $row['name'] .'">Change Password</button>';
			echo '<button name="editUserRole" type="button" data-toggle="modal" id="' .  $row['id'] . '" data-target="#editUserRoleModal" class="btn btn-xs btn-link" aria-label="Change user\'s role: '. $row['name'] .'" >Change Role</button>';
		} else {
			echo '<button name="editUser" type="button" data-toggle="modal" id="' . $row['id'] . '" data-target="#editUserModal" class="btn btn-xs btn-link" aria-label=" Edit user: '. $row['name'] .'" disabled >Edit</button>';
			echo '<button name="changeUserPassword" type="button" data-toggle="modal" id="' . $row['id'] . '" data-target="#changeUserPassword" class="btn btn-xs btn-link" aria-label="Change user\'s password: '. $row['name'] .'" disabled >Change Password</button>';
			echo '<button name="editUserRole" type="button" data-toggle="modal" id="' . $row['id'] . '" data-target="#editUserRoleModal" class="btn btn-xs btn-link" aria-label="Change user\'s role: '. $row['name'] .'" disabled >Change Role</button>';
		}
		if ( ( MODERATOR_DELETE_USER == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
		{
			echo '<input name="deleteUser" type="submit" class="btn btn-xs btn-link" onclick="deleteUser(' . $row['id'] . ')"  aria-label="Delete User: '. $row['name'] .'" value="Delete" />';
		} else {
			echo '<input name="deleteUser" type="submit" class="btn btn-xs btn-link" onclick="deleteUser(' . $row['id'] . ')" aria-label="Delete User: '. $row['name'] .'" value="Delete" disabled />';
		}

		if ($row[5] == '2')
		{
			if ( ( MODERATOR_REACTIVATE_USER == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="reactivateUser" type="submit" class="btn btn-xs btn-link" value="Reactivate" aria-label="Reactivate User: '. $row['name'] .'" />';
			} else {
				echo '<input name="reactivateUser" type="submit" class="btn btn-xs btn-link" value="Reactivate"  aria-label="Reactivate User: '. $row['name'] .'" disabled />';
			}
		}
		else
		{
		  if ( ( MODERATOR_SUSPEND_WITHOUT_REASON == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
		  {
			echo '<input name="suspendUser" type="submit" class="btn btn-xs btn-link" value="Suspend without Reason" aria-label="Suspend user without reason: '. $row['name'] .'" />';
		  } else {
			echo '<input name="suspendUser" type="submit" class="btn btn-xs btn-link" value="Suspend without Reason" aria-label="Suspend user without reason: '. $row['name'] .'" disabled />';
		  }
		  if ( ( MODERATOR_SUSPEND_WITH_REASON == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
		  {
			echo '<input name="suspendUserWithReason" type="submit" class="btn btn-xs btn-link" method="post" value="Suspend With Reason: " aria-label="Suspend user with reason: '. $row['name'] .'" /><input class="form-control" type="text" method="post" placeholder="Reason Here" name="suspendReason" id="suspendReason" aria-label="Reason for suspension of'. $row['name'].'">';
		  } else {
			echo '<input name="suspendUserWithReason" type="submit" class="btn btn-xs btn-link" method="post" value="Suspend With Reason: " aria-label="Suspend user with reason: '. $row['name'] .'" disabled /><input class="form-control" type="text" method="post" placeholder="Reason Here" name="suspendReason" id="suspendReason" aria-label="Reason for suspension of'. $row['name'].'" readonly>';
		  }
		}
	} else {
		echo ' </td>
			<td>
			<form action="'.BASE_URL.'/oc-includes/adminActions.php" method="post">
			<button name="editUser" type="button" data-toggle="modal" id="' . $row['id'] . '" data-target="#editUserModal" class="btn btn-xs btn-link" aria-label=" Edit user: '. $row['name'] .'" disabled >Edit</button>
			<input name="deleteUser" type="submit" class="btn btn-xs btn-link" onclick="deleteUser(' . $row['id'] . ')" value="Delete" aria-label="Delete User: '. $row['name'] .'" disabled />
			';
		if ($row[5] == '2')
		{
			echo '<input name="reactivateUser" type="submit" class="btn btn-xs btn-link" value="Reactivate" aria-label="Reactivate User: '. $row['name'] .'"  disabled/>';
		}
		else
		{
			echo '<input name="suspendUser" type="submit" class="btn btn-xs btn-link" value="Suspend without Reason" aria-label="Suspend user without reason: '. $row['name'] .'" disabled />';
			echo '<input name="suspendUserWithReason" type="submit" class="btn btn-xs btn-link" method="post" value="Suspend With Reason:" aria-label="Suspend user with reason: '. $row['name'] .'" disabled  /><input class="form-control" type="text" method="post" placeholder="Reason Here" name="suspendReason" id="suspendReason" aria-label="Reason for suspension of'. $row['name'].'" readonly>';
		}
	}
	echo '<input name="userId" type="hidden" value=' . $row['id'] . ' />
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


function suspendUser()
{
	session_start();
	$uid = htmlspecialchars($_POST['uid']);
	$myRank = $_SESSION['adminPrivilege'];
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET approved = '2' WHERE id = ?");
	$result = $stmt->execute(array($uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	$pdo = null;

	$_SESSION['accessMessage'] = '<div class="alert alert-success"><span>Successfully suspended user account</span></div>';

	sleep(1);
	header("Location:".BASE_URL."/oc-admin/userManagement.php");
}

function suspendUserWithReason()
{
	session_start();
	$uid = htmlspecialchars($_POST['uid']);
	$suspendReason = htmlspecialchars($_POST['suspendReason']);
	$myRank = $_SESSION['adminPrivilege'];
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET approved = '2' WHERE id = ?");
	$result = $stmt->execute(array($uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET suspendReason = (?) WHERE id = ?");
	$result = $stmt->execute(array($suspendReason,$uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET approved = '1' WHERE id = ?");
	$result = $stmt->execute(array($uid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."users WHERE id = ?");
	$resStatus = $stmt->execute(array($userId));
	$result = $stmt;

	if (!$resStatus)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		$encode["role"] = $row['adminPrivilege'];
	}
	echo json_encode($encode);
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT id FROM ".DB_PREFIX."users WHERE ID = ?");
	$resStatus = $stmt->execute(array($userId));
	$result = $stmt;

	if (!$resStatus)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT ".DB_PREFIX."departments.departmentName FROM ".DB_PREFIX."userDepartments INNER JOIN ".DB_PREFIX."departments on ".DB_PREFIX."userDepartments.departmentId=".DB_PREFIX."departments.departmentId WHERE ".DB_PREFIX."userDepartments.userId = ?");
	$resStatus = $stmt->execute(array($userId));
	$result = $stmt;

	if (!$resStatus)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	$pdo = null;

	$counter = 0;
	foreach($result as $row)
	{
		$encode["department"][$counter] = $row[0];
		$counter++;
	}
}



function getCodes()
{
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $pdo->query("SELECT codeId, codeName FROM ".DB_PREFIX."codes");

	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $pdo->query("SELECT callId, callType, callPrimaryUnit, callStreet1 callStreet2, callStreet3, callNarrative FROM ".DB_PREFIX."callHistory");

	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
		<table id="callHistory" class="table table-striped table-bordered">
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
			<td>' . $row['callId'] . '</td>
			<td>' . $row['callType'] . '</td>
			<td>' . $row['callPrimaryUnit'] . '</td>
			<td>' . $row['callStreet1'] . '</td>
			<td>' . $row['callStreet2'] . '</td>
			<td>' . $row['callStreet3'] . '</td>
			<td>' . $row['callNarrative'] . '</td>
			<td>
				<form action="'.BASE_URL.'/oc-includes/adminActions.php" method="post">
				<input name="delete_callhistory" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete"/>
				<input name="callId" type="hidden" value=' . $row[0] . ' />
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
	$callid = htmlspecialchars($_POST['callId']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."callHistory WHERE callId = ?");
	$result = $stmt->execute(array($callid));

	if (!$result)
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
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
	$userId 		= !empty($_POST['userId']) ? htmlspecialchars($_POST['userId']) : '';

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$newpassword = htmlspecialchars($_POST['password']);
	$hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."users SET password = ? WHERE id = ?");
	$result = $stmt->execute(array($hashedPassword, $$userId ));

	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$_SESSION['profileUpdate'] = '<div class="alert alert-success"><span>Password changed successfully</span></div>';

	$pdo = null;

	sleep(1);
	header("Location:".BASE_URL."/oc-admin/userManagement.php");
}
?>