<?php

	session_start();

	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');    
	require_once('include/functions.inc.php');
	require_once('include/languages.inc.php');	

	$task = isset($_POST['task']) ? prepare_input($_POST['task']) : '';
	$passed_step = isset($_SESSION['passed_step']) ? (int)$_SESSION['passed_step'] : 0;
	$focus_field = 'COMMUNITY_NAME';
	$error_msg = '';
	
	// handle previous steps
	// -------------------------------------------------
	if($passed_step >= 4){
		// OK
	}else{
		header('location: start.php');
		exit;				
	}
	
	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){

		$COMMUNITY_NAME = isset($_SESSION['COMMUNITY_NAME']) ? prepare_input($_SESSION['COMMUNITY_NAME']) : '';
		
		$BASE_URL = isset($_SESSION['BASE_URL']) ? prepare_input($_SESSION['BASE_URL']) : '';
		
		$API_SECURITY = isset($_SESSION['API_SECURITY']) ? prepare_input($_SESSION['API_SECURITY']) : '';

		$CAD_FROM_EMAIL = isset($_SESSION['CAD_FROM_EMAIL']) ? prepare_input($_SESSION['CAD_FROM_EMAIL']) : '';
		$CAD_FROM_NAME = isset($_SESSION['CAD_FROM_NAME']) ? prepare_input($_SESSION['CAD_FROM_NAME']) : '';
		$CAD_TO_EMAIL = isset($_SESSION['CAD_TO_EMAIL']) ? prepare_input($_SESSION['CAD_TO_EMAIL']) : '';
		$CAD_TO_NAME = isset($_SESSION['CAD_TO_NAME']) ? prepare_input($_SESSION['CAD_TO_NAME']) : '';
		
		$AUTH_KEY = isset($_SESSION['AUTH_KEY']) ? prepare_input($_SESSION['AUTH_KEY']) : '';
		$SECURE_AUTH_KEY = isset($_SESSION['SECURE_AUTH_KEY']) ? prepare_input($_SESSION['SECURE_AUTH_KEY']) : '';
		$LOGGED_IN_KEY = isset($_SESSION['LOGGED_IN_KEY']) ? prepare_input($_SESSION['LOGGED_IN_KEY']) : '';
		$NONCE_KEY = isset($_SESSION['NONCE_KEY']) ? prepare_input($_SESSION['NONCE_KEY']) : '';
		$AUTH_SALT = isset($_SESSION['AUTH_SALT']) ? prepare_input($_SESSION['AUTH_SALT']) : '';
		$SECURE_AUTH_SALT = isset($_SESSION['SECURE_AUTH_SALT']) ? prepare_input($_SESSION['SECURE_AUTH_SALT']) : '';
		$LOGGED_IN_SALT = isset($_SESSION['LOGGED_IN_SALT']) ? prepare_input($_SESSION['LOGGED_IN_SALT']) : '';
		$NONCE_SALT = isset($_SESSION['NONCE_SALT']) ? prepare_input($_SESSION['NONCE_SALT']) : '';
		
		$_SESSION['COMMUNITY_NAME'] = $COMMUNITY_NAME;
		$_SESSION['BASE_URL'] = $BASE_URL;
		$_SESSION['API_SECURITY'] = $API_SECURITY;
		
		$_SESSION['CAD_FROM_EMAIL'] = $CAD_FROM_EMAILL;
		$_SESSION['CAD_FROM_NAME'] = $CAD_FROM_NAME;			
		$_SESSION['CAD_TO_EMAIL'] = $CAD_TO_EMAIL;			
		$_SESSION['CAD_TO_NAME'] = $CAD_TO_NAME;
		
		$_SESSION['AUTH_KEY'] = $AUTH_KEY;			
		$_SESSION['SECURE_AUTH_KEY'] = $SECURE_AUTH_KEY;			
		$_SESSION['LOGGED_IN_KEY'] = $LOGGED_IN_KEY;			
		$_SESSION['NONCE_KEY'] = $NONCE_KEY;			
		$_SESSION['AUTH_SALT'] = $AUTH_SALT;			
		$_SESSION['SECURE_AUTH_SALT'] = $SECURE_AUTH_SALT;			
		$_SESSION['LOGGED_IN_SALT'] = $LOGGED_IN_SALT;			
		$_SESSION['NONCE_SALT'] = $NONCE_SALT;		

		$_SESSION['passed_step'] = 5;
		header('location: department_configuration.php');
		exit;

	}else{
	    $COMMUNITY_NAME = isset($_SESSION['COMMUNITY_NAME']) ? prepare_input($_SESSION['COMMUNITY_NAME']) : '';
		
		$BASE_URL = isset($_SESSION['BASE_URL']) ? prepare_input($_SESSION['BASE_URL']) : '';
		
		$API_SECURITY = isset($_SESSION['API_SECURITY']) ? prepare_input($_SESSION['API_SECURITY']) : '';

		$CAD_FROM_EMAIL = isset($_SESSION['CAD_FROM_EMAIL']) ? prepare_input($_SESSION['CAD_FROM_EMAIL']) : '';
		$CAD_FROM_NAME = isset($_SESSION['CAD_FROM_NAME']) ? prepare_input($_SESSION['CAD_FROM_NAME']) : '';
		$CAD_TO_EMAIL = isset($_SESSION['CAD_TO_EMAIL']) ? prepare_input($_SESSION['CAD_TO_EMAIL']) : '';
		$CAD_TO_NAME = isset($_SESSION['CAD_TO_NAME']) ? prepare_input($_SESSION['CAD_TO_NAME']) : '';
		
		$AUTH_KEY = isset($_SESSION['AUTH_KEY']) ? prepare_input($_SESSION['AUTH_KEY']) : '';
		$SECURE_AUTH_KEY = isset($_SESSION['SECURE_AUTH_KEY']) ? prepare_input($_SESSION['SECURE_AUTH_KEY']) : '';
		$LOGGED_IN_KEY = isset($_SESSION['LOGGED_IN_KEY']) ? prepare_input($_SESSION['LOGGED_IN_KEY']) : '';
		$NONCE_KEY = isset($_SESSION['NONCE_KEY']) ? prepare_input($_SESSION['NONCE_KEY']) : '';
		$AUTH_SALT = isset($_SESSION['AUTH_SALT']) ? prepare_input($_SESSION['AUTH_SALT']) : '';
		$SECURE_AUTH_SALT = isset($_SESSION['SECURE_AUTH_SALT']) ? prepare_input($_SESSION['SECURE_AUTH_SALT']) : '';
		$LOGGED_IN_SALT = isset($_SESSION['LOGGED_IN_SALT']) ? prepare_input($_SESSION['LOGGED_IN_SALT']) : '';
		$NONCE_SALT = isset($_SESSION['NONCE_SALT']) ? prepare_input($_SESSION['NONCE_SALT']) : '';

	}
