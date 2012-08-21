<div id="open-representation-dialog">
<?php
$representations = $d['representations'];

foreach ($representations as $representation) {
	echo '<ul>';
	echo "<li><a href='#view/0/{$representation['id']}'>{$representation['title']} (creator: {$representation['creator']})</a></li>";
	echo '</ul>';
}
?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		  $('#open-representation-dialog').jqxWindow({ 
			  theme: Application.THEME, 
			  width: 400,
              height: 220, 
              resizable: false,
              isModal: true
          });
		  $('#open-representation-dialog').bind('closed', function (event) {
			  //cleaning dom
			  $('#open-representation-dialog').remove();
			  $('.jqx-window-modal ').remove();
			  }
		  );
	});
</script>