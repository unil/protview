<div id="toolbar" style="padding: 8px 0; background-color:#CAD353;" class="well">
	<ul class="nav nav-list">
		<li><a id="drawboad-show-representation"><i class="icon-picture"></i> </a>
		</li>
		<!--  
		<li><a href="#"><i class="icon-zoom-in"></i> </a>
		</li>
		<li><a href="#"><i class="icon-zoom-out"></i>
		</a>
		</li>
		-->
		<li><a id="drawboard-export-png"><i class="icon-download-alt"></i> </a>
		</li>
	</ul>
</div>
<?php foreach ($m['css'] as $css): ?>
<link
	href="<?php echo $css ?>" rel="stylesheet">
<?php endforeach ?>
<div id="drawBoard" style="display: block; position: absolute; left: 70px; top: 70px;"></div>
<div id='drawBoardContextMenu' style="visibility: hidden; position: absolute;">
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
		ProtView.DrawBoard.Module.registerSandbox(ProtView.Application.Sandbox);

		ProtView.Application.Sandbox.publish("/drawboard/start");
		

		// disable the default browser's context menu.
	    $('#drawBoard').bind('contextmenu', function (e) {
	         return false;
	    });
	});
</script>