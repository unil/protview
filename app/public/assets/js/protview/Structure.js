ProtView.Structure.Controller = {};
ProtView.Structure.Model = {};
ProtView.Structure.View = {};

ProtView.Structure.Module = (function() {
	var stack = {},
	controller = null,
	sandbox = null,
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
		start : function() {
			load();
		},
		stop : function () {
			unload();
		},
		show : function(e, resource, id) {
			show(resource, id);
		},
		update : function(e, arguments) {
			update(arguments);
		},
		registerSandbox : function(obj) {
			sandbox = obj;
			sandbox.subscribe("/structure/start", ProtView.Structure.Module.start);
			sandbox.subscribe("/structure/stop", ProtView.Structure.Module.stop);
			sandbox.subscribe("/structure/show", ProtView.Structure.Module.show);
			sandbox.subscribe("/application/context", ProtView.Structure.Module.update);
		}
	};
}());