<?php

	session_start();

	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');    
	require_once('include/functions.inc.php');
	require_once('include/languages.inc.php');	

	$task = isset($_POST['task']) ? prepare_input($_POST['task']) : '';
	$passed_step = isset($_SESSION['passed_step']) ? (int)$_SESSION['passed_step'] : 0;
	
	// handle previous steps
	// -------------------------------------------------
	if($passed_step >= 9){
		// OK
	}else{
		//die();
		header('location: start.php');	
	}

	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){
		$_SESSION['passed_step'] = 10;
		header('location: complete_installation.php');
		exit;
	}
	
?>	

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="ApPHP Company - Advanced Power of PHP">
    <meta name="generator" content="ApPHP EasyInstaller">
	<title><?php echo lang_key("installation_guide"); ?> | <?php echo lang_key('ready_to_install'); ?></title>

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
<body>
<div id="main">
	<h1><?php echo lang_key('new_installation_of'); ?> <?php echo EI_APPLICATION_NAME.' '.EI_APPLICATION_VERSION;?>!</h1>
	<h2 class="sub-title"><?php echo lang_key('sub_title_message'); ?></h2>
	
	<div id="content">
		<?php
			draw_side_navigation(10);		
		?>
		<div class="central-part">
			<h2><?php echo lang_key('step_10_of'); ?> - <?php echo lang_key('ready_to_install'); ?></h2>
			<h3><?php echo lang_key('we_are_ready_to_installation'); ?></h3>			
		
			<p><?php echo lang_key('we_are_ready_to_installation_text'); ?></p>			
		
			<form method="post" action="ready_to_install.php">
			<input type="hidden" name="task" value="send" />
			<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
			
			<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tr><td nowrap height="10px" colspan="3"></td></tr>

			<tr><td colspan="2" nowrap height="20px">&nbsp;</td></tr>
			<tr>
				<td colspan="2">
					<a href="extra_settings.php" class="form_button" /><?php echo lang_key('back'); ?></a>
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
</body>
</html>