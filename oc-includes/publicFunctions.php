<?php

if (isset($_GET['getAgencies']))
{
	getAgencies();
}
else if (isset($_GET['getLicenseStatuses']))
{
	getLicenseStatusesa();
}
else if (isset($_GET['getLicenseTypes']))
{
	getLicenseTypes();
}
else if (isset($_GET['getLicenseClasses']))
{
	getLicenseClassses();
}
else if (isset($_GET['getLicenseIssuers']))
{
	getLicenseIssuers();
}
else if (isset($_GET['getGenders']))
{
	getGenders();
}
else if (isset($_GET['getRaces']))
{
	getRaces();
}
else if (isset($_GET['getData2']))
{
	getData2();
}
else if (isset($_GET['getData3']))
{
	getData3();
} else if (isset($_GET['getDataSetTable']))
{
	getDataSetTable();
}


function getAgencies()
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

	$result = $pdo->query("SELECT departmentId, departmentName, departmentLongName from ".DB_PREFIX."departments");
	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	foreach ($result as $row)
	{
			echo '<option value="' . $row['departmentId'] . '">' . $row['departmentLongName'] . '</option>';
	}
	$pdo = null;
}

function getAgenciesWarrants()
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

	$result = $pdo->query("SELECT departmentId, departmentName from ".DB_PREFIX."departments ".WHERE." departmentId != 1 AND departmentId != 7 AND departmentId != 8 AND departmentId != 9");
	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	foreach ($result as $row)
	{
			echo '<option value="' . $row['departmentId'] . '">' . $row['departmentName'] . '</option>';
	}
	$pdo = null;
}
/**#@+
* function getLicenseStatuses()
* Get list of possible license statuses from status() of the 'dlStatus' column of the ncicNames table.
*
* @since 0.2.6
*
**/
function getLicenseStatuses()
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

	$query = "SHOW COLUMNS FROM ".DB_PREFIX."ncicNames LIKE 'dlStatus'";
	$stmt = $pdo->prepare( $query );
	if (!$stmt)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $stmt -> execute();
	if ($result)
	{
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$dl_statuses = implode($row);
		
		// Remove "set(" at start and ");" at end.
		$dl_statuses  = substr($dl_statuses,14,strlen($dl_statuses)-29);
		$dl_statuses = preg_split("/','/",$dl_statuses);
	
		foreach ($dl_statuses as $key=>$value) 
		{
			echo "<option name = '$value' value = '$value'>$value</option>\n";
		}
	}
}

/**#@+
* function getLicenseType()
* Get list of possible license types from status() of the 'dlType' column of the ncicNames table.
*
* @since 0.2.6
*
**/
function getLicenseTypes()
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

	$query = "SHOW COLUMNS FROM ".DB_PREFIX."ncicNames LIKE 'dlType'";
	$stmt = $pdo->prepare( $query );
	if (!$stmt)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $stmt -> execute();
	if ($result) 
	{
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$dl_types = implode($row);

		// Remove "set(" at start and ");" at end.
		$dl_types  = substr($dl_types,12,strlen($dl_types)-27);
		//echo $dl_types;
		$dl_types = preg_split("/','/",$dl_types);

		foreach ($dl_types as $key=>$value)
		{
			echo "<option name = '$value' value = '$value'>$value</option>\n";
		}
	}
}

function getLicenseClasses()
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

	$query = "SHOW COLUMNS FROM ".DB_PREFIX."ncicNames LIKE 'dlClass'";
	$stmt = $pdo->prepare( $query );
	if (!$stmt)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $stmt -> execute();
	if ($result) 
	{
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$dl_classes = implode($row);

		// Remove "set(" at start and ");" at end.
		$dl_classes  = substr($dl_classes,13,strlen($dl_classes)-32);
		//echo $dl_classes;
		$dl_classes = preg_split("/','/",$dl_classes);

		foreach ($dl_classes as $key=>$value)
		{
			echo "<option name = '$value' value = '$value'>$value</option>\n";
		}
	}
}

/**#@+
* function getLicenseIssuers()
* Description of function
*
* @since version
*
**/
function getLicenseIssuers()
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

	$query = "SHOW COLUMNS FROM ".DB_PREFIX."ncicNames LIKE 'dlIssuer'";
	$stmt = $pdo->prepare( $query );
	if (!$stmt)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $stmt -> execute();
	if ($result) 
	{
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$dl_issuers = implode($row);
		// Remove "set(" at start and ");" at end.
		$dl_issuers  = substr($dl_issuers,17,strlen($dl_issuers)-36);
		$dl_issuers = preg_split("/','/",$dl_issuers);

		foreach ($dl_issuers as $key=>$value)
		{
			echo "<option name = '$value' value = '$value'>$value</option>\n";
		}
	}
}



/**#@+
* function getLicenseIssuers()
* Description of function
*
* @since version
*
**/
function getPlateRegisrars()
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

	$query = "SHOW COLUMNS FROM ".DB_PREFIX."ncicPlates LIKE 'vehRegState'";
	$stmt = $pdo->prepare( $query );
	if (!$stmt)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $stmt -> execute();
	if ($result) 
	{
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$dl_issuers = implode($row);
		// Remove "set(" at start and ");" at end.
		$dl_issuers  = substr($dl_issuers,17,strlen($dl_issuers)-36);
		$dl_issuers = preg_split("/','/",$dl_issuers);

		foreach ($dl_issuers as $key=>$value)
		{
			echo "<option name = '$value' value = '$value'>$value</option>\n";
		}
	}
}

