DrawBoard.Core.Mediator = (function() {
	var subscribe = function(channel, callback){
		$.subscribe(channel, callback);
	},
	unsubscribe = function(channel, callback){
		$.unsubscribe(channel, callback);
	},
	publish = function(channel, arguments){
		$.publish(channel, arguments);
	};
	
	return {
	    publish: function(channel, arguments) {
	    	publish(channel, arguments);
	    },
	    subscribe: function(channel, callback) {
	    	subscribe(channel, callback);
	    },
	    unsubscribe : function(channel, callback) {
	    	unsubscribe(channel, callback);
	    }
	};
}());