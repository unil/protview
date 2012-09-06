/**
 * 
 * AbstractMainController, implements main functionalities
 * 
 * 
 * @module Core
 * @namespace Core
 * @class MainController
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Core.MainController = Class.extend( {
	/**
	* Contains all loaded resources
	*
	* @property stack
	* @type Object
	* @default null
	**/
	stack : {},
	/**
	 * Gets controller from stack
	 * 
	 * @param controllerName
	 * @return {Core.Controller} controller
	 */
	getController : function(resource) {
		return this.stack[resource];
	},
	/**
	 * Unloads all loaded resources
	 * 
	 * @method unload
	 * @param {Object} resource
	 */
	unloadAll : function() {
		var stack = this.stack;
		for (var el in stack) {
			   /*var obj = stack[el];
			   obj.unload();*/
			   stack[el] = null;
			   delete stack[el];
		}
	}
});