/**#@+
* function getGenders()
* Get list of possible genders from set() of the 'gender' column of the ncicNames table.
*
* @since 0.2.6
*
**/
function getGenders()
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

	$query = "SHOW COLUMNS FROM ".DB_PREFIX."ncicNames LIKE 'gender'";
	$stmt = $pdo->prepare( $query );
	if (!$stmt)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $stmt -> execute();
	if ($result) 
	{
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$genders = implode($row);
	
		// Remove "set(" at start and ");" at end.
		$genders  = substr($genders,11,strlen($genders)-16);
		$genders = preg_split("/','/",$genders);
	
		foreach ($genders as $key=>$value)
		{
			echo "<option name = '$value' value = '$value'>$value</option>\n";
		}
	}
}

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

	$result = $pdo->query("SELECT id, codeId, codeName from ".DB_PREFIX."incidentTypes");
	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$races  = substr($races,14,strlen($races)-18);
	$races = preg_split("/','/",$races);

	foreach ($result as $row)
	{
			echo '<option value="' . $row['id'] . '">'. $row['codeId'] .' &#8212; '.$row['codeName'] . '</option>\n';
	}
	$pdo = null;
}

/**#@+
* function getRaces()
* Get list of possible Races from the  'race' column of the ncicNames table.
*
* @since 0.3.0
*
**/
function getRaces()
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

	$query = "SHOW COLUMNS FROM ".DB_PREFIX."ncicNames LIKE 'race'";
	$stmt = $pdo->prepare( $query );
	if (!$stmt)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $stmt -> execute();
	if ($result) 
	{
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$genders = implode($row);
	
		// Remove "set(" at start and ");" at end.
		$genders  = substr($genders,9,strlen($genders)-14);
		$genders = preg_split("/','/",$genders);
	
		foreach ($genders as $key=>$value)
		{
			echo "<option name = '$value' value = '$value'>$value</option>\n";
		}
	}
}

function getData2($tableName, $column1, $column2) 
{
	if(!(isset($_POST[$column1])))
		$column1 = 0;
	if(!(isset($_POST[$column2])))
		$column2 = 0;

	 try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $pdo->query("SELECT $column1, $column2 from ".DB_PREFIX.$tableName);
	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}
	foreach ($result as $row)
	{
			echo '<tr>';
			echo '<td>' . $row[$column1] . '</td>';
			echo '<td>' . $row[$column2] . '</td>';
			echo '</tr>';
	}
	$pdo = null;
}

function getData3($tableName, $column1, $column2, $column3) 
{
	if(!(isset($_POST[$column1])))
		$column1 = 1;
	if(!(isset($_POST[$column2])))
		$column2 = 2;
	if(!(isset($_POST[$column3])))
		$column = 3;

	 try{
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	} catch(PDOException $ex)
	{
		$_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
		$_SESSION['error_blob'] = $ex;
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$result = $pdo->query("SELECT $column1, $column2, $column3 from ".DB_PREFIX.$tableName);
	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/oc-content/plugins/error/index.php');
		die();
	}

	$num_rows = $result->rowCount();
	$pdo = null;
	foreach ($result as $row)
	{
			echo '<tr>';
			echo '<td>' . $row[$column1] . '</td>';
			echo '<td>' . $row[$column2] . '</td>';
			echo '<td>' . $row[$column3] . '</td>';
			echo '</tr>';
	}
	$pdo = null;
}


/**#@+
* function getDataSetTable()
* Get values from a given table column as select options
*
* @since 0.3.1
*
**/
function getDataSetTable($dataSet, $column1, $column2, $leadTrim, $followTrim, $modeIs)
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

	$result = $pdo->query("SELECT * from ".DB_PREFIX.$dataSet);
	if (!$result)
	{
		$_SESSION['error'] = $pdo->errorInfo();
		header('Location: '.BASE_URL.'/plugins/error/index.php');
		die();
	}

	$dataSet  = substr($dataSet,$leadTrim,strlen($dataSet)-$followTrim);
	$dataSet = preg_split("/','/",$dataSet);

	foreach ($result as $row)
	{


		if( empty($modeIs) )
		{
			echo '
					<option value="'. $row["$column2"] . '">'. $row[$column1] .'</option>
				';
		}
		else if ( $modeIs == "registration" )
		{
			echo '
					<option value="'. $row["departmentId"] . '">'. $row["departmentLongName"] .'</option>
			';
		}
		else if ( $modeIs == "userGroupEditor" )
		{
			echo '<option value="'. $row["departmentId"] . '">' . $row["departmentShortName"] . ' | '. $row["departmentLongName"] .'</option>
			';
		}
		else if ( $modeIs == "vehicle" )
		{
			echo '
					<option value="'. $row["departmentId"] .' ' . $row[$column2] . '">'. $row[$column1] .' '.$row[$column2] . '</option>
				';
		} else {
			echo '
					<option value="'. $row["departmentId"] .' | ' . $row[$column2] . '">'. $row[$column1] .' | '.$row[$column2] . '</option>
				';
		}
	}
	$pdo = null;
}
?>