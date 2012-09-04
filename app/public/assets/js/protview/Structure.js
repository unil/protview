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
	 * @method start
	 */
	load = function() {
		controller = new ProtView.Structure.Controller.MainController();
		stack.controller = controller;
	},
	show = function(resource, id) {
		controller.load(resource);
		c = controller.getController();
		if (c != null) {
			c.fetch(id);
		}
		else 
			console.log("ProtView.Structure.Module:show controller is null");
	},
	hide = function(resource) {
		controller.unload(resource);
	},
	unload = function() {
		for (var el in stack) {
			   /*var obj = stack[el];
			   obj.unload();*/
			   stack[el] = null;
			   delete stack[el];
		}
	},
	update = function (arguments) {
		if (controller != null)
			controller.update(arguments);
	};
	
	//public
	return {
		/**
		 * Starts module
		 * 
		 * @method start
		 */
		start : function() {
			load();
		},
		/**
		 * Starts module
		 * 
		 * @method start
		 */
		stop : function () {
			unload();
		},
		show : function(e, resource, id) {
			show(resource, id);
		},
		hide : function(e, resource) {
			hide(resource);
		},
		update : function(e, arguments) {
			update(arguments);
		},
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