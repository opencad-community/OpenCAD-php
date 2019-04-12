<?php
   
    session_start();   

	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');
	require_once('include/functions.inc.php');
	require_once('include/languages.inc.php');	

	$task = isset($_POST['task']) ? prepare_input($_POST['task']) : '';
	$passed_step = isset($_SESSION['passed_step']) ? (int)$_SESSION['passed_step'] : 0;
	$installation_type = isset($_SESSION['installation_type']) ? $_SESSION['installation_type'] : 'wizard';
	$program_already_installed = false;
	
	// handle previous installation
	// -------------------------------------------------
    if(file_exists(EI_CONFIG_FILE_PATH)){ 
		$program_already_installed = true;
		//header('location: '.EI_APPLICATION_START_FILE);
        ///exit;
	}
	
	// handle previous steps
	// -------------------------------------------------
	if($passed_step >= 1){
		// OK
	}else{
		header('location: start.php');
		exit;				
	}

	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){
		$_SESSION['passed_step'] = 2;
		header('location: database_settings.php');
		exit;
	}

    ob_start();    
	if(function_exists('phpinfo')) @phpinfo(-1);
	$phpinfo = array('phpinfo' => array());
	if(preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER))
	foreach($matches as $match){
		$array_keys = array_keys($phpinfo);
		$end_array_keys = end($array_keys);
		if(strlen($match[1])){
			$phpinfo[$match[1]] = array();
		}else if(isset($match[3])){
			$phpinfo[$end_array_keys][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
		}else{
			$phpinfo[$end_array_keys][] = $match[2];
		}
	}
	
	$is_error = false;
	$error_mg = array();
	if(EI_CHECK_PHP_MINIMUM_VERSION && (version_compare(phpversion(), EI_PHP_MINIMUM_VERSION, '<'))){	
		$is_error = true;
		$alert_min_version_php = lang_key('alert_min_version_php');
		$alert_min_version_php = str_replace('_PHP_VERSION_', EI_PHP_MINIMUM_VERSION, $alert_min_version_php);
		$alert_min_version_php = str_replace('_PHP_CURR_VERSION_', phpversion(), $alert_min_version_php);
		$error_mg[] = $alert_min_version_php;
	}
	if(EI_CHECK_CONFIG_DIR_WRITABILITY && !is_writable(EI_CONFIG_FILE_DIRECTORY)){
		$is_error = true;
		$EI_CONFIG_FILE_DIRECTORY = EI_CONFIG_FILE_DIRECTORY == '' ? "''" : EI_CONFIG_FILE_DIRECTORY;
		$error_mg[] = str_replace('_FILE_DIRECTORY_', $EI_CONFIG_FILE_DIRECTORY, lang_key('alert_directory_not_writable'));
	}
	
	$php_core_index = ((version_compare(phpversion(), '7.2', '<'))) ? 'PHP Core' : 'Core';
	// [0] requred
	// [1] title
	// [2] condition
	// [3] true value
	// [4] false value
	// [5] error message
	$validations = array(
		'divider_system_info' => array('title'=>lang_key('getting_system_info'), 'description'=>''),
		
		'phpversion'   => array(true, lang_key('php_version'), function_exists('phpversion'), phpversion(), lang_key('unknown')),
		'system'       => array(false, lang_key('system'), isset($phpinfo['phpinfo']['System']), (isset($phpinfo['phpinfo']['System']) ? $phpinfo['phpinfo']['System'] : ''), lang_key('disabled')),
		'architecture' => array(false, lang_key('system_architecture'), (isset($phpinfo['phpinfo']['Architecture'])), (isset($phpinfo['phpinfo']['Architecture']) ? $phpinfo['phpinfo']['Architecture'] : ''), lang_key('disabled')),
		'build_date'   => array(false, lang_key('build_date'), isset($phpinfo['phpinfo']['Build Date']), (isset($phpinfo['phpinfo']['Build Date']) ? $phpinfo['phpinfo']['Build Date'] : ''), lang_key('disabled')),
		'server_api'   => array(false, lang_key('server_api'), isset($phpinfo['phpinfo']['Server API']), (isset($phpinfo['phpinfo']['Server API']) ? $phpinfo['phpinfo']['Server API'] : ''), lang_key('unknown')),
		
		'divider_php_settings' => array('title'=>lang_key('required_php_settings')),
		'pdo_support'  => array(false, lang_key('pdo_support'), (isset($phpinfo['PDO']['PDO support']) && $phpinfo['PDO']['PDO support'] == 'enabled'), lang_key('enabled'), lang_key('disabled'), lang_key('error_pdo_support')),
	);
	$database_system_version = isset($phpinfo['mysql']) ? $phpinfo['mysql']['Client API version'] : "unknown";

	#if(EI_CHECK_MBSTRING_SUPPORT){
	#	$validations['mbstring_support'] = array(false, lang_key('mbstring_support'), function_exists('mb_detect_encoding'), lang_key('enabled'), lang_key('disabled'));
	#}
	
	//if(EI_CHECK_MAGIC_QUOTES){
	//	$validations['divider_magic_quotes'] = array('title'=>'', 'description'=>'');
//		$validations['magic_quotes_gpc'] = array(false, lang_key('magic_quotes_gpc'), ini_get('magic_quotes_gpc'), lang_key('on'), lang_key('off'));
//		$validations['magic_quotes_runtime'] = array(false, lang_key('magic_quotes_runtime'), ini_get('magic_quotes_runtime'), lang_key('on'), lang_key('off'));
//		$validations['magic_quotes_sybase'] = array(false, lang_key('magic_quotes_sybase'), ini_get('magic_quotes_sybase'), lang_key('on'), lang_key('off'));
//	}

//	if(EI_CHECK_MAIL_SETTINGS){
//		$validations['divider_smtp'] = array('title'=>'', 'description'=>'');
//		$validations['smtp'] = array(false, lang_key('smtp'), ini_get('SMTP'), ini_get('SMTP'), lang_key('unknown'));
//		$validations['smtp_port'] = array(false, lang_key('smtp_port'), ini_get('smtp_port'), ini_get('smtp_port'), lang_key('unknown'));
//		$validations['sendmail_from'] = array(false, lang_key('sendmail_from'), ini_get('sendmail_from'), ini_get('sendmail_from'), lang_key('unknown'));
//		$validations['sendmail_path'] = array(false, lang_key('sendmail_path'), ini_get('sendmail_path'), ini_get('sendmail_path'), lang_key('unknown'));
//	}
	
//	if(EI_CHECK_EXTENSIONS){
//		$validations['divider_extensions'] = array('title'=>lang_key('extensions'), 'description'=>'');
//		$loaded_extensions = get_loaded_extensions();
//		$validations['php_curl'] = array(false, 'PHP Curl', in_array('curl', $loaded_extensions), lang_key('installed'), lang_key('not_installed'));
//		$validations['php_xmlrpc'] = array(false, 'PHP XmlRrpc', in_array('xmlrpc', $loaded_extensions), lang_key('installed'), lang_key('not_installed'));
//		$validations['php_gd2'] = array(false, 'PHP Gd2', in_array('gd2', $loaded_extensions), lang_key('installed'), lang_key('not_installed'));
//	}
	
//	if(EI_CHECK_MODES){
//		$validations['divider_modes'] = array('title'=>lang_key('modes'), 'description'=>'');
//		$loaded_extensions = get_loaded_extensions();
//		$validations['mod_rewrite'] = array(false, lang_key('mode').' Rewrite', in_array('rewrite', $loaded_extensions), lang_key('installed'), lang_key('not_installed'));
//		$validations['mod_ldap'] = array(false, lang_key('mode').' LDAP', in_array('ldap', $loaded_extensions), lang_key('installed'), lang_key('not_installed'));
//	}
	
	if(EI_CHECK_DIRECTORIES_AND_FILES){
		$validations['divider_dirs_and_files'] = array('title'=>lang_key('directories_and_files'), 'description'=>'');
		$validations['config_file_dir'] = array(false, EI_CONFIG_FILE_DIRECTORY, is_writable(EI_CONFIG_FILE_DIRECTORY), lang_key('writable'), lang_key('no_writable'));		
		///$validations['cache_file_dir'] = array(false, '../cache/', is_writable('../cache/'), lang_key('writable'), lang_key('no_writable'));
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="ApPHP Company - Advanced Power of PHP">
    <meta name="generator" content="ApPHP EasyInstaller">
	<title><?php echo lang_key('installation_guide'); ?> | <?php echo lang_key('server_requirements'); ?></title>
	
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
		<?php if($installation_type == 'wizard'){ ?>
			<?php
				draw_side_navigation(2);		
			?>
			<div class="central-part">
			<h2><?php echo lang_key('step_2_of'); ?> - <?php echo lang_key('server_requirements'); ?></h2>

			<form action="server_requirements.php" method="post">
			<input type="hidden" name="task" value="send" />
			<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />

				<?php
					$content = '';
					foreach($validations as $key => $val){
						$content .= '<tr>';							
						if(preg_match('/divider\_/i', $key)){
							if($val['title'] != ''){
								$content .= '<td colspan="2">';
								$content .= '<h3>'.$val['title'].'</h3>';
								if(!empty($val['description'])) $content .= '<p>'.$val['description'].'</p>';
								$content .= '</td>';	
							}else{
								$content .= '<td colspan="2" nowrap height="9px"></td>';
							}
						}else{
							$content .= '<td>&#8226; '.$val[1].': <i>'.(($val[2]) ? '<span class="found">'.$val[3].'</span>' : '<span class="disabled">'.$val[4].'</span>').'</i></td>';
							if($val[0] == true && !$val[2]){
								$is_error = true;
								$error_mg[$key] = isset($val[5]) ? $val[5] : str_ireplace('_SETTINGS_NAME_', '<b>'.$key.'</b>', lang_key('error_server_requirements'));
								$content .= '<td><span class="failed">'.lang_key('failed').'!</span></td>';
							}else{
								$content .= '<td><span class="passed">'.lang_key('passed').'</span></td>';	
							}
						}
						$content .= '</tr>'."\n";
					}				
				?>
				
				<?php
					if($is_error){
						echo '<div class="alert alert-error">';
						foreach($error_mg as $msg){
							echo $msg.'<br>';
						}
						echo '</div>';
					}
					if(!$is_error && $program_already_installed){
						echo '<div class="alert alert-warning">'.lang_key('alert_unable_to_install').'</div>';									
					}
				?>
				<table width="99%" cellspacing="2" cellpadding="0" border="0">
				<tbody>
				<?php echo $content; ?>
				</tbody>
				</table>
				
				<div class="buttons-wrapper">
					<a href="start.php" class="form_button" /><?php echo lang_key('back'); ?></a>
					<?php if(!$is_error){ ?>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" class="form_button" name="btnSubmit" value="<?php echo lang_key('continue'); ?>" />
					<?php } ?>
				</div>
			</form>
			</div>
		<?php
			}else{			
				if(EI_ALLOW_MANUAL_INSTALLATION){
					echo '<div id="divManually">';
					echo '<div class="content">';
					include_once(EI_MANUAL_INSTALLATION_DIR.$arr_manual_installations[$curr_lang]);
					echo '</div>';
					echo '<div class="footer"><a href="start.php" class="form_button" title="'.lang_key('cancel_installation').'" />'.lang_key('back').'</a></div>';
					echo '</div>';
				}
			} 	
		?>			
		<div class="clear"></div>
	</div>
	
	<?php include_once('include/footer.inc.php'); ?>

</div>
</body>
</html>