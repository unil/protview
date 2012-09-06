/**
 * 
 * Application Router
 * 
 * Routes URL changes
 * 
 * 
 * @module Application
 * @namespace Application
 * @extends Backbone.Router
 * @class Router
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Application.Router = Backbone.Router.extend({
	/**
	 * Application routes
	 * 
	 * see Backbone documentation
	 * 
	 * @property routes
	 * @type Object
	 * 
	 */
	routes : {
		"view/:protein" : "view",
		"view/:protein/:representation" : "view"
	},
	/**
	 * Updates the context in order to load the view
	 * 
	 * @param protein
	 * @param representation
	 * @method view
	 */
	view : function(protein, representation) {
		Application.CONTEXT.set(null, {
			protein : protein,
			representation : representation
		});
	}
});