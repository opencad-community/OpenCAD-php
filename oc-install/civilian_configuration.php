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
	if($passed_step >= 6){
		// OK
	}else{
		header('location: start.php');
		exit;				
	}
	
	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){

		$ROADSIDE_PANIC = isset($_POST['ROADSIDE_PANIC']) ? prepare_input($_POST['ROADSIDE_PANIC']) : '';
		$ROADSIDE_BOLO = isset($_POST['ROADSIDE_BOLO']) ? prepare_input($_POST['ROADSIDE_BOLO']) : '';
        $ROADSIDE_NCIC_NAME = isset($_POST['ROADSIDE_NCIC_NAME']) ? prepare_input($_POST['ROADSIDE_NCIC_NAME']) : '';
        $ROADSIDE_NCIC_PLATE = isset($_POST['ROADSIDE_NCIC_PLATE']) ? prepare_input($_POST['ROADSIDE_NCIC_PLATE']) : '';
        $ROADSIDE_CALL_SELFASSIGN = isset($_POST['ROADSIDE_CALL_SELFASSIGN']) ? prepare_input($_POST['ROADSIDE_CALL_SELFASSIGN']) : '';

		$CIV_WARRANT = isset($_POST['CIV_WARRANT']) ? prepare_input($_POST['CIV_WARRANT']) : '';
		$CIV_REG = isset($_POST['CIV_REG']) ? prepare_input($_POST['CIV_REG']) : '';
		$CIV_REG = isset($_POST['CIV_REG']) ? prepare_input($_POST['CIV_REG']) : '';
		$CIV_LIMIT_MAX_IDENTITIES = isset($_POST['CIV_LIMIT_MAX_IDENTITIES']) ? prepare_input($_POST['CIV_LIMIT_MAX_IDENTITIES']) : '';
		$CIV_LIMIT_MAX_VEHICLES = isset($_POST['CIV_LIMIT_MAX_VEHICLES']) ? prepare_input($_POST['CIV_LIMIT_MAX_VEHICLES']) : '';
		$CIV_LIMIT_MAX_WEAPONS = isset($_POST['CIV_LIMIT_MAX_WEAPONS']) ? prepare_input($_POST['CIV_LIMIT_MAX_WEAPONS']) : '';
		
		$_SESSION['ROADSIDE_PANIC'] = $ROADSIDE_PANIC;
		$_SESSION['ROADSIDE_BOLO'] = $ROADSIDE_BOLO;
		$_SESSION['ROADSIDE_NCIC_NAME'] = $ROADSIDE_NCIC_NAME;			
		$_SESSION['ROADSIDE_NCIC_PLATE'] = $ROADSIDE_NCIC_PLATE;			
		$_SESSION['ROADSIDE_CALL_SELFASSIGN'] = $ROADSIDE_CALL_SELFASSIGN;
		
		$_SESSION['CIV_WARRANT'] = $CIV_WARRANT;
		$_SESSION['CIV_REG'] = $CIV_REG;
		$_SESSION['CIV_LIMIT_MAX_IDENTITIES'] = $CIV_LIMIT_MAX_IDENTITIES;
		$_SESSION['CIV_LIMIT_MAX_VEHICLES'] = $CIV_LIMIT_MAX_VEHICLES;
		$_SESSION['CIV_LIMIT_MAX_WEAPONS'] = $CIV_LIMIT_MAX_WEAPONS;

		$_SESSION['passed_step'] = 7;
		header('location: administrative_configuration.php');
		exit;

	}else{

		$ROADSIDE_PANIC = isset($_POST['ROADSIDE_PANIC']) ? prepare_input($_POST['ROADSIDE_PANIC']) : '';
		$ROADSIDE_BOLO = isset($_POST['ROADSIDE_BOLO']) ? prepare_input($_POST['ROADSIDE_BOLO']) : '';
        $ROADSIDE_NCIC_NAME = isset($_POST['ROADSIDE_NCIC_NAME']) ? prepare_input($_POST['ROADSIDE_NCIC_NAME']) : '';
        $ROADSIDE_NCIC_PLATE = isset($_POST['ROADSIDE_NCIC_PLATE']) ? prepare_input($_POST['ROADSIDE_NCIC_PLATE']) : '';
        $ROADSIDE_CALL_SELFASSIGN = isset($_POST['ROADSIDE_CALL_SELFASSIGN']) ? prepare_input($_POST['ROADSIDE_CALL_SELFASSIGN']) : '';

		$CIV_WARRANT = isset($_POST['CIV_WARRANT']) ? prepare_input($_POST['CIV_WARRANT']) : '';
		$CIV_REG = isset($_POST['CIV_REG']) ? prepare_input($_POST['CIV_REG']) : '';
		$CIV_LIMIT_MAX_IDENTITIES = isset($_POST['CIV_LIMIT_MAX_IDENTITIES']) ? prepare_input($_POST['CIV_LIMIT_MAX_IDENTITIES']) : '';
		$CIV_LIMIT_MAX_VEHICLES = isset($_POST['CIV_LIMIT_MAX_VEHICLES']) ? prepare_input($_POST['CIV_LIMIT_MAX_VEHICLES']) : '';
		$CIV_LIMIT_MAX_WEAPONS = isset($_POST['CIV_LIMIT_MAX_WEAPONS']) ? prepare_input($_POST['CIV_LIMIT_MAX_WEAPONS']) : '';

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
			draw_side_navigation(7);		
		?>
		<div class="central-part">
			<h2><?php echo lang_key('step_7_of'); ?> - Civilian Settings</h2>
			<h3><?php echo lang_key('civilian_configuration'); ?></h3>

			<form action="civilian_configuration.php" method="post">
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
				<td width="250px">&nbsp;<?php echo lang_key('ROADSIDE_PANIC'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="ROADSIDE_PANIC" id="ROADSIDE_PANIC" <?php echo ($ROADSIDE_PANIC=='true')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_PANIC_notes')" checked onblur="textboxOnBlur('ROADSIDE_PANIC_notes')" value="true" />True
					<input type="radio" name="ROADSIDE_PANIC" id="ROADSIDE_PANIC" <?php echo ($ROADSIDE_PANIC=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_PANIC_notes')" onblur="textboxOnBlur('ROADSIDE_PANIC_notes')" value="false" />False
				</td>
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
					<div id="API_SECURITY_notes" class="notes_container">
						<h4><?php echo lang_key('API_SECURITY_URL'); ?></h4>
						<p><?php echo lang_key('API_SECURITY_notes'); ?></p>
					</div>
					
					<div id="FIRE_PANIC_notes" class="notes_container">
						<h4><?php echo lang_key('FIRE_PANIC'); ?></h4>
						<p><?php echo lang_key('FIRE_PANIC_notes'); ?></p>
					</div>
					
					<img class="loading_img" src="images/ajax_loading.gif" alt="<?php echo lang_key('loading'); ?>..." />
					<div id="notes_message" class="notes_container"></div>					
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('ROADSIDE_BOLO'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="ROADSIDE_BOLO" id="ROADSIDE_BOLO" <?php echo ($ROADSIDE_BOLO=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('ROADSIDE_BOLO_notes')" onblur="textboxOnBlur('ROADSIDE_BOLO_notes')" value="true" />True
					<input type="radio" name="ROADSIDE_BOLO" id="ROADSIDE_BOLO" <?php echo ($ROADSIDE_BOLO=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_BOLO_notes')" onblur="textboxOnBlur('ROADSIDE_BOLO_notes')" value="false" />False
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('ROADSIDE_NCIC_NAME'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="ROADSIDE_NCIC_NAME" id="ROADSIDE_NCIC_NAME" <?php echo ($ROADSIDE_NCIC_NAME=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('ROADSIDE_NCIC_NAME_notes')" onblur="textboxOnBlur('ROADSIDE_NCIC_NAME_notes')" value="true" />True
					<input type="radio" name="ROADSIDE_NCIC_NAME" id="ROADSIDE_NCIC_NAME" <?php echo ($ROADSIDE_NCIC_NAME=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_NCIC_NAME_notes')" onblur="textboxOnBlur('ROADSIDE_NCIC_NAME_notes')" value="false" />False
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('ROADSIDE_NCIC_PLATE'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="ROADSIDE_NCIC_PLATE" id="ROADSIDE_NCIC_PLATE" <?php echo ($ROADSIDE_NCIC_PLATE=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('ROADSIDE_NCIC_PLATE_notes')" onblur="textboxOnBlur('ROADSIDE_NCIC_PLATE_notes')" value="true" />True
					<input type="radio" name="ROADSIDE_NCIC_PLATE" id="ROADSIDE_NCIC_PLATE" <?php echo ($ROADSIDE_NCIC_PLATE=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_NCIC_PLATE_notes')" onblur="textboxOnBlur('ROADSIDE_NCIC_PLATE_notes')" value="false" />False
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('ROADSIDE_CALL_SELFASSIGN'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="ROADSIDE_CALL_SELFASSIGN" id="ROADSIDE_CALL_SELFASSIGN" <?php echo ($ROADSIDE_CALL_SELFASSIGN=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('ROADSIDE_CALL_SELFASSIGN_notes')" onblur="textboxOnBlur('ROADSIDE_CALL_SELFASSIGN_notes')" value="true" />True
					<input type="radio" name="ROADSIDE_CALL_SELFASSIGN" id="ROADSIDE_CALL_SELFASSIGN" <?php echo ($ROADSIDE_CALL_SELFASSIGN=='false')?'checked':'' ?> onfocus="textboxOnFocus('ROADSIDE_CALL_SELFASSIGN_notes')" onblur="textboxOnBlur('ROADSIDE_CALL_SELFASSIGN_notes')" value="false" />False
				</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('CIV_WARRANT'); ?>&nbsp;</td>
					<td>
						<input type="radio" name="CIV_WARRANT" id="CIV_WARRANT" <?php echo ($CIV_WARRANT=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('CIV_WARRANT_notes')" onblur="textboxOnBlur('CIV_WARRANT_notes')" value="true" />True
						<input type="radio" name="CIV_WARRANT" id="CIV_WARRANT" <?php echo ($CIV_WARRANT=='false')?'checked':'' ?> onfocus="textboxOnFocus('CIV_WARRANT_notes')" onblur="textboxOnBlur('CIV_WARRANT_notes')" value="false" />False
					</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('CIV_REG'); ?>&nbsp;</td>
				<td><input type="radio" name="CIV_REG" id="CIV_REG" <?php echo ($CIV_REG=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('CIV_REG_notes')" onblur="textboxOnBlur('CIV_REG_notes')" value="true" />True
				<input type="radio" name="CIV_REG" id="CIV_REG" <?php echo ($CIV_REG=='false')?'checked':'' ?> onfocus="textboxOnFocus('CIV_REG_notes')" onblur="textboxOnBlur('CIV_REG_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('CIV_LIMIT_MAX_IDENTITIES'); ?>&nbsp;</td>
				<td><input name="CIV_LIMIT_MAX_IDENTITIES" id="CIV_LIMIT_MAX_IDENTITIES" value="0" class="form_text" size="28" maxlength="200" value="<?php echo $BASE_URL; ?>" onfocus="textboxOnFocus('CIV_LIMIT_MAX_VEHICLES_notes')" onblur="textboxOnBlur('CIV_LIMIT_MAX_IDENTITIES_notes')" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> placeholder="<?php if(EI_MODE == 'demo') echo 'demo: test'; ?>" /></td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('CIV_LIMIT_MAX_VEHICLES'); ?>&nbsp;</td>
				<td><input name="CIV_LIMIT_MAX_VEHICLES" id="CIV_LIMIT_MAX_VEHICLES" value="0" class="form_text" size="28" maxlength="200" value="<?php echo $BASE_URL; ?>" onfocus="textboxOnFocus('CIV_LIMIT_MAX_VEHICLES_notes')" onblur="textboxOnBlur('CIV_LIMIT_MAX_VEHICLES_notes')" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> placeholder="<?php if(EI_MODE == 'demo') echo 'demo: test'; ?>" /></td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('CIV_LIMIT_MAX_WEAPONS'); ?>&nbsp;</td>
				<td><input name="CIV_LIMIT_MAX_WEAPONS" id="CIV_LIMIT_MAX_WEAPONS" value="0" class="form_text" size="28" maxlength="200" value="<?php echo $BASE_URL; ?>" onfocus="textboxOnFocus('CIV_LIMIT_MAX_WEAPONS_notes')" onblur="textboxOnBlur('CIV_LIMIT_MAX_VEHICLES_notes')" <?php if(EI_MODE != 'debug') echo 'autocomplete="off"'; ?> placeholder="<?php if(EI_MODE == 'demo') echo 'demo: test'; ?>" /></td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td colspan="2">
					<a href="department_configuration.php" class="form_button" /><?php echo lang_key('back'); ?></a>
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
