ProtView.Controller.DrawBoardController = Class.extend( {
	model : null,
	init: function() {

	},
	setModel : function(model) {
		this.model = model;
		this.mediator = new ProtView.Utils.BackboneMediator(this.model);
	},
	update : function() {
		var ret = null;
		if (model != null) {
			ret = this.mediator.fetch(function(r){
				ret = r;
			});
		}
		return ret;
	}
});
