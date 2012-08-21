<!-- JavaScript - for better performance, on the bottom -->
<?php foreach ($m['js'] as $js): ?>
<script
	type="text/javascript" src="<?php echo $js ?>"></script>
<?php endforeach ?>

<script type="text/javascript">
	$(document).ready(function() {
		ProtView.Structure.Module.registerSandbox(ProtView.Application.Sandbox);

		ProtView.Application.Sandbox.publish("/structure/start");
	});
</script>