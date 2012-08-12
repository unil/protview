<ul>
	<li>File
		<ul style='width: 250px;'>
			<li><a target="_parent" href="#file-new-protein">New Protein</a></li>
			<li><a target="_parent" href="#file-open">Open</a></li>
			<li><a target="_parent" href="#file-save">Save</a></li>
		</ul>
	</li>
	<li>View
		<ul style='width: 250px;'>
			<li>Show
				<ul style='width: 250px;'>
					<li><a target="_parent" href="#show-drawboard">Drawboard</a></li>
					<li><a target="_parent" href="#show-sidebar">Sidebar</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li>About
		<ul style='width: 250px;'>
			<li><a target="_parent" href="#about-protview">ProtView</a></li>
		</ul>
	</li>
</ul>
<script type="text/javascript">
	$(document).ready(function() {
		var theme = Application.THEME;

		$("#menubar").jqxMenu({ width: '100%', height: '30px', autoOpen: false, autoCloseInterval: 0, theme: theme });
        $("#menubar").css('visibility', 'visible');
		
		$('#content-loading').remove();
		new ProtView.Core.Router();
		Backbone.history.start();
	});
</script>
