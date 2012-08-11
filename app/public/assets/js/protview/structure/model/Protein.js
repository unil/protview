ProtView.Structure.Model.Protein = Backbone.RelationalModel.extend({
	defaults : {
		id: null,
		name: null,
		species: null,
		note: null,
	},
	initialize : function Protein() {
	},
	url : function() {
		var root = Application.ROOTPATH;
		return root + 'api/proteins/' + this.id;
	}
});