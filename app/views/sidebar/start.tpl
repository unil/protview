<?php echo xView::load('sidebar/proteinsettings')->render() ?>
<script type="text/javascript">
	$(document).ready(function() {
		var theme = 'summer';

		$('#sidebar').jqxDocking({ theme: theme, orientation: 'horizontal', width: 400, mode: 'docked' });
		$('#sidebar').jqxDocking('showAllCollapseButtons');
		$('#settingsTabs').jqxTabs({ theme: theme, width: '100%', height: '100%', selectedItem: 0 });
		
		
	});
</script>