<?php

    if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
    }
		echo '		<ul class="nav navbar-nav">';
			?>
				<a rel="noopener" class="navbar-brand" href="#">
					<img class="navbar-brand-full" src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/images/logo_brand.png" width="30" height="25" alt="OpenCAD Logo">
				</a>
			<?php
				if (CIV_WARRANT === true) { ?> 
				<li class="nav-item dropdown px-2">
					<a rel="noopener" class="nav-item  dropdown-toggle" type="button" data-toggle="dropdown" role="tab" aria-haspopup="true" aria-expanded="false"><em class="fas fa-database" style="color:black"></em> <?php echo lang_key("WARRANTS"); ?></a>
					<div class="dropdown-menu">
						<a rel="noopener" class="dropdown-item" type="button" data-toggle="modal" data-target="#viewWarrant"> <?php echo lang_key("VIEW_WARRANTS"); ?></a>
						<a rel="noopener" class="dropdown-item" type="button" data-toggle="modal" data-target="#createWarrant"><?php echo lang_key("CREATE_WARRANT"); ?></a>
					</div>
				</li>
				<?php } ?>

				<li class="nav-item px-2"><a rel="noopener" type="button" data-toggle="modal" data-target="#newCallModal"> <em class="fas fa-phone"></em> <?php echo lang_key("CREATE_A_CALL"); ?></a></li>
			<?php
			if ( CIV_LIMIT_MAX_IDENTITIES == 0 ) {
				echo '	<li class="nav-item px-2" ><a rel="noopener" type="button" data-toggle="modal" data-target="#IdentityModal"> <em class="fas fa-user-alt"></em> '. lang_key("ADD_NEW_IDENTITY").'</a></li>'.PHP_EOL;
			} else if ( CIV_LIMIT_MAX_IDENTITIES > getNumberOfProfiles() ) {
				echo '	<li class="nav-item px-2"><a rel="noopener" type="button" data-toggle="modal" data-target="#IdentityModal"> <em class="fas fa-user-alt"></em> '.lang_key("ADD_NEW_IDENTITY").' </a></li>'.PHP_EOL;
			}

			if ( CIV_LIMIT_MAX_VEHICLES == 0 ) {
				echo '				<li class="nav-item px-2"><a rel="noopener" type="button" data-toggle="modal" data-target="#createPlateModal"> <em class="fas fa-car"></em> '.lang_key("ADD_NEW_VEHICLE").'</a></li>'.PHP_EOL;
			} else if ( CIV_LIMIT_MAX_VEHICLES > getNumberOfVehicles() ) {
				echo '				<li class="nav-item px-2"><a rel="noopener" type="button" data-toggle="modal" data-target="#createPlateModal"> <em class="fas fa-car"></em> '.lang_key("ADD_NEW_VEHICLE").'</a></li>'.PHP_EOL;
			}

			if ( CIV_LIMIT_MAX_WEAPONS == 0 ) {
				echo '				<li class="nav-item px-2"><a rel="noopener" type="button" data-toggle="modal" data-target="#createWeaponModal"> '.lang_key("ADD_NEW_WEAPON").'</a></li>'.PHP_EOL;
			} else if ( CIV_LIMIT_MAX_WEAPONS > getNumberOfWeapons() ) {
				echo '				<li class="nav-item px-2"><a rel="noopener" type="button" data-toggle="modal" data-target="#createWeaponModal"> '.lang_key("ADD_NEW_WEAPON").'</a></li>'.PHP_EOL;
			}
		?>

			</ul>