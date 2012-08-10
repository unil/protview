ProtView.DrawBoard.Controller.DrawBoardController = Class.extend( {
	model : null,
	init: function() {

	},
	setModel : function(model) {
		this.model = model;
		this.helper = new ProtView.Core.BackboneHelper(this.model);
	},
	update : function(options) {
		var ret = null;
		if (this.model != null) {
			ret = this.helper.fetch(function(r){
				ret = r;
			}, options);
		}
		return ret;
	}
});