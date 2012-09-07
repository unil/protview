/**
 * 
 * Module's Main controller
 * 
 * 
 * @module DrawBoard
 * @namespace DrawBoard.Controller
 * @class MainController
 * @extends Core.Controller
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.DrawBoard.Controller.MainController = ProtView.Core.MainController.extend( {
	/**
	 * Loads the requested resource
	 * 
	 * On loading creates resource controller and view
	 * 
	 * Available resources : drawboard
	 * 
	 * @method load
	 * @param {String} resource
	 */
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
	/**
	 * Updates controller based on arguments
	 * 
	 * @method update
	 * @param arguments
	 */
	update : function(arguments) {
		if (arguments.representation) {
			var stack = this.stack;
			for (var el in stack) {
				stack[el].update(arguments.representation);
			}
		}
	}
});