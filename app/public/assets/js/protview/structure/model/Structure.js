ProtView.Structure.Model.Structure = Backbone.RelationalModel.extend({
	defaults : {
		id: null,
		sequence: null,
		terminusN: null,
		terminusC: null,
		regions : null
	},
	initialize : function Structure() {
	}
});