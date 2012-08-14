ProtView.Structure.Model.Structure = Backbone.RelationalModel.extend({
	defaults : {
		id: null,
		sequence: null,
		terminusN: null,
		terminusC: null,
		membraneRegions : {}
	},
	initialize : function Structure() {
	},
	url : function() {
		var root = Application.ROOTPATH;
		return root + 'api/structure/' + this.id;
	},
});