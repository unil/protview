/**
 * 
 * Protein controller
 * 
 * 
 * @module Structure
 * @namespace Structure.Controller
 * @class ProteinController
 * @extends Core.Controller
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Structure.Controller.ProteinController = ProtView.Core.Controller.extend( {
	/**
	 * Initalizes model and calls parent constructor
	 * 
	 * @method initialize
	 * @constructor
	**/
	init: function() {
		var model = new ProtView.Structure.Model.Protein();
		this._super(model);
	}
});
