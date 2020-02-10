<?php

require_once( "../oc-config.php");
require_once( ABSPATH . '/oc-functions.php');
require_once( ABSPATH . '/oc-settings.php');
require_once( ABSPATH . "/oc-includes/generalActions.php");

setDispatcher("1");

$adminButton = "";
$dispatchButton = "";
$highwayButton = "";
$stateButton = "";
$fireButton = "";
$emsButton = "";
$sheriffButton = "";
$policeButton = "";
$civilianButton = "";
$roadsideAssistButton = "";


    if ($_SESSION['state'] === 'YES')
    {
        $stateButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\"  href=\"".BASE_URL."/".OCAPPS."//mdt.php?dep=state\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">State</a></li>";
    }
    if ($_SESSION['ems'] === 'YES')
    {
        $emsButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=ems\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">EMS</a></li>";   
    }
    if ($_SESSION['fire'] === 'YES')
    {
        $fireButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=fire\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Fire</a></li>";
    }
    if ($_SESSION['highway'] === 'YES')
    {
        $highwayButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=highway\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Highway Patrol</a></li>";
    }
    if ($_SESSION['police'] === 'YES')
    {
        $policeButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=police\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Police Department</a></li>";
    }
    if ($_SESSION['sheriff'] === 'YES')
    {
        $sheriffButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=sheriff\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Sheriff's Office</a></li>";
    }
    if ($_SESSION['dispatch'] === 'YES')
    {
        $dispatchButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/cad.php\">Dispatch<i class=\"nav-icon icon-pencil\"></i> </a></li>";
    } 
    if ($_SESSION['roadsideAssist'] === 'YES')
    {
        $roadsideAssistButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\"href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=roadesideAssist\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Roadside Assistance</a></li>";
    } else {}
    
    if ($_SESSION['civilianPrivilege'] === '1')
    {
        $civilianButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/civilian.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Civilian Services</a></li>";
    }
    if ($_SESSION['adminPrivilege'] === '3')
    {
        $adminButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/oc-admin/admin.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Admin</a></li>";
    }
    if ($_SESSION['adminPrivilege'] === "2")
    {
        $adminButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a class=\"nav-link\" href=\"".BASE_URL."/oc-admin/admin.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Moderator</a></li>";
    }

if (empty($_SESSION['logged_in']))
{
	header('Location: '.BASE_URL);
	die("Not logged in");
}
else
{
  // Do Nothing
}

?>

<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.0.0-beta.0
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<!DOCTYPE html>
<html lang="en">
<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>

  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
	<header class="app-header navbar">
	<button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
		<span class="navbar-toggler-icon"></span>
	</button>
	<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
<span class="navbar-toggler-icon"></span>
</button>
	<?php include( ABSPATH . "/" .  OCCONTENT . "/themes/". THEME ."/includes/topProfile.inc.php"); ?>
	</header>
	<div class="app-body">
	  <div class="sidebar">
		<nav class="sidebar-nav">
		  <ul class="nav">
<<<<<<< HEAD
				<ul "nav-dropdown-items">
					<?php echo $dispatchButton;?>			
				</ul>
				<ul "nav-dropdown-items">
					<?php echo $sheriffButton;?>
					<?php echo $highwayButton;?>
					<?php echo $stateButton;?>
					<?php echo $policeButton;?>
				</ul>
				<ul "nav-dropdown-items">
					<?php echo $fireButton;?>
					<?php echo $emsButton;?>
				</ul>
