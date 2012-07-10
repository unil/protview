
ProtView.Network = {
	send : function (method, callback) {
		$.ajax({
			type : method,
			url : "api/protview/",
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