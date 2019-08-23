
<?php if ( ( MODERATOR_DATAMAN_IMPEXPRES == true && $_SESSION['admin_privilege'] == 2 ) || ( $_SESSION['admin_privilege'] == 3 ) )
{ ?>
 <!-- Data Manager Modal -->
 <div class="modal" id="dataManager" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-md">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="dataManagerModal"><?php echo lang_key("DATA_MANAGER"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                 </div>
                 <div class="clearifx"></div>
                 <!-- ./ modal-header -->
                 <div class="modal-body">
                     <div class="form-group row">
                         <label class="col-md-3 control-label"><?php echo lang_key("Import"); ?></label>
                         <div class="col-md-9">
                             <form role="form" method="post" action="<?php echo BASE_URL; ?>/<?php echo OCINC ?>/adminActions.php"
                                 class="form-horizontal">
                                 <input name="userName" class="form-control" id="userName" />
                             </form>
                         </div>
                         <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <div class="form-group row">
                         <label class="col-md-3 control-label"><?php echo lang_key("Export"); ?></label>
                         <div class="col-md-9">
                             <input type="email" name="userEmail" class="form-control" id="userEmail" />
                         </div>
                         <!-- ./ col-sm-9 -->
                     </div>
                     <!-- ./ form-group -->
                     <form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/dataActions.php" class="form-inline">
                         <label class="col-md-3 control-label"><?php echo lang_key("RESET_DATA"); ?></label>
                         <div class="col">
                             <div class="form-group">
                                 <select class="form-control selectpicker" id="dataType" name="dataType" style="width: 1500px;display:inline-block" style="width:auto;" required>
                                    <optgroup label="<?php echo lang_key("ENVIRONMENTAL_DATA_OPTGRP"); ?>">
                                         <option value="streets"><?php echo lang_key("STREETS"); ?></option>
                                         <option value="vehicles"><?php echo lang_key("vehicles"); ?></option>
                                         <option value="weapons"><?php echo lang_key("WEAPONS"); ?></option>
                                    <optgroup label="<?php echo lang_key("CIVILIAN_DATA_OPTGRP"); ?>">
                                         <option value="ncic_names"><?php echo lang_key("IDENTITIES"); ?></option>
                                         <option value="ncic_plates"><?php echo lang_key("REGISTERED_PLATES"); ?></option>
                                         <option value="ncic_weapons"><?php echo lang_key("REGISTERED_WEAPONS"); ?></option>
                                         <option value="ncic_warrants"><?php echo lang_key("WARRANT_HISTORY"); ?></option>
                                         <option value="ncic_warnings"><?php echo lang_key("WARNING_HISTORY"); ?></option>
                                    <optgroup label="<?php echo lang_key("LEO_SUPPORT_DATA_OPTGRP"); ?>">
                                        <option value="citation_type"><?php echo lang_key("CITATION_TYPES"); ?></option>
                                        <option value="incident_types"><?php echo lang_key("INCIDENT_TYPES"); ?></option>
                                        <option value="radio_codes"><?php echo lang_key("RADIO_CODES"); ?></option>
                                        <option value="warrant_type"><?php echo lang_key("WARRANT_TYPES"); ?></option>
                                        <option value="warning_type"><?php echo lang_key("WARNING_TYPES"); ?></option>
                                    <optgroup label="<?php echo lang_key("RESET_ALL_DATA_OPTGRP"); ?>">
                                        <option value="allData"><?php echo lang_key("RESET_ALL_DATA"); ?></option>
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