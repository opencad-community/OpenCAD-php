<!-- modals -->

<div class="modal" id="newCallModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Create Identity</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
					<form id="new_911" method="post" action="<?php echo BASE_URL; ?>/oc-includes/civActions.php">
						<div class="form-group row">
							<label class="col-md-2 control-label">Caller Name</label>
							<div class="col-md-10">
								<input type="text" name="911_caller" class="form-control" id="911_caller" required />
							</div>
							<!-- ./ col-sm-9 -->
						</div>
						<!-- ./ form-group row -->
						<div class="form-group row">
							<label class="col-md-2 control-label">Location</label>
							<div class="col-md-10">
								<input type="text" name="911_location" class="form-control" id="911_location" required />
							</div>
							<!-- ./ col-sm-9 -->
						</div>
						<!-- ./ form-group row -->
						<div class="form-group row">
							<label class="col-md-2 control-label"><span>Description <a data-toggle="modal"
										href="#911CallHelpModal"><i class="fasfa-question-circle"></i></a></span></label>
							<div class="col-md-10">
								<textarea id="911_description" name="911_description" class="form-control" style="resize:none;" rows="4"></textarea>
							</div>
							<!-- ./ col-sm-9 -->
						</div>
						<!-- ./ form-group row -->
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<input name="create_name" type="submit" class="btn btn-primary" value="Create" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>	
			<!-- ./ modal-dialog modal-lg -->
		</div>



      <div class="modal" id="IdentityModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Create Identity</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/oc-includes/civActions.php" method="post">
                     <div class="form-group row">
                        <label class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-10">
                           <input name="civNameReq" class="form-control" id="civNameReq" value="<?php echo $civName;?>" required />
                           <span class="fasfa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->

							<div class="form-group row">
								<label class="col-lg-2 control-label">Race</label>
								<div class="col-lg-10">
									<select name="civRaceReq" class="form-control selectpicker" id="civRaceReq"
										title="Select a race or ethnicity" data-live-search="true" required>
										<?php getRaces(); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->

													<div class="form-group row">
								<label class="col-lg-2 control-label">Hair Color</label>
								<div class="col-lg-10">
									<select name="civHairReq" class="form-control selectpicker" id="civHairReq"
										title="Select a hair color" required>
										<option val="bld">Bald</option>
										<option val="blk">Black</option>
										<option val="bln">Blonde</option>
										<option val="blu">Blue</option>
										<option val="bro">Brown</option>
										<option val="gry">Gray or Partially Gray</option>
										<option val="grn">Green</option>
										<option val="ong">Orange</option>
										<option val="pnk">Pink</option>
										<option val="ple">Purple</option>
										<option val="red">Red or Auburn</option>
										<option val="sdy">Sandy</option>
										<option val="stw">Strawberry</option>
										<option val="whi">White</option>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Build</label>
								<div class="col-lg-10">
									<select name="civBuildReq" class="form-control selectpicker" id="civBuildReq"
										title="Select a build" required>
										<option val="Average">Average</option>
										<option val="Fit">Fit</option>
										<option val="Muscular">Muscular</option>
										<option val="Overweight">Overweight</option>
										<option val="Skinny">Skinny</option>
										<option val="Thin">Thin</option>
									</select>
									<!-- ./ col-sm-9 -->
								</div>
								<!-- ./ form-group -->
							</div>
							<!-- ./ modal-body -->
							<div class="modal-footer">
								<input name="create_name" type="submit" class="btn btn-primary" value="Create" />
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>

      <!-- Civilian - Edit Identity modal -->
		<div class="modal" id="IdentityEditModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Edit Identity</h4>
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/oc-includes/civActions.php"
							class="editname_modalform" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10">
									<input name="civNameReq" class="form-control" id="civNameReq"
										value="<?php echo $civName;?>" required />
									<span class="fasfa-user form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Date of Birth</label>
								<div class="col-lg-10">
									<input type="text" name="civDobReq" class="form-control" id="datepicker2"
										maxlength="10" value="<?php echo $civDob;?>" required />
									<span class="fasfa-calendar form-control-feedback right" aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Address</label>
								<div class="col-lg-10">
									<input type="text" name="civAddressReq" class="form-control" id="civAddressReq"
										value="<?php echo $civAddr;?>" required />
									<span class="fasfa-location-arrow form-control-feedback right"
										aria-hidden="true"></span>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Sex</label>
								<div class="col-lg-10">
									<select name="civSexReq" class="form-control selectpicker selectpicker3"
										id="civSexReq" title="Select a sex" data-live-search="true" required>
										<?php getGenders();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Race</label>
								<div class="col-lg-10">
									<select name="civRaceReq" class="form-control selectpicker" id="civRaceReq"
										title="Select a race or ethnicity" data-live-search="true" required>
										<?php getRaces(); ?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Hair Color</label>
								<div class="col-lg-10">
									<select name="civHairReq" class="form-control selectpicker civHairReq_picker"
										id="civHairReq" title="Select a hair color" required>
										<option val="bld">Bald</option>
										<option val="blk">Black</option>
										<option val="bln">Blonde</option>
										<option val="blu">Blue</option>
										<option val="bro">Brown</option>
										<option val="gry">Gray or Partially Gray</option>
										<option val="grn">Green</option>
										<option val="ong">Orange</option>
										<option val="pnk">Pink</option>
										<option val="ple">Purple</option>
										<option val="red">Red or Auburn</option>
										<option val="sdy">Sandy</option>
										<option val="stw">Strawberry</option>
										<option val="whi">White</option>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Build</label>
								<div class="col-lg-10">
									<select name="civBuildReq" class="form-control selectpicker civBuildReq_picker"
										id="civBuildReq" title="Select a build" required>
										<option val="Average">Average</option>
										<option val="Fit">Fit</option>
										<option val="Muscular">Muscular</option>
										<option val="Overweight">Overweight</option>
										<option val="Skinny">Skinny</option>
										<option val="Thin">Thin</option>
									</select>
									<!-- ./ col-sm-9 -->
								</div>
								<!-- ./ form-group -->

							</div>

							</div>
							<!-- ./ modal-body -->
							<div class="modal-footer">
								<input type="hidden" name="Edit_id" value="" class="Editdataid" />
								<input name="edit_name" type="submit" class="btn btn-primary" value="Edit" />
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		</div>
		<!-- ./ modal bs-example-modal-lg -->

      <!-- Vehicle Modals -->
      <div class="modal" id="createPlateModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Add Plate to Database</h4>
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/oc-includes/civActions.php" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Registered Owner</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="civilian_names" id="civilian_names"
										data-live-search="true" required>
										<option> </option>
										<?php getCivilianNamesOwn();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">License Plate</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="veh_plate" required />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Make-Model</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="veh_make_model" id="veh_make_model"
										data-live-search="true" required>
										<option> </option>
										<?php getVehicle();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Primary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="veh_pcolor" data-live-search="true"
										required>
										<option val=""> </option>
										<?php getColors();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Secondary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="veh_scolor" data-live-search="true"
										required>
										<option val=""> </option>
										<?php getColors();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
														<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle's Registered State</label>
								<div class="col-lg-10">
									<select class="form-control veh_reg_state_option" name="veh_reg_state" required>
										
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Notes</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="notes" />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<input name="create_plate" type="submit" class="btn btn-primary" value="Create" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		<!-- ./ modal bs-example-modal-lg -->

		<!-- Civilian - Edit Plate Modal -->
		<div class="modal" id="editPlateModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Edit Plate in Database</h4>
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/oc-includes/civActions.php" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Registered Owner</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker civilian_names_picker"
										name="civilian_names" id="civilian_names" data-live-search="true" required>
										<?php getCivilianNamesOwn();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">License Plate</label>
								<div class="col-lg-10">
									<input type="text" class="form-control veh_plate" name="veh_plate" required />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Make-Model</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker veh_make_model" name="veh_make_model"
										id="veh_make_model" data-live-search="true" required>
										<?php getVehicle();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Primary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker veh_pcolor" name="veh_pcolor"
										data-live-search="true" required>
										<?php getColors();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle Secondary Color</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker veh_scolor" name="veh_scolor"
										data-live-search="true" required>
										<?php getColors();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Notes</label>
								<div class="col-lg-10">
									<input type="text" class="form-control notes" name="notes" />
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Vehicle's Registered State</label>
								<div class="col-lg-10">
									<select class="form-control veh_reg_state_option" name="veh_reg_state" required>
										
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
					</div>
					<!-- ./ modal-body -->
					<div class="modal-footer">
						<input type="hidden" class="editplateid" name="Edit_plateId" />
						<input name="edit_plate" type="submit" class="btn btn-primary" value="Edit" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		<!-- ./ modal bs-example-modal-lg -->

      <!-- Weapon modals -->
      <div class="modal" id="createWeaponModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Add Weapon to Database</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					</div>
					<!-- ./ modal-header -->
					<div class="modal-body">
						<form role="form" action="<?php echo BASE_URL; ?>/oc-includes/civActions.php" method="post">
							<div class="form-group row">
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Registered Owner</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="civilian_names" id="civilian_names"
										data-live-search="true" required>
										<option> </option>
										<?php getCivilianNamesOwn();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<!-- ./ form-group -->
							<div class="form-group row">
								<label class="col-lg-2 control-label">Weapon Type-Name</label>
								<div class="col-lg-10">
									<select class="form-control selectpicker" name="weapon_all" id="weapon_all"
										data-live-search="true" required>
										<option> </option>
										<?php getWeapons();?>
									</select>
								</div>
								<!-- ./ col-sm-9 -->
							</div>
							<div class="form-group row">
								<label class="col-lg-2 control-label">Notes</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="weapon_notes" />
								</div>
							</div>
							<!-- ./ modal-body -->
							<div class="modal-footer">
								<input name="create_weapon" type="submit" class="btn btn-primary" value="Create" />
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
					</div>
					<!-- ./ modal-footer -->
				</div>
				<!-- ./ modal-content -->
			</div>
			<!-- ./ modal-dialog modal-lg -->
		</div>
		<!-- ./ modal fade bs-example-modal-lg -->