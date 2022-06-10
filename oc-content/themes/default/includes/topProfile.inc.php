<?php require_once(__DIR__ . '/../../../../oc-config.php');
require_once( ABSPATH . '/oc-functions.php'); 
require_once( ABSPATH . '/oc-settings.php');?> 
			<ul class="nav navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a rel="noopener" class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<img src="<?php echo get_avatar() ?>" alt="..." class="img-avatar">
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="dropdown-header text-center">
							<strong><?php echo lang_key("APPLICATIONS"); ?></strong>
						</div>
						<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL.'/'.OCAPPS ?>/oc-start.php">
							<em class="fa fa-bell-o"></em> <?php echo lang_key("DASHBOARD"); ?>
						</a>
						<div class="dropdown-header text-center">
							<strong><?php echo lang_key("SETTINGS"); ?></strong>
						</div>
						<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL.'/'.OCAPPS ?>/oc-profile.php">
							<em class="fa fa-user"></em> <?php echo lang_key("MY_PROFILE"); ?></a>
						<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL.'/'.OCINC ?>/logout.php">
							<em class="fa fa-lock"></em> <?php echo lang_key("LOGOUT") ?></a>
					</div>
				</li>
			</ul>