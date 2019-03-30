
<?php if ( ( MODERATOR_DATAMAN_IMPEXPRES == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
{ ?>
 <!-- Data Manager Modal -->
 <div class="modal fade" id="dataManager" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-md">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                 </button>
                 <h4 class="modal-title" id="dataManagerModal">Data Manager</h4>
                 <div class="clearifx"></div>
                 <!-- ./ modal-header -->
                 <div class="modal-body">
                     <div class="form-group row">
                         <label class="col-md-3 control-label">Import</label>
                         <div class="col-md-9">
                             <form role="form" method="post" action="<?php echo BASE_URL; ?>/actions/adminActions.php"
                                 class="form-horizontal">
                                 <input name="userName" class="form-control" id="userName" />
                                 <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                             </form>
                         </div>
                         <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                         <label class="col-md-3 control-label">Export</label>
                         <div class="col-md-9">
                             <input type="email" name="userEmail" class="form-control" id="userEmail" />
                             <span class="fas fa-envelope form-control-feedback right" aria-hidden="true"></span>
                         </div>
                         <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <form role="form" method="post" action="<?php echo BASE_URL; ?>/actions/dataActions.php" class="form-inline">
                         <label class="col-md-3 control-label">Reset Data</label>
                         <div class="col">
                             <div class="form-group">
                                 <select class="form-control selectpicker" id="dataType" name="dataType" style="width: 1500px;display:inline-block" style="width:auto;" required>
                                    <optgroup label="Environmental Data">
                                         <option value="streets">Streets</option>
                                         <option value="vehicles">Vehicles</option>
                                         <option value="weapons">Weapons</option>
                                    <optgroup label="Civilian Data">
                                         <option value="ncic_names">Identities</option>
                                         <option value="ncic_plates">Registered Plates</option>
                                         <option value="ncic_weapons">Registered Weapons</option>
                                         <option value="ncic_warrants">Warrant History</option>
                                         <option value="ncic_warnings">Warning History</option>
                                    <optgroup label="LEO Support Data">
                                        <option value="citation_type">Citation Types</option>
                                        <option value="incident_types">Incidenty Types</option>
                                        <option value="radio_codes">Radio Codes</option>
                                        <option value="warrant_type">Warrant Types</option>
                                        <option value="warning_type">Warning Types</option>
                                    <optgroup label="RESET ALL DATA (USE WITH CAUTION)">
                                        <option value="allData">All Data (Use with CAUTION)</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <button onclick="return confirm('Are you sure? (This cannot be reversed.)')" type="submit" name="resetData" class="btn btn-primary btn-sm" style="margin-left:0.5px;margin-bottom:0.5px;min-height:30px;">
                                     <i class="fas fa-power-off fa-s right"></i></button>
                             </div>
                     </form>
                 </div>
                 <!-- ./ col-sm-9 -->
             </div>
         </div>
         <!-- ./ modal-body -->
         <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         <!-- ./ modal-footer -->
         </form>
     </div>
     <!-- ./ modal-content -->
 </div>
 <!-- ./ modal-dialog modal-lg -->
 </div>
 <!-- ./ modal fade bs-example-modal-lg -->
<?php } else {} ?>