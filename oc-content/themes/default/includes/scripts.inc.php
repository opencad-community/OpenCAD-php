	<?php
	require_once(__DIR__ . '/../../../../oc-config.php');
	require_once( ABSPATH . '/oc-functions.php');?>
	
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-3.3.2.js" integrity="sha384-KwAndHbPSueZ9+pG1mDjru/Q6KT6cliBs+/SCGpcOO6XvhrkbF0cBzkSs3+Pl2Zz" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
	
	<!-- popper.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	
	

	<script src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/tooltip.js/index.js"></script>

	<!-- Bootstrap -->
	<script src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- FastClick -->
	<script src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/fastclick/lib/fastclick.js"></script>

	<script src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.24/af-2.3.5/b-1.7.0/date-1.0.3/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.js" integrity="sha384-fkd60e3h4KqQPHk5QzJLtqtz9234AXlWUXryn0nXDmFWkf0Mnuz6w48y/jAYjkpu" crossorigin="anonymous"></script>
<!--<script type="text/javascript" src="<?php BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/jszip/dist/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.3/js/dataTables.autoFill.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.3/js/autoFill.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.0/js/dataTables.colReorder.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.4/js/dataTables.fixedHeader.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/keytable/2.5.0/js/dataTables.keyTable.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.4/js/dataTables.rowReorder.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" integrity="sha384-htFkmzBKFrwO7EbvHZPvJXWg0sJIkPPUTBDe6LXOU2ghApFVGQx9++EDSrKMZtHE" crossorigin="anonymous"></script>

	<!-- jsPanel JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.6.0/dist/jspanel.js" integrity="sha384-niyeYob8+jVAW7wqvuyILwb/P6Q4q/4az0JkdxnHOy93m/Ewd8ZDgibOmPX29dpu" crossorigin="anonymous"></script>
	<!-- optional jsPanel extensions -->
	<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.6.0/dist/extensions/modal/jspanel.modal.js" integrity="sha384-ZDbSMjwE6HKZnvOwK98Muv8T+cswGV0S5fOkLYrtgiDULsM+SjM7upC7k3z5Nfhl" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.6.0/dist/extensions/hint/jspanel.hint.js" integrity="sha384-H4j41Vt8xOv0CMER5LCf09UaYB1/n8o9KhDliTanupnP6ejM5GqX/LzFCS2NngSZ" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.6.0/dist/extensions/layout/jspanel.layout.js" integrity="sha384-QWsZetdzIXth4bYSUwUmxvfcuXa1y208IPHI6Z2fKgxBm3JwivOWUB3Y854Kt42F" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.6.0/dist/extensions/contextmenu/jspanel.contextmenu.js" integrity="sha384-YZ5X1LFz2GGe2aO5EvH6JCbCJmuwI6HZ21yKU4JkXSiCw0vvDgndrRGtJVtQjkar" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jspanel4@4.6.0/dist/extensions/dock/jspanel.dock.js" integrity="sha384-nK35q+8oz0VQ3k/3TdIXlO5LWC08s9ZnvDainbQNVQyDruOo0SbgKfLIWFtftnaU" crossorigin="anonymous"></script>

	<!-- Bootstrap Select -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/bootstrap-select/dist/css/bootstrap-select.css"></script>
	
	<!-- Bootstrap progressbar -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.css"></script>

	<!-- Custom Theme Scripts -->
	<script href="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/coreui/src/js/coreui.min.js"></script>
	<!--<link href="<?php echo BASE_URL . "/" . OCTHEMES . "/" . THEME; ?>/vendors/coreui/src/js/coreui-utilities.js" rel="stylesheet">-->
	<script src="<?php echo BASE_URL;?>/oc-includes/OpenCAD.js"></script>
	<script src="<?php echo BASE_URL; ?>/oc-includes/custom.js"></script>
