/**
 * 
 * Application Context
 * 
 * Holds and stores global context
 * Application Context should be accessed via Sandbox
 * 
 * 
 * @module Application
 * @namespace Application
 * @class Context
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Application.Context = Class.extend( {
	/**
	 * @property sandbox
	 * @type {Application.Sandbox}
	 * @default null
	 */
	sandbox: null,
	/**
	 * @property store
	 * @type Object
	 */
	store : {
		protein : 0,
		representation : 0,
		router : null
	},
	/**
	 * Constructor
	 * 
	 * @constructor
	 * @param sandbox
	 * @param router
	 * @method init
	 */
	init: function(sandbox, router) {
		if (sandbox == null)
			console.log('ProtView.Application.Context.init: sandbox is null');
		else {
			this.sandbox = sandbox;
		}
		if (router == null) {
			console.log('ProtView.Application.Context.init: router is null');
		}
		else {
			this.store.router = router;
		}
		//ProtView.Application.Sandbox.subscribe('/application/context/set', this.set);
	},
	/**
	 * Sets global variable
	 * 
	 * Needs to be fixed to only send one message on mulitple changes
	 * 
	 * @param event
	 * @param arguments
	 * @method set
	 */
	set : function(event, arguments) {
		if (arguments.protein) {
			this.setProtein(arguments.protein);
		}
		if (arguments.representation) {
			this.setRepresentation(arguments.representation);
		}
	},
	/**
	 * Sets current protein
	 * 
	 * @param proteinId
	 * @method setProtein
	 */
	setProtein : function(protein) {
		this.store.protein = protein;
		this.sandbox.publish('/application/context', [{protein : protein}]);
	},
	/**
	 * Sets current representation
	 * 
	 * @param representationId
	 * @method setRepresentation
	 */
	setRepresentation : function(representation) {
		this.store.representation = representation;
		this.sandbox.publish('/application/context', [{representation : representation}]);
	},
	/**
	 * Gets current protein
	 * @return {int} proteinId
	 * @method getProtein
	 */
	getProtein : function() {
		return this.store.protein;
	},
	/**
	 * Gets current representation
	 * @return {int} representationId
	 * @method getRepresentation
	 */
	getRepresentation: function() {
		return this.store.representation;
	},
	/**
	 * Navigates to indicated URL
	 * @param url
	 * @method navigate
	 */
	navigate : function(url) {
		this.store.router.navigate(url, {trigger: true, replace: true});
	}
});
