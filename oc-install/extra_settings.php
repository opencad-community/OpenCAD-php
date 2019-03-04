<?php

	session_start();

	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');    
	require_once('include/functions.inc.php');
	require_once('include/languages.inc.php');	

	$task = isset($_POST['task']) ? prepare_input($_POST['task']) : '';
	$passed_step = isset($_SESSION['passed_step']) ? (int)$_SESSION['passed_step'] : 0;
	$focus_field = 'DEMO_MODE';
	$error_msg = '';
	
	// handle previous steps
	// -------------------------------------------------
	if($passed_step >= 8){
		// OK
	}else{
		header('location: start.php');
		exit;				
	}
	
	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){

		$DEMO_MODE = isset($_POST['DEMO_MODE']) ? prepare_input($_POST['DEMO_MODE']) : '';
		$USE_GRAVATAR = isset($_POST['USE_GRAVATAR']) ? prepare_input($_POST['USE_GRAVATAR']) : '';
		
		$_SESSION['DEMO_MODE'] = $DEMO_MODE;
		$_SESSION['USE_GRAVATAR'] = $USE_GRAVATAR;		

		$_SESSION['passed_step'] = 9;
		header('location: ready_to_install.php');
		exit;

	}else{

		$DEMO_MODE = isset($_POST['DEMO_MODE']) ? prepare_input($_POST['DEMO_MODE']) : '';
		$USE_GRAVATAR = isset($_POST['USE_GRAVATAR']) ? prepare_input($_POST['USE_GRAVATAR']) : '';

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
			draw_side_navigation(9);		
		?>
		<div class="central-part">
			<h2><?php echo lang_key('step_9_of'); ?> - Extra Settings</h2>
			<h3><?php echo lang_key('extra_settings'); ?></h3>

			<form action="extra_settings.php" method="post">
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
			<td>&nbsp;<?php echo lang_key('DEMO_MODE'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="DEMO_MODE" id="DEMO_MODE" <?php echo ($DEMO_MODE=='true')?'checked':'' ?> onfocus="textboxOnFocus('DEMO_MODE_notes')" onblur="textboxOnBlur('DEMO_MODE_notes')" value="true" />True
					<input type="radio" name="DEMO_MODE" id="DEMO_MODE" <?php echo ($DEMO_MODE=='false')?'checked':'' ?> onfocus="textboxOnFocus('DEMO_MODE_notes')" checked  onblur="textboxOnBlur('DEMO_MODE_notes')" value="false" />False
				</td>
				<td rowspan="6" valign="top">					
					<div id="DEMO_MODE_notes" class="notes_container">
						<h4><?php echo lang_key('DEMO_MODE'); ?></h4>
						<p><?php echo lang_key('DEMO_MODE_notes'); ?></p>
					</div>
					
					<div id="USE_GRAVATAR_notes" class="notes_container">
						<h4><?php echo lang_key('USE_GRAVATAR'); ?></h4>
						<p><?php echo lang_key('USE_GRAVATAR_notes'); ?></p>
					</div>
					
					<img class="loading_img" src="images/ajax_loading.gif" alt="<?php echo lang_key('loading'); ?>..." />
					<div id="notes_message" class="notes_container"></div>					
				</td>
			</tr>
			<tr><td colspan="2" nowrap height="5px">&nbsp;</td></tr>
			<tr>
				<td>&nbsp;<?php echo lang_key('USE_GRAVATAR'); ?>&nbsp;</td>
				<td>
					<input type="radio" name="USE_GRAVATAR" id="USE_GRAVATAR" <?php echo ($USE_GRAVATAR=='true')?'checked':'' ?> onfocus="textboxOnFocus('USE_GRAVATAR_notes')" checked onblur="textboxOnBlur('USE_GRAVATAR_notes')" value="true" />True
					<input type="radio" name="USE_GRAVATAR" id="USE_GRAVATAR" <?php echo ($USE_GRAVATAR=='false')?'checked':'' ?> onfocus="textboxOnFocus('USE_GRAVATAR_notes')"  onblur="textboxOnBlur('USE_GRAVATAR_notes')" value="false" />False
				</td>
			</tr>
			<tr><td colspan="2" nowrap height="50px">&nbsp;</td></tr>
			<tr>
				<td colspan="2">
					<a href="administrative_configuration.php" class="form_button" /><?php echo lang_key('back'); ?></a>
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
