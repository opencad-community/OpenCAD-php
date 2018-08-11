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

		$COMMUNITY_NAME = isset($_POST['COMMUNITY_NAME']) ? prepare_input($_POST['COMMUNITY_NAME']) : '';
		
		$BASE_URL = isset($_POST['BASE_URL']) ? prepare_input($_POST['BASE_URL']) : '';
		
		$CAD_FROM_EMAILL = isset($_POST['CAD_FROM_EMAIL']) ? prepare_input($_POST['CAD_FROM_EMAIL']) : '';
		$CAD_FROM_NAME = isset($_POST['CAD_FROM_NAME']) ? prepare_input($_POST['CAD_FROM_NAME']) : '';
		$CAD_TO_EMAIL = isset($_POST['CAD_TO_EMAIL']) ? prepare_input($_POST['CAD_TO_EMAIL']) : '';
		$CAD_TO_NAME = isset($_POST['CAD_TO_NAME']) ? prepare_input($_POST['CAD_TO_NAME']) : '';
		
		$AUTH_KEY = isset($_POST['AUTH_KEY']) ? prepare_input($_POST['AUTH_KEY']) : '';
		$SECURE_AUTH_KEY = isset($_POST['SECURE_AUTH_KEY']) ? prepare_input($_POST['SECURE_AUTH_KEY']) : '';
		$LOGGED_IN_KEY = isset($_POST['LOGGED_IN_KEY']) ? prepare_input($_POST['LOGGED_IN_KEY']) : '';
		$NONCE_KEY = isset($_POST['NONCE_KEY']) ? prepare_input($_POST['NONCE_KEY']) : '';
		$AUTH_SALT = isset($_POST['AUTH_SALT']) ? prepare_input($_POST['AUTH_SALT']) : '';
		$SECURE_AUTH_SALT = isset($_POST['SECURE_AUTH_SALT']) ? prepare_input($_POST['SECURE_AUTH_SALT']) : '';
		$LOGGED_IN_SALT = isset($_POST['LOGGED_IN_SALT']) ? prepare_input($_POST['LOGGED_IN_SALT']) : '';
		$NONCE_SALT = isset($_POST['NONCE_SALT']) ? prepare_input($_POST['NONCE_SALT']) : '';
		
		$POLICE_NCIC = isset($_POST['POLICE_NCIC']) ? prepare_input($_POST['POLICE_NCIC']) : '';
		
		$FIRE_PANIC = isset($_POST['FIRE_PANIC']) ? prepare_input($_POST['FIRE_PANIC']) : '';
		$FIRE_BOLO = isset($_POST['FIRE_BOLO']) ? prepare_input($_POST['FIRE_BOLO']) : '';
		$FIRE_NCIC_NAME = isset($_POST['FIRE_NCIC_NAME']) ? prepare_input($_POST['FIRE_NCIC_NAME']) : '';
		$FIRE_NCIC_PLATE = isset($_POST['FIRE_NCIC_PLATE']) ? prepare_input($_POST['FIRE_NCIC_PLATE']) : '';
		
		$EMS_PANIC = isset($_POST['EMS_PANIC']) ? prepare_input($_POST['EMS_PANIC']) : '';
		$EMS_BOLO = isset($_POST['EMS_BOLO']) ? prepare_input($_POST['EMS_BOLO']) : '';
		$EMS_NCIC_NAME = isset($_POST['EMS_NCIC_NAME']) ? prepare_input($_POST['EMS_NCIC_NAME']) : '';
		$EMS_NCIC_PLATE = isset($_POST['EMS_NCIC_PLATE']) ? prepare_input($_POST['EMS_NCIC_PLATE']) : '';
		
		$ROADSIDE_PANIC = isset($_POST['ROADSIDE_PANIC']) ? prepare_input($_POST['ROADSIDE_PANIC']) : '';
		$ROADSIDE_BOLO = isset($_POST['ROADSIDE_BOLO']) ? prepare_input($_POST['ROADSIDE_BOLO']) : '';
		$ROADSIDE_NCIC_NAME = isset($_POST['ROADSIDE_NCIC_NAME']) ? prepare_input($_POST['ROADSIDE_NCIC_NAME']) : '';
		$ROADSIDE_NCIC_PLATE = isset($_POST['ROADSIDE_NCIC_PLATE']) ? prepare_input($_POST['ROADSIDE_NCIC_PLATE']) : '';
		
		$CIV_WARRANT = isset($_POST['CIV_WARRANT']) ? prepare_input($_POST['CIV_WARRANT']) : '';
		$CIV_REG = isset($_POST['CIV_REG']) ? prepare_input($_POST['CIV_REG']) : '';
		
		$USE_GRAVATAR = isset($_POST['USE_GRAVATAR']) ? prepare_input($_POST['USE_GRAVATAR']) : '';
		
				$_SESSION['COMMUNITY_NAME'] = $COMMUNITY_NAME;
				$_SESSION['BASE_URL'] = $BASE_URL;
				
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
				
				$_SESSION['POLICE_NCIC'] = $POLICE_NCIC;
				
				$_SESSION['FIRE_PANIC'] = $FIRE_PANIC;		
				$_SESSION['FIRE_BOLO'] = $FIRE_BOLO;		
				$_SESSION['FIRE_NCIC_NAME'] = $FIRE_NCIC_NAME;		
				$_SESSION['FIRE_NCIC_PLATE'] = $FIRE_NCIC_PLATE;
				
				$_SESSION['EMS_PANIC'] = $EMS_PANIC;		
				$_SESSION['EMS_BOLO'] = $EMS_BOLO;		
				$_SESSION['EMS_NCIC_NAME'] = $EMS_NCIC_NAME;		
				$_SESSION['EMS_NCIC_PLATE'] = $EMS_NCIC_PLATE;
				
				$_SESSION['ROADSIDE_PANIC'] = $ROADSIDE_PANIC;		
				$_SESSION['ROADSIDE_BOLO'] = $ROADSIDE_BOLO;		
				$_SESSION['ROADSIDE_NCIC_NAME'] = $ROADSIDE_NCIC_NAME;		
				$_SESSION['ROADSIDE_NCIC_PLATE'] = $ROADSIDE_NCIC_PLATE;
				
				$_SESSION['CIV_WARRANT'] = $CIV_WARRANT;		
				$_SESSION['CIV_REG'] = $CIV_REG;	
				
				$_SESSION['USE_GRAVATAR'] = $USE_GRAVATAR;		

				$_SESSION['passed_step'] = 5;
				header('location: ready_to_install.php');
				exit;

	}else{
	    		$COMMUNITY_NAME = isset($_SESSION['COMMUNITY_NAME']) ? prepare_input($_SESSION['COMMUNITY_NAME']) : '';
		
		$BASE_URL = isset($_SESSION['BASE_URL']) ? prepare_input($_SESSION['BASE_URL']) : '';
		
		$CAD_FROM_EMAILL = isset($_SESSION['CAD_FROM_EMAIL']) ? prepare_input($_SESSION['CAD_FROM_EMAIL']) : '';
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
		
		$POLICE_NCIC = isset($_SESSION['POLICE_NCIC']) ? prepare_input($_SESSION['POLICE_NCIC']) : '';
		
		$FIRE_PANIC = isset($_SESSION['FIRE_PANIC']) ? prepare_input($_SESSION['FIRE_PANIC']) : '';
		$FIRE_BOLO = isset($_SESSION['FIRE_BOLO']) ? prepare_input($_SESSION['FIRE_BOLO']) : '';
		$FIRE_NCIC_NAME = isset($_SESSION['FIRE_NCIC_NAME']) ? prepare_input($_SESSION['FIRE_NCIC_NAME']) : '';
		$FIRE_NCIC_PLATE = isset($_SESSION['FIRE_NCIC_PLATE']) ? prepare_input($_SESSION['FIRE_NCIC_PLATE']) : '';
		
		$EMS_PANIC = isset($_SESSION['EMS_PANIC']) ? prepare_input($_SESSION['EMS_PANIC']) : '';
		$EMS_BOLO = isset($_SESSION['EMS_BOLO']) ? prepare_input($_SESSION['EMS_BOLO']) : '';
		$EMS_NCIC_NAME = isset($_SESSION['EMS_NCIC_NAME']) ? prepare_input($_SESSION['EMS_NCIC_NAME']) : '';
		$EMS_NCIC_PLATE = isset($_SESSION['EMS_NCIC_PLATE']) ? prepare_input($_SESSION['EMS_NCIC_PLATE']) : '';
		
		$ROADSIDE_PANIC = isset($_SESSION['ROADSIDE_PANIC']) ? prepare_input($_SESSION['ROADSIDE_PANIC']) : '';
		$ROADSIDE_BOLO = isset($_SESSION['ROADSIDE_BOLO']) ? prepare_input($_SESSION['ROADSIDE_BOLO']) : '';
		$ROADSIDE_NCIC_NAME = isset($_SESSION['ROADSIDE_NCIC_NAME']) ? prepare_input($_SESSION['ROADSIDE_NCIC_NAME']) : '';
		$ROADSIDE_NCIC_PLATE = isset($_SESSION['ROADSIDE_NCIC_PLATE']) ? prepare_input($_SESSION['ROADSIDE_NCIC_PLATE']) : '';
		
		$CIV_WARRANT = isset($_SESSION['CIV_WARRANT']) ? prepare_input($_SESSION['CIV_WARRANT']) : '';
		$CIV_REG = isset($_SESSION['CIV_REG']) ? prepare_input($_SESSION['CIV_REG']) : '';
		
		$USE_GRAVATAR = isset($_SESSION['USE_GRAVATAR']) ? prepare_input($_SESSION['USE_GRAVATAR']) : '';
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
			<h2><?php echo lang_key('step_5_of'); ?> - System Settings</h2>
			<h3><?php echo lang_key('admin_access_data'); ?></h3>

			<form action="options.php" method="post">
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
					<div id="POLICE_NCIC_notes" class="notes_container">
						<h4><?php echo lang_key('POLICE_NCIC'); ?></h4>
						<p><?php echo lang_key('POLICE_NCIC_notes'); ?></p>
					</div>
					<div id="COMMUNITY_NAME_notes" class="notes_container">
						<h4><?php echo lang_key('COMMUNITY_NAME'); ?></h4>
						<p><?php echo lang_key('COMMUNITY_NAME_notes'); ?></p>
					</div>
					<div id="BASE_URL_notes" class="notes_container">
						<h4><?php echo lang_key('BASE_URL'); ?></h4>
						<p><?php echo lang_key('BASE_URL_notes'); ?></p>
					</div>
					
					<div id="FIRE_PANIC_notes" class="notes_container">
						<h4><?php echo lang_key('FIRE_PANIC'); ?></h4>
						<p><?php echo lang_key('FIRE_PANIC_notes'); ?></p>
					</div>
					<div id="FIRE_NCIC_NAME_notes" class="notes_container">
						<h4><?php echo lang_key('FIRE_NCIC_NAME'); ?></h4>
						<p><?php echo lang_key('FIRE_NCIC_NAME_notes'); ?></p>
					</div>
					<div id="FIRE_BOLO_notes" class="notes_container">
						<h4><?php echo lang_key('FIRE_BOLO'); ?></h4>
						<p><?php echo lang_key('FIRE_BOLO_notes'); ?></p>
					</div>
					<div id="FIRE_NCIC_PLATE_notes" class="notes_container">
						<h4><?php echo lang_key('FIRE_NCIC_PLATE'); ?></h4>
						<p><?php echo lang_key('FIRE_NCIC_PLATE_notes'); ?></p>
					</div>
					
					<div id="EMS_PANIC_notes" class="notes_container">
						<h4><?php echo lang_key('EMS_PANIC'); ?></h4>
						<p><?php echo lang_key('EMS_PANIC_notes'); ?></p>
					</div>
					<div id="EMS_BOLO_notes" class="notes_container">
						<h4><?php echo lang_key('EMS_BOLO'); ?></h4>
						<p><?php echo lang_key('EMS_BOLO_notes'); ?></p>
					</div>
					<div id="EMS_NCIC_NAME_notes" class="notes_container">
						<h4><?php echo lang_key('EMS_NCIC_NAME'); ?></h4>
						<p><?php echo lang_key('EMS_NCIC_NAME_notes'); ?></p>
					</div>
					<div id="EMS_NCIC_PLATE_notes" class="notes_container">
						<h4><?php echo lang_key('EMS_NCIC_PLATE'); ?></h4>
						<p><?php echo lang_key('EMS_NCIC_PLATE_notes'); ?></p>
					</div>
					
					<div id="ROADSIDE_PANIC_notes" class="notes_container">
						<h4><?php echo lang_key('ROADSIDE_PANIC'); ?></h4>
						<p><?php echo lang_key('ROADSIDE_PANIC_notes'); ?></p>
					</div>
					<div id="ROADSIDE_BOLO_notes" class="notes_container">
						<h4><?php echo lang_key('ROADSIDE_BOLO'); ?></h4>
						<p><?php echo lang_key('ROADSIDE_BOLO_notes'); ?></p>
					</div>
					<div id="ROADSIDE_NCIC_NAME_notes" class="notes_container">
						<h4><?php echo lang_key('ROADSIDE_NCIC_NAME'); ?></h4>
						<p><?php echo lang_key('ROADSIDE_NCIC_NAME_notes'); ?></p>
					</div>
					<div id="ROADSIDE_NCIC_PLATE_notes" class="notes_container">
						<h4><?php echo lang_key('ROADSIDE_NCIC_PLATE'); ?></h4>
						<p><?php echo lang_key('ROADSIDE_NCIC_PLATE_notes'); ?></p>
					</div>
					
					<div id="CIV_WARRANT_notes" class="notes_container">
						<h4><?php echo lang_key('CIV_WARRANT'); ?></h4>
						<p><?php echo lang_key('CIV_WARRANT_notes'); ?></p>
					</div>
					<div id="CIV_REG_notes" class="notes_container">
						<h4><?php echo lang_key('CIV_REG'); ?></h4>
						<p><?php echo lang_key('CIV_REG_notes'); ?></p>
					</div>
					
					<div id="USE_GRAVATAR_notes" class="notes_container">
						<h4><?php echo lang_key('USE_GRAVATAR'); ?></h4>
						<p><?php echo lang_key('USE_GRAVATAR_notes'); ?></p>
					</div>
					
					<img class="loading_img" src="images/ajax_loading.gif" alt="<?php echo lang_key('loading'); ?>..." />
					<div id="notes_message" class="notes_container"></div>					
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('BASE_URL'); ?>&nbsp;<span class="star">*</span></td>
				<td>http(s)://<input name="BASE_URL" id="BASE_URL" class="form_text" size="20" maxlength="22" value="<?php echo $BASE_URL; ?>" onfocus="textboxOnFocus('BASE_URL_notes')" onblur="textboxOnBlur('BASE_URL_notes')" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> placeholder="<?php if(EI_MODE == 'demo') echo 'demo: test'; ?>" /></td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('POLICE_NCIC'); ?>&nbsp;</td>
				<td><input type="radio" name="POLICE_NCIC" id="POLICE_NCIC" <?php echo ($POLICE_NCIC=='true')?'checked':'' ?> onfocus="textboxOnFocus('POLICE_NCIC_notes')" onblur="textboxOnBlur('POLICE_NCIC_notes')" value="true" />True
				<input type="radio" name="POLICE_NCIC" id="POLICE_NCIC" <?php echo ($POLICE_NCIC=='false')?'checked':'' ?> onfocus="textboxOnFocus('POLICE_NCIC_notes')" checked onblur="textboxOnBlur('POLICE_NCIC_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_PANIC'); ?>&nbsp;</td>
				<td><input type="radio" name="FIRE_PANIC" id="FIRE_PANIC" <?php echo ($FIRE_PANIC=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_PANIC_notes')" onblur="textboxOnBlur('FIRE_PANIC_notes')" value="true" />True
				<input type="radio" name="FIRE_PANIC" id="FIRE_PANIC" <?php echo ($FIRE_PANIC=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_PANIC_notes')" checked onblur="textboxOnBlur('FIRE_PANIC_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_BOLO'); ?>&nbsp;</td>
				<td><input type="radio" name="FIRE_BOLO" id="FIRE_BOLO" <?php echo ($FIRE_BOLO=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_BOLO_notes')" onblur="textboxOnBlur('FIRE_BOLO_notes')" value="true" />True
				<input type="radio" name="FIRE_BOLO" id="FIRE_BOLO" <?php echo ($FIRE_BOLO=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_BOLO_notes')" checked onblur="textboxOnBlur('FIRE_BOLO_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_NCIC_NAME'); ?>&nbsp;</td>
				<td><input type="radio" name="FIRE_NCIC_NAME" id="FIRE_NCIC_NAME" <?php echo ($FIRE_NCIC_NAME=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_NCIC_NAME_notes')" onblur="textboxOnBlur('FIRE_NCIC_NAME_notes')" value="true" />True
				<input type="radio" name="FIRE_NCIC_NAME" id="FIRE_NCIC_NAME" <?php echo ($FIRE_NCIC_NAME=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_NCIC_NAME_notes')" checked onblur="textboxOnBlur('FIRE_NCIC_NAME_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_NCIC_PLATE'); ?>&nbsp;</td>
				<td><input type="radio" name="FIRE_NCIC_PLATE" id="FIRE_NCIC_PLATE" <?php echo ($FIRE_NCIC_PLATE=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_NCIC_PLATE_notes')" onblur="textboxOnBlur('FIRE_NCIC_PLATE_notes')" value="true" />True
				<input type="radio" name="FIRE_NCIC_PLATE" id="FIRE_NCIC_PLATE" <?php echo ($FIRE_NCIC_PLATE=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_NCIC_PLATE_notes')" checked onblur="textboxOnBlur('FIRE_NCIC_PLATE_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('EMS_PANIC'); ?>&nbsp;</td>
				<td><input type="radio" name="EMS_PANIC" id="EMS_PANIC" <?php echo ($EMS_PANIC=='true')?'checked':'' ?> onfocus="textboxOnFocus('EMS_PANIC_notes')" onblur="textboxOnBlur('EMS_PANIC_notes')" value="true" />True
				<input type="radio" name="EMS_PANIC" id="EMS_PANIC" <?php echo ($EMS_PANIC=='false')?'checked':'' ?> onfocus="textboxOnFocus('EMS_PANIC_notes')" checked onblur="textboxOnBlur('EMS_PANIC_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('EMS_BOLO'); ?>&nbsp;</td>
				<td><input type="radio" name="EMS_BOLO" id="EMS_BOLO" <?php echo ($EMS_BOLO=='true')?'checked':'' ?> onfocus="textboxOnFocus('EMS_BOLO_notes')" onblur="textboxOnBlur('EMS_BOLO_notes')" value="true" />True
				<input type="radio" name="EMS_BOLO" id="EMS_BOLO" <?php echo ($EMS_BOLO=='false')?'checked':'' ?> onfocus="textboxOnFocus('EMS_BOLO_notes')" checked onblur="textboxOnBlur('EMS_BOLO_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('EMS_NCIC_NAME'); ?>&nbsp;</td>
				<td><input type="radio" name="EMS_NCIC_NAME" id="EMS_NCIC_NAME" <?php echo ($EMS_NCIC_NAME=='true')?'checked':'' ?> onfocus="textboxOnFocus('EMS_NCIC_NAME_notes')" onblur="textboxOnBlur('EMS_NCIC_NAME_notes')" value="true" />True
				<input type="radio" name="EMS_NCIC_NAME" id="EMS_NCIC_NAME" <?php echo ($EMS_NCIC_NAME=='false')?'checked':'' ?> onfocus="textboxOnFocus('EMS_NCIC_NAME_notes')" checked onblur="textboxOnBlur('EMS_NCIC_NAME_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('EMS_NCIC_PLATE'); ?>&nbsp;</td>
				<td><input type="radio" name="EMS_NCIC_PLATE" id="EMS_NCIC_PLATE" <?php echo ($EMS_NCIC_PLATE=='true')?'checked':'' ?> onfocus="textboxOnFocus('EMS_NCIC_PLATE_notes')" onblur="textboxOnBlur('EMS_NCIC_PLATE_notes')" value="true" />True
				<input type="radio" name="EMS_NCIC_PLATE" id="EMS_NCIC_PLATE" <?php echo ($EMS_NCIC_PLATE=='false')?'checked':'' ?> onfocus="textboxOnFocus('EMS_NCIC_PLATE_notes')" checked onblur="textboxOnBlur('EMS_NCIC_PLATE_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('ROADSIDE_PANIC'); ?>&nbsp;</td>
				<td><input type="radio" name="ROADSIDE_PANIC" id="ROADSIDE_PANIC" <?php echo ($ROADSIDE_PANIC=='true')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_PANIC_notes')" onblur="textboxOnBlur('ROADSIDE_PANIC_notes')" value="true" />True
				<input type="radio" name="ROADSIDE_PANIC" id="ROADSIDE_PANIC" <?php echo ($ROADSIDE_PANIC=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_PANIC_notes')" checked onblur="textboxOnBlur('ROADSIDE_PANIC_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('ROADSIDE_BOLO'); ?>&nbsp;</td>
				<td><input type="radio" name="ROADSIDE_BOLO" id="ROADSIDE_BOLO" <?php echo ($ROADSIDE_BOLO=='true')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_BOLO_notes')" onblur="textboxOnBlur('ROADSIDE_BOLO_notes')" value="true" />True
				<input type="radio" name="ROADSIDE_BOLO" id="ROADSIDE_BOLO" <?php echo ($ROADSIDE_BOLO=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_BOLO_notes')" checked onblur="textboxOnBlur('ROADSIDE_BOLO_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('ROADSIDE_NCIC_NAME'); ?>&nbsp;</td>
				<td><input type="radio" name="ROADSIDE_NCIC_NAME" id="ROADSIDE_NCIC_NAME" <?php echo ($ROADSIDE_NCIC_NAME=='true')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_NCIC_NAME_notes')" onblur="textboxOnBlur('ROADSIDE_NCIC_NAME_notes')" value="true" />True
				<input type="radio" name="ROADSIDE_NCIC_NAME" id="ROADSIDE_NCIC_NAME" <?php echo ($ROADSIDE_NCIC_NAME=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_NCIC_NAME_notes')" checked onblur="textboxOnBlur('ROADSIDE_NCIC_NAME_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('ROADSIDE_NCIC_PLATE'); ?>&nbsp;</td>
				<td><input type="radio" name="ROADSIDE_NCIC_PLATE" id="ROADSIDE_NCIC_PLATE" <?php echo ($ROADSIDE_NCIC_PLATE=='true')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_NCIC_PLATE_notes')" onblur="textboxOnBlur('ROADSIDE_NCIC_PLATE_notes')" value="true" />True
				<input type="radio" name="ROADSIDE_NCIC_PLATE" id="ROADSIDE_NCIC_PLATE" <?php echo ($ROADSIDE_NCIC_PLATE=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_NCIC_PLATE_notes')" checked onblur="textboxOnBlur('ROADSIDE_NCIC_PLATE_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('CIV_WARRANT'); ?>&nbsp;</td>
				<td><input type="radio" name="CIV_WARRANT" id="CIV_WARRANT" <?php echo ($CIV_WARRANT=='true')?'checked':'' ?> onfocus="textboxOnFocus('CIV_WARRANT_notes')" onblur="textboxOnBlur('CIV_WARRANT_notes')" value="true" />True
				<input type="radio" name="CIV_WARRANT" id="CIV_WARRANT" <?php echo ($CIV_WARRANT=='false')?'checked':'' ?> onfocus="textboxOnFocus('CIV_WARRANT_notes')" checked onblur="textboxOnBlur('CIV_WARRANT_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('CIV_REG'); ?>&nbsp;</td>
				<td><input type="radio" name="CIV_REG" id="CIV_REG" <?php echo ($CIV_REG=='true')?'checked':'' ?> onfocus="textboxOnFocus('CIV_REG_notes')" onblur="textboxOnBlur('CIV_REG_notes')" value="true" />True
				<input type="radio" name="CIV_REG" id="CIV_REG" <?php echo ($CIV_REG=='false')?'checked':'' ?> onfocus="textboxOnFocus('CIV_REG_notes')" checked onblur="textboxOnBlur('CIV_REG_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('USE_GRAVATAR'); ?>&nbsp;</td>
				<td><input type="radio" name="USE_GRAVATAR" id="USE_GRAVATAR" <?php echo ($USE_GRAVATAR=='true')?'checked':'' ?> onfocus="textboxOnFocus('USE_GRAVATAR_notes')" checked onblur="textboxOnBlur('USE_GRAVATAR_notes')" value="true" />True
				<input type="radio" name="USE_GRAVATAR" id="USE_GRAVATAR" <?php echo ($USE_GRAVATAR=='false')?'checked':'' ?> onfocus="textboxOnFocus('USE_GRAVATAR_notes')"  onblur="textboxOnBlur('USE_GRAVATAR_notes')" value="false" />False</td>
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
