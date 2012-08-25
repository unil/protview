<?php echo xView::load('sidebar/proteinsettings')->render(); ?>

<script type="text/javascript">
	$(document).ready(function() {
		var theme = Application.THEME;

		$('#sidebar').jqxDocking({ theme: theme, orientation: 'horizontal', width: 400, mode: 'docked' });
		$('#sidebar').jqxDocking('showAllCollapseButtons');
		$('#sidebar').jqxDocking('hideAllCloseButtons');
		
	});
</script>