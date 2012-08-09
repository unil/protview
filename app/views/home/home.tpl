<a href="#" id="showDrawingBoard">Show drawing board</a>
<a href="#" id="showSidebar">Show sidebar</a>
<div id="drawingBoard" style="display: inline;"></div>
<!-- BEGIN SIDEBAR -->
<!-- DOCKING BEGIN -->
<div id="sidebar"></div>
<!-- DOCKING END -->
<!-- END SIDEBAR -->
<script type='text/javascript'>
$(document).ready(function() {
	$('#showDrawingBoard').click(function() {
		var url = Application.ROOTPATH + 'raw/drawingboard/do/';
		var method = 'get';
		$.ajax({
			type : method,
			url : url,
			dataType: 'html',
			data : {
				
			},
			success : function(msg) {
				$('#drawingBoard').html(msg);
				ProtView.DrawBoard.Module.start();
			}
		});
	});
	$('#showSidebar').click(function() {
		var url = Application.ROOTPATH + 'raw/sidebar/do/';
		var method = 'get';
		$.ajax({
			type : method,
			url : url,
			dataType: 'html',
			data : {
				
			},
			success : function(msg) {
				$('#sidebar').html(msg);
			}
		});
	});

});
</script>
