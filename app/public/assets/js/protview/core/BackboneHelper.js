ProtView.Core.BackboneHelper = Class.extend( {
	init: function(collection) {
		this.collection = collection;
	},
	fetch : function(callback, options) {
		var ret = this.collection;
		this.collection.fetch({
				data: options,
				success: function(){
					callback(ret);
				},
				error: function () {
					console.log('ProtView.Core.BackBoneHelper: error');
				}
			}
		);
	}
});