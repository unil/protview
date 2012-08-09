<a href="#" id="showDrawingBoard">Show drawing board</a>
<div id="test" style="display: inline;"></div>
<script type='text/javascript'>
$(document).ready(function() {
	$('#showDrawingBoard').click(function() {
		var url = Application.ROOTPATH + 'raw/drawingboard/do/';
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
			$('#test').html(msg);
			ProtView.DrawBoard.Module.start();
		}
});
}
</script>