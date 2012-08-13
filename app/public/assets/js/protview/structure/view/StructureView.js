ProtView.Structure.View.ProteinView = ProtView.Core.View.extend({
	events: { 
		'click #structure-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
        e.preventDefault();
        console.log('model: ' + this.model.isValid());

        this.controller.save();
    }
});