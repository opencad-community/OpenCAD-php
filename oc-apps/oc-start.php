<?php

if(session_id() == '' || !isset($_SESSION)) {
	// session isn't started
	session_start();
	}

require_once( "../oc-config.php");
require_once( ABSPATH . '/oc-functions.php');
require_once( ABSPATH. '/oc-settings.php');
require_once( ABSPATH . "/oc-includes/generalActions.php");
require_once( ABSPATH . "/oc-includes/adminActions.php");
include_once( ABSPATH . "/" . OCCONTENT . "/plugins/api_auth.php" );

setDispatcher("1");

$adminButton = "";
$debugInfo = "";
$dispatchButton = "";
$highwayButton = "";
$stateButton = "";
$fireButton = "";
$emsButton = "";
$sheriffButton = "";
$policeButton = "";
$civilianButton = "";
$roadsideAssistButton = "";

	if ( $_SESSION['state'] === "YES" || $_SESSION['police'] === "YES" || $_SESSION['highway'] === "YES" || $_SESSION['sheriff'] === "YES" )
	{
		$leoTitle = "<li class=\"nav-title\">".lang_key("LAW_ENFORCEMENT_SERVICES")."</li>";
	}

	if ( $_SESSION['first'] === "YES" || $_SESSION['ems'] === "YES" )
	{
		$firstResponderTitle = "<li class=\"nav-title\">".lang_key("FIRST_RESPONDER_SERVICES")."</li>";
	}

	if ( $_SESSION['civilianPrivilege'] === '1' || $_SESSION['dispath'] === "YES" )
	{
		$civilianTitle = "<li class=\"nav-title\">".lang_key("CIVILIAN_SERVICES")."</li>";
	}

	if ($_SESSION['state'] === 'YES')
	{
		$stateButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\"  href=\"".BASE_URL."/".OCAPPS."//mdt.php?dep=state\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">State</a></li>";
	}
	if ($_SESSION['ems'] === 'YES')
	{
		$emsButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=ems\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">EMS</a></li>";   
	}
	if ($_SESSION['fire'] === 'YES')
	{
		$fireButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=fire\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Fire</a></li>";
	}
	if ($_SESSION['highway'] === 'YES')
	{
		$highwayButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=highway\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Highway Patrol</a></li>";
	}
	if ($_SESSION['police'] === 'YES')
	{
		$policeButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=police\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Police Department</a></li>";
	}
	if ($_SESSION['sheriff'] === 'YES')
	{
		$sheriffButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=sheriff\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Sheriff's Office</a></li>";
	}
	if ($_SESSION['dispatch'] === 'YES')
	{
		$dispatchButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/cad.php\">Dispatch<em class=\"nav-icon icon-pencil\"></em> </a></li>";
	} 
	if ($_SESSION['roadsideAssist'] === 'YES')
	{
		$roadsideAssistButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\"href=\"".BASE_URL."/".OCAPPS."/mdt.php?dep=roadesideAssist\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Roadside Assistance</a></li>";
	}
	
	if ($_SESSION['civilianPrivilege'] === '1')
	{
		$civilianButton = "<li class=\"nav-item\" style=\"list-style: none;\"><a rel=\"noopener\" class=\"nav-link\" href=\"".BASE_URL."/".OCAPPS."/civilian.php\" class=\"btn btn-lg cusbtn animate fadeInLeft delay1\">Civilian Services</a></li>";
	}
	if ($_SESSION['adminPrivilege'] === '3')
	{
		$adminButton = "<a rel=\"noopener\" href=\"".BASE_URL."/oc-admin/admin.php\" class=\"btn btn-primary btn-md animate fadeInLeft delay1 \">Admin</a> ";
		if (OC_DEBUG == 'true')$debugInfo = "<button class=\"btn btn-primary animate fadeInLeft delay2\" name=\"debugInfo_btn\" data-toggle=\"modal\" data-target=\"#debugInfo\">".lang_key("DEBUG_INFO")."</button>";
	}
	if ($_SESSION['adminPrivilege'] === "2")
	{
		$adminButton = "<a rel=\"noopener\" href=\"".BASE_URL."/oc-admin/admin.php\" class=\"btnbtn-primary btn-md animate fadeInLeft delay1\">Moderator</a>";
	}

