/**
 * 
 * DrawBoard controllers handels all drawboard related views and models
 * 
 * 
 * @module DrawBoard
 * @namespace DrawBoard.Controller
 * @class DrawBoardController
 * @extends Core.Controller
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.DrawBoard.Controller.DrawBoardController = ProtView.Core.Controller.extend( {
	/**
	* Contains all resources needs to be updated
	* 
	* @example
	* {
	* 	elementID {x : int, y: int}
	* }
	* 
	* elementID is the original DOM Id (for example : aa-42-1604)
	* 
	* @property updatedElements
	* @type Object
	* @default {}
	**/
	updatedElements : {},
	/**
	 * Initalizes model and calls parent constructor
	 * 
	 * @method initialize
	 * @param {Object} args
	 * @constructor
	**/
	init: function(args) {
		var model = new ProtView.DrawBoard.Model.Representation();
		this._super(model);
	},
	/**
	 * Clears current DrawBoard
	 * 
	 * @method clear
	**/
	clear : function() {
		var views = this.views;

		for (var name in views) {
			var view = views[name];
			view.clear();
		}
	},
	/**
	 * Shows a new representation
	 * 
	 * @method show
	 * @param {int} representationId
	**/
	show : function(representation) {
		console.log('show');
		console.log(this);
		this.clear();
		this.fetch(representation);
	},
	/**
	 * Stores updated elements for later saving
	 * 
	 * Save needs to be called manually as it would be to slow to send a request
	 * back to the server on each position update of a drawboard's element
	 * 
	 * @method show
	 * @param {int} DOMId
	 * @param {Object} newSettings
	**/
	updateElement : function(id, settings) {
		//store in local updatedElements
		//saving directly is to havy
		this.updatedElements[id] = settings;
	},
	/**
	 * Saves updated store to the server
	 * 
	 * @method save
	**/
	save : function() {
		var updatedElements = this.updatedElements;
		var model = this.model;
		var structuralGeometries = model.get('structuralGeometries');
		
		_.each(updatedElements, function(v, k){ 
			//aa-69-2674v
			var t = k.split("-");
			var geoId = t[1];
			var coordId = t[2];
			
			var structuralGeometry = structuralGeometries.get(geoId);
			
			var coordinates = structuralGeometry.get('coordinates');
			
			_.each(coordinates, function(vc, kc) {
				if (vc.id == coordId) {
					_.each(v, function(ic, ik) {
						vc[ik] = ic;
					});
				}
			});
		});
		
		this.model = model;
		this._super();
	},
	/**
	 * Updates the model from server
	 * @param id
	 * @method update
	 */
	update : function(id) {
		this.show(id);
	}
});