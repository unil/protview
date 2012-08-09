ProtView.Core.Helper = (function() {
	var fetch = function (url, method) {
		var ret = null;
		$.ajax({
			type : method,
			url : url,
			dataType: "html",
			data : {
				
			},
			success : function(msg) {
				ret = msg;
				return ret;
	
			}
		});
	};
	return {
		fetch : function(url, method) {
			var ret = fetch(url, method);
			return ret;
		}
	};
})();