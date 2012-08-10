<!-- JavaScript - for better performance, on the bottom -->
<?php foreach ($m['js'] as $js): ?>
<script
	type="text/javascript" src="<?php echo $js ?>"></script>
<?php endforeach ?>

<script type="text/javascript">
	$(document).ready(function() {
		//mediator call should be here instead of module start directly
		ProtView.Structure.Module.start();
	});
</script>