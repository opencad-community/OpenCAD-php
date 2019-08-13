<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  ApPHP EasyInstaller Free version                                           #
##  Developed by:  ApPHP <info@apphp.com>                                      #
##  License:       GNU LGPL v.3                                                #
##  Site:          https://www.apphp.com/php-easyinstaller/                    #
##  Copyright:     ApPHP EasyInstaller (c) 2009-2013. All rights reserved.     #
##                                                                             #
################################################################################

	session_start();
	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');    
	require_once('include/database.class.php'); 
	require_once('include/functions.inc.php');
	require_once('include/languages.inc.php');	

	$task = isset($_POST['task']) ? prepare_input($_POST['task']) : '';
	$passed_step = isset($_SESSION['passed_step']) ? (int)$_SESSION['passed_step'] : 0;
	$program_already_installed = false;
	$focus_field = 'database_host';
	$error_msg = '';
	
	// handle previous steps
	// -------------------------------------------------
	if($passed_step >= 2){
		// OK
	}else{
		header('location: start.php');
		exit;				
	}

	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){
		$database_host		= isset($_POST['database_host']) ? prepare_input($_POST['database_host']) : 'localhost';
		$database_name 		= isset($_POST['database_name']) ? prepare_input($_POST['database_name']) : '';
		$database_username	= isset($_POST['database_username']) ? prepare_input($_POST['database_username']) : '';
		$database_password	= isset($_POST['database_password']) ? prepare_input($_POST['database_password']) : '';
		$database_prefix	= isset($_POST['database_prefix']) ? prepare_input($_POST['database_prefix']) : '';	
		$install_type		= isset($_POST['install_type']) ? prepare_input($_POST['install_type']) : 'create';
		
		// validation here
		// -------------------------------------------------
		if($database_host == ''){
			$focus_field = 'database_host';
			$error_msg = lang_key('alert_db_host_empty');	
		}else if($database_name == ''){
			$focus_field = 'database_name';
			$error_msg = lang_key('alert_db_name_empty');	
		}else if($database_username == ''){
			$focus_field = 'database_username';
			$error_msg = lang_key('alert_db_username_empty');	
		//}else if($database_password == ''){
		//	$focus_field = 'database_password';
		//	$error_msg = lang_key('alert_db_password_empty');
		}else{
			
			if(EI_MODE == 'demo'){
				if($database_host != 'localhost' || $database_name != 'db_name' || $database_username != 'test' || $database_password != 'test'){
					$error_msg = lang_key('alert_wrong_testing_parameters');
				}
			}else{
				// check database connection
				$arr = array();
				$db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE, false, true);
				if($db->Open()){
					if(EI_CHECK_DB_MINIMUM_VERSION && (version_compare($db->GetVersion(), EI_DB_MINIMUM_VERSION, '<'))){
						$alert_min_version_db = lang_key('alert_min_version_db');
						$alert_min_version_db = str_replace('_DB_VERSION_', '<b>'.EI_DB_MINIMUM_VERSION.'</b>', $alert_min_version_db);
						$alert_min_version_db = str_replace('_DB_CURR_VERSION_', '<b>'.$db->GetVersion().'</b>', $alert_min_version_db);
						$alert_min_version_db = str_replace('_DB_', '<b>'.$db->GetDbDriver().'</b>', $alert_min_version_db);
						$error_msg = $alert_min_version_db;									
					}
				}else{
					$error_text = $db->Error();
					$error_text = str_replace(array('"', "'"), '', $error_text);
					$error_text = str_replace(array("\n", "\t"), ' ', $error_text);
					$error_msg = $error_text;
				}				
			}			
			
			if(empty($error_msg)){
				$_SESSION['database_host'] = $database_host;
				$_SESSION['database_name'] = $database_name;
				$_SESSION['database_username'] = $database_username;
				$_SESSION['database_password'] = $database_password;
				$_SESSION['database_prefix'] = $database_prefix;
				$_SESSION['install_type'] = $install_type;

				// skip administrator settings				
				if($install_type == 'un-install'){
					$_SESSION['passed_step'] = 2;
					header('location: ready_to_install.php');
				}
				else if($install_type == 'update'){
					$_SESSION['passed_step'] = 9;
					header('location: ready_to_install.php');								
				}else{
					$_SESSION['passed_step'] = 3;
					header('location: administrator_account.php');
				}
				exit;				
			}
		}		
	}else{
		$database_host		= isset($_SESSION['database_host']) ? $_SESSION['database_host'] : 'localhost';
		$database_name 		= isset($_SESSION['database_name']) ? $_SESSION['database_name'] : '';
		$database_username	= isset($_SESSION['database_username']) ? $_SESSION['database_username'] : '';
		$database_password	= isset($_SESSION['database_password']) ? $_SESSION['database_password'] : '';
		$database_prefix	= isset($_SESSION['database_prefix']) ? $_SESSION['database_prefix'] : '';
		$install_type		= isset($_SESSION['install_type']) ? $_SESSION['install_type'] : 'create';		
		if(file_exists(".dbname")){ $database_name     = file_get_contents(".dbname"); unlink(".dbname"); }
        	if(file_exists(".dbuser")){ $database_username = file_get_contents(".dbuser"); unlink(".dbuser"); }
        	if(file_exists(".dbpass")){ $database_password = file_get_contents(".dbpass"); unlink(".dbpass"); }
	} 

	// handle previous installation
	// -------------------------------------------------
    if(file_exists(EI_CONFIG_FILE_PATH)){        
		$program_already_installed = true;
		if($install_type == 'create'){
			if(EI_ALLOW_UPDATE) $install_type = 'update';
			else if(EI_ALLOW_UN_INSTALLATION) $install_type = 'un-install';
		}
		include_once(EI_CONFIG_FILE_PATH);
		if(defined('DB_PREFIX')) $database_prefix = DB_PREFIX;	
		///header('location: ../'.EI_APPLICATION_START_FILE);
        ///exit;
	}	
	
