/**
 * 
 * Core Helper class for Backbone fetching/saving
 * 
 * 
 * @module Core
 * @namespace Core
 * @class BackboneHelper
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Core.BackboneHelper = Class.extend( {
	/**
	 * Constructor
	 * 
	 * @constructor
	 * @param resource
	 * @method init
	 */
	init: function(collection) {
		this.collection = collection;
	},
	/**
	 * Fetches data from Server
	 * 
	 * @param {function} callback
	 * @param {Object} fetchOptions
	 * @method fetch
	 */
	fetch : function(callback, options) {
		var ret = this.collection;
		this.collection.fetch({
				data: options,
				success: function(){
					callback(ret);
				},
				error: function () {
					console.log('ProtView.Core.BackBoneHelper: error');
				},
			}
		);
	}
});