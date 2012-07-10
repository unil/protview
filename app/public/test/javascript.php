<script type="text/javascript">
var TestClass = {
	text : null,
	doThis : function (localText) {
		console.log(localText);
		console.log(this.text);
	}	
};

TestClass.doThis("first");
TestClass.text = "text";
TestClass.doThis("second");
</script>