?>	

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="ApPHP Company - Advanced Power of PHP">
    <meta name="generator" content="ApPHP EasyInstaller">
	<title><?php echo lang_key("installation_guide"); ?> | <?php echo lang_key('database_settings'); ?></title>

	<link href="images/apphp.ico" rel="shortcut icon" />
	<link rel="stylesheet" type="text/css" href="templates/<?php echo EI_TEMPLATE; ?>/css/styles.css" />
	<?php
		if($curr_lang_direction == 'rtl'){
			echo '<link rel="stylesheet" type="text/css" href="templates/'.EI_TEMPLATE.'/css/rtl.css" />'."\n";
		}
	?>

	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<?php
		if(file_exists('languages/js/'.$curr_lang.'.js')){
			echo '<script type="text/javascript" src="language/'.$curr_lang.'/js/common.js"></script>';
		}else{
			echo '<script type="text/javascript" src="language/en/js/common.js"></script>';
		}
	?>
</head>
<body onload="bodyOnLoad()">
<div id="main">
	<h1><?php echo lang_key('new_installation_of'); ?> <?php echo EI_APPLICATION_NAME.' '.EI_APPLICATION_VERSION;?>!</h1>
	<h2 class="sub-title"><?php echo lang_key('sub_title_message'); ?></h2>
	
	<div id="content">
		<?php
			draw_side_navigation(3);		
		?>
		<div class="central-part">
			<h2><?php echo lang_key('step_3_of'); ?> - <?php echo lang_key('database_settings'); ?></h2>
			<h3><?php echo lang_key('database_import'); ?></h3>

			<form action="database_settings.php" method="post">
			<input type="hidden" name="task" value="send" />
			<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />

			<?php
				if(!empty($error_msg)){
					echo '<div class="alert alert-error">'.$error_msg.'</div>';
				}
			?>

			<table width="99%" border="0" cellspacing="1" cellpadding="1">
			<tr>
				<td colspan="3"><span class="star">*</span> <?php echo lang_key('alert_required_fields'); ?></td>
			</tr>
			<tr><td nowrap height="10px" colspan="3"></td></tr>
			<tr>
				<td width="250px" nowrap>&nbsp;<?php echo lang_key('database_host'); ?>: <span class="star">*</span></td>
				<td>
					<input type="text" class="form_text" name="database_host" id="database_host" size="30" value="<?php echo $database_host; ?>" placeholder="<?php if(EI_MODE == 'demo') echo 'demo: localhost'; ?>" onfocus="textboxOnFocus('notes_host')" onblur="textboxOnBlur('notes_host')" />					
				</td>
				<td rowspan="7" valign="top">					
					<div id="notes_host" class="notes_container">
						<h4><?php echo lang_key('database_host'); ?></h4>
						<p><?php echo lang_key('database_host_info'); ?></p>
					</div>						
					<div id="notes_db_name" class="notes_container">
						<h4><?php echo lang_key('database_name'); ?></h4>
						<p><?php echo lang_key('database_name_info'); ?></p>
					</div>
					<div id="notes_db_user" class="notes_container">
						<h4><?php echo lang_key('database_username'); ?></h4>
						<p><?php echo lang_key('database_username_info'); ?></p>
					</div>
					<div id="notes_db_password" class="notes_container">
						<h4><?php echo lang_key('database_password'); ?></h4>
						<p><?php echo lang_key('database_password_info'); ?></p>
					</div>
					<div id="notes_db_prefix" class="notes_container">
						<h4><?php echo lang_key('database_prefix'); ?></h4>
						<p><?php echo lang_key('database_prefix_info'); ?></p>
					</div>
					<img class="loading_img" src="images/ajax_loading.gif" alt="<?php echo lang_key('loading'); ?>..." />
					<div id="notes_message" class="notes_container"></div>					
				</td>
			</tr>
			<tr>
				<td nowrap>&nbsp;<?php echo lang_key('database_username'); ?>: <span class="star">*</span></td>
				<td>
					<input type="text" class="form_text" name="database_username" id="database_username" size="30" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> value="<?php echo $database_username; ?>" placeholder="<?php if(EI_MODE == 'demo') echo 'demo: test'; ?>" onfocus="textboxOnFocus('notes_db_user')" onblur="textboxOnBlur('notes_db_user')" />
				</td>
			</tr>
			<tr>
				<td nowrap>&nbsp;<?php echo lang_key('database_password'); ?>:</td>
				<td>
					<input type="password" class="form_text" name="database_password" id="database_password" size="30" value="<?php echo $database_password; ?>" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> placeholder="<?php if(EI_MODE == 'demo') echo 'demo: test'; ?>" onfocus="textboxOnFocus('notes_db_password')" onblur="textboxOnBlur('notes_db_password')" />
				</td>
			</tr>
			<tr>
				<td nowrap>&nbsp;<?php echo lang_key('database_name'); ?>: <span class="star">*</span></td>
				<td>
					<input type="text" class="form_text" name="database_name" id="database_name" size="30" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> value="<?php echo $database_name; ?>" placeholder="<?php if(EI_MODE == 'demo') echo 'demo: db_name'; ?>" onfocus="textboxOnFocus('notes_db_name')" onblur="textboxOnBlur('notes_db_name')" />					
				</td>
			</tr>
			<tr>
				<td nowrap>&nbsp;<?php echo lang_key('database_prefix'); ?></td>
				<td>
			<input type="text" class="form_text" name="database_prefix" size="30" maxlength="12" <?php if(!empty($database_prefix)){?>value="<?php echo $database_prefix; ?>"<?php } else { ?>value=<?php echo generateRandomString2(6); ?>_<?php }?> <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> onfocus="textboxOnFocus('notes_database_prefix')" onblur="textboxOnBlur('notes_databaseprefix')" />
				</td>
			</tr>
			<tr>
				<td>
					<?php if(EI_ALLOW_NEW_INSTALLATION && !$program_already_installed) { ?><input type="hidden" name="install_type" id="rb_create" value="create" <?php echo ($install_type == 'create') ? 'checked="checked"' : ''; ?> onclick="installTypeOnClick(this.value)" /> <?php } ?>
					<?php if(EI_ALLOW_UPDATE) { ?><input type="radio" name="install_type" id="rb_update" value="update" <?php echo (!$program_already_installed) ? 'disabled="disabled"' : ''; ?> <?php echo ($install_type == 'update') ? 'checked="checked"' : ''; ?> onclick="installTypeOnClick(this.value)" /> <label for="rb_update"><?php echo lang_key('update'); ?></label> <?php } ?>
					<?php if(EI_ALLOW_UN_INSTALLATION) { ?><input type="radio" name="install_type" id="rb_uninstall" value="un-install" <?php echo (!$program_already_installed) ? 'disabled="disabled"' : ''; ?> <?php echo ($install_type == 'un-install') ? 'checked="checked"' : ''; ?> onclick="installTypeOnClick(this.value)" /> <label for="rb_uninstall"><?php echo lang_key('uninstall'); ?></label> <?php } ?>						
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="form_button" title="<?php echo lang_key('test_database_connection'); ?>" onclick="testDatabaseConnection()" value="<?php echo lang_key('test_connection'); ?>" />
				</td>
			</tr>
			<tr><td nowrap height="10px" colspan="3"></td></tr>
			<tr>
				<td colspan="2">
					<a href="server_requirements.php" class="form_button" /><?php echo lang_key('back'); ?></a>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" class="form_button" value="<?php echo lang_key('continue'); ?>" />
				</td>
			</tr>                        
			</table>
			</form>                        

		</div>
		<div class="clear"></div>
	</div>
	
	<?php include_once('include/footer.inc.php'); ?>        

</div>

<script type="text/javascript">
	function bodyOnLoad(){
		setFocus("<?php echo $focus_field; ?>");
		installTypeOnClick($("input[@name='install_type']:checked").val());
	}	
</script>
</body>
</html>
