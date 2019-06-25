<?php

	session_start();

	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');
	require_once('include/database.class.php'); 
    require_once('include/functions.inc.php');	
	require_once('include/languages.inc.php');	
    
	$passed_step = isset($_SESSION['passed_step']) ? (int)$_SESSION['passed_step'] : 0;

	// handle previous steps
	// -------------------------------------------------
	if($passed_step >= 10){
		// OK
	}else{
		header('location: start.php');
		exit;				
	}
	
	if(EI_MODE == 'debug') error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    
	$completed = false;
	$error_mg  = array();
		
	if($passed_step == 10){
		
		$database_host						= isset($_SESSION['database_host']) ? prepare_input($_SESSION['database_host']) : '';
		$database_name						= isset($_SESSION['database_name']) ? prepare_input($_SESSION['database_name']) : '';
		$database_username					= isset($_SESSION['database_username']) ? prepare_input($_SESSION['database_username']) : '';
		$database_password					= isset($_SESSION['database_password']) ? prepare_input($_SESSION['database_password']) : '';
		$database_prefix					= isset($_SESSION['database_prefix']) ? prepare_input($_SESSION['database_prefix']) : '';
		$install_type						= isset($_SESSION['install_type']) ? $_SESSION['install_type'] : 'create';
		
		$admin_name							= isset($_SESSION['admin_name']) ? stripslashes($_SESSION['admin_name']) : '';
		$admin_identifier					= isset($_SESSION['admin_identifier']) ? stripslashes($_SESSION['admin_identifier']) : '';
		$admin_password						= isset($_SESSION['admin_password']) ? stripslashes($_SESSION['admin_password']) : '';
		$admin_email 						= isset($_SESSION['admin_email']) ? stripslashes($_SESSION['admin_email']) : '';
		$password_encryption 				= isset($_SESSION['password_encryption']) ? $_SESSION['password_encryption'] : EI_PASSWORD_ENCRYPTION_TYPE;
		
	    $COMMUNITY_NAME						= isset($_SESSION['COMMUNITY_NAME']) ? prepare_input($_SESSION['COMMUNITY_NAME']) : '';
		
		$BASE_URL							= isset($_SESSION['BASE_URL']) ? prepare_input($_SESSION['BASE_URL']) : '';
		
		$API_SECURITY						= isset($_SESSION['API_SECURITY']) ? prepare_input($_SESSION['API_SECURITY']) : '';

		$CAD_FROM_EMAIL						= isset($_SESSION['CAD_FROM_EMAIL']) ? prepare_input($_SESSION['CAD_FROM_EMAIL']) : '';
		$CAD_TO_EMAIL						= isset($_SESSION['CAD_TO_EMAIL']) ? prepare_input($_SESSION['CAD_TO_EMAIL']) : '';
		
		$AUTH_KEY							= isset($_SESSION['AUTH_KEY']) ? prepare_input($_SESSION['AUTH_KEY']) : '';
		$SECURE_AUTH_KEY					= isset($_SESSION['SECURE_AUTH_KEY']) ? prepare_input($_SESSION['SECURE_AUTH_KEY']) : '';
		$LOGGED_IN_KEY						= isset($_SESSION['LOGGED_IN_KEY']) ? prepare_input($_SESSION['LOGGED_IN_KEY']) : '';
		$NONCE_KEY							= isset($_SESSION['NONCE_KEY']) ? prepare_input($_SESSION['NONCE_KEY']) : '';
		$AUTH_SALT							= isset($_SESSION['AUTH_SALT']) ? prepare_input($_SESSION['AUTH_SALT']) : '';
		$SECURE_AUTH_SALT					= isset($_SESSION['SECURE_AUTH_SALT']) ? prepare_input($_SESSION['SECURE_AUTH_SALT']) : '';
		$LOGGED_IN_SALT						= isset($_SESSION['LOGGED_IN_SALT']) ? prepare_input($_SESSION['LOGGED_IN_SALT']) : '';
		$NONCE_SALT							= isset($_SESSION['NONCE_SALT']) ? prepare_input($_SESSION['NONCE_SALT']) : '';
		
		$POLICE_NCIC						= isset($_SESSION['POLICE_NCIC']) ? prepare_input($_SESSION['POLICE_NCIC']) : '';
		$POLICE_CALL_SELFASSIGN				= isset($_SESSION['POLICE_CALL_SELFASSIGN']) ? prepare_input($_SESSION['POLICE_CALL_SELFASSIGN']) : '';

		$FIRE_PANIC							= isset($_SESSION['FIRE_PANIC']) ? prepare_input($_SESSION['FIRE_PANIC']) : '';
		$FIRE_BOLO							= isset($_SESSION['FIRE_BOLO']) ? prepare_input($_SESSION['FIRE_BOLO']) : '';
		$FIRE_NCIC_NAME						= isset($_SESSION['FIRE_NCIC_NAME']) ? prepare_input($_SESSION['FIRE_NCIC_NAME']) : '';
		$FIRE_NCIC_PLATE					= isset($_SESSION['FIRE_NCIC_PLATE']) ? prepare_input($_SESSION['FIRE_NCIC_PLATE']) : '';
		$FIRE_CALL_SELFASSIGN				= isset($_SESSION['FIRE_CALL_SELFASSIGN']) ? prepare_input($_SESSION['FIRE_CALL_SELFASSIGN']) : '';
		
		$EMS_PANIC							= isset($_SESSION['EMS_PANIC']) ? prepare_input($_SESSION['EMS_PANIC']) : '';
		$EMS_BOLO							= isset($_SESSION['EMS_BOLO']) ? prepare_input($_SESSION['EMS_BOLO']) : '';
		$EMS_NCIC_NAME						= isset($_SESSION['EMS_NCIC_NAME']) ? prepare_input($_SESSION['EMS_NCIC_NAME']) : '';
		$EMS_NCIC_PLATE						= isset($_SESSION['EMS_NCIC_PLATE']) ? prepare_input($_SESSION['EMS_NCIC_PLATE']) : '';
		$EMS_CALL_SELFASSIGN				= isset($_SESSION['EMS_CALL_SELFASSIGN']) ? prepare_input($_SESSION['EMS_CALL_SELFASSIGN']) : '';
		
		$ROADSIDE_PANIC						= isset($_SESSION['ROADSIDE_PANIC']) ? prepare_input($_SESSION['ROADSIDE_PANIC']) : '';
		$ROADSIDE_BOLO						= isset($_SESSION['ROADSIDE_BOLO']) ? prepare_input($_SESSION['ROADSIDE_BOLO']) : '';
		$ROADSIDE_NCIC_NAME					= isset($_SESSION['ROADSIDE_NCIC_NAME']) ? prepare_input($_SESSION['ROADSIDE_NCIC_NAME']) : '';
		$ROADSIDE_NCIC_PLATE				= isset($_SESSION['ROADSIDE_NCIC_PLATE']) ? prepare_input($_SESSION['ROADSIDE_NCIC_PLATE']) : '';
		$ROADSIDE_CALL_SELFASSIGN			= isset($_SESSION['ROADSIDE_CALL_SELFASSIGN']) ? prepare_input($_SESSION['ROADSIDE_CALL_SELFASSIGN']) : '';
		
		$CIV_WARRANT						= isset($_SESSION['CIV_WARRANT']) ? prepare_input($_SESSION['CIV_WARRANT']) : '';
		$CIV_REG							= isset($_SESSION['CIV_REG']) ? prepare_input($_SESSION['CIV_REG']) : '';
		$CIV_LIMIT_MAX_IDENTITIES			= isset($_SESSION['CIV_LIMIT_MAX_IDENTITIES']) ? prepare_input($_SESSION['CIV_LIMIT_MAX_IDENTITIES']) : '';
		$CIV_LIMIT_MAX_VEHICLES				= isset($_SESSION['CIV_LIMIT_MAX_VEHICLES']) ? prepare_input($_SESSION['CIV_LIMIT_MAX_VEHICLES']) : '';
		$CIV_LIMIT_MAX_WEAPONS				= isset($_SESSION['CIV_LIMIT_MAX_WEAPONS']) ? prepare_input($_SESSION['CIV_LIMIT_MAX_WEAPONS']) : '';

		$MODERATOR_APPROVE_USER				= isset($_SESSION['MODERATOR_APPROVE_USER']) ? prepare_input($_SESSION['MODERATOR_APPROVE_USER']) : '';
		$MODERATOR_EDIT_USER				= isset($_SESSION['MODERATOR_EDIT_USER']) ? prepare_input($_SESSION['MODERATOR_EDIT_USER']) : '';
		$MODERATOR_SUSPEND_WITH_REASON		= isset($_SESSION['MODERATOR_SUSPEND_WITH_REASON']) ? prepare_input($_SESSION['MODERATOR_SUSPEND_WITH_REASON']) : '';
		$MODERATOR_SUSPEND_WITHOUT_REASON	= isset($_SESSION['MODERATOR_SUSPEND_WITHOUT_REASON']) ? prepare_input($_SESSION['MODERATOR_SUSPEND_WITHOUT_REASON']) : '';
	$MODERATOR_REACTIVATE_USER				= isset($_SESSION['MODERATOR_REACTIVATE_USER']) ? prepare_input($_SESSION['MODERATOR_REACTIVATE_USER']) : '';
		$MODERATOR_REMOVE_GROUP 			= isset($_SESSION['MODERATOR_REMOVE_GROUP']) ? prepare_input($_SESSION['MODERATOR_REMOVE_GROUP']) : '';
		$MODERATOR_DELETE_USER 				= isset($_SESSION['MODERATOR_DELETE_USER']) ? prepare_input($_SESSION['MODERATOR_DELETE_USER']) : '';
		$MODERATOR_NCIC_EDITOR 				= isset($_SESSION['MODERATOR_NCIC_EDITOR']) ? prepare_input($_SESSION['MODERATOR_NCIC_EDITOR']) : '';
		
		$MODERATOR_DATA_MANAGER				= isset($_SESSION['MODERATOR_DATA_MANAGER']) ? prepare_input($_SESSION['MODERATOR_DATA_MANAGER']) : '';
		$MODERATOR_DATAMAN_CITATIONTYPES	= isset($_SESSION['MODERATOR_DATAMAN_CITATIONTYPES']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_CITATIONTYPES']) : '';
		$MODERATOR_DATAMAN_DEPARTMENTS		= isset($_SESSION['MODERATOR_DATAMAN_DEPARTMENTS']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_DEPARTMENTS']) : '';
		$MODERATOR_DATAMAN_INCIDENTTYPES	= isset($_SESSION['MODERATOR_DATAMAN_INCIDENTTYPES']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_INCIDENTTYPES']) : '';
		$MODERATOR_DATAMAN_RADIOCODES		= isset($_SESSION['MODERATOR_DATAMAN_RADIOCODES']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_RADIOCODES']) : '';
		$MODERATOR_DATAMAN_STREETS			= isset($_SESSION['MODERATOR_DATAMAN_STREETS']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_STREETS']) : '';		
		$MODERATOR_DATAMAN_VEHICLES			= isset($_SESSION['MODERATOR_DATAMAN_VEHICLES']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_VEHICLES']) : '';
		$MODERATOR_DATAMAN_WARNINGTYPES		= isset($_SESSION['MODERATOR_DATAMAN_WARNINGTYPES']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_WARNINGTYPES']) : '';	
		$MODERATOR_DATAMAN_WARRANTTYPES		= isset($_SESSION['MODERATOR_DATAMAN_WARRANTTYPES']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_WARRANTTYPES']) : '';
		$MODERATOR_DATAMAN_WEAPONS			= isset($_SESSION['MODERATOR_DATAMAN_WEAPONS']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_WEAPONS']) : '';
		$MODERATOR_DATAMAN_IMPEXPRESET		= isset($_SESSION['MODERATOR_DATAMAN_IMPEXPRESET']) ? prepare_input($_SESSION['MODERATOR_DATAMAN_IMPEXPRESET']) : '';

		$DEMO_MODE							= isset($_SESSION['DEMO_MODE']) ? prepare_input($_SESSION['DEMO_MODE']) : '';

		$USE_GRAVATAR						= isset($_SESSION['USE_GRAVATAR']) ? prepare_input($_SESSION['USE_GRAVATAR']) : '';
		
		if($install_type == 'update'){
			$sql_dump_file = EI_SQL_DUMP_FILE_UPDATE;
		}else if($install_type == 'un-install'){
			$sql_dump_file = EI_SQL_DUMP_FILE_UN_INSTALL;
		}else{
			$sql_dump_file = EI_SQL_DUMP_FILE_CREATE;
		}		
						
		if(empty($database_host)) $error_mg[] = lang_key('alert_database_host_empty');	
		if(empty($database_name)) $error_mg[] = lang_key('alert_database_name_empty'); 
		if(empty($database_username)) $error_mg[] = lang_key('alert_database_usernamename_empty'); 	
		if (empty($database_password)) $error_mg[] = lang_key('alert_database_password_empty');
		if (empty($database_prefix)) $error_mg[] = lang_key('alert_database_prefix_empty');

		if(empty($error_mg)){		
			if(EI_MODE == 'demo'){
				if($database_host == 'localhost' && $database_name == 'database_name' && $database_username == 'test' && $database_password == 'test'){
					$completed = true; 
				}else{
					$error_mg[] = lang_key('alert_wrong_testing_parameters');
				}
			}else{				
				$db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE, false, true);
				if(EI_DATABASE_CREATE && ($install_type == 'create') && !$db->Create()){
					$error_mg[] = $db->Error();					
				}else if($db->Open()){
					if(EI_CHECK_DB_MINIMUM_VERSION && (version_compare($db->GetVersion(), EI_DB_MINIMUM_VERSION, '<'))){
						$alert_min_version_db = lang_key('alert_min_version_db');
						$alert_min_version_db = str_replace('_DB_VERSION_', '<b>'.EI_DB_MINIMUM_VERSION.'</b>', $alert_min_version_db);
						$alert_min_version_db = str_replace('_DB_CURR_VERSION_', '<b>'.$db->GetVersion().'</b>', $alert_min_version_db);
						$alert_min_version_db = str_replace('_DB_', '<b>'.$db->GetDbDriver().'</b>', $alert_min_version_db);
						$error_mg[] = $alert_min_version_db;
					}else{
						// read sql dump file
						$sql_dump = file_get_contents($sql_dump_file);
						if($sql_dump != ''){
							if(false == ($db_error = apphp_db_install($sql_dump_file))){
								if(EI_MODE != 'debug') $error_mg[] = lang_key('error_sql_executing');								
							}else{
								// write additional operations here, like setting up system preferences etc.
								// ...
								$completed = true;
								
								session_destroy();
								
								// now try to create file and write information
								$config_file = file_get_contents(EI_CONFIG_FILE_TEMPLATE);
								$config_file = str_replace('<DB_HOST>', $database_host, $config_file);
								$config_file = str_replace('<DB_NAME>', $database_name, $config_file);
								$config_file = str_replace('<DB_USER>', $database_username, $config_file);
								$config_file = str_replace('<DB_PASSWORD>', $database_password, $config_file);
								$config_file = str_replace('<DB_PREFIX>', $database_prefix, $config_file);
								
								$config_file = str_replace('<DEFAULT_LANGUAGE>', $DEFAULT_LANUGAGE, $config_file);
								$config_file = str_replace('<DEFAULT_LANUGAGE_DIRECTION>', $DEFAULT_LANUGAGE_DIRECTION, $config_file);

								$config_file = str_replace('<COMMUNITY_NAME>', $COMMUNITY_NAME, $config_file);
								$config_file = str_replace('<BASE_URL>', $BASE_URL, $config_file);
								$config_file = str_replace('<API_SECURITY>', $API_SECURITY, $config_file);
								
								$config_file = str_replace('<CAD_FROM_EMAIL>', $CAD_FROM_EMAIL, $config_file);
								$config_file = str_replace('<CAD_TO_EMAIL>', $CAD_TO_EMAIL, $config_file);
								
								$config_file = str_replace('<AUTH_KEY>', $AUTH_KEY, $config_file);
								$config_file = str_replace('<SECURE_AUTH_KEY>', $SECURE_AUTH_KEY, $config_file);
								$config_file = str_replace('<LOGGED_IN_KEY>', $LOGGED_IN_KEY, $config_file);
								$config_file = str_replace('<NONCE_KEY>', $NONCE_KEY, $config_file);
								$config_file = str_replace('<AUTH_SALT>', $AUTH_SALT, $config_file);
								$config_file = str_replace('<SECURE_AUTH_SALT>', $SECURE_AUTH_SALT, $config_file);
								$config_file = str_replace('<LOGGED_IN_SALT>', $LOGGED_IN_SALT, $config_file);
								$config_file = str_replace('<NONCE_SALT>', $NONCE_SALT, $config_file);
								
								$config_file = str_replace('<POLICE_NCIC>', $POLICE_NCIC, $config_file);
								$config_file = str_replace('<POLICE_CALL_SELFASSIGN>', $POLICE_CALL_SELFASSIGN, $config_file);
								
								$config_file = str_replace('<FIRE_PANIC>', $FIRE_PANIC, $config_file);
								$config_file = str_replace('<FIRE_BOLO>', $FIRE_BOLO, $config_file);
								$config_file = str_replace('<FIRE_NCIC_NAME>', $FIRE_NCIC_NAME, $config_file);
								$config_file = str_replace('<FIRE_NCIC_PLATE>', $FIRE_NCIC_PLATE, $config_file);
								$config_file = str_replace('<FIRE_CALL_SELFASSIGN>', $FIRE_CALL_SELFASSIGN, $config_file);
								
								$config_file = str_replace('<EMS_PANIC>', $EMS_PANIC, $config_file);
								$config_file = str_replace('<EMS_BOLO>', $EMS_BOLO, $config_file);
								$config_file = str_replace('<EMS_NCIC_NAME>', $EMS_NCIC_NAME, $config_file);
								$config_file = str_replace('<EMS_NCIC_PLATE>', $EMS_NCIC_PLATE, $config_file);
								$config_file = str_replace('<EMS_CALL_SELFASSIGN>', $EMS_NCIC_PLATE, $config_file);
								
								$config_file = str_replace('<ROADSIDE_PANIC>', $ROADSIDE_PANIC, $config_file);
								$config_file = str_replace('<ROADSIDE_BOLO>', $ROADSIDE_BOLO, $config_file);
								$config_file = str_replace('<ROADSIDE_NCIC_NAME>', $ROADSIDE_NCIC_NAME, $config_file);
								$config_file = str_replace('<ROADSIDE_NCIC_PLATE>', $ROADSIDE_NCIC_PLATE, $config_file);
								$config_file = str_replace('<ROADSIDE_CALL_SELFASSIGN>', $ROADSIDE_CALL_SELFASSIGN, $config_file);
								
								$config_file = str_replace('<CIV_WARRANT>', $CIV_WARRANT, $config_file);
								$config_file = str_replace('<CIV_REG>', $CIV_REG, $config_file);
								$config_file = str_replace('<CIV_LIMIT_MAX_IDENTITIES>', $CIV_LIMIT_MAX_IDENTITIES, $config_file);
								$config_file = str_replace('<CIV_LIMIT_MAX_VEHICLES>', $CIV_LIMIT_MAX_VEHICLES, $config_file);
								$config_file = str_replace('<CIV_LIMIT_MAX_WEAPONS>', $CIV_LIMIT_MAX_WEAPONS, $config_file);

								$config_file = str_replace('<MODERATOR_APPROVE_USER>', $MODERATOR_APPROVE_USER, $config_file);
								$config_file = str_replace('<MODERATOR_EDIT_USER>', $MODERATOR_EDIT_USER, $config_file);
								$config_file = str_replace('<MODERATOR_SUSPEND_WITH_REASON>', $MODERATOR_SUSPEND_WITH_REASON, $config_file);
								$config_file = str_replace('<MODERATOR_SUSPEND_WITHOUT_REASON>', $MODERATOR_SUSPEND_WITHOUT_REASON, $config_file);
								$config_file = str_replace('<MODERATOR_REACTIVATE_USER>', $MODERATOR_REACTIVATE_USER, $config_file);
								$config_file = str_replace('<MODERATOR_REMOVE_GROUP>', $MODERATOR_REMOVE_GROUP, $config_file);
								$config_file = str_replace('<MODERATOR_DELETE_USER>', $MODERATOR_DELETE_USER, $config_file);
								$config_file = str_replace('<MODERATOR_NCIC_EDITOR>', $MODERATOR_NCIC_EDITOR, $config_file);
								
								$config_file = str_replace('<MODERATOR_DATA_MANAGER>', $MODERATOR_DATA_MANAGER, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_CITATIONTYPES>', $MODERATOR_DATAMAN_CITATIONTYPES, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_DEPARTMENTS>', $MODERATOR_DATAMAN_DEPARTMENTS, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_INCIDENTTYPES>', $MODERATOR_DATAMAN_INCIDENTTYPES, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_RADIOCODES>', $MODERATOR_DATAMAN_RADIOCODES, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_STREETS>', $MODERATOR_DATAMAN_STREETS, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_VEHICLES>', $MODERATOR_DATAMAN_VEHICLES, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_WARNINGTYPES>', $MODERATOR_DATAMAN_WARNINGTYPES, $config_file);								
								$config_file = str_replace('<MODERATOR_DATAMAN_WARRANTTYPES>', $MODERATOR_DATAMAN_WARRANTTYPES, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_WEAPONS>', $MODERATOR_DATAMAN_WEAPONS, $config_file);
								$config_file = str_replace('<MODERATOR_DATAMAN_IMPEXPRESET>', $MODERATOR_DATAMAN_IMPEXPRESET, $config_file);

								$config_file = str_replace('<DEMO_MODE>', $DEMO_MODE, $config_file);
								$config_file = str_replace('<USE_GRAVATAR>', $USE_GRAVATAR, $config_file);
								
								chmod(EI_CONFIG_FILE_PATH, 0600);
								$f = fopen(EI_CONFIG_FILE_PATH, 'w+');
								if(!fwrite($f, $config_file) > 0){
									$error_mg[] = str_replace('_CONFIG_FILE_PATH_', EI_CONFIG_FILE_PATH, lang_key('error_can_not_open_config_file')); 
								}
								fclose($f);
								if($install_type == 'un-install') unlink(EI_CONFIG_FILE_PATH);
								///@chmod('../'.EI_CONFIG_FILE_DIRECTORY, 0644);									
							}							
						}else{
							$error_mg[] = str_replace('_SQL_DUMP_FILE_', $sql_dump_file, lang_key('error_can_not_read_file')); 
						}						
					}
				}else{
					if(EI_MODE == 'debug'){
						$error_mg[] = str_replace('_ERROR_', '<br />Error: '.$db->Error(), lang_key('error_check_db_connection')); 
					}else{
						$error_mg[] = str_replace('_ERROR_', '', lang_key('error_check_db_connection')); 
					}						
				}
			}			
		}
	}else{
		$error_mg[] = lang_key('alert_wrong_parameter_passed');
	}
        
?>	

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="ApPHP Company - Advanced Power of PHP">
    <meta name="generator" content="ApPHP EasyInstaller">
	<title><?php echo lang_key('installation_guide'); ?> | <?php echo lang_key('complete_installation'); ?></title>

	<link href="../images/favicon.ico" rel="shortcut icon" />
	<link rel="stylesheet" type="text/css" href="templates/<?php echo EI_TEMPLATE; ?>/css/styles.css" />
	<?php
		if($curr_lang_direction == 'rtl'){
			echo '<link rel="stylesheet" type="text/css" href="templates/'.EI_TEMPLATE.'/css/rtl.css" />'."\n";
		}
	?>

	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div id="main">    
	<h1><?php echo lang_key('new_installation_of'); ?> <?php echo EI_APPLICATION_NAME.' '.EI_APPLICATION_VERSION;?>!</h1>
	<h2 class="sub-title"><?php echo lang_key('sub_title_message'); ?></h2>
	
	<div id="content">
		<?php
			draw_side_navigation(11);		
		?>

		<div class="central-part">
			<h2><?php echo lang_key('step_11_of'); ?>
			<?php if(!$completed){ ?>
				- <?php echo lang_key('database_import_error'); ?>
			<?php }else{ ?>
				- <?php echo lang_key('completed'); ?>
				<!--<h3><?php //echo lang_key('updating_completed'); ?></h3>			-->
			<?php } ?>
			</h2>

			<?php
				if(!$completed){
					echo '<div class="alert alert-error">';
					foreach($error_mg as $msg){
						echo $msg.'<br>';
					}
					echo '</div>';
				}
			?>
		
			<table width="99%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
			<?php if(!$completed){ ?>
				<tr><td nowrap height="25px">&nbsp;</td></tr>
				<tr>
					<td>	
						<a href="ready_to_install.php" class="form_button"><?php echo lang_key('back'); ?></a>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" class="form_button" onclick="javascript:location.reload();" value="<?php echo lang_key('complete'); ?>" />
					</td>
				</tr>							
			<?php }else{ ?>
				<tr><td>&nbsp;</td></tr>						
				<?php if($install_type == 'update'){ ?>
					<tr><td><h4><?php echo lang_key('updating_completed'); ?></h4></td></tr>
					<tr>
						<td>
							<div class="alert alert-success"><?php echo str_replace('_CONFIG_FILE_', EI_CONFIG_FILE_PATH, lang_key('file_successfully_rewritten')); ?></div>
							<div class="alert alert-warning"><?php echo lang_key('alert_remove_files'); ?></div>
							<?php echo (EI_POST_INSTALLATION_TEXT != '') ? '<div class="alert alert-info">'.EI_POST_INSTALLATION_TEXT.'</div>' : ''; ?>
							<br /><br />
							<?php if(EI_APPLICATION_START_FILE != ''){ ?><a href="<?php echo '../'.EI_APPLICATION_START_FILE;?>"><?php echo lang_key('proceed_to_login_page'); ?></a><?php } ?>
						</td>
					</tr>									
				<?php }else if($install_type == 'un-install'){ ?>
					<tr><td><h4><?php echo lang_key('uninstallation_completed'); ?></h4></td></tr>
					<tr>
						<td>
							<div class="alert alert-success"><?php echo str_replace('_CONFIG_FILE_', EI_CONFIG_FILE_PATH, lang_key('file_successfully_deleted')); ?></div>
							<div class="alert alert-warning"><?php echo lang_key('alert_remove_files'); ?></div>
							<br /><br />
							<?php if(EI_APPLICATION_START_FILE != ''){ ?><a href="<?php echo '../'.EI_APPLICATION_START_FILE;?>"><?php echo lang_key('proceed_to_login_page'); ?></a><?php } ?>
						</td>
					</tr>															
				<?php }else{ ?>									
					<tr><td><h4><?php echo lang_key('installation_completed'); ?></h4></td></tr>
					<tr>
						<td>
							<div class="alert alert-success"><?php echo str_replace('_CONFIG_FILE_', EI_CONFIG_FILE_PATH, lang_key('file_successfully_created')); ?></div>
							<div class="alert alert-warning"><?php echo lang_key('alert_remove_files'); ?></div>
							<?php echo (EI_POST_INSTALLATION_TEXT != '') ? '<div class="alert alert-info">'.EI_POST_INSTALLATION_TEXT.'</div>' : ''; ?>
							<br /><br />
							<?php if(EI_APPLICATION_START_FILE != ''){ ?><a href="<?php echo '../'.EI_APPLICATION_START_FILE;?>"><?php echo lang_key('proceed_to_login_page'); ?></a><?php } ?>
						</td>
					</tr>															
				<?php } ?>
			<?php } ?>
			</tbody>
			</table>
			<br>

			<?php
				if(EI_ALLOW_START_ALL_OVER && $completed){
					echo '<h3>'.lang_key('start_all_over').'</h3>';
					echo '<p>'.lang_key('start_all_over_text').'</p>';
					echo '<form action="start.php" method="post">';
					echo '<input type="hidden" name="task" value="start_over" />';
					echo '<input type="hidden" name="token" value="'.$_SESSION['token'].'" />';
					echo '<input type="submit" class="form_button" name="btnSubmit" value="'.lang_key('remove_configuration_button').'" />';
				}
			?>			
			
		</div>
		<div class="clear"></div>
	</div>
	
	<?php include_once('include/footer.inc.php'); ?>        

</div>
</body>
</html>