ProtView.Structure.Controller = {};
ProtView.Structure.Model = {};
ProtView.Structure.View = {};

ProtView.Structure.Module = (function() {
	//local
	//var mediator = null,
	var stack = {},
	resource = null,
	load = function() {
		var model = null,
		controller = null,
		view = null;
		if (resource == null || resource == 'undefined') {
			resource = 'protein';
		}
		switch(resource) {
			case 'protein': 
				model = new ProtView.Structure.Model.ProteinCollection();
				view = new ProtView.Structure.View.ProteinView();
				controller = new ProtView.Structure.Controller.ProteinController();
				controller.setModel(model);
				view.setModel(model);
				view.setController(controller);
				controller.update(1);
				resource = 'protein';
				break;		
		}
		stack.model = model;
		stack.view = view;
		stack.controller = controller;
	},
	show = function(resource, id) {
		//if (resource != this.resource) 
		
		
		
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