/**
 * 
 * Handles and shows new protein dialog
 * 
 * 
 * @module Structure
 * @namespace Structure.View
 * @class NewProteinView
 * @extends Core.View
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Structure.View.NewProteinView = ProtView.Core.View.extend({
	events: { 
		/**
		 * @event click #new-protein-form-submit
		 */
		'click #new-protein-form-submit' : 'submitForm'
	},
	/**
	 * Handles form submit
	 * 
	 * @method submitForm
	 * @param {Object} event
	 */
	submitForm : function(e) {
        e.preventDefault();
        this.controller.save();
        this.model.on('change', this.update, this);
    },
    /**
	 * This is method is called on each model update
	 * 
	 * If model is validate and its content saved to the server, the dialog closes
	 * 
	 * @method update
	 */
	update : function() {
		proteinId = this.model.get('xinsertid');
		
		if (proteinId != null && proteinId != 0) {
			Application.CONTEXT.navigate("view/" + proteinId);

			$('#new-protein-dialog').jqxWindow('close');
		}
	}
});