=======
			<li class="nav-title">Civilian Services</li>
				<?php echo $dispatchButton;?>			
			<li class="nav-item">
			  <a class="nav-link" href="typography.html">
				<i class="nav-icon icon-pencil"></i> Typograhy</a>
			</li>
			<li class="nav-title">Law Enforement Services</li>
				<ul>
				<?php echo $sheriffButton;?>
				<?php echo $highwayButton;?>
				<?php echo $stateButton;?>
				<?php echo $policeButton;?>
			  </ul>
			</li>
			<li class="nav-item nav-dropdown">
			  <a class="nav-link nav-dropdown-toggle" href="#">
				<i class="nav-icon icon-bell"></i> Notifications</a>
			  <ul class="nav-dropdown-items">
				<li class="nav-item">
				  <a class="nav-link" href="notifications-alerts.html">
					<i class="nav-icon icon-bell"></i> Alerts</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="notifications-badge.html">
					<i class="nav-icon icon-bell"></i> Badge</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="notifications-modals.html">
					<i class="nav-icon icon-bell"></i> Modals</a>
				</li>
			  </ul>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="widgets.html">
				<i class="nav-icon icon-calculator"></i> Widgets
				<span class="badge badge-primary">NEW</span>
			  </a>
			</li>
			<li class="divider"></li>
			<li class="nav-title">First Responder Services</li>
			<li class="nav-item nav-dropdown">
			  <a class="nav-link nav-dropdown-toggle" href="#">
				<i class="nav-icon icon-star"></i> Pages</a>
			  <ul class="nav-dropdown-items">
				<li class="nav-item">
				  <a class="nav-link" href="login.html" target="_top">
					<i class="nav-icon icon-star"></i> Login</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="register.html" target="_top">
					<i class="nav-icon icon-star"></i> Register</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="404.html" target="_top">
					<i class="nav-icon icon-star"></i> Error 404</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="500.html" target="_top">
					<i class="nav-icon icon-star"></i> Error 500</a>
				</li>
			  </ul>
			</li>
