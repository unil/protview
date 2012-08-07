ProtView.Utils.BackboneMediator = Class.extend( {
	init: function(collection) {
		this.collection = collection;
	},
	fetch : function(callback) {
		this.collection.fetch({
				success: function(){
					callback(this.collection);
				},
				error: function () {
					console.log('error');
				}
			}
		);
	}
});
