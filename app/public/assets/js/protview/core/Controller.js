/**
 * 
 * AbstractController, implements main functionalities
 * 
 * 
 * @module Core
 * @namespace Core
 * @class Controller
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Core.Controller = Class.extend( {
	init: function(model) {
		/**
		* Model handled by the controller
		*
		* @property model
		* @type Object
		* @default null
		**/
		this.model = null;
		/**
		* Views handled by the controller
		*
		* @property views
		* @type Object
		* @default {}
		**/
		this.views = {};
		/**
		* Contains all loaded resources
		*
		* @property stack
		* @type Object
		* @default null
		**/
		this.stack = {};
		/**
		 * Constructor
		 * @param model
		 * @method init
		 */
		var stack = {};
		var helper = new ProtView.Core.BackboneHelper(model);
		
		stack.model = model;
		stack.helper = helper;
		
		this.helper = helper;
		this.model = model;
		
		this.stack = stack;
	},
	/**
	 * Adds a view to the controller
	 * 
	 * @param {Core.View} view
	 * @method addView
	 */
	addView: function(view) {
		var viewEL = view.el;
		view.setController(this);
		view.setModel(this.model);
		view.render();
		this.views[viewEL] = view;
	},
	/**
	 * Get all views
	 * 
	 * @method getViews
	 * @returns {Object} views
	 */
	getViews: function() {
		return this.views;
	},
	/**
	 * Get the model handled by this controller
	 * 
	 * @method getModel
	 * @returns {Backbone.Model} model
	 */
	getModel : function() {
		return this.model;
	},
	/**
	 * Fetches model by specified id
	 * 
	 * Overrides this method in child Controller
	 * 
	 * @param id
	 * @returns serverResponse
	 * @method fetch
	 */
	fetch : function(id) {
		var ret = null,
		model = this.model;
		if (model != null) {
			if (id != null && id > 0 && model.get('id') != id) {
				model.set({id : id}, {silent: true});
				this.model = model;
				
				ret = this.helper.fetch(function(r){
					ret = r;
				});
			}
			else {
				console.log('ProtView.Core.Controller:fetch: no id for model');
			}
		}
		
		return ret;
	},
	/**
	 * Unloads all loaded resources
	 * 
	 * @method unload
	 */
	unload : function() {	
		var stack = this.views;
		for (var el in stack) {
			   var obj = stack[el];
			   obj.unload();
			   stack[el] = null;
			   delete stack[el];
		}
	},
	/**
	 * Saves the model to the server
	 * 
	 * @method save
	 */
	save : function() {
		this.model.save(null,{
			error: function(err){
				console.log('ProtView.Core.Controller.save: error callback not implemented');
			}, 
			success: function(succ) {
				console.log('ProtView.Core.Controller.save: success callback not implemented');
			}
			});
	},
	/**
	 * Updates the model from server
	 * @param id
	 * @method update
	 */
	update : function(id) {
		if (this.model != null) {
			this.fetch(id);
		}
	}
});
