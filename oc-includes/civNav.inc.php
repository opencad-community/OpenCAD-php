<ul class="nav navbar">									

									<?php
						   if (CIV_WARRANT === true) { ?> <li class="nav-item">
										<a><i class="fas fa-warning"></i> Warrants <span
												class="fas fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createWarrant">
													Create Warrants</a></li>
											<li class="nav-item"><a type="button" data-toggle="modal" data-target="#viewWarrant"> View
													Warrants</a></li>
										</ul>
									</li>
									<?php } else { ?>
									<?php } ?>
									<li class="nav-item"><a type="button" data-toggle="modal" data-target="#newCall"> <i
												class="fas fa-phone"></i> Create a Call</a></li>
									<?php
				if ( CIV_LIMIT_MAX_IDENTITIES == 0 ) {
					echo '<li><a type="button" data-toggle="modal" data-target="#IdentityModal"><i class="fas fa-user-alt"></i> Add New Identity</a></li>';
				} else if ( CIV_LIMIT_MAX_IDENTITIES > getNumberOfProfiles() ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#IdentityModal"><i class="fas fa-user-alt"></i> Add New Identity</a></li>';
				} else {/* Do Nothing. */}
				if ( CIV_LIMIT_MAX_VEHICLES == 0 ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createPlateModal"> <i class="fas fa-car"></i> Add New Plate</a></li>';
				} else if ( CIV_LIMIT_MAX_VEHICLES > getNumberOfVehicles() ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createPlateModal"> <i class="fas fa-car"></i> Add New Plate</a></li>';
				} else {/* Do Nothing. */}
				if ( CIV_LIMIT_MAX_WEAPONS == 0 ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createWeaponModal">Add New Weapon</a></li>';
				} else if ( CIV_LIMIT_MAX_WEAPONS > getNumberOfWeapons() ) {
					echo '<li class="nav-item"><a type="button" data-toggle="modal" data-target="#createWeaponModal">Add New Weapon</a></li>';
				} else {/* Do Nothing. */}
			?>
			</ul>