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

	require_once(__DIR__ .'/../oc-config.php');
	require_once( ABSPATH . "/oc-functions.php");
	require_once( ABSPATH . "/oc-content/plugins/api_auth.php");

/* This file handles all actions for admin.php script */

/* Handle resetData POST request */

//** Handle POST requests for Citation Type Manager **/
if (isset($_POST['getCitationTypes']))
{
	getCitationTypes();
} else if (isset($_POST['getCitationTypeDetails']))
{
	getCitationTypeDetails();
} else if (isset($_POST['editCitationType']))
{
	editCitationType();
} else if (isset($_POST['deleteCitationType']))
{
	deleteCitationType();
}

//** Handle POST requests for Departments Manager **/
else if (isset($_POST['getDepartments']))
{
	getDepartments();
} else if (isset($_POST['getDepartmentDetails']))
{
	getDepartmentDetails();
} else if (isset($_POST['editDepartment']))
{
	editDepartment();
} else if (isset($_POST['deleteDepartment']))
{
	deleteDepartment();
}

//** Handle POST requests for Incident Types **/
else if (isset($_POST['getIncidentTypes']))
{
	getIncidentTypes();
} else if (isset($_POST['getIncidentTypeDetails']))
{
	getIncidentTypeDetails();
} else if (isset($_POST['editIncidentType']))
{
	editIncidentType();
} else if (isset($_POST['deleteIncidentType']))
{
	deleteIncidentType();
}

//** Handle POST requests for Radio Code Manager **/
else if (isset($_POST['getRadioCodes']))
{
	getRadioCodes();
} else if (isset($_POST['getRadioCodeDetails']))
{
	getRadioCodeDetails();
} else if (isset($_POST['editRadioCode']))
{
	editRadioCode();
} else if (isset($_POST['deleteRadioCode']))
{
	deleteRadioCode();
}

// Handle POST requests for Streets **//
else if (isset($_POST['getStreets']))
{
	getStreets();
} else if (isset($_POST['getStreetDetails']))
{
	getStreetDetails();
} else if (isset($_POST['editStreet']))
{
	editStreet();
} else if (isset($_POST['deleteStreet']))
{
	deleteStreet();
}

//** Handle POST requests for Vehicles **/
else if (isset($_POST['getVehicles']))
{
	getVehicles();
} else if (isset($_POST['getVehicleDetails']))
{
	getVehicleDetails();
} else if (isset($_POST['editVehicle']))
{
	editVehicle();
} else if (isset($_POST['deleteVehicle']))
{
	deleteVehicle();
}

//** Handle POST requests for Warning Types Manager **/
else if (isset($_POST['getWarningTypes']))
{
	getWarningTypes();
} else if (isset($_POST['getWarningTypeDetails']))
{
	getWarningTypeDetails();
} else if (isset($_POST['editWarningType']))
{
	editWarningType();
} else if (isset($_POST['deleteWarningType']))
{
	deleteWarningType();
}

//** Handle POST requests for Warrant Types Manager **/
else if (isset($_POST['getWarrantTypes']))
{
	getWarrantTypes();
} else if (isset($_POST['getWarrantTypeDetails']))
{
	getWarrantTypeDetails();
} else if (isset($_POST['editWarrantType']))
{
	editWarrantType();
} else if (isset($_POST['deleteWarrantType']))
{
	deleteWarrantType();
}

//** Handle POST requests for Weapons **/
else if (isset($_POST['getWeapons']))
{
	getWeapons();
} else if (isset($_POST['getWeaponDetails']))
{
	getWeaponDetails();
} else if (isset($_POST['editWeapon']))
{
	editWeapon();
} else if (isset($_POST['deleteWeapon']))
{
	deleteWeapon();
}

/* Handle POST requests for Import/Export/Reset */

else if (isset($_POST['resetData']))
{
	resetData();
}

//** BEGIN Citation Types Manager FUNCTIONS **/

