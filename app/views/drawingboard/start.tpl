<?php foreach ($m['css'] as $css): ?>
<link
	href="<?php echo $css ?>" rel="stylesheet">
<?php endforeach ?>
<div id="drawBoard" style="display: inline;"></div>
<div id='drawBoardContextMenu'>
	<ul>
		<li><a href="#drawingboard-color-aa">Color amino acid</a></li>
	</ul>
</div>
<!-- JavaScript - for better performance, on the bottom -->
<?php foreach ($m['js'] as $js): ?>
<script
	type="text/javascript" src="<?php echo $js ?>"></script>
<?php endforeach ?>
<script type="text/javascript">
	$(document).ready(function() {
		ProtView.DrawBoard.Module.start();

		// disable the default browser's context menu.
	    $('#drawBoard').bind('contextmenu', function (e) {
	         return false;
	    });
	});
</script>
