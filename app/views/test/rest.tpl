<script type='text/javascript'>
	$(document).ready(function() {
		$('#get').click(function() {
			send("get");
		});
		$('#post').click(function() {
			send("post");
		});
		$('#put').click(function() {
			send("put");
		});
		$('#delete').click(function() {
			send("delete");
		});
	});

	function send(method) {
		$.ajax({
			type : method,
			url : "api/testrest/",
			dataType: "text",
			data : {
				"id" : "12",
				"example" : "adsf"
			},
			success : function(msg) {
				$('#log').append("<br/>method: " + method);
				$('#log').append("<br/>result" + msg);
				$('#log').append("<br/>--------------")
			}
		});
	}
</script>
<a href="#" id="get">Send GET</a>
	<br />
	<br />
	<a href="#" id="post">Send POST</a>
	<br />
	<br />
	<a href="#" id="put">Send PUT</a>
	<br />
	<br />
	<a href="#" id="delete">Send DELETE</a>
	<br />
	<br />
	Log: <br/>
	<pre id="log"></pre>