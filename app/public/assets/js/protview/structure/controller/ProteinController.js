ProtView.Structure.Controller.ProteinController = Class.extend( {
	model : null,
	init: function() {

	},
	setModel : function(model) {
		this.model = model;
		this.helper = new ProtView.Core.BackboneHelper(this.model);
	},
	update : function(id) {
		var ret = null;
		if (this.model != null) {
			ret = this.helper.fetch(function(r){
				ret = r;
			},{id: id});
		}
		return ret;
	}
});