?>	

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="ApPHP Company - Advanced Power of PHP">
    <meta name="generator" content="ApPHP EasyInstaller">
	<title><?php echo lang_key("installation_guide"); ?> | System Settings</title>

	<link href="../images/favicon.ico" rel="shortcut icon" />
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
			draw_side_navigation(5);		
		?>
		<div class="central-part">
			<h2><?php echo lang_key('step_5_of'); ?> - Core Application Settings</h2>
			<h3><?php echo lang_key('core_configuration'); ?></h3>

			<form action="core_configuration.php" method="post">
			<input type="hidden" name="task" value="send" />
			<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
			
			<?php
				if(!empty($error_msg)){
					echo '<div class="alert alert-error">'.$error_msg.'</div>';
				}
			?>

			<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr>
				<td colspan="3"><span class="star">*</span> <?php echo lang_key('alert_required_fields'); ?></td>
			</tr>
			<tr><td nowrap height="10px" colspan="3"></td></tr>
			<tr>
				<td width="250px">&nbsp;<?php echo lang_key('COMMUNITY_NAME'); ?>&nbsp;<span class="star">*</span></td>
				<td><input name="COMMUNITY_NAME" id="COMMUNITY_NAME" class="form_text" size="28" maxlength="22" value="<?php echo $COMMUNITY_NAME; ?>" onfocus="textboxOnFocus('COMMUNITY_NAME_notes')" onblur="textboxOnBlur('COMMUNITY_NAME_notes')" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> placeholder="<?php if(EI_MODE == 'demo') echo 'demo: test'; ?>" /></td>
				<td rowspan="6" valign="top">					
					<div id="API_SECURITY_notes" class="notes_container">
						<h4><?php echo lang_key('API_SECURITY'); ?></h4>
						<p><?php echo lang_key('API_SECURITY_notes'); ?></p>
					</div>
					<div id="COMMUNITY_NAME_notes" class="notes_container">
						<h4><?php echo lang_key('COMMUNITY_NAME'); ?></h4>
						<p><?php echo lang_key('COMMUNITY_NAME_notes'); ?></p>
					</div>
					<div id="BASE_URL_notes" class="notes_container">
						<h4><?php echo lang_key('BASE_URL'); ?></h4>
						<p><?php echo lang_key('BASE_URL_notes'); ?></p>
					</div>
					<div id="API_SECURITY_notes" class="notes_container">
						<h4><?php echo lang_key('API_SECURITY_URL'); ?></h4>
						<p><?php echo lang_key('API_SECURITY_notes'); ?></p>
					</div>
					
					<img class="loading_img" src="images/ajax_loading.gif" alt="<?php echo lang_key('loading'); ?>..." />
					<div id="notes_message" class="notes_container"></div>					
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('BASE_URL'); ?>&nbsp;<span class="star">*</span></td>
				<td><input name="BASE_URL" id="BASE_URL" class="form_text" size="28" maxlength="200" value="<?php echo $BASE_URL; ?>" onfocus="textboxOnFocus('BASE_URL_notes')" onblur="textboxOnBlur('BASE_URL_notes')" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> placeholder="<?php if(EI_MODE == 'demo') echo 'demo: test'; ?>" /></td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('API_SECURITY'); ?>&nbsp;</td>
				<td><input type="radio" name="API_SECURITY" id="API_SECURITY" <?php echo ($API_SECURITY=='true')?'checked':'' ?> onfocus="textboxOnFocus('POLICE_NCIC_notes')" onblur="textboxOnBlur('POLICE_NCIC_notes')" value="true" />True
				<input type="radio" name="API_SECURITY" id="API_SECURITY" <?php echo ($API_SECURITY=='false')?'checked':'' ?> onfocus="textboxOnFocus('POLICE_NCIC_notes')" checked onblur="textboxOnBlur('POLICE_NCIC_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="50px">&nbsp;</td></tr>
			<tr>
				<td colspan="2">
					<a href="administrator_account.php" class="form_button" /><?php echo lang_key('back'); ?></a>
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
	}	
</script>
</body>
</html>
