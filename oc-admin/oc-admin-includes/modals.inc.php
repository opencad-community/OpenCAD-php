<!-- modals -->
    <!-- Data Manager Modal -->
    <div class="modal fade" id="dataManager" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Data Manager</h4>
            <div class="clearifx"></div>
          <!-- ./ modal-header -->
          <div class="modal-body">

              <div class="form-group row">
                <label class="col-md-3 control-label">Import</label>
                <div class="col-md-9">
                <form role="form" method="post" action="<?php echo BASE_URL; ?>/actions/adminActions.php" class="form-horizontal" >
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
              <div class="form-group row">
                <label class="col-md-3 control-label">Reset Data</label>
                <div class="col-md-9">
                    <form role="form" method="post" action="<?php echo BASE_URL; ?>/actions/dataActions.php" class="form-horizontal" > 
                        <select class="form-control selectpicker" id="dataType" name="dataType" size="6" required>
                          <option disabled>Environmental Data</option>
                          <option value="streets">Streets</option>
                          <option value="vehicles">Vehicles</option>
                          <option value="weapons">Weapons</option>
                          <option disabled>Civilian Data</option>
                          <option value="identities">Identities</option>
                          <option value="registeredPlates">Registered Plates</option>
                          <option value="registeredWeapons">Registered Weapons</option>
                          <option value="violationHistory">Warrant/Warning History</option>
                          <option value="allData">All Data (Use with CAUTION)</option>
                        </select>
                      <input type="submit" name="resetData" class="btn btn-primary" value="Reset OpenCAD"/>
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