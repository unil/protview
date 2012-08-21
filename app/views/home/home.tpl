<div id="toolbar" style="padding: 8px 0; background-color:#CCCCCC;" class="well">
	<ul class="nav nav-list">
		<li><a href="#"><i class="icon-picture"></i> </a>
		</li>
		<li><a href="#"><i class="icon-zoom-in"></i> </a>
		</li>
		<li><a href="#"><i class="icon-zoom-out"></i>
		</a>
		</li>
		<li><a id="export-png"><i class="icon-download-alt"></i> </a>
		</li>
	</ul>
</div>
<!-- BEGIN DRAWBOARD -->
<div id="drawingBoard"
	style="display: block;"></div>
<!-- END DRAWBOARD -->
<!-- BEGIN SIDEBAR -->
<!-- DOCKING BEGIN -->
<div id="sidebar"></div>
<!-- DOCKING END -->
<!-- END SIDEBAR -->
<script type="text/javascript">
	$(document).ready(function() {
		var tb = new ProtView.Application.ToolbarView();
	});
</script>
