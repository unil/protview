<?php echo xView::load('sidebar/proteinsettings')->render(); ?>

<script type="text/javascript">
	$(document).ready(function() {
		var theme = Application.THEME;

		$('#sidebar').jqxDocking({ theme: theme, orientation: 'horizontal', width: 400, mode: 'docked' });
		$('#sidebar').jqxDocking('showAllCollapseButtons');
		$('#settingsTabs').jqxTabs({ theme: theme, width: '100%', height: '100%', selectedItem: 0 });
		
		var loadPage = function (tabIndex) {
			var url = null;
			var tabId = null;
			var alreadyLoaded = false;
			switch(tabIndex) {
				case 1 :
					alreadyLoaded = $('#protein-form').length;
					url = Application.ROOTPATH + 'raw/proteins/do';
					tabId = '#proteinSettings';
					break;
				case 2: 
					alreadyLoaded = $('#peptide-form').length;
					url = Application.ROOTPATH + 'raw/peptides/do';
					tabId = '#peptideSettings';
					break;
				case 3:
					alreadyLoaded = $('#postmodification-form').length;
					url = Application.ROOTPATH + 'raw/postmodification/do';
					tabId = '#postmodificationSettings';
					break;
			}
			//fixes default widget behaviour which causes reloading on
			//each request even container still exists
			if (!alreadyLoaded && url != null && tabId != null) {
	            $.get(url, function (data) {
	                $(tabId).html(data);
	            });
			}
        };
        loadPage(1);
        $('#settingsTabs').bind('selected', function (event) {
           
            var pageIndex = event.args.item + 1;
            loadPage(pageIndex);
        });
	});
</script>