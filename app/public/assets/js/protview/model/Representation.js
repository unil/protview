ProtView.Model.Representation = Backbone.Model.extend({
	defaults : {
		regions : new ProtView.Model.Regions()
	},
	initialize : function Representation() {
	},
	url : function() {
		return this.id ? 'api/representation/' + this.id : 'api/representation';
	},
});