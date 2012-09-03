ProtView.Structure.View.NewProteinView = ProtView.Core.View.extend({
	events: { 
		'click #new-protein-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
        e.preventDefault();
        this.controller.save();
        this.model.on('change', this.update, this);
    },
	update : function() {
		proteinId = this.model.get('xinsertid');
		
		if (proteinId != null && proteinId != 0) {
			Application.CONTEXT.navigate("view/" + proteinId);

			$('#new-protein-dialog').jqxWindow('close');
		}
	}
});