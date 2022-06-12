<?php

namespace Global;

class GlobalFunctions
{
    public function generateModal()
    {
        static $modalName = "Street";
        static $modalId = "editStreetModal";
        static $modalSubmit = "editStreet";
        static $modalBox = "Street/Postal Code";
        static $modalBox1 = "County";
        static $ajaxType = "allStreets";
        static $ajaxGetDetails = "getStreetDetails";
        static $ajaxId = "streetID";
        static $ajaxIdData = "streetID";

?>

        <div class="modal" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="<?php echo $modalId; ?>">Edit <?php echo $modalName; ?> Type</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/dataActions.php" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 control-label"><?php echo $modalBox; ?></label>
                                <div class="col-md-9">
                                    <input data-lpignore='true' type="text" name="name" class="form-control" id="name" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label"><?php echo $modalBox1; ?></label>
                                <div class="col-md-9">
                                    <input data-lpignore='true' type="text" name="county" class="form-control" id="county" />
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="hidden" name="<?php echo $ajaxIdData; ?>" id="<?php echo $ajaxIdData; ?>" aria-hidden="true">
                        <input type="submit" name="<?php echo $modalSubmit; ?>" class="btn btn-primary" value="Edit Citation Type" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}
