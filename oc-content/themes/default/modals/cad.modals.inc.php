	<!-- modals -->
	<!-- Quick Guide Modal -->
	<div class="modal" id="quickGuide" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel">CLI Quick Guide</h4>
			   </div>
			   <!-- ./ modal-header -->
			   <div class="modal-body">
				  <form>
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Create a new call</label>
						<div class="col-lg-10">
						   <input type="text" class="form-control" readonly="readonly" placeholder="action, callsign, calltype, 'location', 'notes'" />
						   <input type="text" class="form-control" readonly="readonly" placeholder="new, 5V-29, 10-11, 'Alta Street at Hawick Avenue', '4 door blue sedan occ 2x'" />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Change Unit Status</label>
						<div class="col-lg-10">
						   <input type="text" class="form-control" readonly="readonly" placeholder="action, callsign, status" />
						   <input type="text" class="form-control" readonly="readonly" placeholder="status, 5V-29, 10-6" />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Assign Unit to Call</label>
						<div class="col-lg-10">
						   <input type="text" class="form-control" readonly="readonly" placeholder="action, callId, callsign" />
						   <input type="text" class="form-control" readonly="readonly" placeholder="assign, 1234, 5V-29" />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">NCIC Lookup</label>
						<div class="col-lg-10">
						   <input type="text" class="form-control" readonly="readonly" placeholder="action, name/plate" />
						   <input type="text" class="form-control" readonly="readonly" placeholder="ncic, 'John Doe'" />
						   <input type="text" class="form-control" readonly="readonly" placeholder="ncic, 'ABC123'" />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
				  </form>
			   </div>
			   <!-- ./ modal-body -->
			   <div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			   </div>
			   <!-- ./ modal-footer -->
			</div>
			<!-- ./ modal-content -->
		 </div>
		 <!-- ./ modal-dialog modal-lg -->
	  </div>
	  <!-- ./ modal bs-example-modal-lg -->
	  <div class="modal" id="rms" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
			<h4 class="modal-title" id="myModalLabel">Warning Viewer</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" id="citation_panel">
				  <div class="x_title">
					<h2>RMS Warnings</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
					  </li>
					  <li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <!-- ./ x_title -->
				  <div class="x_content">
					 <?php rms_warnings();?>
				  </div>
				  <!-- ./ x_content -->
				</div>
				<div class="x_panel" id="citation_panel">
				  <div class="x_title">
					<h2>RMS Citations</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
					  </li>
					  <li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <!-- ./ x_title -->
				  <div class="x_content">
					 <?php rms_citations();?>
				  </div>
				  <!-- ./ x_content -->
				</div>
				<div class="x_panel" id="citation_panel">
				  <div class="x_title">
					<h2>RMS Arrests</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
					  </li>
					  <li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <!-- ./ x_title -->
				  <div class="x_content">
					 <?php rms_arrests();?>
				  </div>
				  <!-- ./ x_content -->
				</div>
				<div class="x_panel" id="citation_panel">
				  <div class="x_title">
					<h2>RMS Warrants</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
					  </li>
					  <li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <!-- ./ x_title -->
				  <div class="x_content">
					 <?php rms_warrants();?>
				  </div>
				  <!-- ./ x_content -->
				</div>
				<!-- ./ x_panel -->
			  </div>
			  <!-- ./ form-group -->
		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
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
	  <!-- Assign User to Call Modal -->
	  <div class="modal" id="assign" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel">Assign a User</h4>
			   </div>
			   <!-- ./ modal-header -->
			   <div class="modal-body">
				  <form class="assignUnitForm" id="assignUnitForm">
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Assign Unit to Call</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker unit" data-live-search="true" name="unit" id="unit" title="Select a Unit">
							  <option name="callsign"></option>
						   </select>
						   <input type="hidden" value="" name="callId" />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ modal-body -->
					 <div class="modal-footer">
						<input type="submit" name="assign_unit" class="btn btn-primary" value="Send"/>
						<button id="closeAssign" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					 </div>
					 <!-- ./ modal-footer -->
				  </form>
			   </div>
			   <!-- ./ modal-body -->
			</div>
			<!-- ./ modal-content -->
		 </div>
		 <!-- ./ modal-dialog modal-lg -->
	  </div>
	  <!-- ./ modal bs-example-modal-lg -->
	<!-- AOP Modal -->
	<div class="modal" id="aop" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="setAreaOfPatrolLabel"><?php echo lang_key("SET_AREA_OF_PATROL"); ?></h4>
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . "/" . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="setAreaOfPatrolLabel">
				<div class="form-group row">
				</div>
				<div class="form-group row">
				<div class="col-lg-10">
					<input name="aop" class="form-control" id="aop" placeholder="Set AOP" required aria-label="Set Area of Patrol" />
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
		  <div class="modal-footer">
				<input name="change_aop" type="submit" class="btn btn-primary" value="Send" />
			   <button type="reset" class="btn btn-default" value="Reset">Reset</button>
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
	  <!-- New Call Modal -->
	  <div class="modal" id="newCall" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel">New Call</h4>
			   </div>
			   <!-- ./ modal-header -->
			   <div class="modal-body">
				  <form class="newCallForm" id="newCallForm">
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Incident Type</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker" data-live-search="true" name="callType" title="Incident Type" required>
							  <?php getIncidentTypes();?>
						   </select>
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <br/>
					 <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Address</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker" data-live-search="true" name="street1" id="street1" title="Street 1" aria-label="Select Primary Street or Postal" required>
								<?php getStreet();?>
							</select>
							<select class="form-control selectpicker" data-live-search="true" name="street2" id="street2" title="Street 2/Cross/Postal" aria-label="Select Cross Street or Postal" >
								<?php getStreet();?>
							</select>
								<input type="text" class="form-control" name="additionalLocation" placeholder="Any Additional Location Information" aria-label="Provide any additional information" />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
					 <br/>
					 <br/>
					 <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Narrative</label>
						<div class="col-lg-10">
						   <textarea name="narrative" id="narrative" class="form-control" style="text-transform:uppercase" rows="5" aria-label="Narrative" ></textarea>
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
			   </div>
			   <!-- ./ modal-body -->
			   <div class="modal-footer">
			   <input type="submit" name="create_call" class="btn btn-primary" value="Send"/>
			   <button type="reset" class="btn btn-default" value="Reset" aria-label="Reset new call form">Reset</button>
			   <button id="newCallReset" type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close new call form.">Close</button>
			   </div>
			   <!-- ./ modal-footer -->
			   </form>
			</div>
			<!-- ./ modal-body -->
		 </div>
		 <!-- ./ modal-content -->
	  </div>
	  <!-- ./ modal-dialog modal-lg -->
	<!-- New Person Bolo Modal -->
	<div class="modal" id="newPersonsBOLO" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="createPersonBoloLabel">Create Person BOLO</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="createPersonBoloLabel">
				<div class="form-group row">
				</div>
				<div class="form-group row">
				<label class="col-lg-2 control-label">First Name</label>
				<div class="col-lg-10">
					<input name="firstName" class="form-control" id="firstName" placeholder="First Name of the BOLOed subject."/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
				<label class="col-lg-2 control-label">Last Name</label>
				<div class="col-lg-10">
					<input name="lastName" class="form-control" id="lastName" placeholder="Last Name of the BOLOed subject."/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Gender</label>
				<div class="col-lg-10">
					<select name="gender" class="form-control selectpicker" id="gender" title="Select a sex" data-live-search="true">
					<option> </option>
					<?php getGenders();?>
					</select>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
				<label class="col-lg-2 control-label">Physical Description</label>
				<div class="col-lg-10">
					<input name="physicalDescription" class="form-control" id="physicalDescription" placeholder="Physical description of the BOLOed subject." aria-label="Physical description of the BOLOed subject."/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
				<label class="col-lg-2 control-label">Reason Wanted</label>
				<div class="col-lg-10">
					<textarea name="reasonWanted" class="form-control" style="text-transform:uppercase" rows="5" id="reasonWanted" placeholder="Wanted reason of the BOLOed subject." aria-label="Wanted reason of the BOLOed subject." required> </textarea>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
				<label class="col-lg-2 control-label">Last Seen</label>
				<div class="col-lg-10">
					<input name="lastSeen" class="form-control" id="lastSeen" placeholder="Last observed location of the BOLOed subject." aria-label="=Last observed location of the BOLOed subject."/>
					<span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
		  <div class="modal-footer">
				<input name="create_personbolo" type="submit" class="btn btn-primary" value="Send" />
			   <button type="reset" class="btn btn-default" value="Reset" aria-label="Reset new bolo form.">Reset</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close new bolo form.">Close</button>
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
	<!-- Edit Person Bolo Modal -->
	<div class="modal" id="editPersonboloModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="editPersonBoloLabel">Edit Person BOLO</h4>
		  </div>
		  <!-- ./ modal-header -->
	  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="editPersonBoloLabel">
				<div class="form-group row">
				</div>
				<div class="form-group row">
				<label class="col-lg-2 control-label">First Name</label>
				<div class="col-lg-10">
		  <input name="firstName" class="form-control" id="firstName" placeholder="First Name of the BOLOed subject."/>
		  <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
				<label class="col-lg-2 control-label">Last Name</label>
				<div class="col-lg-10">
		  <input name="lastName" class="form-control" id="lastName" placeholder="Last Name of the BOLOed subject."/>
		  <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Gender</label>
				<div class="col-lg-10">
		  <select name="gender" class="form-control selectpicker gender_picker" id="gender" title="Select a sex" data-live-search="true">
					<option> </option>
					<?php getGenders();?>
		  </select>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
				<label class="col-lg-2 control-label">Physical Description</label>
				<div class="col-lg-10">
		  <input name="physicalDescription" class="form-control" id="physicalDescription" placeholder="Physical description of the BOLOed subject."/>
		  <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
				<label class="col-lg-2 control-label">Reason Wanted</label>
				<div class="col-lg-10">
		  <textarea name="reasonWanted" class="form-control" style="text-transform:uppercase" rows="5" id="reasonWanted" placeholder="Wanted reason of the BOLOed subject." required> </textarea>
		  <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
				<label class="col-lg-2 control-label">Last Seen</label>
				<div class="col-lg-10">
		  <input name="lastSeen" class="form-control" id="lastSeen" placeholder="Last observed location of the BOLOed subject."/>
		  <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
		  <div class="modal-footer">
				<input type="hidden" name="edit_personId" class="Editdataid">
				<input name="edit_personbolo" type="submit" class="btn btn-primary" value="Edit" />
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
	<!-- New Vehicle Bolo Modal -->
	<div class="modal" id="newVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="createVehicleBoloLabel">Create Vehicle BOLO</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="createVehicleBoloLabel">
				<div class="form-group row">
				</div>
				<div class="form-group row">
						<label class="col-lg-2 control-label">Vehicle Make</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker" data-live-search="true" name="make" title="Vehicle Make">
							  <?php getVehicleMakes();?>
						   </select>
						</div>
				</div>
			  <!-- ./ form-group -->
				<div class="form-group row">
						<label class="col-lg-2 control-label">Vehicle Model</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker" data-live-search="true" name="model" title="Vehicle Model">
							  <?php getVehicleModels();?>
						   </select>
						</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
						<label class="col-lg-2 control-label">Vehicle Plate</label>
						<div class="col-lg-10">
										<input type="text" class="form-control plate" name="plate" placeholder="The plate of the BOLO vehicle." />
						</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
						<label class="col-lg-2 control-label">Primary Color</label>
						<div class="col-lg-10">
										<input type="text" class="form-control primaryColor" name="primaryColor" placeholder="The primary color of the BOLO vehicle." />
						</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Secondary Color</label>
						<div class="col-lg-10">
							<input type="text" class="form-control secondaryColor" name="secondaryColor" placeholder="The secondary color, if any, of the BOLO vehicle." />                        </div>
						<!-- ./ col-sm-9 -->
					 </div>
				<!-- ./ col-sm-9 -->
			  <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Reason Wanted</label>
						<div class="col-lg-10">
								<textarea name="reasonWanted" id="narrative" class="form-control reasonWanted" style="text-transform:uppercase" rows="5"></textarea>
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
			  <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Last Seen</label>
						<div class="col-lg-10">
						   <input type="text" class="form-control lastSeen" name="lastSeen" placeholder="Last observed location of the BOLOed vehicle." />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
			</div>
		  <div class="modal-footer">
			  <input name="create_vehiclebolo" type="submit" class="btn btn-primary" value="Send" />
			   <button type="reset" class="btn btn-default" value="Reset">Reset</button>
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
	<!-- Edit Vehicle Bolo Modal -->
	<div class="modal" id="editVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="editVehicleBoloLabel">Edit Vehicle BOLO</h4>
		  </div>
		  <!-- ./ modal-header -->
	  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="editVehicleBoloLabel">
				<div class="form-group row">
				</div>
				<div class="form-group row">
						<label class="col-lg-2 control-label">Vehicle Make</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker make" data-live-search="true" name="make" title="Vehicle Make" required>
							  <?php getVehicleMakes();?>
						   </select>
						</div>
			  <!-- ./ form-group -->
				<div class="form-group row">
						<label class="col-lg-2 control-label">Vehicle Model</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker model" data-live-search="true" name="model" title="Vehicle Model" required>
							  <?php getVehicleModels();?>
						   </select>
						</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
				<div class="form-group row">
						<label class="col-lg-2 control-label">Vehicle Plate</label>
						<div class="col-lg-10">
							<input type="text" class="form-control plate" name="plate" placeholder="The plate of the BOLO vehicle." />
						</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
						<label class="col-lg-2 control-label">Primary Color</label>
						<div class="col-lg-10">
							<input type="text" class="form-control primaryColor" name="primaryColor" placeholder="The primary color of the BOLO vehicle." />
						</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Secondary Color</label>
						<div class="col-lg-10">
							<input type="text" class="form-control secondaryColor" name="secondaryColor" placeholder="The secondary color, if any, of the BOLO vehicle." />                        </div>
						<!-- ./ col-sm-9 -->
					 </div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Reason Wanted</label>
						<div class="col-lg-10">
								<textarea name="reasonWanted" id="narrative" class="form-control reasonWanted" style="text-transform:uppercase" rows="5"></textarea>
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
			  <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Last Seen</label>
						<div class="col-lg-10">
						   <input type="text" class="form-control lastSeen" name="lastSeen" placeholder="Last observed location of the BOLOed vehicle." />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
			  <!-- ./ form-group -->
		  <div class="modal-footer">
				<input type="hidden" name="edit_vehicleboloid" class="EditVehicleId">
				<input name="edit_vehiclebolo" type="submit" class="btn btn-primary" value="Edit" />
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
	  <!-- Call Details Modal -->
	  <div class="modal" id="callDetails" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		 <div class="modal-content">
			<div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
			   </button>
			   <h4 class="modal-title" id="myModalLabel">Call Details</h4>
			</div>
			<!-- ./ modal-header -->
			<div class="modal-body">
			   <form class="callDetailsForm" id="callDetailsForm">
				  <div class="form-group">
					 <label class="col-lg-2 control-label">Incident ID</label>
					 <div class="col-lg-10">
						<input type="text" id="callId_det" name="callId_det" class="form-control" disabled>
					 </div>
					 <!-- ./ col-sm-9 -->
				  </div>
				  <br/>
				  <!-- ./ form-group -->
				  <div class="form-group">
					 <label class="col-lg-2 control-label">Incident Type</label>
					 <div class="col-lg-10">
						<input type="text" id="call_type_det" name="call_type_det" class="form-control" disabled>
					 </div>
					 <!-- ./ col-sm-9 -->
				  </div>
				  <br/>
				  <!-- ./ form-group -->
				  <div class="form-group">
					 <label class="col-lg-2 control-label">Main Street</label>
					 <div class="col-lg-10">
						<input type="text" id="call_street1_det" name="call_street1_det" class="form-control" disabled>
					 </div>
					 <!-- ./ col-sm-9 -->
				  </div>
				  <br/>
				  <!-- ./ form-group -->
				  <div class="form-group">
					 <label class="col-lg-2 control-label">Cross Street</label>
					 <div class="col-lg-10">
						<input type="text" id="call_street2_det" name="call_street2_det" class="form-control" disabled>
					 </div>
					 <!-- ./ col-sm-9 -->
				  </div>
				  <br/>
				  <!-- ./ form-group -->
				  <div class="form-group">
					 <label class="col-lg-2 control-label">Additional Location Info</label>
					 <div class="col-lg-10">
						<input type="text" id="call_street3_det" name="call_street3_det" class="form-control" disabled>
					 </div>
					 <!-- ./ col-sm-9 -->
				  </div>
					 <br/>
				  <div class=" clearfix">
					 <br/><br/><br/><br/>
					 <!-- ./ form-group -->
				  <div  class="clearfix">
					 <br/><br/><br/><br/>
					 <!-- ./ form-group -->
					 <div class="form-group">
						<label class="col-lg-2 control-label">Narrative</label>
						<div class="col-lg-10">
						   <div name="callNarrative" id="callNarrative" contenteditable="false" style="background-color: #eee; opacity: 1; border: 1px solid #ccc; padding: 6px 12px; font-size: 14px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"></div>
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <br/>
					 <br/><br/><br/><br/>
					 <!-- ./ form-group -->
					 <div class="form-group">
						<label class="col-lg-2 control-label">Add Narrative</label>
						<div class="col-lg-10">
						   <textarea name="narrative_add" id="narrative_add" class="form-control" style="text-transform:uppercase" rows="2" required></textarea>
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <br/>
				  <!-- ./ modal-body -->
				  <br/>
				  <div class="modal-footer">
					 <input type="submit" id="addCallNarrative" class="btn btn-primary pull-left" value="Add Narrative" />
					 <button id="closeDetailsModal" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				  <!-- ./ modal-footer -->
			   </form>
			</div>
			<!-- ./ modal-content -->
		 </div>
		 <!-- ./ modal-dialog modal-lg -->
	  </div>
	  </div>
	  </div>
	  </div>
	  <!-- ./ modal bs-example-modal-lg -->

	  <!-- New Vehicle BOLO Modal -->
	  <div class="modal" id="createVehicleBOLO" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel">Test</h4>
			   </div>
			   <!-- ./ modal-header -->
			   <div class="modal-body">
				  <form class="newCallForm" id="newCallForm">
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Vehicle Make</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker" data-live-search="true" name="make" title="Vehicle Make" required>
							  <?php getVehicleMakes();?>
						   </select>
						</div>
						<label class="col-lg-2 control-label">Vehicle Model</label>
						<div class="col-lg-10">
						   <select class="form-control selectpicker" data-live-search="true" name="vehicleMake" title="Vehicle Make" required>
							  <?php getVehicleModels();?>
						   </select>
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <br/>
					 <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Primary Color</label>
						<div class="col-lg-10">
										<input type="text" class="form-control" name="primaryColor" placeholder="The primary color of the BOLO vehicle." />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Secondary Color</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="secondaryColor" placeholder="The secondary color, if any, of the BOLO vehicle." />                        </div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
					 <br/>
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Reason Wanted</label>
						<div class="col-lg-10">
								<textarea name="reasonWanted" id="narrative" class="form-control" style="text-transform:uppercase" rows="5"></textarea>
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <br/>
					 <!-- ./ form-group -->
					 <div class="form-group row">
						<label class="col-lg-2 control-label">Last Seen</label>
						<div class="col-lg-10">
						   <input type="text" class="form-control" name="lastSeen" placeholder="Last observed location of the BOLOed vehicle." />
						</div>
						<!-- ./ col-sm-9 -->
					 </div>
					 <!-- ./ form-group -->
			   </div>
			   <!-- ./ modal-body -->
			   <div class="modal-footer">
			   <input type="submit" name="create_call" class="btn btn-primary" value="Send"/>
			   <button type="reset" class="btn btn-default" value="Reset">Reset</button>
			   <button id="newCallReset" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			   </div>
			   <!-- ./ modal-footer -->
			   </form>
			</div>
			<!-- ./ modal-body -->
		 </div>
		 <!-- ./ modal-content -->
	  </div>
	  <!-- ./ modal-dialog modal-lg -->

	  </div>

	   <!-- Edit Vehicle BOLO Modal -->

	  <!-- Create Citation Modal -->
	  <div class="modal" id="createCitation" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
			<h4 class="modal-title" id="createCitationBoloLabel">Create Citation</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="createCitationLabel">
				<div class="form-group row">
				<label class="col-lg-2 control-label">Civilian Name</label>
				<div class="col-lg-10">
				  <select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" required title="Select Civilian">
					<?php getCivilianNamesOption();?>
				  </select>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Citation Name 1</label>
				<div class="col-lg-10">
					<input type="text" name="citation_name_1" id="citation_name_1" size="70" placeholder="Enter a citation" required />
					<input type="number" name="citation_fine_1" id="citation_fine_1" size="10" placeholder="Enter a fine amount" required />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <p>Optional</p>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Citation Name 2</label>
				<div class="col-lg-10">
					<input type="text" name="citation_name_2" id="citation_name_2" size="70" placeholder="Enter a citation"  />
					<input type="number" name="citation_fine_2" id="citation_fine_2" placeholder="Enter a fine amount"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Citation Name 3</label>
				<div class="col-lg-10">
					<input type="text" name="citation_name_3" id="citation_name_3" size="70" placeholder="Enter a citation"  />
					<input type="number" name="citation_fine_3" id="citation_fine_3" placeholder="Enter a fine amount"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Citation Name 4</label>
				<div class="col-lg-10">
					<input type="text" name="citation_name_4" id="citation_name_4" size="70" placeholder="Enter a citation"  />
					<input type="number" name="citation_fine_4" id="citation_fine_4" placeholder="Enter a fine amount"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Citation Name 5</label>
				<div class="col-lg-10">
					<input type="text" name="citation_name_5" id="citation_name_5" size="70" placeholder="Enter a citation"  />
					<input type="number" name="citation_fine_5" id="citation_fine_5" placeholder="Enter a fine amount"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
				<input name="create_citation" type="submit" class="btn btn-primary" value="Create" />
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
	  <!-- View Citation Modal -->
	  <div class="modal" id="viewCitation" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
			<h4 class="modal-title" id="myModalLabel">Citation Viewer</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" id="citation_panel">
				  <div class="x_title">
					<h2>NCIC Citations</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
					  </li>
					  <li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <!-- ./ x_title -->
				  <div class="x_content">
					 <?php ncicGetCitations();?>
				  </div>
				  <!-- ./ x_content -->
				</div>
				<!-- ./ x_panel -->
			  </div>
			  <!-- ./ form-group -->
		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
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
	  <!-- Create Warning Modal -->
	  <div class="modal" id="createWarning" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
			<h4 class="modal-title" id="createWarningLabel">Create Warning</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="createWarningLabel">
				<div class="form-group row">
				<label class="col-lg-2 control-label">Civilian Name</label>
				<div class="col-lg-10">
				  <select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" required title="Select Civilian">
					<?php getCivilianNamesOption();?>
				  </select>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Warning Name 1</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_1" id="warning_name_1" placeholder="Enter a warning" required />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <p>Optional</p>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Warning Name 2</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_2" id="warning_name_2" placeholder="Enter a warning"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Warning Name 3</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_3" id="warning_name_3" placeholder="Enter a warning"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Warning Name 4</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_4" id="warning_name_4" placeholder="Enter a warning"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Warning Name 5</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" name="warning_name_5" id="warning_name_5" placeholder="Enter a warning"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
				<input name="create_warning" type="submit" class="btn btn-primary" value="Create" />
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
	  <div class="modal" id="createArrest" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		 <div class="modal-content">
			<div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
			   </button>
			   <h4 class="modal-title" id="createArrestReportLabel">Create Arrest Report</h4>
			</div>
			<!-- ./ modal-header -->
		  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="createArrestReportLabel">
				<div class="form-group row">
				<label class="col-lg-2 control-label">Civilian Name</label>
				<div class="col-lg-10">
				  <select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" required title="Select Civilian">
					<?php getCivilianNamesOption();?>
				  </select>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Arrest Reason 1</label>
				<div class="col-lg-10">
					<input type="text" name="arrestReason1" id="arrestReason1" size="70" placeholder="Enter a reason for arrest" required />
					<input type="number" name="arrestFine1" id="arrestFine1" size="10" placeholder="Enter a fine amount" />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <p>Optional</p>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Arrest Reason 2</label>
				<div class="col-lg-10">
					<input type="text" name="arrestReason2" id="arrestReason2" size="70" placeholder="Enter a reason for arrest"  />
					<input type="number" name="arrestFine2" id="arrestFine2" placeholder="Enter a fine amount"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Arrest Reason 3</label>
				<div class="col-lg-10">
					<input type="text" name="arrestReason3" id="arrestReason3" size="70" placeholder="Enter a reason for arrest"  />
					<input type="number" name="arrestFine3" id="arrestFine3" placeholder="Enter a fine amount"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Arrest Reason 4</label>
				<div class="col-lg-10">
					<input type="text" name="arrestReason4" id="arrestReason4" size="70" placeholder="Enter a reason for arrest"  />
					<input type="number" name="arrestFine4" id="arrestFine4" placeholder="Enter a fine amount"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Arrest Reason 5</label>
				<div class="col-lg-10">
					<input type="text" name="arrestReason5" id="arrestReason5" size="70" placeholder="Enter a reason for arrest"  />
					<input type="number" name="arrestFine5" id="arrestFine5" placeholder="Enter a fine amount"  />
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
				<input name="create_arrest" type="submit" class="btn btn-primary" value="Create" />
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
	  <div class="modal" id="viewArrest" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
			<h4 class="modal-title" id="myModalLabel">Arrests Viewer</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" id="citation_panel">
				  <div class="x_title">
					<h2>NCIC Arrests</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
					  </li>
					  <li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <!-- ./ x_title -->
				  <div class="x_content">
					 <?php ncicGetArrests();?>
				  </div>
				  <!-- ./ x_content -->
				</div>
				<!-- ./ x_panel -->
			  </div>
			  <!-- ./ form-group -->
		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
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
	  <!-- View Warning Modal -->
	  <div class="modal" id="viewWarning" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
			<h4 class="modal-title" id="myModalLabel">Warning Viewer</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" id="citation_panel">
				  <div class="x_title">
					<h2>NCIC Warnings</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
					  </li>
					  <li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <!-- ./ x_title -->
				  <div class="x_content">
					 <?php ncicGetWarnings();?>
				  </div>
				  <!-- ./ x_content -->
				</div>
				<!-- ./ x_panel -->
			  </div>
			  <!-- ./ form-group -->
		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
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

	  <!-- Create Warrant Modal -->
	  <div class="modal" id="createWarrant" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
			<h4 class="modal-title" id="createWarrantLabel">Create Warrant</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . OCINC ?>/dispatchActions.php" method="post" aria-labelledby="createWarrantLabel">
				<div class="form-group row">
				<label class="col-lg-2 control-label">Civilian Name</label>
				<div class="col-lg-10">
				  <select class="form-control selectpicker" name="civilian_names" id="civilian_names" data-live-search="true" aria-label="Select subject of warrant." required>
					<option> </option>
					<?php getCivilianNames();?>
				  </select>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Warrant Name</label>
				<div class="col-lg-10">
				  <select class="form-control selectpicker" name="warrant_name_sel" id="warrant_name_sel" data-live-search="true" title="Select a Warrant" aria-label="Select reason for warrant.">
					<optgroup label="Violent Warrants (60 day expiry)">
					  <option value="1st Degree Murder">1st Degree Murder</option>
					  <option value="2nd Degree Murder">2nd Degree Murder</option>
					  <option value="3rd Degree Murder">3rd Degree Murder</option>
					  <option value="Attempted Murder">Attempted Murder</option>
					  <option value="Kidnapping">Kidnapping</option>
					  <option value="Attempted Kidnapping">Attempted Kidnapping</option>
					  <option value="Hostage Taking">Hostage Taking</option>
					  <option value="Bank/Fed Robbery">Bank/Fed Robbery</option>
					  <option value="Terroristic Activity">Terroristic Activity</option>
					  <option value="Terroristic Threats">Terroristic Threats</option>
					  <option value="JailBreak">JailBreak</option>
					  <option value="Robbery">Robbery</option>
					  <option value="Grand Theft Auto">Grand Theft Auto</option>
					  <option value="Burglary">Burglary</option>
					  <option value="Threatening an Official">Threatening an Official</option>
					  <option value="Sexual Assault">Sexual Assault</option>
					  <option value="Hate Crime">Hate Crime</option>
					  <option value="Assault">Assault</option>
					  <option value="Conspiracy">Conspiracy</option>
					  <option value="Drug Trafficking">Drug Trafficking</option>
					  <option value="Evasion/Fleeing/Eluding">Evasion/Fleeing/Eluding</option>
					  <option value="Felony Evading">Felony Evading</option>
					  <option value="Resisting Arrest">Resisting Arrest</option>
					  <option value="Firearm in City Limits">Firearm in City Limits</option>
					  <option value="Firearm by Felon">Firearm by Felon</option>
					  <option value="Unlicensed Firearm">Unlicensed Firearm</option>
					  <option value="Firearm Discharge in City Limits">Firearm Discharge in City Limits</option>
					  <option value="Illegal Weapon">Illegal Weapon</option>
					  <option value="Illegal Magazine">Illegal Magazine</option>
					  <option value="Concealed Carry Rifle">Concealed Carry Rifle</option>
					  <option value="Failure to Inform">Failure to Inform</option>
					</optgroup>
					<optgroup label="Non-Violent Warrants (30 day expiry)">
					  <option value="FTA: Lewd Conduct">FTA: Lewd Conduct</option>
					  <option value="FTA: DUI/DWI">FTA: DUI/DWI</option>
					  <option value="FTA: Fraud">FTA: Fraud</option>
					  <option value="FTA: Hit and Run">FTA: Hit and Run</option>
					  <option value="FTA: Speeding">FTA: Speeding</option>
					  <option value="FTA: Reckless Driving">FTA: Reckless Driving</option>
					  <option value="FTA: Obstruction of Justice">FTA: Obstruction of Justice</option>
					  <option valu e="FTA: Verbal Abuse">FTA: Verbal Abuse</option>
					  <option value="FTA: Bribery">FTA: Bribery</option>
					  <option value="FTA: Disorderly Conduct">FTA: Disorderly Conduct</option>
					  <option value="FTA: Drug Posession">FTA: Drug Posession</option>
					  <option value="FTA: Trespassing">FTA: Trespassing</option>
					  <option value="FTA: Excessive Noise">FTA: Excessive Noise</option>
					  <option value="FTA: Failure to Identify">FTA: Failure to Identify</option>
					  <option value="FTA: Stalking">FTA: Stalking</option>
					  <option value="FTA: Public Intoxication">FTA: Public Intoxication</option>
					</optgroup>
				  </select>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->
			  <div class="form-group row">
				<label class="col-lg-2 control-label">Issuing Agency</label>
				<div class="col-lg-10">
				  <select class="form-control selectpicker" name="issuer" id="issuer" data-live-search="true" aria-label="Select department which is issuing the warrant." required>
					<?php getAgencies();?>
				  </select>
				</div>
				<!-- ./ col-sm-9 -->
			  </div>
			  <!-- ./ form-group -->

		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
				<input name="create_warrant" type="submit" class="btn btn-primary" value="Create" aria-label="Create warrant" />
				<button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close new warrant eentry modal.">Close</button>
			</form>
		  </div>
		  <!-- ./ modal-footer -->
		</div>
		<!-- ./ modal-content -->
	  </div>
	  <!-- ./ modal-dialog modal-lg -->
	</div>
	<!-- ./ modal bs-example-modal-lg -->
	  <!-- View Warrant Modal -->
	  <div class="modal" id="viewWarrant" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-lg">
			<div class="modal-content">
			   <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
			<h4 class="modal-title" id="myModalLabel">Warrant Viewer</h4>
		  </div>
		  <!-- ./ modal-header -->
		  <div class="modal-body">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" id="citation_panel">
				  <div class="x_title">
					<h2>NCIC Warrants</h2>
					<ul class="nav navbar-right panel_toolbox">
					  <li><a rel="noopener" class="collapse-link"><em class="fas fa-chevron-up"></em></a>
					  </li>
					  <li><a rel="noopener" class="close-link"><em class="fas fa-close"></em></a>
					  </li>
					</ul>
					<div class="clearfix"></div>
				  </div>
				  <!-- ./ x_title -->
				  <div class="x_content">
					 <?php ncicGetWarrants();?>
				  </div>
				  <!-- ./ x_content -->
				</div>
				<!-- ./ x_panel -->
			  </div>
			  <!-- ./ form-group -->
		  </div>
		  <!-- ./ modal-body -->
		  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</form>
		  </div>
		  <!-- ./ modal-footer -->
		</div>
		<!-- ./ modal-content -->
	  </div>
	  <!-- ./ modal-dialog modal-lg -->