ProtView.DrawBoard.Controller.MainController = ProtView.Core.MainController.extend( {
	load : function(resource) {
		var controller = null,
		view = null,
		stack = this.stack;

		if (!stack[resource]) {
			switch(resource) {
				case 'drawboard' :
					controller = new ProtView.DrawBoard.Controller.DrawBoardController();
					view = new ProtView.DrawBoard.View.DrawBoardView({ 
						el: $('#drawBoard').get(0) 
					});
					controller.addView(view);
					break;
				default :
					console.log('ProtView.DrawBoard.Controller.load:error no resource given or not known');
					break;
			}
			stack[resource] = controller;
			this.stack = stack;
		}
	},
	update : function(arguments) {
		if (arguments.representation) {
			var stack = this.stack;
			for (var el in stack) {
				stack[el].update(arguments.protein);
			}
		}
	}
});