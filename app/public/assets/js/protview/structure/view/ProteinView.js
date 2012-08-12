ProtView.Structure.View.ProteinView = ProtView.Core.View.extend({
	events: { 
		'click #protein-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
        e.preventDefault();
        console.log('model: ' + this.model.isValid());

        this.controller.save();
    }
});