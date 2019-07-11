<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Pluggin QapTcha : captcha system with jQuery</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="jquery/QapTcha.jquery.css" type="text/css" />
	
	<style type="text/css">
		form{margin:30px;width:300px}
		label{float:left;clear:both;width:100px;margin-top:10px}
		input{float:left;margin-top:10px}
		.clr{clear:both}
		.notice {background-color:#d8e6fc;color:#35517c;border:1px solid #a7c3f0;padding:10px}
		
		.code {
			margin:30px;
			border:1px solid #F0F0F0;
			background-color:#F8F8F8;
			padding:10px;
			color:#777;
		}
	</style>
</head>
<body>
<h1>QapTcha Plugin v3.0</h1>
<p><a href="http://www.myjqueryplugins.com/QapTcha">Home Page QapTcha</a></p>
<p><a href="http://www.myjqueryplugins.com/QapTcha/demo">Online Demo QapTcha</a></p>
<?php
	// if form is submit
	if(isset($_POST['submit']))
	{
		$response = '<div class="notice">';
		
		if(isset($_POST['iQapTcha']) && empty($_POST['iQapTcha']) && isset($_SESSION['iQaptcha']) && $_SESSION['iQaptcha'])
		{
			$response .= 'Form can be submited';
			unset($_SESSION['iQaptcha']);
		}
		else
			$response .= 'Form can not be submited';
			
		$response .= '</div>';
		
		echo $response;
	}
?>

<form method="post" action="">
	<fieldset>
		<label>First Name</label> <input type="text" name="firstname" />
		<label>Last Name</label> <input type="text" name="lastname" />
		<div class="clr"></div>
		
		<div class="QapTcha"></div>
		<input type="submit" name="submit" value="Submit form" />
	</fieldset>
</form>

<div class="code">
<pre>
<?php
echo htmlentities('<!--HTML-->
<form method="post" action="">
  <fieldset>
    <label>First Name</label> <input type="text" name="firstname" />
    <label>Last Name</label> <input type="text" name="lastname" />
    <div class="clr"></div>

	<!-- Add this line in your form -->
        <div class="QapTcha"></div>

    <input type="submit" name="submit" value="Submit form" />
  </fieldset>
</form>

<!-- JS -->
<script type="text/javascript">
  $(document).ready(function(){
	$(\'.QapTcha\').QapTcha();
  });
</script>');
?>
</pre>
</div>

	<script type="text/javascript" src="jquery/jquery.js"></script>
	<script type="text/javascript" src="jquery/jquery-ui.js"></script>
	<script type="text/javascript" src="jquery/jquery.ui.touch.js"></script>
	<script type="text/javascript" src="jquery/QapTcha.jquery.js"></script>
	<script type="text/javascript">
		$('.QapTcha').QapTcha({});
	</script>
</body>
</html>
