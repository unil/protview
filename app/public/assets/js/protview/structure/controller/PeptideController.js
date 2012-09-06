/**
 * 
 * Peptide controller
 * 
 * 
 * @module Structure
 * @namespace Structure.Controller
 * @class PeptideController
 * @extends Core.Controller
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Structure.Controller.PeptideController = ProtView.Core.Controller.extend( {
	/**
	 * Initalizes model and calls parent constructor
	 * 
	 * @method initialize
	 * @constructor
	**/
	init: function() {		
		var model = new ProtView.Structure.Model.Peptide();
		this._super(model);
	},
	/**
	 * Overrides fetch method in order to handle protein specifiec model attributes
	 * 
	 * @method fetch
	 * @param {int} protein_id
	 * @return {Object} server response
	**/
	fetch : function(protein_id) {
		var ret = null,
		model = this.model;
		if (model != null) {
			if (protein_id != null && protein_id > 0 && model.get('protein_id') != protein_id) {
				model.set({protein_id : protein_id}, {silent: true});
				this.model = model;
				ret = this.helper.fetch(function(r){
					ret = r;
				});
			}
			else {
				console.log('ProtView.Structure.Controller:fetch: no id for model');
			}
		}
		
		return ret;
	},
});
