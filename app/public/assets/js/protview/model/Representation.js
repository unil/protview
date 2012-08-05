ProtView.Model.Representation = Backbone.Model.extend({
	defaults : {
		region : new ProtView.Model.Regions()
	},
	initialize : function Representation() {
	},
	addRegion : function(region) {
		this.get('region').add(region);
		this.trigger('regionChanged');
	},
	url : function() {
		return this.id ? 'api/representations/' + this.id : 'api/representation';
	},
});