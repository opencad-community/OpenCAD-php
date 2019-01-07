<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  ApPHP EasyInstaller Free version                                           #
##  Developed by:  ApPHP <info@apphp.com>                                      #
##  License:       GNU LGPL v.3                                                #
##  Site:          http://www.apphp.com/php-easyinstaller/                     #
##  Copyright:     ApPHP EasyInstaller (c) 2009-2013. All rights reserved.     #
##                                                                             #
##  Additional modules (embedded):                                             #
##  -- jQuery (JavaScript Library)                           http://jquery.com #
##                                                                             #
################################################################################
   
    session_start();   

	require_once('include/shared.inc.php');    
    require_once('include/settings.inc.php');
	require_once('include/functions.inc.php');
	require_once('include/languages.inc.php');	

	$task = isset($_POST['task']) ? prepare_input($_POST['task']) : '';
	$installation_type = isset($_POST['installation_type']) ? prepare_input($_POST['installation_type']) : 'wizard';
	$program_already_installed = false;
	
	// handle previous installation
	// -------------------------------------------------
    if(file_exists(EI_CONFIG_FILE_PATH)){ 
		$program_already_installed = true;
		///header('location: '.EI_APPLICATION_START_FILE);
        ///exit;
	}
	
	// handle form submission
	// -------------------------------------------------
	if($task == 'send'){
		$_SESSION['passed_step'] = 1;
		$_SESSION['installation_type'] = $installation_type;
		header('location: server_requirements.php');
		exit;
	}else if($task == 'start_over'){
		$_SESSION['passed_step'] = 0;
		$_SESSION['installation_type'] = '';
		@unlink(EI_CONFIG_FILE_PATH);
		session_destroy();		
		// *** set new token
		$_SESSION['token'] = md5(uniqid(rand(), true));
	}	

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="ApPHP Company - Advanced Power of PHP">
    <meta name="generator" content="ApPHP EasyInstaller">
	<title><?php echo lang_key('installation_guide'); ?> | <?php echo lang_key('start'); ?></title>

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
			draw_side_navigation(1);		
		?>
		<div class="central-part">

			<form action="start.php" method="post">
			<input type="hidden" name="task" value="send" />
			<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />

			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
			<tr>
				<td>
					<h2><?php echo lang_key('step_1_of'); ?> - <?php echo lang_key('start'); ?></h2>
					<h3><?php echo lang_key('select_installation_type'); ?></h3>
					<?php if(EI_ALLOW_MANUAL_INSTALLATION){ ?>
						<input type="radio" value="wizard" name="installation_type" id="installation_type_wizard" onclick="toggleInstructions(1)" checked="checked" /><label for="installation_type_wizard"><?php echo lang_key('follow_the_wizard'); ?></label>
						<br>
					<?php }else{ ?>
						<?php echo lang_key('follow_the_wizard'); ?>
					<?php } ?>
				</td>
			</tr>
			<tr><td nowrap="nowrap" height="10px"></td></tr>
			<tr>
				<td>
					<?php
						if(count($arr_active_languages) > 1){
							echo lang_key('language').': ';
							echo '<select class="form_select" name="lang" onchange="document.location=\'start.php?lang=\'+this.value">';
							foreach($arr_active_languages as $key => $val){
								echo '<option '.(($key == $curr_lang) ? 'selected="selected"' : '').' value="'.$key.'">'.$val['name'].'</option>';
							}
							echo '</select>';						
						}
					?>
				</td>                
			</tr>
			<tr><td nowrap="nowrap" height="30px"></td></tr>
			<tr>
				<td>
					<input type="submit" class="form_button" name="btnSubmit" id="button_start" title="<?php echo lang_key('click_to_start_installation'); ?>" value="<?php echo lang_key('start'); ?>" />
				</td>
			</tr>
			</tbody>
			</table>
			</form>
		
		</div>
		<div class="clear"></div>
	</div>
	

</div>
</body>
</html>