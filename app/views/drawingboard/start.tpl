<?php foreach ($m['css'] as $css): ?>
<link
	href="<?php echo $css ?>" rel="stylesheet">
<?php endforeach ?>
<div id="drawBoard"
	style="display: inline;"></div>
<!-- JavaScript - for better performance, on the bottom -->
<?php foreach ($m['js'] as $js): ?>
<script
	type="text/javascript" src="<?php echo $js ?>"></script>
<?php endforeach ?>
