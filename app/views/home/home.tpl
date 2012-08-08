<a href="#" id="showDrawingBoard">Show drawing board</a>
<div id="test" style="display: inline;"></div>
<script type='text/javascript'>
$(document).ready(function() {
	$('#showDrawingBoard').click(function() {
		send("get");
	});

});

function send(method) {
	$.ajax({
		type : method,
		url : "<?php echo xUtil::url('raw/drawingboard/do/')?>",
		dataType: "html",
		data : {
			
		},
		success : function(msg) {
			
			$('#test').html(msg);

		}
	});
}
</script>