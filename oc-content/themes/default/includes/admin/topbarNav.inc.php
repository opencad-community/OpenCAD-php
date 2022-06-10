		<?php
			if(session_id() == '' || !isset($_SESSION)) {
			// session isn't started
			session_start();
		} ?>
			<a rel="noopener" class="navbar-brand" href="#">
				<img class="navbar-brand-full" src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME ?>/images/logo_brand.png" width="30" height="25" alt="OpenCAD Logo">
			</a>
		<ul class="nav navbar-nav">
		<li class="nav-item px-3" <?php if ( $pageName == "Dashboard") echo $currentPage; ?>><a rel="noopener" href="<?php echo BASE_URL; ?>/oc-admin/admin.php" style="color:black"><em class="fas fa-home"  style="color:black"></em>  Dashboard</a></li>
		<?php if ( ( MODERATOR_USER_MANAGER == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
		{ ?>
		<li class="nav-item px-3" <?php if ( $pageName == "".lang_key("USER_MANAGER")."") echo $currentPage; ?>><a rel="noopener" href="<?php echo BASE_URL; ?>/oc-admin/userManagement.php" style="color:black"><em class="fas fa-database fa-3px" style="color:black"></em> <?php echo lang_key("USER_MANAGER"); ?></a></li>
		<?php  } ?>
		<?php if ( ( MODERATOR_NCIC_EDITOR == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
		{ ?>
		<li class="nav-item px-3" <?php if ( $pageName == "".lang_key("NCIC_EDITOR")."") echo $currentPage; ?>><a rel="noopener" href="<?php echo BASE_URL; ?>/oc-admin/ncicAdmin.php" style="color:black"><em class="fas fa-database fa-3px" style="color:black"></em> <?php echo lang_key("NCIC_EDITOR"); ?></a></li>
		<?php  } ?>
		<?php if ( ( MODERATOR_DATA_MANAGER == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
		{ ?>
		<li class="nav-item dropdown">
			<a rel="noopener" class="nav-item dropdown-toggle" data-toggle="dropdown" href="#" role="tab" aria-haspopup="true" aria-expanded="false" style="color:black"><em class="fas fa-database" style="color:black"></em> <?php echo lang_key("DATA_MANAGER"); ?></a>			<div class="dropdown-menu">
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/citationTypeManager.php"; ?>"><em class="fas fa-exclamation-triangle"></em> <?php echo lang_key("CITATIONTYPE_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/departmentsManager.php"; ?>"><em class="fas fa-exclamation-triangle"></em> <?php echo lang_key("DEPARTMENT_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/incidentTypeManager.php"; ?>"><em class="fas fa-shield-alt"></em> <?php echo lang_key("INCIDENTTYPE_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/radioCodesManager.php"; ?>"><em class="fas fa-shield-alt"></em> <?php echo lang_key("RADIOCODE_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/streetManager.php"; ?>"><em class="fas fa-road"></em> <?php echo lang_key("STREET_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/vehicleManager.php"; ?>"><em class="fas fa-motorcycle"></em> <?php echo lang_key("VEHICLE_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/warningTypeManager.php"; ?>"><em class="fas fa-exclamation-triangle"></em> <?php echo lang_key("WARNINGTYPE_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/warrantTypeManager.php"; ?>"><em class="fas fa-exclamation-triangle"></em> <?php echo lang_key("WARRANTTYPE_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" href="<?php echo BASE_URL . "/oc-admin/dataManagement/weaponManager.php"; ?>"><em class="fas fa-shield-alt"></em> <?php echo lang_key("WEAPON_MANAGER"); ?></a>
			<a rel="noopener" class="dropdown-item" <?php if (MODERATOR_DATAMAN_IMPEXPRES == false) echo "onclick=\"return false\""; ?> type="button" data-toggle="modal" data-target="#dataManager"> <em class="fas fa-database"></em> Import/Export/Reset</a>
			</div>
		</li>
		<?php  } ?>
		<li class="nav-item px-3"<?php if ( $pageName == "" . lang_key("ABOUT_OPENCAD") . "") echo $currentPage; ?>><a rel="noopener" href="<?php echo BASE_URL; ?>/oc-admin/about.php"  style="color:black"><em class="fas fa-info-circle fa-3px" style="color:black"></em> <?php echo lang_key("ABOUT_OPENCAD"); ?></a></li>
		</ul>