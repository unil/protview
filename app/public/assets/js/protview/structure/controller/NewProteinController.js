ProtView.Structure.Controller.NewProteinController = ProtView.Core.Controller.extend( {
	init: function(args) {
		stack = {};
		
		model = new ProtView.Structure.Model.Protein();
		view = new ProtView.Structure.View.NewProteinView({
			el : '#new-protein-form',
			templateEl : '#new-protein-form-template',
			bindings : {
					name: '#new-protein-name',
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
		view.render();
		
		this.view = view;
		this.stack = stack;
	}
});
