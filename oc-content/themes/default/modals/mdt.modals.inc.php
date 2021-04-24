<!-- MDT - Modals -->

	  <!-- MDT - New Call Modal -->
	  <div class="modal" id="newCall" tabindex="-1" role="dialog" aria-hidden="true">
		 <div class="modal-dialog modal-md">
			<div class="modal-content">
			   <div class="modal-header">
			   		<h3 class="modal-title" id="myModalLabel">New Call</h3>
					<button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
				  </button>
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
	<!-- ./ MDT - New Call Modal -->

	
<!-- ./MDT Modals -->
