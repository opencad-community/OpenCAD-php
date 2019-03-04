<?php

	session_start();

	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');    
	require_once('include/functions.inc.php');
	require_once('include/languages.inc.php');	

	$task = isset($_POST['task']) ? prepare_input($_POST['task']) : '';
	$passed_step = isset($_SESSION['passed_step']) ? (int)$_SESSION['passed_step'] : 0;
	$focus_field = 'POLICE_NCIC';
	$error_msg = '';
	
	// handle previous steps
	// -------------------------------------------------
	if($passed_step >= 5){
		// OK
	}else{
		header('location: start.php');
		exit;				
	}
	
	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){
		
		$POLICE_NCIC = isset($_POST['POLICE_NCIC']) ? prepare_input($_POST['POLICE_NCIC']) : '';
		$POLICE_CALL_SELFASSIGN = isset($_POST['POLICE_CALL_SELFASSIGN']) ? prepare_input($_POST['POLICE_CALL_SELFASSIGN']) : '';
		
		$FIRE_PANIC = isset($_POST['FIRE_PANIC']) ? prepare_input($_POST['FIRE_PANIC']) : '';
		$FIRE_BOLO = isset($_POST['FIRE_BOLO']) ? prepare_input($_POST['FIRE_BOLO']) : '';
		$FIRE_NCIC_NAME = isset($_POST['FIRE_NCIC_NAME']) ? prepare_input($_POST['FIRE_NCIC_NAME']) : '';
		$FIRE_NCIC_PLATE = isset($_POST['FIRE_NCIC_PLATE']) ? prepare_input($_POST['FIRE_NCIC_PLATE']) : '';
		$FIRE_CALL_SELFASSIGN = isset($_POST['FIRE_CALL_SELFASSIGN']) ? prepare_input($_POST['FIRE_CALL_SELFASSIGN']) : '';
		
		$EMS_PANIC = isset($_POST['EMS_PANIC']) ? prepare_input($_POST['EMS_PANIC']) : '';
		$EMS_BOLO = isset($_POST['EMS_BOLO']) ? prepare_input($_POST['EMS_BOLO']) : '';
		$EMS_NCIC_NAME = isset($_POST['EMS_NCIC_NAME']) ? prepare_input($_POST['EMS_NCIC_NAME']) : '';
		$EMS_NCIC_PLATE = isset($_POST['EMS_NCIC_PLATE']) ? prepare_input($_POST['EMS_NCIC_PLATE']) : '';
		
		$_SESSION['POLICE_NCIC'] = $POLICE_NCIC;
		$_SESSION['POLICE_CALL_SELFASSIGN'] = $POLICE_CALL_SELFASSIGN;
		
		$_SESSION['FIRE_PANIC'] = $FIRE_PANIC;		
		$_SESSION['FIRE_BOLO'] = $FIRE_BOLO;		
		$_SESSION['FIRE_NCIC_NAME'] = $FIRE_NCIC_NAME;		
		$_SESSION['FIRE_NCIC_PLATE'] = $FIRE_NCIC_PLATE;
		$_SESSION['FIRE_CALL_SELFASSIGN'] = $FIRE_CALL_SELFASSIGN;
		
		$_SESSION['EMS_PANIC'] = $EMS_PANIC;		
		$_SESSION['EMS_BOLO'] = $EMS_BOLO;		
		$_SESSION['EMS_NCIC_NAME'] = $EMS_NCIC_NAME;		
		$_SESSION['EMS_NCIC_PLATE'] = $EMS_NCIC_PLATE;

		$_SESSION['passed_step'] = 6;
		header('location: civilian_configuration.php');
		exit;

	}else{

		$POLICE_NCIC = isset($_POST['POLICE_NCIC']) ? prepare_input($_POST['POLICE_NCIC']) : '';
		$POLICE_CALL_SELFASSIGN = isset($_POST['POLICE_CALL_SELFASSIGN']) ? prepare_input($_POST['POLICE_CALL_SELFASSIGN']) : '';
		
		$FIRE_PANIC = isset($_POST['FIRE_PANIC']) ? prepare_input($_POST['FIRE_PANIC']) : '';
		$FIRE_BOLO = isset($_POST['FIRE_BOLO']) ? prepare_input($_POST['FIRE_BOLO']) : '';
		$FIRE_NCIC_NAME = isset($_POST['FIRE_NCIC_NAME']) ? prepare_input($_POST['FIRE_NCIC_NAME']) : '';
		$FIRE_NCIC_PLATE = isset($_POST['FIRE_NCIC_PLATE']) ? prepare_input($_POST['FIRE_NCIC_PLATE']) : '';
		$FIRE_CALL_SELFASSIGN = isset($_POST['FIRE_CALL_SELFASSIGN']) ? prepare_input($_POST['FIRE_CALL_SELFASSIGN']) : '';
		
		$EMS_PANIC = isset($_POST['EMS_PANIC']) ? prepare_input($_POST['EMS_PANIC']) : '';
		$EMS_BOLO = isset($_POST['EMS_BOLO']) ? prepare_input($_POST['EMS_BOLO']) : '';
		$EMS_NCIC_NAME = isset($_POST['EMS_NCIC_NAME']) ? prepare_input($_POST['EMS_NCIC_NAME']) : '';
		$EMS_NCIC_PLATE = isset($_POST['EMS_NCIC_PLATE']) ? prepare_input($_POST['EMS_NCIC_PLATE']) : '';

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
			draw_side_navigation(6);		
		?>
		<div class="central-part">
			<h2><?php echo lang_key('step_6_of'); ?> - Department Settings</h2>
			<h3><?php echo lang_key('department_configuration'); ?></h3>

			<form action="department_configuration.php" method="post">
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
				<td width="250px">&nbsp;<?php echo lang_key('POLICE_NCIC'); ?>&nbsp;</td>
				<td><input type="radio" name="POLICE_NCIC" id="POLICE_NCIC" <?php echo ($POLICE_NCIC=='true')?'checked':'' ?> onfocus="textboxOnFocus('POLICE_NCIC_notes')" checked onblur="textboxOnBlur('POLICE_NCIC_notes')" value="true" />True
				<input type="radio" name="POLICE_NCIC" id="POLICE_NCIC" <?php echo ($POLICE_NCIC=='false')?'checked':'' ?> onfocus="textboxOnFocus('POLICE_NCIC_notes')"  onblur="textboxOnBlur('POLICE_NCIC_notes')" value="false" />False</td>
				<td rowspan="6" valign="top">					
					<div id="POLICE_NCIC_notes" class="notes_container">
						<h4><?php echo lang_key('POLICE_NCIC'); ?></h4>
						<p><?php echo lang_key('POLICE_NCIC_notes'); ?></p>
					</div>
					<div id="POLICE_CALL_SELFASSIGN_notes" class="notes_container">
						<h4><?php echo lang_key('POLICE_CALL_SELFASSIGN'); ?></h4>
						<p><?php echo lang_key('POLICE_CALL_SELFASSIGN_notes'); ?></p>
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
					<div id="FIRE_CALL_SELFASSIGN_notes" class="notes_container">
						<h4><?php echo lang_key('FIRE_CALL_SELFASSIGN'); ?></h4>
						<p><?php echo lang_key('FIRE_CALL_SELFASSIGN_notes'); ?></p>
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
					
					<img class="loading_img" src="images/ajax_loading.gif" alt="<?php echo lang_key('loading'); ?>..." />
					<div id="notes_message" class="notes_container"></div>					
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('POLICE_CALL_SELFASSIGN'); ?>&nbsp;</td>
				<td><input type="radio" name="POLICE_CALL_SELFASSIGN" id="POLICE_CALL_SELFASSIGN" <?php echo ($POLICE_CALL_SELFASSIGN=='true')?'checked':'' ?> onfocus="textboxOnFocus('POLICE_CALL_SELFASSIGN_notes')" checked onblur="textboxOnBlur('POLICE_CALL_SELFASSIGN_notes')" value="true" />True
				<input type="radio" name="POLICE_CALL_SELFASSIGN" id="POLICE_CALL_SELFASSIGN" <?php echo ($POLICE_CALL_SELFASSIGN=='false')?'checked':'' ?> onfocus="textboxOnFocus('POLICE_CALL_SELFASSIGN_notes')" onblur="textboxOnBlur('POLICE_CALL_SELFASSIGN_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_PANIC'); ?>&nbsp;</td>
				<td><input type="radio" name="FIRE_PANIC" id="FIRE_PANIC" <?php echo ($FIRE_PANIC=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_PANIC_notes')" checked onblur="textboxOnBlur('FIRE_PANIC_notes')" value="true" />True
				<input type="radio" name="FIRE_PANIC" id="FIRE_PANIC" <?php echo ($FIRE_PANIC=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_PANIC_notes')" onblur="textboxOnBlur('FIRE_PANIC_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_BOLO'); ?>&nbsp;</td>
				<td><input type="radio" name="FIRE_BOLO" id="FIRE_BOLO" <?php echo ($FIRE_BOLO=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_BOLO_notes')" checked onblur="textboxOnBlur('FIRE_BOLO_notes')" value="true" />True
				<input type="radio" name="FIRE_BOLO" id="FIRE_BOLO" <?php echo ($FIRE_BOLO=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_BOLO_notes')" onblur="textboxOnBlur('FIRE_BOLO_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_NCIC_NAME'); ?>&nbsp;</td>
				<td><input type="radio" name="FIRE_NCIC_NAME" id="FIRE_NCIC_NAME" <?php echo ($FIRE_NCIC_NAME=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_NCIC_NAME_notes')" checked onblur="textboxOnBlur('FIRE_NCIC_NAME_notes')" value="true" />True
				<input type="radio" name="FIRE_NCIC_NAME" id="FIRE_NCIC_NAME" <?php echo ($FIRE_NCIC_NAME=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_NCIC_NAME_notes')" onblur="textboxOnBlur('FIRE_NCIC_NAME_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_NCIC_PLATE'); ?>&nbsp;</td>
				<td><input type="radio" name="FIRE_NCIC_PLATE" id="FIRE_NCIC_PLATE" <?php echo ($FIRE_NCIC_PLATE=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_NCIC_PLATE_notes')" checked onblur="textboxOnBlur('FIRE_NCIC_PLATE_notes')" value="true" />True
				<input type="radio" name="FIRE_NCIC_PLATE" id="FIRE_NCIC_PLATE" <?php echo ($FIRE_NCIC_PLATE=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_NCIC_PLATE_notes')" onblur="textboxOnBlur('FIRE_NCIC_PLATE_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('FIRE_CALL_SELFASSIGN'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="FIRE_CALL_SELFASSIGN" id="FIRE_CALL_SELFASSIGN" <?php echo ($FIRE_CALL_SELFASSIGN=='true')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_CALL_SELFASSIGN_notes')" checked onblur="textboxOnBlur('FIRE_CALL_SELFASSIGN_notes')" value="true" />True
					<input type="radio" name="FIRE_CALL_SELFASSIGN" id="FIRE_CALL_SELFASSIGN" <?php echo ($FIRE_CALL_SELFASSIGN=='false')?'checked':'' ?> onfocus="textboxOnFocus('FIRE_CALL_SELFASSIGN_notes')" onblur="textboxOnBlur('FIRE_CALL_SELFASSIGN_notes')" value="false" />False
				</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('EMS_PANIC'); ?>&nbsp;</td>
				<td><input type="radio" name="EMS_PANIC" id="EMS_PANIC" <?php echo ($EMS_PANIC=='true')?'checked':'' ?> onfocus="textboxOnFocus('EMS_PANIC_notes')" checked onblur="textboxOnBlur('EMS_PANIC_notes')" value="true" />True
				<input type="radio" name="EMS_PANIC" id="EMS_PANIC" <?php echo ($EMS_PANIC=='false')?'checked':'' ?> onfocus="textboxOnFocus('EMS_PANIC_notes')" onblur="textboxOnBlur('EMS_PANIC_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('EMS_BOLO'); ?>&nbsp;</td>
				<td><input type="radio" name="EMS_BOLO" id="EMS_BOLO" <?php echo ($EMS_BOLO=='true')?'checked':'' ?> onfocus="textboxOnFocus('EMS_BOLO_notes')" checked onblur="textboxOnBlur('EMS_BOLO_notes')" value="true" />True
				<input type="radio" name="EMS_BOLO" id="EMS_BOLO" <?php echo ($EMS_BOLO=='false')?'checked':'' ?> onfocus="textboxOnFocus('EMS_BOLO_notes')" onblur="textboxOnBlur('EMS_BOLO_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('EMS_NCIC_NAME'); ?>&nbsp;</td>
				<td><input type="radio" name="EMS_NCIC_NAME" id="EMS_NCIC_NAME" <?php echo ($EMS_NCIC_NAME=='true')?'checked':'' ?> onfocus="textboxOnFocus('EMS_NCIC_NAME_notes')" checked onblur="textboxOnBlur('EMS_NCIC_NAME_notes')" value="true" />True
				<input type="radio" name="EMS_NCIC_NAME" id="EMS_NCIC_NAME" <?php echo ($EMS_NCIC_NAME=='false')?'checked':'' ?> onfocus="textboxOnFocus('EMS_NCIC_NAME_notes')" onblur="textboxOnBlur('EMS_NCIC_NAME_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('EMS_NCIC_PLATE'); ?>&nbsp;</td>
				<td><input type="radio" name="EMS_NCIC_PLATE" id="EMS_NCIC_PLATE" <?php echo ($EMS_NCIC_PLATE=='true')?'checked':'' ?> onfocus="textboxOnFocus('EMS_NCIC_PLATE_notes')" checked onblur="textboxOnBlur('EMS_NCIC_PLATE_notes')" value="true" />True
				<input type="radio" name="EMS_NCIC_PLATE" id="EMS_NCIC_PLATE" <?php echo ($EMS_NCIC_PLATE=='false')?'checked':'' ?> onfocus="textboxOnFocus('EMS_NCIC_PLATE_notes')" onblur="textboxOnBlur('EMS_NCIC_PLATE_notes')" value="false" />False</td>
			</tr>				
			<tr><td colspan="2" nowrap height="50px">&nbsp;</td></tr>
			<tr>
				<td colspan="2">
					<a href="core_configuration.php" class="form_button" /><?php echo lang_key('back'); ?></a>
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
