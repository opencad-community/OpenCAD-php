<!-- MDT - Modals -->
<!-- MDT - Callsign Modal -->
<div class="modal" id="callsign" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" id="closeCallsign" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="enterCallsignLabel">Enter Your Callsign for This Patrol</h4>
		</div>
		<!-- ./ modal-header -->
		<div class="modal-body">
			<form class="callsignForm" id="callsignForm" aria-labelledby="enterCallsignLabel">
				<div class="form-group">
					<label class="col-md-2 control-label">Callsign</label>
					<div class="col-md-10">
						<input type="text" id="callsign" name="callsign" class="form-control" />
					</div>
					<!-- ./ col-sm-9 -->
				</div>
				<!-- ./ form-group -->
		</div>
		<!-- ./ modal-body -->
		<div class="modal-footer">
		<input type="submit" name="setCallsign" class="btn btn-primary setcall_cls" value="Set Callsign"/>
		</div>
		<!-- ./ modal-footer -->
		</form>
	</div>
	<!-- ./ modal-content -->
</div>
<!-- ./ modal-dialog modal-md -->
</div>
<!-- ./ modal fade -->
<!-- ./MDT - Enter Callsign -->

<!-- Vehicle BOLO Board Modal -->
<div class="modal" id="vehicles-bolo-board" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" id="closeCallsign" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="currentlyActiveVehicleBoloLabel">Currently Active Vehicle BOLOs</h4>
		</div>
		<!-- ./ modal-header -->
		<div class="modal-body">
			<form class="callsignForm" id="activeVehicleBoloForm" aria-labelledby="currentlyActiveVehicleBoloLabel">
							<div id="vehiclebolo">
							</div>
					<!-- ./ col-sm-9 -->
				</div>
				<!-- ./ form-group -->
		</div>
		<!-- ./ modal-body -->
		</form>
	</div>
	<!-- ./ modal-content -->
</div>
<!-- ./ modal-dialog modal-md -->
<!-- ./Vehicle BOLO Board Modal -->

<!-- Person BOLO Board Modal -->
<div class="modal" id="persons-bolo-board" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" id="closeCallsign" data-dismiss="modal"><span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="currentlyActivePersonBoloLabel">Currently Active Person BOLOs</h4>
		</div>
		<!-- ./ modal-header -->
		<div class="modal-body">
			<form class="callsignForm" id="currentlyActivePersonBoloForm" aria-labelledby="currentlyActivePersonBoloLabel">
							<div id="personbolo">
							</div>
					<!-- ./ col-sm-9 -->
				</div>
				<!-- ./ form-group -->
		</div>
		<!-- ./ modal-body -->
		</form>
	</div>
	<!-- ./ modal-content -->
</div>
<!-- ./ modal-dialog modal-md -->
<!-- ./Person BOLO Board Modal -->

<!-- Call Details Modal -->
<div class="modal fade" id="createArrest" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
		</button>
		<h4 class="modal-title" id="currentCallDestilsLabel">Arrest Report</h4>
	</div>
	<!-- ./ modal-header -->
	<div class="modal-body">
	<form role="form" action="<?php BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/oc-includes/responderActions.php" method="post">
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
		<input class="form-control" type="text" name="arrestReason1" id="arrestReason1" size="70" placeholder="Enter a reason for arrest" required />
		<input class="form-control" type="number" name="arrestFine1" id="arrestFine1" size="10" placeholder="Enter a fine amount" />
			</div>
			<!-- ./ col-sm-9 -->
		</div>
	<p>Optional</p>
		<div class="form-group row">
			<label class="col-lg-2 control-label">Arrest Reason 2</label>
			<div class="col-lg-10">
		<input class="form-control" type="text" name="arrestReason2" id="arrestReason2" size="70" placeholder="Enter a reason for arrest"  />
		<input class="form-control" type="number" name="arrestFine2" id="arrestFine2" placeholder="Enter a fine amount"  />
			</div>
			<!-- ./ col-sm-9 -->
		</div>
		<div class="form-group row">
			<label class="col-lg-2 control-label">Arrest Reason 3</label>
			<div class="col-lg-10">
		<input class="form-control" type="text" name="arrestReason3" id="arrestReason3" size="70" placeholder="Enter a reason for arrest"  />
		<input class="form-control" type="number" name="arrestFine3" id="arrestFine3" placeholder="Enter a fine amount"  />
			</div>
			<!-- ./ col-sm-9 -->
		</div>
		<div class="form-group row">
			<label class="col-lg-2 control-label">Arrest Reason 4</label>
			<div class="col-lg-10">
		<input class="form-control" type="text" name="arrestReason4" id="arrestReason4" size="70" placeholder="Enter a reason for arrest"  />
		<input class="form-control" type="number" name="arrestFine4" id="arrestFine4" placeholder="Enter a fine amount"  />
			</div>
			<!-- ./ col-sm-9 -->
		</div>
		<div class="form-group row">
			<label class="col-lg-2 control-label">Arrest Reason 5</label>
			<div class="col-lg-10">
		<input class="form-control" type="text" name="arrestReason5" id="arrestReason5" size="70" placeholder="Enter a reason for arrest"  />
		<input class="form-control" type="number" name="arrestFine5" id="arrestFine5" placeholder="Enter a fine amount"  />
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
<!-- ./ modal fade bs-example-modal-lg -->
<div class="modal fade" id="rms" tabindex="-1" role="dialog" aria-hidden="true">
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
<!-- ./ modal fade bs-example-modal-lg -->