>>>>>>> 213ef0dd853e19eb3d9e412b77d130fdfd5475ad
		  </ul>
		</nav>
	  </div>
	  <main class="main">
		<div class="container-fluid">
			<div class="animated fadeIn">

			<div class="row">
			  <div class="col-md-12">
				<div class="card">
				  <div class="card-header">
					Traffic &amp; Sales
				  </div>
				  <div class="card-body">
					<div class="row">
					  <div class="col-sm-6">
						<div class="row">
						  <div class="col-sm-6">
							<div class="callout callout-info">
							  <small class="text-muted">New Clients</small>
							  <br>
							  <strong class="h4">9,123</strong>
							  <div class="chart-wrapper">
								<canvas id="sparkline-chart-1" width="100" height="30"></canvas>
							  </div>
							</div>
						  </div>
						  <!--/.col-->
						  <div class="col-sm-6">
							<div class="callout callout-danger">
							  <small class="text-muted">Recuring Clients</small>
							  <br>
							  <strong class="h4">22,643</strong>
							  <div class="chart-wrapper">
								<canvas id="sparkline-chart-2" width="100" height="30"></canvas>
							  </div>
							</div>
						  </div>
						  <!--/.col-->
						</div>
						<!--/.row-->
						<hr class="mt-0">
						<div class="progress-group mb-4">
						  <div class="progress-group-prepend">
							<span class="progress-group-text">
							  Monday
							</span>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group mb-4">
						  <div class="progress-group-prepend">
							<span class="progress-group-text">
							  Tuesday
							</span>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-danger" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group mb-4">
						  <div class="progress-group-prepend">
							<span class="progress-group-text">
							  Wednesday
							</span>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-danger" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group mb-4">
						  <div class="progress-group-prepend">
							<span class="progress-group-text">
							  Thursday
							</span>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-danger" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group mb-4">
						  <div class="progress-group-prepend">
							<span class="progress-group-text">
							  Friday
							</span>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-danger" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group mb-4">
						  <div class="progress-group-prepend">
							<span class="progress-group-text">
							  Saturday
							</span>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group mb-4">
						  <div class="progress-group-prepend">
							<span class="progress-group-text">
							  Sunday
							</span>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-danger" role="progressbar" style="width: 69%" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
					  </div>
					  <!--/.col-->
					  <div class="col-sm-6">
						<div class="row">
						  <div class="col-sm-6">
							<div class="callout callout-warning">
							  <small class="text-muted">Pageviews</small>
							  <br>
							  <strong class="h4">78,623</strong>
							  <div class="chart-wrapper">
								<canvas id="sparkline-chart-3" width="100" height="30"></canvas>
							  </div>
							</div>
						  </div>
						  <!--/.col-->
						  <div class="col-sm-6">
							<div class="callout callout-success">
							  <small class="text-muted">Organic</small>
							  <br>
							  <strong class="h4">49,123</strong>
							  <div class="chart-wrapper">
								<canvas id="sparkline-chart-4" width="100" height="30"></canvas>
							  </div>
							</div>
						  </div>
						  <!--/.col-->
						</div>
						<!--/.row-->
						<hr class="mt-0">
						<div class="progress-group">
						  <div class="progress-group-header">
							<i class="icon-user progress-group-icon"></i>
							<div>Male</div>
							<div class="ml-auto font-weight-bold">43%</div>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group mb-5">
						  <div class="progress-group-header">
							<i class="icon-user-female progress-group-icon"></i>
							<div>Female</div>
							<div class="ml-auto font-weight-bold">37%</div>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group">
						  <div class="progress-group-header align-items-end">
							<i class="icon-globe progress-group-icon"></i>
							<div>Organic Search</div>
							<div class="ml-auto font-weight-bold mr-2">191.235</div>
							<div class="text-muted small">(56%)</div>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-success" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group">
						  <div class="progress-group-header align-items-end">
							<i class="icon-social-facebook progress-group-icon"></i>
							<div>Facebook</div>
							<div class="ml-auto font-weight-bold mr-2">51.223</div>
							<div class="text-muted small">(15%)</div>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group">
						  <div class="progress-group-header align-items-end">
							<i class="icon-social-twitter progress-group-icon"></i>
							<div>Twitter</div>
							<div class="ml-auto font-weight-bold mr-2">37.564</div>
							<div class="text-muted small">(11%)</div>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-success" role="progressbar" style="width: 11%" aria-valuenow="11" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
						<div class="progress-group">
						  <div class="progress-group-header align-items-end">
							<i class="icon-social-linkedin progress-group-icon"></i>
							<div>LinkedIn</div>
							<div class="ml-auto font-weight-bold mr-2">27.319</div>
							<div class="text-muted small">(8%)</div>
						  </div>
						  <div class="progress-group-bars">
							<div class="progress progress-xs">
							  <div class="progress-bar bg-success" role="progressbar" style="width: 8%" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </div>
						</div>
					  </div>
					  <!--/.col-->
					</div>
					<!--/.row-->
					<br/>
					<table class="table table-responsive-sm table-hover table-outline mb-0">
					  <thead class="thead-light">
						<tr>
						  <th class="text-center">
							<i class="icon-people"></i>
						  </th>
						  <th>User</th>
						  <th class="text-center">Country</th>
						  <th>Usage</th>
						  <th class="text-center">Payment Method</th>
						  <th>Activity</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <td class="text-center">
							<div class="avatar">
							  <img src="img/avatars/1.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
							  <span class="avatar-status badge-success"></span>
							</div>
						  </td>
						  <td>
							<div>Yiorgos Avraamu</div>
							<div class="small text-muted">
							  <span>New</span> | Registered: Jan 1, 2015
							</div>
						  </td>
						  <td class="text-center">
							<i class="flag-icon flag-icon-us h4 mb-0" title="us" id="us"></i>
						  </td>
						  <td>
							<div class="clearfix">
							  <div class="float-left">
								<strong>50%</strong>
							  </div>
							  <div class="float-right">
								<small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
							  </div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </td>
						  <td class="text-center">
							<i class="fa fa-cc-mastercard" style="font-size:24px"></i>
						  </td>
						  <td>
							<div class="small text-muted">Last login</div>
							<strong>10 sec ago</strong>
						  </td>
						</tr>
						<tr>
						  <td class="text-center">
							<div class="avatar">
							  <img src="img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
							  <span class="avatar-status badge-danger"></span>
							</div>
						  </td>
						  <td>
							<div>Avram Tarasios</div>
							<div class="small text-muted">

							  <span>Recurring</span> | Registered: Jan 1, 2015
							</div>
						  </td>
						  <td class="text-center">
							<i class="flag-icon flag-icon-br h4 mb-0" title="br" id="br"></i>
						  </td>
						  <td>
							<div class="clearfix">
							  <div class="float-left">
								<strong>10%</strong>
							  </div>
							  <div class="float-right">
								<small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
							  </div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </td>
						  <td class="text-center">
							<i class="fa fa-cc-visa" style="font-size:24px"></i>
						  </td>
						  <td>
							<div class="small text-muted">Last login</div>
							<strong>5 minutes ago</strong>
						  </td>
						</tr>
						<tr>
						  <td class="text-center">
							<div class="avatar">
							  <img src="img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
							  <span class="avatar-status badge-warning"></span>
							</div>
						  </td>
						  <td>
							<div>Quintin Ed</div>
							<div class="small text-muted">
							  <span>New</span> | Registered: Jan 1, 2015
							</div>
						  </td>
						  <td class="text-center">
							<i class="flag-icon flag-icon-in h4 mb-0" title="in" id="in"></i>
						  </td>
						  <td>
							<div class="clearfix">
							  <div class="float-left">
								<strong>74%</strong>
							  </div>
							  <div class="float-right">
								<small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
							  </div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-warning" role="progressbar" style="width: 74%" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </td>
						  <td class="text-center">
							<i class="fa fa-cc-stripe" style="font-size:24px"></i>
						  </td>
						  <td>
							<div class="small text-muted">Last login</div>
							<strong>1 hour ago</strong>
						  </td>
						</tr>
						<tr>
						  <td class="text-center">
							<div class="avatar">
							  <img src="img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
							  <span class="avatar-status badge-secondary"></span>
							</div>
						  </td>
						  <td>
							<div>Enéas Kwadwo</div>
							<div class="small text-muted">
							  <span>New</span> | Registered: Jan 1, 2015
							</div>
						  </td>
						  <td class="text-center">
							<i class="flag-icon flag-icon-fr h4 mb-0" title="fr" id="fr"></i>
						  </td>
						  <td>
							<div class="clearfix">
							  <div class="float-left">
								<strong>98%</strong>
							  </div>
							  <div class="float-right">
								<small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
							  </div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-danger" role="progressbar" style="width: 98%" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </td>
						  <td class="text-center">
							<i class="fa fa-paypal" style="font-size:24px"></i>
						  </td>
						  <td>
							<div class="small text-muted">Last login</div>
							<strong>Last month</strong>
						  </td>
						</tr>
						<tr>
						  <td class="text-center">
							<div class="avatar">
							  <img src="img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
							  <span class="avatar-status badge-success"></span>
							</div>
						  </td>
						  <td>
							<div>Agapetus Tadeáš</div>
							<div class="small text-muted">
							  <span>New</span> | Registered: Jan 1, 2015
							</div>
						  </td>
						  <td class="text-center">
							<i class="flag-icon flag-icon-es h4 mb-0" title="es" id="es"></i>
						  </td>
						  <td>
							<div class="clearfix">
							  <div class="float-left">
								<strong>22%</strong>
							  </div>
							  <div class="float-right">
								<small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
							  </div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </td>
						  <td class="text-center">
							<i class="fa fa-google-wallet" style="font-size:24px"></i>
						  </td>
						  <td>
							<div class="small text-muted">Last login</div>
							<strong>Last week</strong>
						  </td>
						</tr>
						<tr>
						  <td class="text-center">
							<div class="avatar">
							  <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
							  <span class="avatar-status badge-danger"></span>
							</div>
						  </td>
						  <td>
							<div>Friderik Dávid</div>
							<div class="small text-muted">
							  <span>New</span> | Registered: Jan 1, 2015
							</div>
						  </td>
						  <td class="text-center">
							<i class="flag-icon flag-icon-pl h4 mb-0" title="pl" id="pl"></i>
						  </td>
						  <td>
							<div class="clearfix">
							  <div class="float-left">
								<strong>43%</strong>
							  </div>
							  <div class="float-right">
								<small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
							  </div>
							</div>
							<div class="progress progress-xs">
							  <div class="progress-bar bg-success" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						  </td>
						  <td class="text-center">
							<i class="fa fa-cc-amex" style="font-size:24px"></i>
						  </td>
						  <td>
							<div class="small text-muted">Last login</div>
							<strong>Yesterday</strong>
						  </td>
						</tr>
					  </tbody>
					</table>
				  </div>
				</div>
			  </div>
			  <!--/.col-->
			</div>
			<!--/.row-->
		  </div>

		</div>
	  </main>
	</div>
	<footer class="app-footer">
          <div>
              <a href="https://opencad.io">OpenCAD</a>
              <span>&copy; 2017 <?php echo date("Y"); ?>.</span>
          </div>
          <div class="ml-auto">

          </div>
        </footer>
	<?php include ( ABSPATH . "/oc-includes/jquery-colsolidated.inc.php"); ?>
  </body>
</html>