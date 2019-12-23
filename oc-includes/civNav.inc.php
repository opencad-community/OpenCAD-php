<ul class="nav navbar">									

									<?php
						   if (CIV_WARRANT === true) { ?> 
						   		<li class="nav-item dropdown">
									<a class="nav-item dropdown-toggle" data-toggle="dropdown" href="#" role="tab" aria-haspopup="true" aria-expanded="false"><i class="fas fa-database" style="color:black"></i> <?php echo lang_key("WARRANTS"); ?></a>
									<div class="dropdown-menu">
										<a class="dropdown-item" type="button" data-toggle="modal" data-target="#viewWarrant"> <?php echo lang_key("VIEW_WARRANTS"); ?></a>
										<a class="dropdown-item" type="button" data-toggle="modal" data-target="#createWarrant"><?php echo lang_key("CREATE_WARRANT"); ?></a>
										</div>
									</li>
									<?php } else { ?>
									<?php } ?>
										<li class="nav-item"><a type="button" data-toggle="modal" data-target="#newCall"> <i class="fas fa-phone"></i> <?php echo lang_key("CREATE_A_CALL"); ?></a></li>
									<?php
				if ( CIV_LIMIT_MAX_IDENTITIES == 0 ) {
					echo '<li><a type="button" data-toggle="modal" data-target="#IdentityModal"><i class="fas fa-user-alt"></i> '. lang_key("ADD_NEW_IDENTITY").'</a></li>';
				} else if ( CIV_LIMIT_MAX_IDENTITIES > getNumberOfProfiles() ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#IdentityModal"><i class="fas fa-user-alt"></i> '.lang_key("ADD_NEW_IDENTITY").' </a></li>';
				} else {/* Do Nothing. */}
				if ( CIV_LIMIT_MAX_VEHICLES == 0 ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createPlateModal"> <i class="fas fa-car"></i> '.lang_key("ADD_NEW_VEHICLE").'</a></li>';
				} else if ( CIV_LIMIT_MAX_VEHICLES > getNumberOfVehicles() ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createPlateModal"> <i class="fas fa-car"></i> '.lang_key("ADD_NEW_VEHICLE").'</a></li>';
				} else {/* Do Nothing. */}
				if ( CIV_LIMIT_MAX_WEAPONS == 0 ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createWeaponModal"> '.lang_key("ADD_NEW_WEAPON").'</a></li>';
				} else if ( CIV_LIMIT_MAX_WEAPONS > getNumberOfWeapons() ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createWeaponModal"> '.lang_key("ADD_NEW_WEAPON").'</a></li>';
				} else {/* Do Nothing. */}
			?>
			</ul>