/**#@+
* function getCitationTypes()
* Fetches all Warrant Types from the warrantTypes table with their resepective IDs and
* types. It then builds the table and includes functions such as Edit and Delete
* These functions are handled by editCitationTypes(); and deleteCitationTypes(); 
*
* @since OpenCAD 0.2.6
*
**/
function getCitationTypes()
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

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."citationTypes");
    $resStatus = $stmt->execute();
    $result = $stmt;

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
		echo "<div class=\"alert alert-info\"><span>There are no citation types in the database.</span></div>";
		
	} else {
		echo '
			<table id="allCitationTypes" class="table table-striped table-bordered">
			<thead>
				<tr>
				<th>Citation Description</th>
				<th>Citation Fine (Recommended)</th>
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
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_EDIT_WARNINGTYPE == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editCitationType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editCitationTypeModal" class="btn btn-xs btn-link" >Edit</button>';
			} else {
				echo '<button name="editCitationType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editCitationTypeModal" class="btn btn-xs btn-link" disabled >Edit</button>';
			}

			if ( ( MODERATOR_DELETE_WARNINGTYPE == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="deleteCitationType" type="submit" class="btn btn-xs btn-link" onclick="deleteCitationType(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<input name="deleteCitationType" type="submit" class="btn btn-xs btn-link" onclick="deleteCitationType(' . $row[0] . ')" value="Delete" disabled />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editCitationType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editCitationTypeModal" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteCitationType" type="submit" class="btn btn-xs btn-link" onclick="deleteCitationTypeCode(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="warrantTypeID" type="hidden" value=' . $row[0] . ' />
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
* function getCitationTypeDetails();
* Fetches details for a given edit modal in Warrant Types Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getCitationTypeDetails()
{
	$id = htmlspecialchars($_POST['id']);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."citationTypes WHERE id = ?");
	$resStatus = $stmt->execute(array($id));
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
		$encode["id"] = $row[0];
		$encode["citationDescription"] = $row[1];
		$encode["citationFine"] = $row[2];
	}
	
	echo json_encode($encode);

}

function editCitationType()
{
	$id	        	                = !empty($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
	$citationDescription           = !empty($_POST['citationDescription']) ? htmlspecialchars($_POST['citationDescription']) : '';
	$citationFine  		        = !empty($_POST['citationFine']) ? $_POST['citationFine'] : '';

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."citationTypes SET	citationDescription = ?, citationFine = ? WHERE id = ?");
	if ($stmt->execute(array($citationDescription, $citationFine, $id))) {
		$pdo = null;

		//Let the user know their information was updated
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Citation '.$citation.' with a recommended fine of '.$code_fine.'  edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/citationTypeManager.php");
	} else {
		echo "Error updating record: " . print_r($stmt->errorInfo(), true);
	}
	$pdo = null;
}

/**#@+
* function deleteCitationType()
* Delete a given Warrant Type from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteCitationType()
{
	session_start();
	$id = htmlspecialchars($_POST['citationTypeID']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."citationTypes WHERE id = ?");
	if (!$stmt->execute(array($id)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully removed incident type from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/dataManagement/citationTypeManager.php");
}

//** END Citation Types Manager FUNCTIONS **//

//** BEGIN Departments Manager FUNCTIONS **/

/**#@+
* function getDepartments()
* Fetches all Warrant s from the warrant_s table with their resepective IDs and
* s. It then builds the table and includes functions such as Edit and Delete
* These functions are handled by editDepartments(); and deleteDepartments(); 
*
* @since OpenCAD 0.2.6
*
**/
function getDepartments()
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

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."departments");
	$resStatus = $stmt->execute();
	$result = $stmt;

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
		echo "<div class=\"alert alert-info\"><span>There are no Departments in the database.</span></div>";
		
	} else {
		echo '
			<table id="allDepartments" class="table table-striped table-bordered">
			<thead>
				<tr>                
					<th>Department</th>
					<th>Department Short Name</th>
					<th>Department Long Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
		';

		foreach($result as $row)
		{

			if($row[4] = 1) {
				$deptStatus = "<span style=\"color:red;\">Disabled (1)</span>";
			} else {
				$deptStatus = "<span style=\"color:green; font-weight:bold;\">Enabled (2)</span>";
			}

			echo '
			<tr>
				<td>' . $row[1] . '</td>
				<td>' . $row[2] . '</td>
				<td>' . $row[3] . '</td>

				<td>';
		if ( DEMO_MODE == false) {
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_DATAMAN_DEPARTMENTS== true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editDepartment" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editDepartmentModal" class="btn btn-xs btn-link">Edit</button>';
				echo '<input name="deleteDepartment" type="submit" class="btn btn-xs btn-link" onclick="deleteDepartment(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<button name="editDepartment" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editDepartmentModal" class="btn btn-xs btn-link" disabled >Edit</button>';
				echo '<input name="deleteDepartment" type"submit" class="btn btn-xs btn-link" onclick="deleteDepartment(' . $row[0] . ')" value="Delete" />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editDepartment" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editDepartmentModal" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteDepartment" type="submit" class="btn btn-xs btn-link" onclick="deleteDepartment(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="departmentID" type="hidden" value=' . $row[0] . ' aria-hidden="true" />
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
* function getDepartmentDetails();
* Fetches details for a given edit modal in Warrant s Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getDepartmentDetails()
{
	$departmentID = htmlspecialchars($_POST['departmentID']);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."departments WHERE departmentId = ?");
	$resStatus = $stmt->execute(array($departmentID));
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
		$encode["departmentID"] = $row[0];
		$encode["departmentName"] = $row[1];
		$encode["departmentShortName"] = $row[2];
		$encode["departmentLongName"] = $row[3];
		$encode["departmentEnabled"] = $row[4];

	}
	
	echo json_encode($encode);

}

function editDepartment()
{
	$departmentID				= !empty($_POST['departmentID']) ? htmlspecialchars($_POST['departmentID']) : '';
	$departmentName				= !empty($_POST['departmentName']) ? htmlspecialchars($_POST['departmentName']) : '';
	$departmentShortName		= !empty($_POST['departmentShortName']) ? htmlspecialchars($_POST['departmentShortName']) : '';
	$departmentLongName			= !empty($_POST['departmentLongName']) ? htmlspecialchars($_POST['departmentLongName']) : '';
	$departmentEnabled			= !empty($_POST['departmentEnabled']) ? htmlspecialchars($_POST['departmentEnabled']) : '';

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."departments SET	departmentName = ?, departmentShortName = ?, departmentLongName = ? WHERE departmentId = ?");
	if ($stmt->execute(array($departmentName, $departmentShortName, $departmentLongName, $departmentID))) {
		$pdo = null;

		//Let the user know their information was updated
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Department '.$departmentLongName.' ('.$departmentShortName.')  was  edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/departmentsManager.php");
	} else {
		echo "Error updating record: " . print_r($stmt->errorInfo(), true);
	}
	$pdo = null;
}

