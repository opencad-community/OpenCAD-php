
<?php if ( ( MODERATOR_DATAMAN_IMPEXPRES == true && $_SESSION['adminPrivilege'] == 2 ) || ( $_SESSION['adminPrivilege'] == 3 ) )
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
                                         <option value="ncicNames"><?php echo lang_key("IDENTITIES"); ?></option>
                                         <option value="ncicPlates"><?php echo lang_key("REGISTERED_PLATES"); ?></option>
                                         <option value="ncic_weapons"><?php echo lang_key("REGISTERED_WEAPONS"); ?></option>
                                         <option value="ncic_warrants"><?php echo lang_key("WARRANT_HISTORY"); ?></option>
                                         <option value="ncic_warnings"><?php echo lang_key("WARNING_HISTORY"); ?></option>
                                    <optgroup label="<?php echo lang_key("LEO_SUPPORT_DATA_OPTGRP"); ?>">
                                        <option value="citation_type"><?php echo lang_key("CITATION_TYPES"); ?></option>
                                        <option value="incident_types"><?php echo lang_key("INCIDENT_TYPES"); ?></option>
                                        <option value="radioCodes"><?php echo lang_key("RADIO_CODES"); ?></option>
                                        <option value="warrant_type"><?php echo lang_key("WARRANT_TYPES"); ?></option>
                                        <option value="warning_type"><?php echo lang_key("WARNING_TYPES"); ?></option>
                                    <optgroup label="<?php echo lang_key("RESET_ALL_DATA_OPTGRP"); ?>">
                                        <option value="allData"><?php echo lang_key("RESET_ALL_DATA"); ?></option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <button onclick="return confirm('Are you sure? (This cannot be reversed.)')" type="submit" name="resetData" class="btn btn-primary btn-sm" style="margin-left:0.5px;margin-bottom:0.5px;min-height:30px;">
                                     <em class="fas fa-power-off fa-s right"></em></button>
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
<?php } ?>