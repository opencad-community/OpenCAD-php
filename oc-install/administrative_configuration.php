<?php

	session_start();

	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');    
	require_once('include/functions.inc.php');
	require_once('include/languages.inc.php');	

	$task = isset($_POST['task']) ? prepare_input($_POST['task']) : '';
	$passed_step = isset($_SESSION['passed_step']) ? (int)$_SESSION['passed_step'] : 0;
	$focus_field = 'MODERATOR_APPROVE_USER';
	$error_msg = '';
	
	// handle previous steps
	// -------------------------------------------------
	if($passed_step >= 7){
		// OK
	}else{
		header('location: start.php');
		exit;				
	}
	
	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){

		$MODERATOR_APPROVE_USER = isset($_POST['MODERATOR_APPROVE_USER']) ? prepare_input($_POST['MODERATOR_APPROVE_USER']) : '';
        $MODERATOR_EDIT_USER = isset($_POST['MODERATOR_EDIT_USER']) ? prepare_input($_POST['MODERATOR_EDIT_USER']) : '';
		$MODERATOR_DELETE_USER = isset($_POST['MODERATOR_DELETE_USER']) ? prepare_input($_POST['MODERATOR_DELETE_USER']) : '';
		
        $MODERATOR_SUSPEND_WITH_REASON = isset($_POST['MODERATOR_SUSPEND_WITH_REASON']) ? prepare_input($_POST['MODERATOR_SUSPEND_WITH_REASON']) : '';
		$MODERATOR_SUSPEND_WITHOUT_REASON = isset($_POST['MODERATOR_SUSPEND_WITHOUT_REASON']) ? prepare_input($_POST['MODERATOR_SUSPEND_WITHOUT_REASON']) : '';
		$MODERATOR_REACTIVATE_USER = isset($_POST['MODERATOR_REACTIVATE_USER']) ? prepare_input($_POST['MODERATOR_REACTIVATE_USER']) : '';

		$MODERATOR_REMOVE_GROUP = isset($_POST['MODERATOR_REMOVE_GROUP']) ? prepare_input($_POST['MODERATOR_REMOVE_GROUP']) : '';

		$MODERATOR_NCIC_EDITOR 				= isset($_POST['MODERATOR_NCIC_EDITOR']) ? prepare_input($_POST['MODERATOR_NCIC_EDITOR']) : '';

		$MODERATOR_DATA_MANAGER = isset($_POST['MODERATOR_DATA_MANAGER']) ? prepare_input($_POST['MODERATOR_DATA_MANAGER']) : '';
		$MODERATOR_DATAMAN_CITATIONTYPES = isset($_POST['MODERATOR_DATAMAN_CITATIONTYPES']) ? prepare_input($_POST['MODERATOR_DATAMAN_CITATIONTYPES']) : '';
		$MODERATOR_DATAMAN_DEPARTMENTS = isset($_POST['MODERATOR_DATAMAN_DEPARTMENTS']) ? prepare_input($_POST['MODERATOR_DATAMAN_DEPARTMENTS']) : '';
		$MODERATOR_DATAMAN_INCIDENTTYPES = isset($_POST['MODERATOR_DATAMAN_INCIDENTTYPES']) ? prepare_input($_POST['MODERATOR_DATAMAN_INCIDENTTYPES']) : '';
		$MODERATOR_DATAMAN_RADIOCODES = isset($_POST['MODERATOR_DATAMAN_RADIOCODES']) ? prepare_input($_POST['MODERATOR_DATAMAN_RADIOCODES']) : '';
		$MODERATOR_DATAMAN_STREETS = isset($_POST['MODERATOR_DATAMAN_STREETS']) ? prepare_input($_POST['MODERATOR_DATAMAN_STREETS']) : '';		
		$MODERATOR_DATAMAN_VEHICLES = isset($_POST['MODERATOR_DATAMAN_VEHICLES']) ? prepare_input($_POST['MODERATOR_DATAMAN_VEHICLES']) : '';
		$MODERATOR_DATAMAN_WARNINGTYPES = isset($_POST['MODERATOR_DATAMAN_WARNINGTYPES']) ? prepare_input($_POST['MODERATOR_DATAMAN_WARNINGTYPES']) : '';	
		$MODERATOR_DATAMAN_WARRANTTYPES = isset($_POST['MODERATOR_DATAMAN_WARRANTTYPES']) ? prepare_input($_POST['MODERATOR_DATAMAN_WARRANTTYPES']) : '';
		$MODERATOR_DATAMAN_WEAPONS = isset($_POST['MODERATOR_DATAMAN_WEAPONS']) ? prepare_input($_POST['MODERATOR_DATAMAN_WEAPONS']) : '';
		$MODERATOR_DATAMAN_IMPEXPRESET = isset($_POST['MODERATOR_DATAMAN_IMPEXPRESET']) ? prepare_input($_POST['MODERATOR_DATAMAN_IMPEXPRESET']) : '';

		$_SESSION['MODERATOR_APPROVE_USER'] = $MODERATOR_APPROVE_USER;
		$_SESSION['MODERATOR_EDIT_USER'] = $MODERATOR_EDIT_USER;			
		$_SESSION['MODERATOR_DELETE_USER'] = $MODERATOR_DELETE_USER;

		$_SESSION['MODERATOR_SUSPEND_WITH_REASON'] = $MODERATOR_SUSPEND_WITH_REASON;
		$_SESSION['MODERATOR_SUSPEND_WITHOUT_REASON'] = $MODERATOR_SUSPEND_WITHOUT_REASON;
		$_SESSION['MODERATOR_REACTIVATE_USER'] = $MODERATOR_REACTIVATE_USER;

		$_SESSION['MODERATOR_REMOVE_GROUP'] = $MODERATOR_REMOVE_GROUP;

		$_SESSION['MODERATOR_NCIC_EDITOR'] = $MODERATOR_NCIC_EDITOR;

		$_SESSION['MODERATOR_DATA_MANAGER'] = $MODERATOR_DATA_MANAGER;
		$_SESSION['MODERATOR_DATAMAN_CITATIONTYPES'] = $MODERATOR_DATAMAN_CITATIONTYPES;
		$_SESSION['MODERATOR_DATAMAN_DEPARTMENTS'] = $MODERATOR_DATAMAN_DEPARTMENTS;
		$_SESSION['MODERATOR_DATAMAN_INCIDENTTYPES'] = $MODERATOR_DATAMAN_INCIDENTTYPES;
		$_SESSION['MODERATOR_DATAMAN_RADIOCODES'] = $MODERATOR_DATAMAN_RADIOCODES;
		$_SESSION['MODERATOR_DATAMAN_STREETS'] = $MODERATOR_DATAMAN_STREETS;
		$_SESSION['MODERATOR_DATAMAN_VEHICLES'] = $MODERATOR_DATAMAN_VEHICLES;
		$_SESSION['MODERATOR_DATAMAN_WARNINGTYPES'] = $MODERATOR_DATAMAN_WARNINGTYPES;
		$_SESSION['MODERATOR_DATAMAN_WARRANTTYPES'] = $MODERATOR_DATAMAN_WARRANTTYPES;
		$_SESSION['MODERATOR_DATAMAN_WEAPONS'] = $MODERATOR_DATAMAN_WEAPONS;
		$_SESSION['MODERATOR_DATAMAN_IMPEXPRESET'] = $MODERATOR_DATAMAN_IMPEXPRESET;

		$_SESSION['passed_step'] = 8;
		header('location: extra_settings.php');
		exit;

	}else{

		$MODERATOR_APPROVE_USER = isset($_POST['MODERATOR_APPROVE_USER']) ? prepare_input($_POST['MODERATOR_APPROVE_USER']) : '';
        $MODERATOR_EDIT_USER = isset($_POST['MODERATOR_EDIT_USER']) ? prepare_input($_POST['MODERATOR_EDIT_USER']) : '';
		$MODERATOR_DELETE_USER = isset($_POST['MODERATOR_DELETE_USER']) ? prepare_input($_POST['MODERATOR_DELETE_USER']) : '';
		
        $MODERATOR_SUSPEND_WITH_REASON = isset($_POST['MODERATOR_SUSPEND_WITH_REASON']) ? prepare_input($_POST['MODERATOR_SUSPEND_WITH_REASON']) : '';
		$MODERATOR_SUSPEND_WITHOUT_REASON = isset($_POST['MODERATOR_SUSPEND_WITHOUT_REASON']) ? prepare_input($_POST['MODERATOR_SUSPEND_WITHOUT_REASON']) : '';
		$MODERATOR_REACTIVATE_USER = isset($_POST['MODERATOR_REACTIVATE_USER']) ? prepare_input($_POST['MODERATOR_REACTIVATE_USER']) : '';

		$MODERATOR_REMOVE_GROUP = isset($_POST['MODERATOR_REMOVE_GROUP']) ? prepare_input($_POST['MODERATOR_REMOVE_GROUP']) : '';

		$MODERATOR_NCIC_EDITOR = isset($_POST['MODERATOR_NCIC_EDITOR']) ? prepare_input($_POST['MODERATOR_NCIC_EDITOR']) : '';
		
		$MODERATOR_DATAMAN_CITATIONTYPES = isset($_POST['MODERATOR_DATAMAN_CITATIONTYPES']) ? prepare_input($_POST['MODERATOR_DATAMAN_CITATIONTYPES']) : '';
		$MODERATOR_DATAMAN_DEPARTMENTS = isset($_POST['MODERATOR_DATAMAN_DEPARTMENTS']) ? prepare_input($_POST['MODERATOR_DATAMAN_DEPARTMENTS']) : '';
		$MODERATOR_DATAMAN_INCIDENTTYPES = isset($_POST['MODERATOR_DATAMAN_INCIDENTTYPES']) ? prepare_input($_POST['MODERATOR_DATAMAN_INCIDENTTYPES']) : '';
		$MODERATOR_DATAMAN_RADIOCODES = isset($_POST['MODERATOR_DATAMAN_RADIOCODES']) ? prepare_input($_POST['MODERATOR_DATAMAN_RADIOCODES']) : '';
		$MODERATOR_DATAMAN_STREETS = isset($_POST['MODERATOR_DATAMAN_STREETS']) ? prepare_input($_POST['MODERATOR_DATAMAN_STREETS']) : '';		
		$MODERATOR_DATAMAN_VEHICLES = isset($_POST['MODERATOR_DATAMAN_VEHICLES']) ? prepare_input($_POST['MODERATOR_DATAMAN_VEHICLES']) : '';
		$MODERATOR_DATAMAN_WARNINGTYPES = isset($_POST['MODERATOR_DATAMAN_WARNINGTYPES']) ? prepare_input($_POST['MODERATOR_DATAMAN_WARNINGTYPES']) : '';	
		$MODERATOR_DATAMAN_WARRANTTYPES = isset($_POST['MODERATOR_DATAMAN_WARRANTTYPES']) ? prepare_input($_POST['MODERATOR_DATAMAN_WARRANTTYPES']) : '';
		$MODERATOR_DATAMAN_WEAPONS = isset($_POST['MODERATOR_DATAMAN_WEAPONS']) ? prepare_input($_POST['MODERATOR_DATAMAN_WEAPONS']) : '';
		$MODERATOR_DATAMAN_IMPEXPRESET = isset($_POST['MODERATOR_DATAMAN_IMPEXPRESET']) ? prepare_input($_POST['MODERATOR_DATAMAN_IMPEXPRESET']) : '';

		$_SESSION['MODERATOR_APPROVE_USER'] = $MODERATOR_APPROVE_USER;
		$_SESSION['MODERATOR_EDIT_USER'] = $MODERATOR_EDIT_USER;			
		$_SESSION['MODERATOR_DELETE_USER'] = $MODERATOR_DELETE_USER;

		$_SESSION['MODERATOR_SUSPEND_WITH_REASON'] = $MODERATOR_SUSPEND_WITH_REASON;
		$_SESSION['MODERATOR_SUSPEND_WITHOUT_REASON'] = $MODERATOR_SUSPEND_WITHOUT_REASON;
		$_SESSION['MODERATOR_REACTIVATE_USER'] = $MODERATOR_REACTIVATE_USER;

		$_SESSION['MODERATOR_REMOVE_GROUP'] = $MODERATOR_REMOVE_GROUP;

		$_SESSION['MODERATOR_NCIC_EDITOR'] = $MODERATOR_NCIC_EDITOR;

		$_SESSION['MODERATOR_DATA_MANAGER'] = $MODERATOR_DATA_MANAGER;
		$_SESSION['MODERATOR_DATAMAN_CITATIONTYPES'] = $MODERATOR_DATAMAN_CITATIONTYPES;
		$_SESSION['MODERATOR_DATAMAN_DEPARTMENTS'] = $MODERATOR_DATAMAN_DEPARTMENTS;
		$_SESSION['MODERATOR_DATAMAN_INCIDENTTYPES'] = $MODERATOR_DATAMAN_INCIDENTTYPES;
		$_SESSION['MODERATOR_DATAMAN_RADIOCODES'] = $MODERATOR_DATAMAN_RADIOCODES;
		$_SESSION['MODERATOR_DATAMAN_STREETS'] = $MODERATOR_DATAMAN_STREETS;
		$_SESSION['MODERATOR_DATAMAN_VEHICLES'] = $MODERATOR_DATAMAN_VEHICLES;
		$_SESSION['MODERATOR_DATAMAN_WARNINGTYPES'] = $MODERATOR_DATAMAN_WARNINGTYPES;
		$_SESSION['MODERATOR_DATAMAN_WARRANTTYPES'] = $MODERATOR_DATAMAN_WARRANTTYPES;
		$_SESSION['MODERATOR_DATAMAN_WEAPONS'] = $MODERATOR_DATAMAN_WEAPONS;
		$_SESSION['MODERATOR_DATAMAN_IMPEXPRESET'] = $MODERATOR_DATAMAN_IMPEXPRESET;
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
			<h2><?php echo lang_key('step_8_of'); ?> - Administrative Settings</h2>
			<h3><?php echo lang_key('administrative_configuration'); ?></h3>

			<form action="administrative_configuration.php" method="post">
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
				<td width="250px">&nbsp;<?php echo lang_key('MODERATOR_APPROVE_USER'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="MODERATOR_APPROVE_USER" id="MODERATOR_APPROVE_USER" <?php echo ($MODERATOR_APPROVE_USER=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_APPROVE_USER_notes')" checked onblur="textboxOnBlur('MODERATOR_APPROVE_USER_notes')" value="true" />True
					<input type="radio" name="MODERATOR_APPROVE_USER" id="MODERATOR_APPROVE_USER" <?php echo ($MODERATOR_APPROVE_USER=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_APPROVE_USER_notes')" onblur="textboxOnBlur('MODERATOR_APPROVE_USER_notes')" value="false" />False
				</td>
				<td rowspan="6" valign="top">					
					<div id="MODERATOR_APPROVE_USER_notes" class="notes_container">
						<h4><?php echo lang_key('MODERATOR_APPROVE_USER'); ?></h4>
						<p><?php echo lang_key('MODERATOR_APPROVE_USER_notes'); ?></p>
					</div>
					<div id="MODERATOR_EDIT_USER_notes" class="notes_container">
						<h4><?php echo lang_key('MODERATOR_EDIT_USER'); ?></h4>
						<p><?php echo lang_key('MODERATOR_EDIT_USER_notes'); ?></p>
					</div>
					<div id="MODERATOR_SUSPEND_WITH_REASON_notes" class="notes_container">
						<h4><?php echo lang_key('MODERATOR_SUSPEND_WITH_REASON_URL'); ?></h4>
						<p><?php echo lang_key('MODERATOR_SUSPEND_WITH_REASON_notes'); ?></p>
					</div>
					<div id="MODERATOR_SUSPEND_WITHOUT_REASON_notes" class="notes_container">
						<h4><?php echo lang_key('MODERATOR_SUSPEND_WITHOUT_REASON'); ?></h4>
						<p><?php echo lang_key('MODERATOR_SUSPEND_WITHOUT_REASON_notes'); ?></p>
					</div>
					<div id="MODERATOR_REACTIVATE_USER_notes" class="notes_container">
						<h4><?php echo lang_key('MODERATOR_REACTIVATE_USER'); ?></h4>
						<p><?php echo lang_key('MODERATOR_REACTIVATE_USER_notes'); ?></p>
					</div>
					<div id="MODERATOR_REMOVE_GROUP_notes" class="notes_container">
						<h4><?php echo lang_key('MODERATOR_REMOVE_GROUP'); ?></h4>
						<p><?php echo lang_key('MODERATOR_REMOVE_GROUP_notes'); ?></p>
					</div>
					<div id="MODERATOR_NCIC_EDITOR_notes" class="notes_container">
						<h4><?php echo lang_key('MODERATOR_NCIC_EDITOR'); ?></h4>
						<p><?php echo lang_key('MODERATOR_NCIC_EDITOR_notes'); ?></p>
					</div>
					<div id="MODERATOR_DATA_MANAGER_notes" class="notes_container">
						<h4><?php echo lang_key('MODERATOR_DATA_MANAGER'); ?></h4>
						<p><?php echo lang_key('MODERATOR_DATA_MANAGER_notes'); ?></p>
					</div>
					
					<img class="loading_img" src="images/ajax_loading.gif" alt="<?php echo lang_key('loading'); ?>..." />
					<div id="notes_message" class="notes_container"></div>					
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_EDIT_USER'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_EDIT_USER" id="MODERATOR_EDIT_USER" <?php echo ($MODERATOR_APPROVE_USER=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_EDIT_USER_notes')" onblur="textboxOnBlur('MODERATOR_EDIT_USER')" value="true" />True
				<input type="radio" name="MODERATOR_EDIT_USER" id="MODERATOR_EDIT_USER" <?php echo ($MODERATOR_APPROVE_USER=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_EDIT_USER_notes')" onblur="textboxOnBlur('MODERATOR_EDIT_USER)" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DELETE_USER'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DELETE_USER" id="MODERATOR_DELETE_USER" <?php echo ($MODERATOR_DELETE_USER=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DELETE_USER_notes')" checked onblur="textboxOnBlur('MODERATOR_DELETE_USER_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DELETE_USER" id="MODERATOR_DELETE_USER" <?php echo ($MODERATOR_DELETE_USER=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DELETE_USER_notes')" onblur="textboxOnBlur('MODERATOR_DELETE_USER_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_SUSPEND_WITH_REASON'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_SUSPEND_WITH_REASON" id="MODERATOR_SUSPEND_WITH_REASON" <?php echo ($MODERATOR_SUSPEND_WITH_REASON=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_SUSPEND_WITH_REASON_notes')" onblur="textboxOnBlur('MODERATOR_SUSPEND_WITH_REASON_notes')" value="true" />True
				<input type="radio" name="MODERATOR_SUSPEND_WITH_REASON" id="MODERATOR_SUSPEND_WITH_REASON" <?php echo ($MODERATOR_SUSPEND_WITH_REASON=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_SUSPEND_WITH_REASON_notes')" onblur="textboxOnBlur('MODERATOR_SUSPEND_WITH_REASON_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_SUSPEND_WITHOUT_REASON'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_SUSPEND_WITHOUT_REASON" id="MODERATOR_SUSPEND_WITHOUT_REASON" <?php echo ($MODERATOR_SUSPEND_WITHOUT_REASON=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_SUSPEND_WITHOUT_REASON_notes')" onblur="textboxOnBlur('MODERATOR_SUSPEND_WITHOUT_REASON_notes')" value="true" />True
				<input type="radio" name="MODERATOR_SUSPEND_WITHOUT_REASON" id="MODERATOR_SUSPEND_WITHOUT_REASON" <?php echo ($MODERATOR_SUSPEND_WITHOUT_REASON=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_SUSPEND_WITHOUT_REASON_notes')" onblur="textboxOnBlur('MODERATOR_SUSPEND_WITHOUT_REASON_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_REACTIVATE_USER'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_REACTIVATE_USER" id="MODERATOR_REACTIVATE_USER" <?php echo ($MODERATOR_SUSPEND_WITHOUT_REASON=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_REACTIVATE_USER_WITHOUT_REASON_notes')" onblur="textboxOnBlur('MODERATOR_REACTIVATE_USER_notes')" value="true" />True
				<input type="radio" name="MODERATOR_REACTIVATE_USER" id="MODERATOR_REACTIVATE_USER" <?php echo ($MODERATOR_SUSPEND_WITHOUT_REASON=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_REACTIVATE_USER_notes')" onblur="textboxOnBlur('MODERATOR_REACTIVATE_USER_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>	
			<tr>
			<td>&nbsp;<?php echo lang_key('MODERATOR_REMOVE_GROUP'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_REMOVE_GROUP" id="MODERATOR_REMOVE_GROUP" <?php echo ($MODERATOR_NCIC_EDITOR=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_REMOVE_GROUP_notes')" checked onblur="textboxOnBlur('MODERATOR_REMOVE_GROUP_notes')" value="true" />True
				<input type="radio" name="MODERATOR_REMOVE_GROUP" id="MODERATOR_REMOVE_GROUP" <?php echo ($MODERATOR_NCIC_EDITOR=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_REMOVE_GROUP_notes')" onblur="textboxOnBlur('MODERATOR_REMOVE_GROUP_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_NCIC_EDITOR'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_NCIC_EDITOR" id="MODERATOR_NCIC_EDITOR" <?php echo ($MODERATOR_NCIC_EDITOR=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_NCIC_EDITOR_notes')" onblur="textboxOnBlur('MODERATOR_NCIC_EDITOR_notes')" value="true" />True
				<input type="radio" name="MODERATOR_NCIC_EDITOR" id="MODERATOR_NCIC_EDITOR" <?php echo ($MODERATOR_NCIC_EDITOR=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_NCIC_EDITOR_notes')" onblur="textboxOnBlur('MODERATOR_NCIC_EDITOR_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATA_MANAGER'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATA_MANAGER" id="MODERATOR_DATA_MANAGER" <?php echo ($MODERATOR_DATA_MANAGER=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATA_MANAGER_notes')" onblur="textboxOnBlur('MODERATOR_DATA_MANAGER_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATA_MANAGER" id="MODERATOR_DATA_MANAGER" <?php echo ($MODERATOR_DATA_MANAGER=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATA_MANAGER_notes')" onblur="textboxOnBlur('MODERATOR_DATA_MANAGER_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_CITATIONTYPES'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_CITATIONTYPES" id="MODERATOR_DATAMAN_CITATIONTYPES" <?php echo ($MODERATOR_DATAMAN_CITATIONTYPES=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_CITATIONTYPES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_CITATIONTYPES_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_CITATIONTYPES" id="MODERATOR_DATAMAN_CITATIONTYPES" <?php echo ($MODERATOR_DATAMAN_CITATIONTYPES=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_CITATIONTYPES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_CITATIONTYPES_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_DEPARTMENTS'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_DEPARTMENTS" id="MODERATOR_DATAMAN_DEPARTMENTS" <?php echo ($MODERATOR_DATAMAN_DEPARTMENTS=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_DEPARTMENTS_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_DEPARTMENTS_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_DEPARTMENTS" id="MODERATOR_DATAMAN_DEPARTMENTS" <?php echo ($MODERATOR_DATAMAN_DEPARTMENTS=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_DEPARTMENTS_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_DEPARTMENTS_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_INCIDENTTYPES'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_INCIDENTTYPES" id="MODERATOR_DATAMAN_INCIDENTTYPES" <?php echo ($MODERATOR_DATAMAN_INCIDENTTYPES=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_INCIDENTTYPES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_INCIDENTTYPES_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_INCIDENTTYPES" id="MODERATOR_DATAMAN_INCIDENTTYPES" <?php echo ($MODERATOR_DATAMAN_INCIDENTTYPES=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_INCIDENTTYPES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_INCIDENTTYPES_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_RADIOCODES'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_RADIOCODES" id="MODERATOR_DATAMAN_RADIOCODES" <?php echo ($MODERATOR_DATAMAN_RADIOCODES=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_RADIOCODES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_RADIOCODES_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_RADIOCODES" id="MODERATOR_DATAMAN_RADIOCODES" <?php echo ($MODERATOR_DATAMAN_RADIOCODES=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_RADIOCODES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_RADIOCODES_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_STREETS'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_STREETS" id="MODERATOR_DATAMAN_STREETS" <?php echo ($MODERATOR_DATAMAN_STREETS=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_STREETS_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_STREETS_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_STREETS" id="MODERATOR_DATAMAN_STREETS" <?php echo ($MODERATOR_DATAMAN_STREETS=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_STREETS_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_STREETS_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_VEHICLES'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_VEHICLES" id="MODERATOR_DATAMAN_VEHICLES" <?php echo ($MODERATOR_DATAMAN_VEHICLES=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_VEHICLES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_VEHICLES_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_VEHICLES" id="MODERATOR_DATAMAN_VEHICLES" <?php echo ($MODERATOR_DATAMAN_VEHICLES=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_VEHICLES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_VEHICLES_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_WARNINGTYPES'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_WARNINGTYPES" id="MODERATOR_DATAMAN_WARNINGTYPES" <?php echo ($MODERATOR_DATAMAN_WARNINGTYPES=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_WARNINGTYPES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_WARNINGTYPES_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_WARNINGTYPES" id="MODERATOR_DATAMAN_WARNINGTYPES" <?php echo ($MODERATOR_DATAMAN_WARNINGTYPES=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_WARNINGTYPES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_WARNINGTYPES_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_WARRANTTYPES'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_WARRANTTYPES" id="MODERATOR_DATAMAN_WARRANTTYPES" <?php echo ($MODERATOR_DATAMAN_WARRANTTYPES=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_WARRANTTYPES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_WARRANTTYPES_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_WARRANTTYPES" id="MODERATOR_DATAMAN_WARRANTTYPES" <?php echo ($MODERATOR_DATAMAN_WARRANTTYPES=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_WARRANTTYPES_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_WARRANTTYPES_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_WEAPONS'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_WEAPONS" id="MODERATOR_DATAMAN_WEAPONS" <?php echo ($MODERATOR_DATAMAN_WEAPONS=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_WEAPONS_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_WEAPONS_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_WEAPONS" id="MODERATOR_DATAMAN_WEAPONS" <?php echo ($MODERATOR_DATAMAN_WEAPONS=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_WEAPONS_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_WEAPONS_notes')" value="false" />False</td>
			</tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('MODERATOR_DATAMAN_IMPEXPRESET'); ?>&nbsp;</td>
				<td><input type="radio" name="MODERATOR_DATAMAN_IMPEXPRESET" id="MODERATOR_DATAMAN_IMPEXPRESET" <?php echo ($MODERATOR_DATAMAN_IMPEXPRESET=='true')?'checked':'' ?> checked onfocus="textboxOnFocus('MODERATOR_DATAMAN_IMPEXPRESET_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_IMPEXPRESET_notes')" value="true" />True
				<input type="radio" name="MODERATOR_DATAMAN_IMPEXPRESET" id="MODERATOR_DATAMAN_IMPEXPRESET" <?php echo ($MODERATOR_DATAMAN_IMPEXPRESET=='false')?'checked':'' ?> onfocus="textboxOnFocus('MODERATOR_DATAMAN_IMPEXPRESET_notes')" onblur="textboxOnBlur('MODERATOR_DATAMAN_IMPEXPRESET_notes')" value="false" />False</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td colspan="2">
					<a href="civilian_configuration.php" class="form_button" /><?php echo lang_key('back'); ?></a>
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