/**#@+
* function deleteDepartment()
* Delete a given Warrant  from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteDepartment()
{
	session_start();
	$departmentID = htmlspecialchars($_POST['departmentID']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."departments WHERE departmentId = ?");
	if (!$stmt->execute(array($departmentID)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully removed incident  from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/dataManagement/departmentsManager.php");
}

//** END Departments Manager FUNCTIONS **//

//** BEGIN Incident Type Manager FUNCTIONS **/

/**#@+
* function getIncidentTypes()
* Fetches all Incident Types from the incident_types table with their resepective IDs and
* types. It then builds the table and includes functions such as Edit and Delete
* These functions are handled by editIncidentType(); and deleteIncidnetTypes(); 
*
* @since OpenCAD 0.2.6
*
**/
function getIncidentTypes()
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
	
	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."incidentTypes");
	$resStatus = $stmt->execute();
	$result = $stmt;

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
		echo "<div class=\"alert alert-info\"><span>There are no incident types in the database.</span></div>";
		
	} else {
		echo '
			<table id="allIncidentTypes" class="table table-striped table-bordered">
			<thead>
				<tr>
				<th>Incident ID</th>
				<th>Incident Name</th>
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
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_EDIT_INCIDENTTYPES == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editIncidentType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editIncidentTypeModal" class="btn btn-xs btn-link" >Edit</button>';
			} else {
				echo '<button name="editIncidentType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editIncidentTypeModal" class="btn btn-xs btn-link" disabled >Edit</button>';
			}

			if ( ( MODERATOR_DELETE_INCIDENTTYPES == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="deleteIncidentType" type="submit" class="btn btn-xs btn-link" onclick="deleteIncidentType(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<input name="deleteIncidentType" type="submit" class="btn btn-xs btn-link" onclick="deleteIncidentType(' . $row[0] . ')" value="Delete" disabled />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editIncidentType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editIncidentTypeModal" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteIncidentType" type="submit" class="btn btn-xs btn-link" onclick="deleteIncidentType(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="WeaponID" type="hidden" value=' . $row[0] . ' />
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
* function getIncidentTypeDetails();
* Fetches details for a given edit modal in Weapon Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getIncidentTypeDetails()
{
	$incidentTypeID = htmlspecialchars($_POST['incidentTypeID']);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."incident_types WHERE id = ?");
	$resStatus = $stmt->execute(array($incidentTypeID));
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
		$encode["incidentTypeID"] = $row[0];
		$encode["incident_code"] = $row[1];
		$encode["incident_name"] = $row[2];
	}
	
	echo json_encode($encode);

}

function editIncidentType()
{
	$id	        	    = !empty($_POST['incidentTypeID']) ? htmlspecialchars($_POST['incidentTypeID']) : '';
	$incident_code		= !empty($_POST['incident_code']) ? htmlspecialchars($_POST['incident_code']) : '';
	$incident_name    	= !empty($_POST['incident_name']) ? htmlspecialchars($_POST['incident_name']) : '';


	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."incident_types SET codeId = ?, codeName = ? WHERE id = ?");
	if ($stmt->execute(array($incident_code, $incident_name, $id))) {
		$pdo = null;

		//Let the user know their information was updated
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Incident '.$incident_code.' – '.$incident_name.' edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/incidentTypeManager.php");
	} else {
		echo "Error updating record: " . print_r($stmt->errorInfo(), true);
	}
	$pdo = null;
}

