<?php if (!empty(COMMUNITY_HOMEPAGE)) {?>
	<footer class="app-footer">
		<div>
			<a rel="noopener" href="<?php echo COMMUNITY_HOMEPAGE ?>""><?php echo COMMUNITY_NAME ?> CAD </a> poweed by <a rel="noopener" href="https://opencad.io">OpenCAD</a>
			<span>&copy; 2017 <?php echo date("Y"); ?></span>
		</div>
		<div class="ml-auto">
		</div>
	</footer>
	<?php } else {?>
	<footer class="app-footer">
		<div>
			<?php echo COMMUNITY_NAME ?> CAD poweed by <a rel="noopener" href="https://opencad.io">OpenCAD</a>
			<span>&copy; 2017 <?php echo date("Y"); ?></span>
		</div>
		<div class="ml-auto">
		</div>
	</footer>
	<?php } ?>