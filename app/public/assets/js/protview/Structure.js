ProtView.Structure.Controller = {};
ProtView.Structure.Model = {};
ProtView.Structure.View = {};

ProtView.Structure.Module = (function() {
	//local
	//var mediator = null,
	var stack = {},
	controller = null,
	load = function() {
		//init mediator, main controller
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
	};
	/*publish = function(channel, argument) {
		mediator.publish(publisher, argument);
	};
	subscribe = function(subscriber, callback) {
		mediator.subscribe(subscriber, callback);
	};
	unsubscribe = function(subsriber) {
		mediator.unsubsribe(subsriber);
	};*/
	
	//public
	return {
		start : function() {
			load();
		},
		stop : function () {
			unload();
		},
		show : function(resource, id) {
			show(resource, id);
		},
		publish : function(publisher, argument) {
			publish(publisher, argument);
		},
		subscribe: function(subsriber, callback) {
			subscribe(subscriber, callback);
		},
		unsubscribe : function (subscriber) {
			unsubscribe(subscriber);
		}
	};
}());