
ProtView.Network = {
	send : function (method, url, callback) {
		$.ajax({
			type : method,
			url : url,
			dataType: "json",
			data : {
				"id" : "12",
				"example" : "adsf"
			},
			success : function(msg) {
				callback(msg);	
			}
		});
	}
};