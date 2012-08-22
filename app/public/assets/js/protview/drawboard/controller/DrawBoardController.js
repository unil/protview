ProtView.DrawBoard.Controller.DrawBoardController = ProtView.Core.Controller.extend( {
	init: function(args) {
		stack = {};

		var model = new ProtView.DrawBoard.Model.StructuralGeometryCollection();
		var view = new ProtView.DrawBoard.View.DrawBoardView({ el: $('#drawBoard').get(0) });
		var helper = new ProtView.Core.BackboneHelper(model);
		
		stack.model = model;
		stack.view = view;
		stack.helper = helper;
		
		this.helper = helper;
		this.model = model;
		
		view.setController(this);
		view.setModel(model);
		view.render();
		
		this.view = view;
		this.stack = stack;
	},
	clear : function() {
		this.view.clear();
	}
	/*,
	fetch: function(options) {
		console.log('options');
		console.log(options);
		var ret = null;
		if (this.model != null) {
			ret = this.helper.fetch(function(r){
				ret = r;
			}, options);
		}
		return ret;
	}*/
});