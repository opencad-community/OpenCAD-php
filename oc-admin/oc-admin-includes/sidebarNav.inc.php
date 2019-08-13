
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3" <?php if ( $pageName == "Dashboard") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/admin.php"><i class="fas fa-home"></i>  Dashboard</a></li>
        <?php if ( ( MODERATOR_USER_MANAGER == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        { ?>
        <li class="nav-item px-3" <?php if ( $pageName == "User Manager") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/userManagement.php"><i class="fas fa-database fa-3px " style="color:black"></i> Users</a></li>
      <?php  } else { }?>
        <?php if ( ( MODERATOR_NCIC_EDITOR == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        { ?>
        <li class="nav-item px-3" <?php if ( $pageName == "NCIC Editor") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/ncicAdmin.php"><i class="fas fa-database fa-3px"  role="tab" data-toggle="tab" style="color:black"></i> NCIC Editor</a></li>
      <?php  } else { }?>
        <li class="nav-item px-3" <?php if ( $pageName == "About OpenCAD") echo $currentPage; ?>><a class= href="<?php echo BASE_URL; ?>/oc-admin/about.php"><i class="fas fa-info-circle fa-3px" style="color:black"></i> About OpenCAD</a></li>
      </li>
    </ul>