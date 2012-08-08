
var Pattern = Class.extend({});

Patern.prototype.Module = (function() {
	//local
	var mediator = null,
	load = function() {};
	unload = function() {
		mediator.unload();
		mediator = null;
	};
	publish = function(publisher, argument) {
		mediator.publish(publisher, argument);
	};
	subscribe = function(subscriber, callback) {
		mediator.subscribe(subscriber, callback);
	};
	unsubscribe = function(subsriber) {
		mediator.unsubsribe(subsriber);
	};
	
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

