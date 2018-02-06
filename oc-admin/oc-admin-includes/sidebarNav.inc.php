<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
        <li <?php if ( $pageName == "Dashboard") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/admin.php">Dashboard</a></li>
        <li <?php if ( $pageName == "User Management") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/userManagement.php">User Management</a></li>
        <li <?php if ( $pageName == "Call History") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/callhistory.php">Call History</a></li>
      </li>
      <li><a><i class="fa fa-database"></i> NCIC Editor <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li <?php if ( $pageName == "NCIC Editor") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/ncicAdmin.php">NCIC Editor</a></li>
        </ul>
      </li>

      <li><a><i class="fa fa-key"></i> CAD Permissions <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li <?php if ( $pageName == "Permissions Management") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/permissionManagement.php">Permissions Management</a></li>
        </ul>
        <li <?php if ( $pageName == "About OpenCAD") echo $currentPage; ?>><a href="<?php echo BASE_URL; ?>/oc-admin/about.php">About OpenCAD</a></li>
      </li>

    </ul>
  </div>
  <!-- ./ menu_section -->
</div>
<!-- /sidebar menu -->
