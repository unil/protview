/**
* Contains module controllers
* 
* @author Stefan Meier
* @version 20120903
* 
* @module Structure
*/
ProtView.Structure.Controller = {};
/**
* Contains module models
* 
* @author Stefan Meier
* @version 20120903
* 
* @module Structure
*/
ProtView.Structure.Model = {};
/**
* Contains module views
* 
* @author Stefan Meier
* @version 20120903
* 
* @module Structure
*/
ProtView.Structure.View = {};

/**
 * Structure module facade
 * 
 * Handles module requests and responses
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 * @namespace Structure
 * @class Module
 * @module Structure
 */
ProtView.Structure.Module = (function() {
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
		controller = new ProtView.Structure.Controller.MainController();
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
		//Gets resource controller from MainController
		controller.load(resource);
		var c = controller.getController(resource);
		if (c != null) {
			c.fetch(id);
		}
		else 
			console.log("ProtView.Structure.Module:show controller is null");
	},
	/**
	 * Hides indicated resource
	 * 
	 * @private
	 * @param {String} resource
	 * @method hide
	 */
	hide = function(resource) {
		controller.unload(resource);
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
	};
	
	//public
	return {
		/**
		 * Starts module
		 * 
		 * Calls load
		 * 
		 * @method start
		 */
		start : function() {
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
		 * Hides specified resource
		 * 
		 * Calls hide
		 * 
		 * @param {Object} event
		 * @param {String} resource
		 * @method hide
		 */
		hide : function(e, resource) {
			hide(resource);
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
		 * Registers sandbox and module's public methods
		 * 
		 * @param {Object} sandbox
		 */
		registerSandbox : function(obj) {
			sandbox = obj;
			sandbox.subscribe("/structure/start", ProtView.Structure.Module.start);
			sandbox.subscribe("/structure/stop", ProtView.Structure.Module.stop);
			sandbox.subscribe("/structure/show", ProtView.Structure.Module.show);
			sandbox.subscribe("/structure/hide", ProtView.Structure.Module.hide);
			sandbox.subscribe("/application/context", ProtView.Structure.Module.update);
		}
	};
}());