<?php

	$lang = isset($_REQUEST['lang']) ? prepare_input($_REQUEST['lang']) : '';
	
	if(!isset($arr_active_languages)) $arr_active_languages = array();
	
	if(!empty($lang) && array_key_exists($lang, $arr_active_languages)){
		$curr_lang = $_SESSION['curr_lang'] = $lang;
		$curr_lang_direction = $_SESSION['curr_lang_direction'] = isset($arr_active_languages[$lang]['direction']) ? $arr_active_languages[$lang]['direction'] : EI_DEFAULT_LANGUAGE;
	}else if(isset($_SESSION['curr_lang']) && array_key_exists($_SESSION['curr_lang'], $arr_active_languages)){
		$curr_lang = $_SESSION['curr_lang'];
		$curr_lang_direction = isset($_SESSION['curr_lang_direction']) ? $_SESSION['curr_lang_direction'] : EI_DEFAULT_LANGUAGE_DIRECTION;
	}else{
		$curr_lang = EI_DEFAULT_LANGUAGE;
		$curr_lang_direction = EI_DEFAULT_LANGUAGE_DIRECTION;
	}
	
	if(file_exists('install/oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php')){
		include_once('install/oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php');
	}else if(file_exists('../oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php')){
		include_once('../oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php');
	}else if(file_exists('../oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php')){
		include_once('../oc-lang/'.$curr_lang.'/'.$curr_lang.'.inc.php');
	}else{
		include_once('../oc-lang/en/en.inc.php');    	
	}	

