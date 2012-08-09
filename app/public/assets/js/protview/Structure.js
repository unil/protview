ProtView.Structure.Controller = {};
ProtView.Structure.Model = {};
ProtView.Structure.View = {};
ProtView.Structure.Utils = {};

ProtView.Structure.Module = (function() {
	//local
	//var mediator = null,
	var stack = {},
	load = function() {
		var model = new ProtView.DrawBoard.Model.StructuralGeometryCollection();
		var view = new ProtView.DrawBoard.View.DrawBoardView();
		var controller = new ProtView.DrawBoard.Controller.DrawBoardController();
		controller.setModel(model);
		view.setModel(model);
		view.setController(controller);
		controller.update();
		stack.model = model;
		stack.view = view;
		stack.controller = controller;
	};
	/*unload = function() {
		mediator.unload();
		mediator = null;
	};
	publish = function(channel, argument) {
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