ProtView.DrawBoard.Controller = {};
ProtView.DrawBoard.Model = {};
ProtView.DrawBoard.View = {};
ProtView.DrawBoard.Utils = {};

ProtView.DrawBoard.Module = (function() {
	//local
	var stack = {},
	controller = null,
	sandbox = null,
	load = function() {
		//init mediator, main controller
		controller = new ProtView.DrawBoard.Controller.MainController();
		
		stack.controller = controller;
	},
	show = function(resource, id) {
		controller.load(resource);
		c = controller.getController();
		if (c != null) {
			if (id > 0)
				c.fetch(id);
			else
				c.clear();
		}
		else 
			console.log("ProtView.Drawboard.Module:show controller is null");
	},
	unload = function() {
		for (var el in stack) {
			   /*var obj = stack[el];
			   obj.unload();*/
			   stack[el] = null;
			   delete stack[el];
		}
	};	
	//public
	return {
		start : function() {
			new ProtView.DrawBoard.View.ToolbarView();
			load();
		},
		stop : function () {
			unload();
		},
		show : function(e, resource, id) {
			show(resource, id);
		},
		update : function(e, arguments) {
			if (arguments.representation) {
				ProtView.Application.Sandbox.publish("/drawboard/show", ['drawboard', arguments.representation]);
			}
		},
		registerSandbox : function(obj) {
			sandbox = obj;
			sandbox.subscribe("/drawboard/start", ProtView.DrawBoard.Module.start);
			sandbox.subscribe("/drawboard/stop", ProtView.DrawBoard.Module.stop);
			sandbox.subscribe("/drawboard/show", ProtView.DrawBoard.Module.show);
			sandbox.subscribe("/application/context", ProtView.DrawBoard.Module.update);
		}
	};
}());