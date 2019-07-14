 <script>  
   $(document).ready(function () {
		jsPanel.create(
         {
			theme: 'dark',
			headerTitle: 'Radio Code Reference',
         position: 'center-top 0 0',
         headerControls: 'hide',
         contentOverflow: 'hidden',
			contentSize: {
				width: 780,
				height: 528
			},
         content: '<iframe src="<?php echo BASE_URL . '/' . OC_CONTENT_DIR ?>/plugins/radioCodeReference/load.php" scrolling="no" style="width:100%; height:530px;"></iframe>'
		});
   });
</script>