/**#@+
* function deleteIncidentType()
* Delete a given Weapon from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteIncidentType()
{
	session_start();
	$id = htmlspecialchars($_POST['IncidentTypeID']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."incident_types WHERE id = ?");
	if (!$stmt->execute(array($id)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully removed incident type from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/dataManagement/incidentTypeManager.php");
}

//** END Incident Types Manager FUNCTIONS **//

//** BEGIN Radio Codes Manager FUNCTIONS **/

/**#@+
* function getRadioCodes()
* Fetches all Warrant Types from the warrantTypes table with their resepective IDs and
* types. It then builds the table and includes functions such as Edit and Delete
* These functions are handled by editRadioCode(); and deleteRadioCode(); 
*
* @since OpenCAD 0.2.6
*
**/
function getRadioCodes()
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

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."radioCodes");
	$resStatus = $stmt->execute();
	$result = $stmt;

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
		echo "<div class=\"alert alert-info\"><span>There are no radio codes in the database.</span></div>";
		
	} else {
		echo '
			<table id="allRadioCodes" class="table table-striped table-bordered">
			<thead>
				<tr>
				<th>Code</th>
				<th>Code Description</th>
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
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_EDIT_WARNINGTYPE == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editRadioCode" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editRadioCodeModal" class="btn btn-xs btn-link" >Edit</button>';
			} else {
				echo '<button name="editRadioCode" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editRadioCodeModal" class="btn btn-xs btn-link" disabled >Edit</button>';
			}

			if ( ( MODERATOR_DELETE_WARNINGTYPE == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="deleteRadioCode" type="submit" class="btn btn-xs btn-link" onclick="deleteRadioCode(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<input name="deleteRadioCode" type="submit" class="btn btn-xs btn-link" onclick="deleteRadioCode(' . $row[0] . ')" value="Delete" disabled />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editRadioCode" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editRadioCodeModal" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteRadioCode" type="submit" class="btn btn-xs btn-link" onclick="deleteRadioCode(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="warrantTypeID" type="hidden" value=' . $row[0] . ' />
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
* function getRadioCodeDetails();
* Fetches details for a given edit modal in Warrant Types Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getRadioCodeDetails()
{
	$id = htmlspecialchars($_POST['id']);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."radioCodes WHERE id = ?");
	$resStatus = $stmt->execute(array($id));
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
		$encode["id"] = $row[0];
		$encode["code"] = $row[1];
		$encode["codeDescription"] = $row[2];
	}
	
	echo json_encode($encode);

}

function editRadioCode()
{
	$id	        	        = !empty($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
	$code		            = !empty($_POST['code']) ? htmlspecialchars($_POST['code']) : '';
	$codeDescription		= !empty($_POST['codeDescription']) ? htmlspecialchars($_POST['codeDescription']) : '';
	$OnCall		            = !empty($_POST['OnCall']) ? htmlspecialchars($_POST['OnCall']) : '';

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."radioCodes SET codeDescription = ?, code = ? WHERE id = ?");
	if ($stmt->execute(array($codeDescription, $code, $id))) {
		$pdo = null;

		//Let the user know their information was updated
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Code '.$code.' – '.$codeDescription.'  edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/radioCodeManager.php");
	} else {
		echo "Error updating record: " . print_r($stmt->errorInfo(), true);
	}
	$pdo = null;
}

/**#@+
* function deleteRadioCode()
* Delete a given Warrant Type from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteRadioCode()
{
	session_start();
	$id = htmlspecialchars($_POST['warrantTypeID']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."radioCodes WHERE id = ?");
	if (!$stmt->execute(array($id)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully removed incident type from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/dataManagement/warrantTypeManager.php");
}

//** END Radio Codes Manager FUNCTIONS **//

