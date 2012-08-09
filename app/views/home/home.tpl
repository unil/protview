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
		fetch(url, method);
	});
	$('#showSidebar').click(function() {
		var url = Application.ROOTPATH + 'raw/sidebar/do/';
		var method = 'get';
		fetch(url, method);
	});

});

function fetch(url, method) {
	$.ajax({
		type : method,
		url : url,
		dataType: 'html',
		data : {
			
		},
		success : function(msg) {
			/*$('#drawingBoard').html(msg);
			ProtView.DrawBoard.Module.start();*/
			$('#sidebar').html(msg);
		}
});
}
</script>
