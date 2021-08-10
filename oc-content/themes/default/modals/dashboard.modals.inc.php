<?php if(OC_DEBUG == 'true'){?>
<!-- Debug Info Modal -->
<div class="modal" id="debugInfo" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
   <div class="modal-content">
	  <div class="modal-header">
		 <h4 class="modal-title" id="debugInfoModalLabel">Debug Info</h4>
				 <button type="button" class="close" id="closeDebugInfo" data-dismiss="modal"><span aria-hidden="true">×</span>
		 </button>
		</div>
		<!-- ./ modal-header -->
		<div class="modal-body">
		<?php
				session_start();
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL & E_STRICT  & ~E_NOTICE);
				echo "<pre>";
				print_r($_SESSION);
				echo "</pre>";
			} else {
				ini_set('display_errors', 0);
				ini_set('display_startup_errors', 0);
				?>
   		</div>
   <!-- ./ modal-content -->
</div>
<!-- ./ modal-dialog modal-md -->
</div>
<!-- ./ modal fade -->
<!-- ./ Debug Info Modal -->
<?php } ?>