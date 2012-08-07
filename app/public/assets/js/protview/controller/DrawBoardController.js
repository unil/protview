ProtView.Controller.DrawBoardController = Class.extend( {
	models : {},
	view : null,
	init: function(view) {
		this.view = view;
		var sgc = new ProtView.Model.StructuralGeometryCollection();
		sgc.on('change', this.update('sgc'), this);
		this.models.sgc = sgc;
	},
	setView : function(view) {
		this.view = view;
	},
	update : function(obj) {
		this.notify('model changed');
	},
	notify : function(arguments) {
		this.view.update(this, arguments);
	}
});
