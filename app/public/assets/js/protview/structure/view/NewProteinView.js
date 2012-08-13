ProtView.Structure.View.ProteinView = ProtView.Core.View.extend({
	events: { 
		'click #newprotein-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
        e.preventDefault();
        this.controller.save();
    }
});