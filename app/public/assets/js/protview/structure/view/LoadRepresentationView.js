ProtView.Structure.View.NewProteinView = ProtView.Core.View.extend({
	events: { 
		'click #new-protein-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
        e.preventDefault();
        this.controller.save();
        $('#new-protein-dialog').jqxWindow('close');
    }
});