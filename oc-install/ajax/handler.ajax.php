<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  ApPHP EasyInstaller Free version                                           #
##  Developed by:  ApPHP <info@apphp.com>                                      #
##  License:       GNU LGPL v.3                                                #
##  Site:          http://www.apphp.com/php-easyinstaller/                     #
##  Copyright:     ApPHP EasyInstaller (c) 2009-2013. All rights reserved.     #
##                                                                             #
################################################################################

	session_start();

    require_once('../include/settings.inc.php');
	require_once('../include/database.class.php'); 
    require_once('../include/functions.inc.php');
	require_once('../include/languages.inc.php');	

	$check_key = isset($_POST['check_key']) ? prepare_input($_POST['check_key']) : '';
	$database_host = isset($_POST['db_host']) ? prepare_input($_POST['db_host']) : '';
	$database_name = isset($_POST['db_name']) ? prepare_input($_POST['db_name']) : '';
	$database_username = isset($_POST['db_username']) ? prepare_input($_POST['db_username']) : '';
	$database_password = isset($_POST['db_password']) ? prepare_input($_POST['db_password']) : '';
	
    $arr = array();

	$arr[] = '"status": "0"';
	$arr[] = '"db_connection_status": "0"';
	$arr[] = '"db_version": ""';
	$arr[] = '"db_error": ""';

	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
	header('Pragma: no-cache'); // HTTP/1.0
	header('Content-Type: application/json');		
	
    if($check_key == 'apphpei'){
		
        $arr[] = '"status": "1"';

		$error = false;
		if(EI_MODE == 'demo'){
			if($database_host == 'localhost' && $database_name == 'db_name' && $database_username == 'test' && $database_password == 'test'){
				$error = true;
				$arr[] = '"db_connection_status": "1"';
				$arr[] = '"db_version": "test"';
			}else{
				$error = true;
				$arr[] = '"db_error": "'.lang_key('alert_wrong_testing_parameters').'"'; 
			}
		}else{
			if(empty($database_host)){
				$error = true;
				$arr[] = '"db_error": "'.lang_key('alert_db_host_empty').'"'; 
			}else if(empty($database_name)){
				$error = true;
				$arr[] = '"db_error": "'.lang_key('alert_db_name_empty').'"'; 
			}else if(empty($database_username)){
				$error = true;
				$arr[] = '"db_error": "'.lang_key('alert_db_username_empty').'"'; 
			}				
		}

		if(!$error){
			$db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE, false, true);
			if($db->Open()){
				if(EI_CHECK_DB_MINIMUM_VERSION && (version_compare($db->GetVersion(), EI_DB_MINIMUM_VERSION, '<'))){
					$alert_min_version_db = lang_key('alert_min_version_db');
					$alert_min_version_db = str_replace('_DB_VERSION_', '<b>'.EI_DB_MINIMUM_VERSION.'</b>', $alert_min_version_db);
					$alert_min_version_db = str_replace('_DB_CURR_VERSION_', '<b>'.$db->GetVersion().'</b>', $alert_min_version_db);
					$alert_min_version_db = str_replace('_DB_', '<b>'.$db->GetDbDriver().'</b>', $alert_min_version_db);
					$arr[] = '"db_version": "'.EI_DATABASE_TYPE.' '.$db->GetVersion().'"';
					$arr[] = '"db_error": "'.$alert_min_version_db.'"';									
				}else{
					$arr[] = '"db_connection_status": "1"';
					$arr[] = '"db_version": "'.EI_DATABASE_TYPE.' '.$db->GetVersion().'"';
				}
			}else{
				$error_text = $db->Error();
				$error_text = str_replace(array('"', "'"), '', $error_text);
				$error_text = str_replace(array("\n", "\t"), ' ', $error_text);
				$arr[] = '"db_error": "'.$error_text.'"';
			}			
		}
    }else{
		// wrong parameters passed!
        $arr[] = '"status": "0"';
    }
    
	echo '{';
	echo implode(',', $arr);
	echo '}';

