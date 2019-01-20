<?php

if ( EI_MODE === "debug" )
	{
		echo "<pre>";
		var_dump($_SESSION);
		echo "</pre>";
	}



/**
 * 	Prepare reading of SQL dump file and executing SQL statements
 * 		@param $sql_dump_file
 */
function apphp_db_install($sql_dump_file) {
	global $error_mg;
	global $admin_name;
	global $admin_email;
	global $admin_identifier;
	global $admin_password;
	global $database_prefix;
	global $password_encryption;
	global $db;
	
	$sql_array = array();
	$query = '';
	
	// get  sql dump content
	$sql_dump = file($sql_dump_file);
	
	// replace database prefix if exists
	$sql_dump = str_ireplace('<DB_PREFIX>', $database_prefix, $sql_dump);

    // disabling magic quotes at runtime
    if(get_magic_quotes_runtime()){
        function stripslashes_runtime(&$value){
            $value = stripslashes($value);	
        }
        array_walk_recursive($sql_dump, 'stripslashes_runtime');
    }

	// add ';' at the end of file to catch last sql query
	if(substr($sql_dump[count($sql_dump)-1], -1) != ';') $sql_dump[count($sql_dump)-1] .= ';';

	// replace username and password if exists
		$sql_dump = str_ireplace('<NAME>', $admin_name, $sql_dump);
		$sql_dump = str_ireplace('<EMAIL>', $admin_email, $sql_dump);
		$password = password_hash($admin_password, PASSWORD_DEFAULT);
		$sql_dump = str_ireplace('<PASSWORD>', $password, $sql_dump);

	// encode connection, server, client etc.	
	if(EI_USE_ENCODING){
		$db->SetEncoding(EI_DUMP_FILE_ENCODING, EI_DUMP_FILE_COLLATION);
	}		
	
	foreach($sql_dump as $sql_line){
		$tsl = trim(utf8_decode($sql_line));
		if(($sql_line != '') && (substr($tsl, 0, 2) != '--') && (substr($tsl, 0, 1) != '?') && (substr($tsl, 0, 1) != '#')){
			$query .= $sql_line;
			if(preg_match("/;\s*$/", $sql_line)){
				if(strlen(trim($query)) > 5){					
					if(EI_MODE == 'debug'){
						if(!$db->Query($query)){ $error_mg[] = '<b>SQL</b>:'.$query.'<br /><br /><b>'.lang_key('error').'</b>:<br />'.$db->Error(); return false; }						
					}else{
						if(!@$db->Query($query)) return false;
					}
				}
				$query = '';
			}
		}
	}
	return true;
}

/**
 * 	Returns language key
 * 		@param $key
 */
function lang_key($key){
	global $arrLang;
        $output = '';
        
	if(isset($arrLang[$key])){
		$output = $arrLang[$key];
	}else{
		$output = str_replace('_', ' ', $key);		
	}
	return $output;
}

/**
 *	Remove bad chars from input
 *	  	@param $str_words - input
 **/
function prepare_input($str_words, $escape = false, $level = 'low')
{
	$found = false;
	$str_words = htmlentities(strip_tags($str_words));
	if($level == 'low'){
		$bad_string = array('drop', '--', 'insert', 'xp_', '%20union%20', '/*', '*/union/*', '+union+', 'load_file', 'outfile', 'document.cookie', 'onmouse', '<script', '<iframe', '<applet', '<meta', '<style', '<form', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'ftp://', 'smb://', 'onmouseover=', 'onmouseout=');
	}else if($level == 'medium'){
		$bad_string = array('select', 'drop', '--', 'insert', 'xp_', '%20union%20', '/*', '*/union/*', '+union+', 'load_file', 'outfile', 'document.cookie', 'onmouse', '<script', '<iframe', '<applet', '<meta', '<style', '<form', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'ftp://', 'smb://', 'onmouseover=', 'onmouseout=');		
	}else{
		$bad_string = array('select', 'drop', '--', 'insert', 'xp_', '%20union%20', '/*', '*/union/*', '+union+', 'load_file', 'outfile', 'document.cookie', 'onmouse', '<script', '<iframe', '<applet', '<meta', '<style', '<form', '<img', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'http://', 'https://', 'ftp://', 'smb://', 'onmouseover=', 'onmouseout=');
	}
	for($i = 0; $i < count($bad_string); $i++){
		$str_words = str_replace($bad_string[$i], '', $str_words);
	}
	
	if($escape){
		$str_words = encode_text($str_words); 
	}
	
	return $str_words;
}

/**
 *	Get encoded text
 *		@param $string
 */
function encode_text($string = '')
{
	$search	 = array("\\","\0","\n","\r","\x1a","'",'"',"\'",'\"');
	$replace = array("\\\\","\\0","\\n","\\r","\Z","\'",'\"',"\\'",'\\"');
	return str_replace($search, $replace, $string);
}

function is_email($value)
{
	return preg_match('/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/', $value);
}


function draw_side_navigation($step = 1, $draw = true)
{
	$steps = array(
		'1'=>array('url'=>'start.php', 'text'=>lang_key('start')),
		'2'=>array('url'=>'server_requirements.php', 'text'=>lang_key('server_requirements')),
		'3'=>array('url'=>'database_settings.php', 'text'=>lang_key('database_settings')),
		'4'=>array('url'=>'administrator_account.php', 'text'=>lang_key('administrator_account')),
		'5'=>array('url'=>'core_configuration.php', 'text'=>lang_key('core_configuration')),
		'6'=>array('url'=>'department_configuration.php', 'text'=>lang_key('department_configuration')),
		'7'=>array('url'=>'civilian_configuration.php', 'text'=>lang_key('civilian_configuration')),
		'8'=>array('url'=>'administrative_settings.php', 'text'=>lang_key('administrative_configuration')),
		'9'=>array('url'=>'extra_settings.php', 'text'=>lang_key('extra_settings')),
		'10'=>array('url'=>'ready_to_install.php', 'text'=>lang_key('ready_to_install')),
		'11'=>array('url'=>'complete_installation.php', 'text'=>lang_key('installation_complete'))
	);
	
	$output  = '<div class="left-part">';
	$output .= '<ul class="left-menu">';
		foreach($steps as $key => $val){
			if($step > $key){				
				$css_class = ' class="passed"';
				$output .= '<li'.$css_class.'><a href="'.$val['url'].'">'.$val['text'].'</a></li>';
			}else if($step == $key){
				$css_class = ' class="current"';
				$output .= '<li'.$css_class.'><label>'.$val['text'].'</label></li>';
			}else{
				$output .= '<li><label>'.$val['text'].'</label></li>';
			}
			
			///'.$key.'. 
			
		}
	$output .= '</ul>';
	$output .= '</div>';
	
	if($draw) echo $output;	
	else return $output;
}

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

