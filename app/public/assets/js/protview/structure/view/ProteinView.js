/**
 * 
 * Handles and shows protein form
 * 
 * 
 * @module Structure
 * @namespace Structure.View
 * @class ProteinView
 * @extends Core.View
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Structure.View.ProteinView = ProtView.Core.View.extend({

	events: { 
		/**
		 * @event click #protein-form-submit
		 */
		'click #protein-form-submit' : 'submitForm'
	},
	/**
	 * Handles form submit
	 * 
	 * @method submitForm
	 * @param {Object} event
	 */
	submitForm : function(e) {
        e.preventDefault();
        console.log('model: ' + this.model.isValid());

        this.controller.save();
    }
});