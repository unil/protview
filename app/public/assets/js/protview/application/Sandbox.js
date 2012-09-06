/**
 * 
 * Application sandbox
 * 
 * Protects model from being called directly.
 * 
 * 
 * @module Application
 * @namespace Application
 * @class Sandbox
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Application.Sandbox = (function() {
	/**
	 * Interacts with server side
	 * 
	 * Server return is shown in given domElement
	 * 
	 * @param xaction
	 * @el domElement
	 * @method server
	 * @private
	 */
	var server = function(action, el) {
		var method = 'post',
		url = Application.ROOTPATH + 'raw/application/do/';
		$.ajax({
			type : method,
			url : url,
			dataType : 'html',
			data : {
				xaction: action
			},
			success : function(data) {
				console.log('ProtView.Application.Sandbox.Server: ' + action + ' OK');
				$(el).append(data);
			}
		});
	},
	/**
	 * Loads modules
	 * 
	 * The specified module is loaded into domElement
	 * 
	 * @param moduleName
	 * @param domElement
	 * @method load
	 * @private
	 */
	load = function (module, el) {
		var action = null;
		switch(module) {
			case 'drawboard' :
				action = 'startDrawboard';
				break;
			case 'sidebar' :
				action = 'startSidebar';
				break;
			case 'structure' :
				action = 'startStructure';
				break;
		}
		if (action != null) {
			server(action, el);
			//ProtView.Application.Sandbox.subscribe("/" + module + "/status");
		}
		else
			console.log('ProtView.Application.Sandbox.Load: module "' + module + '" does not exist.');
	},
	/**
	 * Unloads a module
	 * 
	 * Is not implemented
	 * 
	 * @todo implement
	 * @param module
	 * @method unload
	 * @private
	 */
	unload = function(module) {
		
	};
	return {
		/**
		 * Starts specified module
		 * 
		 * Calls start
		 * 
		 * @param module
		 * @param el
		 * @method start
		 */
		start : function(module, el) {
			load(module, el);
		},
		/**
		 * Stops specified module
		 * 
		 * Calls stop
		 * 
		 * @param module
		 * @method stop
		 */
		stop : function (module) {
			unload(module);
		},
		/**
		 * Retunrs current status of module
		 * 
		 * Not implemented
		 * 
		 * @param moduleName
		 * @method status
		 */
		status : function(module) {
			
		},
		/**
		 * Publish message via Mediator
		 * @param channel
		 * @param arguments
		 * @method publish
		 */
		publish : function(channel, arguments) {
			ProtView.Application.Mediator.publish(channel, arguments);
		},
		/**
		 * Subscribe to a channel using Mediator
		 * @param channel
		 * @param callback
		 * @method subscribe
		 */
		subscribe : function (channel, callback) {
			ProtView.Application.Mediator.subscribe(channel, callback);
		},
		/**
		 * Unsubscribes channel
		 * @param channel
		 * @method unsubscribe
		 */
		unsubscribe : function(channel) {
			ProtView.Application.Mediator.unsubscribe(channel);
		}
	};
}());