//** BEGIN Streets Manager FUNCTIONS **//
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $pdo->query("SELECT * FROM ".DB_PREFIX."streets");

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
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_EDIT_STREETS == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editStreet" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editStreetModal" class="btn btn-xs btn-link" >Edit</button>';
			} else {
				echo '<button name="editStreet" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editStreetModal" class="btn btn-xs btn-link" disabled >Edit</button>';
			}

			if ( ( MODERATOR_DELETE_STREETS == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="deleteStreet" type="submit" class="btn btn-xs btn-link" onclick="deleteStreet(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<input name="deleteStreet" type="submit" class="btn btn-xs btn-link" onclick="deleteStreet(' . $row[0] . ')" value="Delete" disabled />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editStreet" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editStreetModal" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteStreet" type="submit" class="btn btn-xs btn-link" onclick="deleteStreet(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="streetID" type="hidden" value=' . $row[0] . ' />
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."streets WHERE id = ?");
	$resStatus = $stmt->execute(array($streetID));
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
		$encode["streetID"] = $row[0];
		$encode["name"] = $row[1];
		$encode["county"] = $row[2];
	}
	
	echo json_encode($encode);

}

function editStreet()
{
	$id		    = !empty($_POST['streetID']) ? htmlspecialchars($_POST['streetID']) : '';
	$name 		= !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
	$county 	= !empty($_POST['county']) ? htmlspecialchars($_POST['county']) : '';


	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."streets SET name = ?, county = ? WHERE id = ?");
	if ($stmt->execute(array($name, $county, $id))) {
		$pdo = null;

		//Let the user know their information was updated
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Street '.$name.' in '.$county.' edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/streetManager.php");
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
	$id = htmlspecialchars($_POST['streetID']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."streets WHERE id = ?");
	if (!$stmt->execute(array($id)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully removed street from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/dataManagement/streetManager.php");
}

//** END Streets Manager FUNCTIONS **//

//** BEGIN Vehicle Manager FUNCTIONS **/
/**#@+
* function getVehicles()
* Fetches all vehicles from the streets table with their resepective IDs and
* counties. It then build the table and includes functions such as Edit and Delete
* These functions are handled by editVehcile(); and deleteVehicle(); 
*
* @since OpenCAD 0.2.6
*
**/
function getVehicles()
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

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."vehicles");
    $resStatus = $stmt->execute();
    $result = $stmt;

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
		echo "<div class=\"alert alert-info\"><span>There are no vehicles in the database.</span></div>";
		
	} else {
		echo '
			<table id="allVehicles" class="table table-striped table-bordered">
			<thead>
				<tr>
				<th>Make</th>
				<th>Model</th>
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
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_EDIT_VEHICLES == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editVehicle" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editVehicleModal" class="btn btn-xs btn-link" >Edit</button>';
			} else {
				echo '<button name="editVehicle" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editVehicleModal" class="btn btn-xs btn-link" disabled >Edit</button>';
			}

			if ( ( MODERATOR_DELETE_VEHICLES == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="deleteVehicle" type="submit" class="btn btn-xs btn-link" onclick="deleteVehicle(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<input name="deleteVehicle" type="submit" class="btn btn-xs btn-link" onclick="deleteVehicle(' . $row[0] . ')" value="Delete" disabled />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editVehicle" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editVehicle" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteVehcile" type="submit" class="btn btn-xs btn-link" onclick="deleteVehicle(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="vehicleID" type="hidden" value=' . $row[0] . ' />
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
* function getVehicleDetails();
* Fetches details for a given edit modal in Vehicle Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getVehicleDetails()
{
	$vehicleID = htmlspecialchars($_POST['vehicleID']);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."vehicles WHERE id = ?");
	$resStatus = $stmt->execute(array($vehicleID));
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
		$encode["vehicleID"] = $row[0];
		$encode["make"] = $row[1];
		$encode["model"] = $row[2];
	}
	
	echo json_encode($encode);
}

/**#@+
* function editVehicle()
* Updates the corresponding record for the given vehicle in the database.
*
* @since 0.2.6
*
**/
function editVehicle()
{
	$id		    = !empty($_POST['vehicleID']) ? htmlspecialchars($_POST['vehicleID']) : '';
	$make 		= !empty($_POST['make']) ? htmlspecialchars($_POST['make']) : '';
	$model   	= !empty($_POST['model']) ? htmlspecialchars($_POST['model']) : '';


	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."vehicles SET make = ?, model = ? WHERE id = ?");
	if ($stmt->execute(array($make, $model, $id))) {
		$pdo = null;

		/** Indicate that the vehicle record was updated successfully **/
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Vehicle '.$make.' '.$model.' edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/vehicleManager.php");
	} else {
		echo "Error updating record: " . print_r($stmt->errorInfo(), true);
	}
	$pdo = null;
}

