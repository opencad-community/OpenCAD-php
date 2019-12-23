<?php require_once( __DIR__ . '/../oc-config.php');
require_once( ABSPATH . '/oc-functions.php'); 
require_once( ABSPATH . '/oc-settings.php');?> 
      
      <ul class="nav navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo get_avatar() ?>" alt="..." class="img-avatar">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong><?php echo lang_key("APPLICATIONS"); ?></strong>
            </div>
            <a class="dropdown-item" href="<?php echo BASE_URL.'/'.OCAPPS ?>/oc-start.php">
              <i class="fa fa-bell-o"></i> <?php echo lang_key("DASHBOARD"); ?>
            </a>
            <div class="dropdown-header text-center">
              <strong><?php echo lang_key("SETTINGS"); ?></strong>
            </div>
            <a class="dropdown-item" href="<?php echo BASE_URL.'/'.OCAPPS ?>/oc-profile.php">
              <i class="fa fa-user"></i> <?php echo lang_key("MY_PROFILE"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL.'/'.OCINC ?>/logout.php">
              <i class="fa fa-lock"></i> <?php echo lang_key("LOGOUT") ?></a>
          </div>
        </li>
      </ul>