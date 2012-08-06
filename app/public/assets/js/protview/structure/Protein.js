ProtView.Model.Protein = Backbone.RelationalModel.extend({
	defaults : {
		id: null,
		name: null,
		species: null,
		note: null,
	},
	initialize : function Region() {
	},
	url : function() {
		return this.id ? 'api/protein/' + this.id : 'api/protein';
	},
});