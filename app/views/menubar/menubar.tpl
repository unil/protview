<ul>
	<li>File
		<ul style='width: 250px;'>
			<li><a target="_parent" href="#Education">Open</a></li>
			<li><a target="_parent" href="#Education">Save</a></li>
		</ul>
	</li>
	<li>View
		<ul style='width: 250px;'>
			<li>Show
				<ul style='width: 250px;'>
					<li><a target="_parent" href="#Education">Settings</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li>About
		<ul style='width: 250px;'>
			<li><a target="_parent" href="#Education">ProtView</a></li>
		</ul>
	</li>
</ul>
<script type="text/javascript">
	$(document).ready(function() {

		var theme = Application.THEME;

		$("#menubar").jqxMenu({ width: '100%', height: '30px', autoOpen: false, autoCloseInterval: 0, theme: theme });
        $("#menubar").css('visibility', 'visible');

		//$('#sidebar').jqxDocking({ theme: theme, orientation: 'horizontal', width: 400, mode: 'docked' });
		//$('#sidebar').jqxDocking('showAllCollapseButtons');
		//$('#settingsTabs').jqxTabs({ theme: theme, width: '100%', height: '100%', selectedItem: 0 });
		
		$('#content-loading').remove();

	});
</script>