/**#@+
* function deleteVehicle()
* Delete a given vehicle from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteVehicle()
{
	session_start();
	$id         = !empty($_POST['make']) ? htmlspecialchars($_POST['vehicleID']) : '';
	$make 		= !empty($_POST['make']) ? htmlspecialchars($_POST['make']) : '';
	$model   	= !empty($_POST['model']) ? htmlspecialchars($_POST['model']) : '';

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."vehicles WHERE id = ?");
	if (!$stmt->execute(array($id)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = "<div class=\"alert alert-success\"><span>Vehicle ".$_POST['make']." ".$_POST['model']." removed successfully.</div>";
	header("Location: ".BASE_URL."/oc-admin/dataManagement/vehicleManager.php");
}

//** END Vehicle Manager FUNCTIONS **//

//** BEGIN Warning Type Manager FUNCTIONS **/

/**#@+
* function getWarningTypes()
* Fetches all Warning Types from the warningTypes table with their resepective IDs and
* types. It then builds the table and includes functions such as Edit and Delete
* These functions are handled by editWarningType(); and deleteWarningTypes(); 
*
* @since OpenCAD 0.2.6
*
**/
function getWarningTypes()
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

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."warningTypes");
    $resStatus = $stmt->execute();
    $result = $stmt;

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
		echo "<div class=\"alert alert-info\"><span>There are no warning types in the database.</span></div>";
		
	} else {
		echo '
			<table id="allWarningTypes" class="table table-striped table-bordered">
			<thead>
				<tr>
				<th>Warning Description</th>
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
				<td>';
		if ( DEMO_MODE == false) {
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_EDIT_WARNINGTYPE == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editWarningType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWarningTypeModal" class="btn btn-xs btn-link" >Edit</button>';
			} else {
				echo '<button name="editWarningType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWarningypeModal" class="btn btn-xs btn-link" disabled >Edit</button>';
			}
			if ( ( MODERATOR_DELETE_WARNINGTYPE == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="deleteWarningType" type="submit" class="btn btn-xs btn-link" onclick="deleteWarningType(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<input name="deleteWarningType" type="submit" class="btn btn-xs btn-link" onclick="deleteWarningType(' . $row[0] . ')" value="Delete" disabled />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editWarningType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWarningTypeModal" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteWarningType" type="submit" class="btn btn-xs btn-link" onclick="deleteWarningType(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="warningTypeID" type="hidden" value=' . $row[0] . ' />
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
* function getWarningDetails();
* Fetches details for a given edit modal in Warning Types Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getWarningTypeDetails()
{
	$warningTypeID = htmlspecialchars($_POST['warningTypeID']);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."warningTypes WHERE id = ?");
	$resStatus = $stmt->execute(array($warningTypeID));
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
		$encode["warningTypeID"] = $row[0];
		$encode["warningDescription"] = $row[1];
	}
	
	echo json_encode($encode);

}

function editWarningType()
{
	$id						= !empty($_POST['warningTypeID']) ? htmlspecialchars($_POST['warningTypeID']) : '';
	$warningDescription		= !empty($_POST['warningDescription']) ? htmlspecialchars($_POST['warningDescription']) : '';

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."warningTypes SET warningDescription = ? WHERE id = ?");
	if ($stmt->execute(array($warningDescription, $id))) {
		$pdo = null;

		//Let the user know their information was updated
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Incident edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/warningTypeManager.php");
	} else {
		echo "Error updating record: " . print_r($stmt->errorInfo(), true);
	}
	$pdo = null;
}

/**#@+
* function deleteWarningType()
* Delete a given Warning Type from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteWarningType()
{
	session_start();
	$id = htmlspecialchars($_POST['warningTypeID']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."warningTypes WHERE id = ?");
	if (!$stmt->execute(array($id)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully removed incident type from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/dataManagement/warningTypeManager.php");
}

//** END Warning Types Manager FUNCTIONS **//

//** BEGIN Warrant Type Manager FUNCTIONS **/

/**#@+
* function getWarrantTypes()
* Fetches all Warrant Types from the warrantTypes table with their resepective IDs and
* types. It then builds the table and includes functions such as Edit and Delete
* These functions are handled by editWarrantType(); and deleteWarrantType(); 
*
* @since OpenCAD 0.2.6
*
**/
function getWarrantTypes()
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

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."warrantTypes");
    $resStatus = $stmt->execute();
    $result = $stmt;

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
		echo "<div class=\"alert alert-info\"><span>There are no warrant types in the database.</span></div>";
		
	} else {

		echo '
			<table id="allWarrantTypes" class="table table-striped table-bordered">
			<thead>
				<tr>
				<th>Warrant Description</th>
				<th>Violent</th>
				<th>Actions</th>
				</tr>
			</thead>
			<tbody>
		';

		foreach($result as $row)
		{
		if ( $row[1] == '0') 
		{
			$warrantViolent = "Non Violent";
		}
		else {
			$warrantViolent = "Violent";
		}

			echo '
			<tr>
				<td>' . $row[2] . '</td>
				<td>' . $warrantViolent . '</td>
				<td>';
		if ( DEMO_MODE == false) {
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_EDIT_WARRANTTYPES == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editWarrantType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWarrantTypeModal" class="btn btn-xs btn-link" >Edit</button>';
			} else {
				echo '<button name="editWarrantType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWarrantypeModal" class="btn btn-xs btn-link" disabled >Edit</button>';
			}

			if ( ( MODERATOR_DELETE_WARRANTTYPES == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="deleteWarrantType" type="submit" class="btn btn-xs btn-link" onclick="deleteWarrantType(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<input name="deleteWarrantType" type="submit" class="btn btn-xs btn-link" onclick="deleteWarrantType(' . $row[0] . ')" value="Delete" disabled />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editWarrantType" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWarrantTypeModal" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteWarrantType" type="submit" class="btn btn-xs btn-link" onclick="deleteWarrantType(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="warrantTypeID" type="hidden" value=' . $row[0] . ' />
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
* function getWarrantTypeDetails();
* Fetches details for a given edit modal in Warrant Types Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getWarrantTypeDetails()
{
	$warrantTypeID = htmlspecialchars($_POST['warrantTypeID']);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."warrantTypes WHERE id = ?");
	$resStatus = $stmt->execute(array($warrantTypeID));
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
		$encode["warrantTypeID"] = $row[0];
		$encode["warrantDescription"] = $row[1];
	}
	
	echo json_encode($encode);

}

function editWarrantType()
{
	$id						= !empty($_POST['warrantTypeID']) ? htmlspecialchars($_POST['warrantTypeID']) : '';
	$warrantDescription		= !empty($_POST['warrantDescription']) ? htmlspecialchars($_POST['warrantDescription']) : '';

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."warrantTypes SET warrantDescription = ? WHERE id = ?");
	if ($stmt->execute(array($warrantDescription, $id))) {
		$pdo = null;

		//Let the user know their information was updated
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Warrant type "'.$warrantDescription.'" edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/warrantTypeManager.php");
	} else {
		echo "Error updating record: " . print_r($stmt->errorInfo(), true);
	}
	$pdo = null;
}

/**#@+
* function deleteWarrantType()
* Delete a given Warrant Type from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteWarrantType()
{
	session_start();
	$id = htmlspecialchars($_POST['warrantTypeID']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."warrantTypes WHERE id = ?");
	if (!$stmt->execute(array($id)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully removed warrant type from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/dataManagement/warrantTypeManager.php");
}

//** END Warrant Types Manager FUNCTIONS **//

//** BEGIN Weapon Manager FUNCTIONS **/

/**#@+
* function getWeapons()
* Fetches all Weapons from the weapons table with their resepective IDs and
* types. It then builds the table and includes functions such as Edit and Delete
* These functions are handled by editWeapon(); and deleteWeapon(); 
*
* @since OpenCAD 0.2.6
*
**/
function getWeapons()
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

	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."weapons");
	$resStatus = $stmt->execute();
	$result = $stmt;

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
		echo "<div class=\"alert alert-info\"><span>There are no weapons in the database.</span></div>";
		
	} else {
		echo '
			<table id="allWeapons" class="table table-striped table-bordered">
			<thead>
				<tr>
				<th>Weapon Type</th>
				<th>Weapon Name</th>
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
			echo '<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">';
			if ( ( MODERATOR_EDIT_WEAPONS == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<button name="editWeapon" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWeaponModal" class="btn btn-xs btn-link" >Edit</button>';
			} else {
				echo '<button name="editWeapon" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWeaponModal" class="btn btn-xs btn-link" disabled >Edit</button>';
			}

			if ( ( MODERATOR_DELETE_WEAPONS == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
			{
				echo '<input name="deleteWeapon" type="submit" class="btn btn-xs btn-link" onclick="deleteWeapon(' . $row[0] . ')" value="Delete" />';
			} else {
				echo '<input name="deleteWeapon" type="submit" class="btn btn-xs btn-link" onclick="deleteWeapon(' . $row[0] . ')" value="Delete" disabled />';
			}
		} else {
			echo ' </td>
				<td>
				<form action="'.BASE_URL.'/oc-includes/dataActions.php" method="post">
				<button name="editWeapon" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editWeaponModal" class="btn btn-xs btn-link" disabled >Edit</button>
				<input name="deleteWeapon" type="submit" class="btn btn-xs btn-link" onclick="deleteWeapon(' . $row[0] . ')" value="Delete" disabled />
				';
			}
		
		echo '<input name="WeaponID" type="hidden" value=' . $row[0] . ' />
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
* function getWeaponDetails();
* Fetches details for a given edit modal in Weapon Manager.
*
* @since OpenCAD 0.2.6
*
**/
function getWeaponDetails()
{
	$weaponID = htmlspecialchars($_POST['weaponID']);
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	$stmt = $pdo->prepare("SELECT * FROM ".DB_PREFIX."weapons WHERE id = ?");
	$resStatus = $stmt->execute(array($weaponID));
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
		$encode["weaponID"] = $row[0];
		$encode["weaponType"] = $row[1];
		$encode["weaponName"] = $row[2];
	}
	
	echo json_encode($encode);
}

function editWeapon()
{
	$id	        	    = !empty($_POST['weaponID']) ? htmlspecialchars($_POST['weaponID']) : '';
	$weaponType 		= !empty($_POST['weaponType']) ? htmlspecialchars($_POST['weaponType']) : '';
	$weaponName     	= !empty($_POST['weaponName']) ? htmlspecialchars($_POST['weaponName']) : '';
	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	$stmt = $pdo->prepare("UPDATE ".DB_PREFIX."weapons SET weaponName = ?, weaponType = ? WHERE id = ?");
	if ($stmt->execute(array($weaponName, $weaponType, $id))) {
		$pdo = null;
		//Let the user know their information was updated
		$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Weapon '.$weaponName.' '.$weaponType.' edited successfully.</span></div>';
		header("Location: ".BASE_URL."/oc-admin/dataManagement/weaponManager.php");
	} else {
		echo "Error updating record: " . print_r($stmt->errorInfo(), true);
	}
	$pdo = null;
}

/**#@+
* function deleteWeapon()
* Delete a given Weapon from the database.
*
* @since OpenCAD 0.2.6
*
**/
function deleteWeapon()
{
	session_start();
	$id = htmlspecialchars($_POST['WeaponID']);

	try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$stmt = $pdo->prepare("DELETE FROM ".DB_PREFIX."weapons WHERE id = ?");
	if (!$stmt->execute(array($id)))
	{
		$_SESSION['error'] = $stmt->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully removed weapon from database</span></div>';
	header("Location: ".BASE_URL."/oc-admin/dataManagement/weaponManager.php");
}

//** END Weapon Manager FUNCTIONS **//


//** BEGIN Data Import/Export/Reset FUNCTIONS **//

/**#@+
* function resetData();
*
* Accepts "dataType" from "Reset Data" and purges table based on input or  
* if "allData" is passed then it will purge ALL user game specific data.
*
* This s function does not purge the users table or reset any administrative
* permissions.
* 
* @since OpenCAD 0.2.6
*
**/
function resetData()
{
	$dataType 	=   !empty($_POST['dataType']) ? $_POST['dataType'] : '';

	try{
		$pdo    =   new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	if ($_POST == "allData") 
	{
		$tables = array(
				"userDepartments",
				"userdepartmentsTemp",
				"activeUsers",
				"aop",
				"bolosPersons",
				"bolosVehicles",
				"calls",
				"callsUsers",
				"callHistory",
				"callList",
				"callCitations",
				"civilianNames",
				"colors",
				"departments",
				"dispatchers",
				"incident_types",
				"ncicArrests",
				"ncic_citations",
				"ncicNames",
				"ncicPlates",
				"ncicWarnings",
				"ncicWarrants",
				"ncicWeapons",
				"statuses",
				"streets",
				"tones",
				"vehicles",
				"weapons",
				"radioCdoes",
				"warningTypes",
				"warrantTypes",
				"citationTypes"
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
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$pdo = null;

	session_start();
	$_SESSION['successMessage'] = '<div class="alert alert-success"><span>Successfully reset the '.strtoupper($dataType).' table.</span></div>';
	header("Location: ".BASE_URL."/oc-admin/admin.php");
}
//** END Data Import/Export/Reset FUNCTIONS **//
?>