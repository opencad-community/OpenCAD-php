	<!-- Law Enforcement Registration -->
	<div class="modal" id="registerFirstResponder" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="firstResponderRegLabel"><?php echo lang_key("FIRST_RESPONDER_ACCESS_REQUEST"); ?></h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
			</div>
		<!-- ./ modal-header -->
		<div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . "/" . OCINC ?>/register.php" method="post" aria-labelledby="firstResponderRegLabel">
					<div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("NAME"); ?></label>
						<div class="col-lg-10">
                        	<input class="form-control" placeholder="<?php echo lang_key("NAME"); ?>" name="uname" type="text" required>
						</div>
                    </div>
                    <div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("EMAIL"); ?></label>
						<div class="col-lg-10">
                        	<input class="form-control" placeholder="<?php echo lang_key("EMAIL"); ?>" name="email" type="email" required>
						</div>
                    </div>
                    <div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("IDENTIFIER"); ?></label>
						<div class="col-lg-10">
                        	<input class="form-control" placeholder="<?php echo lang_key("IDENTIFIER_PLCAEHOLDER"); ?>" name="identifier" type="text" required>
						</div>
                    </div>
                    <div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("PASSWORD"); ?></label>
						<div class="col-lg-10">
                        	<input class="form-control" placeholder="<?php echo lang_key("PASSWORD"); ?>" name="password" type="password" value="<?php if($testing){echo "password";}?>" required>
						</div>
                    </div>
                    <!-- ./ form-group -->
                    <div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("CONFIRM_PASSWORD"); ?></label>
						<div class="col-lg-10">
	                        <input class="form-control" placeholder="<?php echo lang_key("CONFIRM_PASSWORD"); ?>" name="password1" type="password" required>
						</div>
                    </div>
                    <!-- ./ form-group -->
                    <div class="form-group row">
                        <label class="col-lg-2 control-label"><?php echo lang_key("DIVISION_SELECT_ALL"); ?></label>
						<div class="col-lg-10">
							<select class="form-control selectpicker" id="division" name="division[]" multiple="multiple" size="6" required>
							<?php getAgencies(); ?>
							</select>
						</div>
                     </div>
			  <!-- ./ form-group -->
		  <div class="modal-footer">
				<input name="register" type="submit" class="btn btn-primary" value="<?php echo lang_key("REQUEST"); ?>" />
				<button type="reset" class="btn btn-default" value="Reset"><?php echo lang_key("RESET"); ?></button>
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang_key("CLOSE"); ?></button>
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

	<!-- Civilian Registration -->
	<div class="modal" id="registerCivilian" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="civiliaAccessReqLabel"><?php echo lang_key("CIVILIAN_ACCESS_REQUEST"); ?></h4>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
			</div>
		<!-- ./ modal-header -->
		<div class="modal-body">
			<form role="form" action="<?php echo BASE_URL . "/" . OCINC ?>/register.php" method="post" aria-labelledby="civiliaAccessReqLabel">
					<div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("NAME"); ?></label>
						<div class="col-lg-10">
                        	<input class="form-control" placeholder="<?php echo lang_key("NAME"); ?>" name="uname" type="text" required>
						</div>
                    </div>
                    <div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("EMAIL"); ?></label>
						<div class="col-lg-10">
                        	<input class="form-control" placeholder="<?php echo lang_key("EMAIL"); ?>" name="email" type="email" required>
						</div>
                    </div>
                    <div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("PASSWORD"); ?></label>
						<div class="col-lg-10">
                        	<input class="form-control" placeholder="<?php echo lang_key("PASSWORD"); ?>" name="password" type="password" value="<?php if($testing){echo "password";}?>" required>
						</div>
                    </div>
                    <!-- ./ form-group -->
                    <div class="form-group row">
						<label class="col-lg-2 control-label"><?php echo lang_key("CONFIRM_PASSWORD"); ?></label>
						<div class="col-lg-10">
	                        <input class="form-control" placeholder="<?php echo lang_key("CONFIRM_PASSWORD"); ?>" name="password1" type="password" required>
						</div>
                    </div>
                    <!-- ./ form-group -->
		  			<div class="modal-footer">
					  <input name="register" type="submit" class="btn btn-primary" value="<?php echo lang_key("REQUEST"); ?>" />
				<button type="reset" class="btn btn-default" value="Reset"><?php echo lang_key("RESET"); ?></button>
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang_key("CLOSE"); ?></button>
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
