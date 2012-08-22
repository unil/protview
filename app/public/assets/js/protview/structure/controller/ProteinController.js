ProtView.Structure.Controller.ProteinController = ProtView.Core.Controller.extend( {
	init: function() {
		stack = {};
		
		model = new ProtView.Structure.Model.Protein();
		view = new ProtView.Structure.View.ProteinView({
			el : '#protein-form',
			templateEl : '#protein-form-template',
			bindings : {
					name: '#protein-name',
					species: '#protein-species',
					note: '#protein-note'
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
		this.view.render();
	}
});
