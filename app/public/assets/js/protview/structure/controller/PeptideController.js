ProtView.Structure.Controller.PeptideController = ProtView.Core.Controller.extend( {
	init: function() {
		stack = {};
		
		model = new ProtView.Structure.Model.Peptide();
		view = new ProtView.Structure.View.PeptideView({
			el : '#peptide-form',
			templateEl : '#peptide-form-template',
			bindings : {
					sequence: '#peptide-sequence'
				}
		});
		helper = new ProtView.Core.BackboneHelper(model);
		
		stack.model = model;
		stack.view = view;
		stack.helper = helper;
		
		this.helper = helper;
		this.model = model;
		
		view.setController(this);
		view.setModel(model);
		
		this.view = view;
		this.stack = stack;
	}
});
