ProtView.Structure.Controller = {};
ProtView.Structure.Model = {};
ProtView.Structure.View = {};

/**
 * Structure module facade
 * 
 * Handles module requests and responses
 * 
 * @namespace Structure
 * @class Module
 * @module Structure
 */
ProtView.Structure.Module = (function() {
	var stack = {},
	controller = null,
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
	 * @method show
	 */
	show = function(resource, id) {
		//Gets resource controller from MainController
		controller.load(resource);
		c = controller.getController();
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
	 * @method hide
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
		 * @method show
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
		 * @method show
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