if (empty($_SESSION['logged_in']))
{
	header('Location: '.BASE_URL);
	die("Not logged in");
}
?>

<!DOCTYPE html>
<html lang="en">
	<?php include ( ABSPATH . "/".OCTHEMES."/".THEME."/includes/header.inc.php"); ?>
	<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-sm">
		<header class="app-header navbar">
			<a rel="noopener" class="navbar-brand" href="#">
				<img class="navbar-brand-full" src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/images/logo_brand.png" width="30" height="25" alt="OpenCAD Logo">
			</a>
			<button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
				<span class="navbar-toggler-icon"></span>
			</button>
			<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php include( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/topProfile.inc.php"); ?>
		</header>
		<div class="app-body">
			<div class="sidebar">
				<nav class="sidebar-nav">
					<ul class="nav">
						<?php echo $civilianTitle; ?>
					<ul>
						<?php echo $dispatchButton;?>
						<?php echo $civilianButton; ?>
					</ul>
						<?php echo $leoTitle; ?>
					<ul>
						<?php echo $sheriffButton;?>
						<?php echo $highwayButton;?>
						<?php echo $stateButton;?>
						<?php echo $policeButton;?>
					</ul>
				</li>
					<?php echo $firstResponderTitle; ?>
					<ul>
						<?php echo $fireButton;?>
						<?php echo $emsButton;?>
					</ul>
					</ul>
				</nav>
			</div>
			<main class="main">
				<div class="container-fluid">
					<div class="animated fadeIn">
						<br />
						<?php if ( $_SESSION['adminPrivilege'] == 3 | $_SESSION['adminPrivilege'] == 2 ) {?>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<?php echo lang_key("ACCESS_REQUESTS"); ?>
									</div>
									<div class="card-body">
										<?php getPendingUsersReadOnly();?>
									</div>
									<div class="card-footer">
										<?php echo $adminButton; echo $debugInfo;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<?php echo lang_key("PATROL_STATUS"); ?>
									<div class="float-right">
										<button class="btn btn-primary btn-sm justify-content-right float-right" name="aop" data-target="#aop" id="getAOP" disabled></button>
									</div>
								</div>
								<?php if (!empty(LIVEMAP_URL)) {?>
								<div class="card-body">
									<iframe src="<?php echo LIVEMAP_URL; ?>" height="1024px" width="100%"></iframe>
								</div>
								<?php } else { ?>
								<div class="card-body">
									<strong>ADMINITRATOR:</strong> <i>Configure LIVEMAP_URL variable in oc-config.php</i>
								</div>
								<?php } ?>
								<div class="card=footer">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</main>
		</div>
	</div>
	</div>
	<?php 
		require_once ( ABSPATH . "/" . OCTHEMES ."/". THEME ."/includes/footer.inc.php");
		require_once ( ABSPATH . OCTHEMEINC ."/scripts.inc.php" ); 
	?>
		<script type="text/javascript">
			$(document).ready(function() {
				$(function() {
					$('#menu_toggle').click();
				});
					getAOP();
				});
			function getAOP() {
			$.ajax({
					type: "GET",
					url: "../<?php echo OCINC ?>/generalActions.php",
					data: {
						getAOP: 'yes'
					},
					success: function(response)
					{
						$('#getAOP').html(response);
						// SG - Removed until node/real-time data setup
						/*$('#activeUsers').DataTable({
						searching: false,
						scrollY: "200px",
						lengthMenu: [[4, -1], [4, "All"]]
					});*/
						setTimeout(getAOP, 5000);
					},
					error : function(XMLHttpRequest, textStatus, errorThrown)
					{
						console.log("Error");
					}
				});
			}
		</script>
	</body>
</html>