<!-- MDT - Create Citation Modal -->
<div class="modal fade" id="createCitation" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
		</button>
		<h4 class="modal-title" id="createCitationLabel">Create Citation</h4>
	</div>
	<!-- ./ modal-header -->
	<div class="modal-body">
	<form role="form" action="<?php BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/oc-includes/responderActions.php" method="post" aria-labelledby="createCitationLabel">
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
		<input class="form-control" type="text" name="citation_name_1" id="citation_name_1" size="70" placeholder="Enter a citation" required />
		<input class="form-control" type="number" name="citation_fine_1" id="citation_fine_1" size="10" placeholder="Enter a fine amount" required />
			</div>
			<!-- ./ col-sm-9 -->
		</div>
	<p>Optional</p>
		<div class="form-group row">
			<label class="col-lg-2 control-label">Citation Name 2</label>
			<div class="col-lg-10">
		<input class="form-control" type="text" name="citation_name_2" id="citation_name_2" size="70" placeholder="Enter a citation"  />
		<input class="form-control" type="number" name="citation_fine_2" id="citation_fine_2" placeholder="Enter a fine amount"  />
			</div>
			<!-- ./ col-sm-9 -->
		</div>
		<div class="form-group row">
			<label class="col-lg-2 control-label">Citation Name 3</label>
			<div class="col-lg-10">
		<input class="form-control" type="text" name="citation_name_3" id="citation_name_3" size="70" placeholder="Enter a citation"  />
		<input class="form-control" type="number" name="citation_fine_3" id="citation_fine_3" placeholder="Enter a fine amount"  />
			</div>
			<!-- ./ col-sm-9 -->
		</div>
		<div class="form-group row">
			<label class="col-lg-2 control-label">Citation Name 4</label>
			<div class="col-lg-10">
		<input class="form-control" type="text" name="citation_name_4" id="citation_name_4" size="70" placeholder="Enter a citation"  />
		<input class="form-control" type="number" name="citation_fine_4" id="citation_fine_4" placeholder="Enter a fine amount"  />
			</div>
			<!-- ./ col-sm-9 -->
		</div>
		<div class="form-group row">
			<label class="col-lg-2 control-label">Citation Name 5</label>
			<div class="col-lg-10">
		<input class="form-control" type="text" name="citation_name_5" id="citation_name_5" size="70" placeholder="Enter a citation"  />
		<input class="form-control" type="number" name="citation_fine_5" id="citation_fine_5" placeholder="Enter a fine amount"  />
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
<!-- ./ modal fade bs-example-modal-lg -->
<!-- ./MDT - Create Citation Modal -->

<!-- MDT - Create Warning Modal -->
<div class="modal fade" id="createWarning" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
			</button>
	<h4 class="modal-title" id="createWarningLabel">Create Warning</h4>
	</div>
	<!-- ./ modal-header -->
	<div class="modal-body">
	<form role="form" action="<?php BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/oc-includes/responderActions.php" method="post" aria-labelledby="createWarningLabel">
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
<!-- ./ modal fade bs-example-modal-lg -->
<!-- ./ MDT - Warning Modal -->

<!-- MDT - Call Details Modal -->
<div class="modal fade" id="callDetails" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
		</button>
		<h4 class="modal-title" id="callDetailsLabel">Call Details</h4>
	</div>
	<!-- ./ modal-header -->
	<div class="modal-body">
		<form class="callDetailsForm" id="callDetailsForm" aria-labelledby="callDetailsLabel">
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
					<input type="text" id="call_street2_det" name="call_street1_det" class="form-control" disabled>
				</div>
				<!-- ./ col-sm-9 -->
			</div>
			<br/>
			<!-- ./ form-group -->
			<div class="form-group">
				<label class="col-lg-2 control-label">Cross Street</label>
				<div class="col-lg-10">
					<input type="text" id="call_street3_det" name="call_street2_det" class="form-control" disabled>
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
			<div class="clearfix">
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
<!-- ./ modal fade bs-example-modal-lg -->
<div class="modal fade" id="rms" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" id="closeNewCall"><span aria-hidden="true">×</span>
			</button>
	<h4 class="modal-title" id="myModalLabel">Warning Creator</h4>
	</div>
	<!-- ./ modal-header -->
	<div class="modal-body">
	<form role="form" action="<?php BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/oc-includes/responderActions.php" method="post">
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
<!-- ./ modal fade bs-example-modal-lg -->
<!-- ./MDT - Call Details Modal -->
<!-- ./MDT Modals