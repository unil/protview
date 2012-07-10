var ProtView = {
	VERSION_NUMBER : 0.1,
	init : function() {
		ProtView.Network.send('get', 'api/protview/', ProtView.Graphic.init);
	}
};

