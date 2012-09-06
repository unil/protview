/**
* Contains module controllers
* 
* @author Stefan Meier
* @version 20120903
* 
* @module DrawBoard
*/
ProtView.DrawBoard.Controller = {};
/**
* Contains module models
* 
* @author Stefan Meier
* @version 20120903
* 
* @module DrawBoard
*/
ProtView.DrawBoard.Model = {};
/**
* Contains module views
* 
* @author Stefan Meier
* @version 20120903
* 
* @module DrawBoard
*/
ProtView.DrawBoard.View = {};
/**
* Contains module utility functions
* 
* @author Stefan Meier
* @version 20120903
* 
* @module DrawBoard
*/
ProtView.DrawBoard.Utils = {};

/**
 * DrawBoard module facade
 * 
 * Handles module requests and responses
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 * @namespace DrawBoard
 * @class Module
 * @module DrawBoard
 */
ProtView.DrawBoard.Module = (function() {
	/**
	* Contains all loaded resources
	*
	* @property stack
	* @type Object
	* @default null
	**/
	var stack = {},
	/**
	* Modules main controller
	*
	* @property controller
	* @type Core.MainController
	* @default null
	**/
	controller = null,
	/**
	* Reference to sandbox
	* 
	* @property sandbox
	* @type Application.Sandbox
	* @default null
	**/
	sandbox = null,
	/**
	 * Loads module core classes
	 * 
	 * @private
	 * @method load
	 */
	load = function() {
		controller = new ProtView.DrawBoard.Controller.MainController();
		stack.controller = controller;
	},
	/**
	 * Shows indicated resource or updates resource with specified id
	 * 
	 * @private
     * @param {String} resource
	 * @param {int} id
	 * @method show
	 */
	show = function(resource, id) {
		controller.load(resource);
		var c = controller.getController(resource);
		if (c != null) {
			if (id > 0)
				c.fetch(id);
			else
				c.clear();
		}
		else 
			console.log("ProtView.Drawboard.Module:show controller is null");
	},
	/**
	 * Unloads module and all its functionalities
	 * 
	 * @private
	 * @todo this method needs to be implemented
	 * @method unload
	 */
	unload = function() {
		for (var el in stack) {
			   /*var obj = stack[el];
			   obj.unload();*/
			   stack[el] = null;
			   delete stack[el];
		}
	},
	/**
	 * Updateds module
	 * 
	 * Only subscribed controllers will be updated with information
	 * 
	 * @private
	 * @param {Object} arguments
	 * @method update
	 */
	update = function (arguments) {
		if (controller != null)
			controller.update(arguments);
	},
	/**
	 * Saves current representation
	 * 
	 * 
	 * @private
	 * @todo this method needs for other module functionalities
	 * @method save
	 */
	save = function() {
		var c = controller.getController('drawboard');
		c.save();
	};
	//public
	return {
		/**
		 * Starts module
		 * 
		 * Calls load and starts toolbar
		 * 
		 * @method start
		 */
		start : function() {
			new ProtView.DrawBoard.View.ToolbarView();
			load();
		},
		/**
		 * Stops module
		 * 
		 * Calls unload
		 * 
		 * @method stop
		 */
		stop : function () {
			unload();
		},
		/**
		 * Shows specified resource
		 * 
		 * Calls show
		 * 
		 * @param {Object} event
		 * @param {String} resource
		 * @param {int} id
		 * @method show
		 */
		show : function(e, resource, id) {
			show(resource, id);
		},
		/**
		 * Updates module
		 * 
		 * Calls update
		 * 
		 * @param {Object} event
		 * @param {Object} arguments
		 * @method update
		 */
		update : function(e, arguments) {
			update(arguments);
		},
		/**
		 * Saves module
		 * 
		 * Calls save
		 * 
		 * @method save
		 */
		save : function() {
			save();
		},
		/**
		 * Registers sandbox and module's public methods
		 * 
		 * @param {Object} sandbox
		 */
		registerSandbox : function(obj) {
			sandbox = obj;
			sandbox.subscribe("/drawboard/start", ProtView.DrawBoard.Module.start);
			sandbox.subscribe("/drawboard/stop", ProtView.DrawBoard.Module.stop);
			sandbox.subscribe("/drawboard/show", ProtView.DrawBoard.Module.show);
			sandbox.subscribe("/drawboard/save", ProtView.DrawBoard.Module.save);
			sandbox.subscribe("/application/context", ProtView.DrawBoard.Module.update);
		}
	};
}());