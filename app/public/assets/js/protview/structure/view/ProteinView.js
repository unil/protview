/**
 * 
 * Handles and shows protein form
 * 
 * @class ProteinView
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 * @module Structure
 * @namespace Structure.View
 * @extends Core.View
 */
ProtView.Structure.View.ProteinView = ProtView.Core.View.extend({

	events: { 
		/**
		 * @event click #protein-form-submit
		 */
		'click #protein-form-submit' : 'submitForm'
	},
	/**
	 * @method submitForm
	 * @param {Object} event
	 */
	submitForm : function(e) {
        e.preventDefault();
        console.log('model: ' + this.model.isValid());

        this.controller.save();
    }
});