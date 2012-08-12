<?php echo xView::load('sidebar/proteinsettings')->render(); ?>
<?php 
 //in order to load js files necessary for this widget
echo xView::load('structure/start')->render() ;
?>
<script type="text/javascript">
	$(document).ready(function() {
		var theme = Application.THEME;

		$('#sidebar').jqxDocking({ theme: theme, orientation: 'horizontal', width: 400, mode: 'docked' });
		$('#sidebar').jqxDocking('showAllCollapseButtons');
		$('#settingsTabs').jqxTabs({ theme: theme, width: '100%', height: '100%', selectedItem: 0 });
		
		var loadPage = function (tabIndex) {
			var url = Application.ROOTPATH + 'raw/proteins/do';
			var tabId = '#proteinSettings';
			switch(tabIndex) {
				case 2: 
					url = Application.ROOTPATH + 'raw/structure/do';
					tabId = '#structuralSettings';
					break;
				case 3:
					url = Application.ROOTPATH + 'raw/postmodification/do';
					tabId = '#postmodificationSettings';
					break;
			}
            $.get(url, function (data) {
                $(tabId).html(data);
            });
        };
        loadPage(1);
        $('#settingsTabs').bind('selected', function (event) {
           
            var pageIndex = event.args.item + 1;
            loadPage(pageIndex);
        });
	});
</script>