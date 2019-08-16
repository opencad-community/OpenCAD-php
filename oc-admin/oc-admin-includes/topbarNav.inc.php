
    <ul class="nav navbar">
        <li class="nav-item" <?php if ( $pageName == "Dashboard") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/admin.php"><i class="fas fa-home"></i>  Dashboard</a></li>
        <?php if ( ( MODERATOR_USER_MANAGER == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        { ?>
        <li class="nav-item" <?php if ( $pageName == "".lang_key("USER_MANAGER")."") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/userManagement.php"><i class="fas fa-database fa-3px " style="color:black"></i> <?php echo lang_key("USER_MANAGER"); ?></a></li>
      <?php  } else { }?>
        <?php if ( ( MODERATOR_NCIC_EDITOR == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        { ?>
        <li class="nav-item" <?php if ( $pageName == "".lang_key("NCIC_EDITOR")."") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/ncicAdmin.php"><i class="fas fa-database fa-3px"></i> <?php echo lang_key("NCIC_EDITOR"); ?></a></li>
      <?php  } else { }?>
      <?php if ( ( MODERATOR_DATA_MANAGER == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        { ?>
        <li class="nav-item dropdown">
          <a class="nav-item dropdown-toggle" data-toggle="dropdown" href="#" role="tab" aria-haspopup="true" aria-expanded="false"><i class="fas fa-database" style="color:black"></i> <?php echo lang_key("DATA_MANAGER"); ?></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/citationTypeManager.php"; ?>"><?php echo lang_key("CITATIONTYPE_MANAGER"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/departmentsManager.php"; ?>"><?php echo lang_key("DEPARTMENT_MANAGER"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/incidentTypeManager.php"; ?>"><?php echo lang_key("INCIDENTTYPE_MANAGER"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/radioCodeManager.php"; ?>"><?php echo lang_key("RADIOCODE_MANAGER"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/streetManager.php"; ?>"><?php echo lang_key("STREET_MANAGER"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/vehicleManager.php"; ?>"><?php echo lang_key("VEHICLE_MANAGER"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/warningTypeManager.php"; ?>"><?php echo lang_key("WARNINGTYPE_MANAGER"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/warrantTypeManager.php"; ?>"><?php echo lang_key("WARRANTTYPE_MANAGER"); ?></a>
            <a class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/weaponManager.php"; ?>"><?php echo lang_key("WEAPON_MANAGER"); ?></a>
          </div>
        </li>
        <?php  } else { }?>
        <li class="nav-item" <?php if ( $pageName == "" . lang_key("ABOUT_OPENCAD") . "") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/about.php"><i class="fas fa-info-circle fa-3px" style="color:black"></i> <?php echo lang_key("ABOUT_OPENCAD"); ?></a></li>

    </ul>