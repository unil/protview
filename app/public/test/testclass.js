
var TestClass = {
	text : null,
	doThis : function (localText) {
		console.log(localText);
		console.log(text);
	}	
};

TestClass.doThis("first");
TestClass.text = "text";
TestClass.doThis("second");
