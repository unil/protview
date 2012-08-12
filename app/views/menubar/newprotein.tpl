<div id="new-protein-dialog">
	<div>Header</div>
<div>Content</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		  $('#new-protein-dialog').jqxWindow({ 
			  theme: Application.THEME, 
			  width: 400,
              height: 110, 
              resizable: false,
              isModal: true
          });
		  $('#new-protein-dialog').bind('closed', function (event) {
			  //cleaning dom
			  $('#new-protein-dialog').remove();
			  $('.jqx-window-modal ').remove();
			  }
		  );
	});
</script>