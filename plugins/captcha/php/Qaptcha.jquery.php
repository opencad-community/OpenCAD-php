<?php
session_start();

$aResponse['error'] = false;
$_SESSION['iQaptcha'] = false;	
	
if(isset($_POST['action']))
{
	if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'qaptcha')
	{
		$_SESSION['iQaptcha'] = true;
		if($_SESSION['iQaptcha'])
			echo json_encode($aResponse);
		else
		{
			$aResponse['error'] = true;
			echo json_encode($aResponse);
		}
	}
	else
	{
		$aResponse['error'] = true;
		echo json_encode($aResponse);
	}
}
else
{
	$aResponse['error'] = true;
	echo json_encode($aResponse);
}