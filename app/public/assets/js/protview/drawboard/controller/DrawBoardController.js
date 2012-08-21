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
	}
});