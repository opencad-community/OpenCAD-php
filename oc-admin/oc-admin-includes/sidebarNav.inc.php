<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
        <li <?php if ( $pageName == "Dashboard") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/admin.php"><i class="fas fa-home"></i>  Dashboard</a></li>
        <li <?php if ( $pageName == "User Management") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/userManagement.php"><i class="fas fa-user"></i> User Management</a></li>
        <?php if ( ( MODERATOR_NCIC_EDITOR == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        { ?>
        <li <?php if ( $pageName == "NCIC Editor") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/ncicAdmin.php"><i class="fas fa-database"></i> NCIC Editor</a></li>
      <?php  } else { }?>

      <?php if ( ( MODERATOR_DATA_MANAGER == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
        { ?>
      <li>
          <a><i class="fas fa-table"></i> Game Data Manager <span class="fas fa-chevron-down"></span></a>
          <ul class="nav child_menu">

            <li <?php if ( $pageName == "Citation Types Manager") echo $currentPage; if (MODERATOR_DATAMAN_CITATIONTYPES == false) echo "onclick=\"return false\""; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/dataManagement/citationTypeManager.php"><i class="fas fa-exclamation-triangle"></i> Citation Types Manager</a></li>
            <li <?php if ( $pageName == "Departments Manager") echo $currentPage; if (MODERATOR_DATAMAN_CITATIONTYPES == false) echo "onclick=\"return false\""; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/dataManagement/departmentsManager.php"><i class="fas fa-exclamation-triangle"></i> Departments Manager</a></li>
            <li <?php if ( $pageName == "Incident Types Manager") echo $currentPage; if (MODERATOR_DATAMAN_INCIDENTTYPES == false) echo "onclick=\"return false\"";  ?>><a href="<?php echo BASE_URL; ?>/oc-admin/dataManagement/incidentTypeManager.php" disabled><i class="fas fa-shield-alt"></i> Incident Types Manager</a></li>
            <li <?php if ( $pageName == "Radio Codes Manager") echo $currentPage; ?>><a href="<?php echo BASE_URL; if (MODERATOR_DATAMAN_RADIOCODES== false) echo "onclick=\"return false\"";    ?>/oc-admin/dataManagement/radioCodesManager.php" ><i class="fas fa-shield-alt"></i> Radio Codes Manager</a></li>
            <li <?php if ( $pageName == "Streets Manager") echo $currentPage; ?>><a href="<?php echo BASE_URL; if (MODERATOR_DATAMAN_STREET == false) echo "onclick=\"return false\"";  ?>/oc-admin/dataManagement/streetManager.php"><i class="fas fa-road"></i> Streets Manager</a></li>
            <li <?php if ( $pageName == "Vehicles Manager") echo $currentPage; ?>><a href="<?php echo BASE_URL; if (MODERATOR_DATAMAN_VEHICLES == false) echo "onclick=\"return false\"";  ?>/oc-admin/dataManagement/vehicleManager.php"><i class="fas fa-motorcycle"></i> Vehicles Manager</a></li>
            <li <?php if ( $pageName == "Warning Types Manager") echo $currentPage; ?>><a href="<?php echo BASE_URL; if (MODERATOR_DATAMAN_WARNINGTYPES == false) echo "onclick=\"return false\"";  ?>/oc-admin/dataManagement/warningTypeManager.php" disabled><i class="fas fa-exclamation-triangle"></i> Warning Types Manager</a></li>
            <li <?php if ( $pageName == "Warrant Types Manager") echo $currentPage; ?>><a href="<?php echo BASE_URL; if (MODERATOR_DATAMAN_WARRANTTYPES == false) echo "onclick=\"return false\"";  ?>/oc-admin/dataManagement/warrantTypeManager.php" disabled><i class="fas fa-exclamation-triangle"></i> Warrant Types Manager</a></li>
            <li <?php if ( $pageName == "Weapon Manager") echo $currentPage; ?>><a href="<?php echo BASE_URL; if (MODERATOR_DATAMAN_WEAPONS == false) echo "onclick=\"return false\"";  ?>/oc-admin/dataManagement/weaponManager.php" disabled><i class="fas fa-shield-alt"></i> Weapon Manager</a></li>
            <li><a <?php if (MODERATOR_DATAMAN_IMPEXPRES == false) echo "onclick=\"return false\""; ?> type="button" data-toggle="modal" data-target="#dataManager"> <i class="fas fa-database"></i> Import/Export/Reset</a></li>
          </ul>
        </li>
        <?php } else {} ?>

        <li <?php if ( $pageName == "About OpenCAD") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/about.php"><i class="fas fa-info-circle"></i> About OpenCAD</a></li>
      </li>
    </ul>
  </div>
  <!-- ./ menu_section -->
</div>
<!-- /sidebar menu -->
