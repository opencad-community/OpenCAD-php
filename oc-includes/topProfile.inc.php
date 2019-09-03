<?php require_once( '../oc-config.php');?> 
      <?php require_once( ABSPATH . '/oc-settings.php');?> 
      
      <ul class="nav navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo get_avatar() ?>" alt="..." class="img-avatar">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Applications</strong>
            </div>
            <a class="dropdown-item" href="<?php echo BASE_URL.OCAPPS ?>/oc-start.php">
              <i class="fa fa-bell-o"></i> Dashboard
            </a>
            <div class="dropdown-header text-center">
              <strong>Settings</strong>
            </div>
            <a class="dropdown-item" href="<?php echo BASE_URL.OCAPPS ?>/oc-profile.php">
              <i class="fa fa-user"></i> Profile</a>
            <a class="dropdown-item" href="<?php echo BASE_URL.OCINC ?>/logout.php">
              <i class="fa fa-lock"></i> Logout</a>
          </div>
        </li>
      </ul>