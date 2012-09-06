/**
 * 
 * Application Mediator
 * 
 * Handles subscription/publications of channels and message
 * 
 * 
 * @module Application
 * @namespace Application
 * @class Mediator
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Application.Mediator = (function() {
	/**
	 * Subscribes callback to channel
	 * 
	 * @param channel
	 * @param callback
	 * @method subscribe
	 * @private
	 */
	var subscribe = function(channel, callback){
		$.subscribe(channel, callback);
	},
	/**
	 * Unsubscribes callback from channel
	 * 
	 * @param channel
	 * @param callback
	 * @method unsubscribe
	 * @private
	 */
	unsubscribe = function(channel, callback){
		$.unsubscribe(channel, callback);
	},
	/**
	 * Publish message to channel
	 * 
	 * @param channel
	 * @param message
	 * @method publish
	 * @private
	 */
	publish = function(channel, arguments){
		$.publish(channel, arguments);
	};
	return {
		/**
		 * Publish message to channel
		 * 
		 * @param channel
		 * @param message
		 * @method publish
		 */
	    publish: function(channel, arguments) {
	    	publish(channel, arguments);
	    },
	    /**
	     * Subscribes callback to channel
	     * 
	     * @param channel
	     * @param callback
	     * @method subscribe
	     */
	    subscribe: function(channel, callback) {
	    	subscribe(channel, callback);
	    },
	    /**
	     * Unsubscribes callback from channel
	     * 
	     * @param channel
	     * @param callback
	     * @method unsubscribe
	     */
	    unsubscribe : function(channel, callback) {
	    	unsubscribe(channel, callback);
	    }
	};
}());