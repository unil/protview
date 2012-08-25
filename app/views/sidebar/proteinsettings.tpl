<div>
	<!-- SETTINGS WINDOW BEGIN -->
	<div id="settingsWindow" style="height: 540px">
		<div>Protein definition</div>
		<div style="overflow: hidden;">
			<div id="settingsTabs">
				<ul style="margin-left: 3px">
					<li>General</li>
					<li>Structure</li>
					<!--  <li>Post modification</li>-->
				</ul>
				<!-- PROTEIN SETTINGS BEGIN-->
				<div id="proteinSettings">
					<img src="<?php echo xUtil::url('a/js/lib/jqwidgets/resources/loader.gif')?>" />
				</div>
				<!-- PROTEIN SETTINGS END-->
				<!-- STRUCTURE SETTINGS BEGIN -->
				<div id="peptideSettings">
					<img src="<?php echo xUtil::url('a/js/lib/jqwidgets/resources/loader.gif')?>" />
				</div>
				<!-- STRUCTURE SETTINGS END -->
				<!-- MODIFICATION SETTINGS BEGIN -->
				<!-- <div id="postmodificationSettings">
					<img src="<?php echo xUtil::url('a/js/lib/jqwidgets/resources/loader.gif')?>" />
				</div> -->
				<!-- MODIFICATION SETTINGS END -->
			</div>
		</div>
	</div>
	<!-- SETTINGS WINDOW END -->
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var theme = Application.THEME;

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

        $('#settingsWindow').bind('close', function (event) {
        	$(this).remove();    
		}); 
	});
</script>