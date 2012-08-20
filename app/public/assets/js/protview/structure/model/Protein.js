ProtView.Structure.Model.Protein = Backbone.Model.extend({
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
		return this.id == null ? root + 'api/proteins/0': root + 'api/proteins/' + this.id;
	},
	validation: {
	    name: {
	      required: true,
	      msg: 'Please enter a valid email'
	    }
	}
});