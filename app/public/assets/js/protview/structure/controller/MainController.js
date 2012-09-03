ProtView.Structure.Controller.MainController = ProtView.Core.MainController.extend( {
	load : function(resource) {
		var controller = null,
		view = null,
		stack = this.stack;

		if (!stack[resource]) {
			switch(resource) {
				case 'peptide' :
					controller = new ProtView.Structure.Controller.PeptideController();
					view = new ProtView.Structure.View.PeptideView({
						el : '#peptide-form',
						templateEl : '#peptide-form-template',
						bindings : {
								sequence: '#peptide-sequence'
							}
					});
					controller.addView(view);
					break;
				case 'protein' :
					controller = new ProtView.Structure.Controller.ProteinController();
					view = new ProtView.Structure.View.ProteinView({
						el : '#protein-form',
						templateEl : '#protein-form-template',
						bindings : {
								name: '#protein-name',
								species: '#protein-species',
								note: '#protein-note'
							}
					});
					controller.addView(view);
					break;	
				case 'protein-new' :
					controller = new ProtView.Structure.Controller.ProteinController();
					view = new ProtView.Structure.View.NewProteinView({
						el : '#new-protein-form',
						templateEl : '#new-protein-form-template',
						bindings : {
								name: '#new-protein-name',
							}
					});
					controller.addView(view);
				break;
				default :
					console.log('error no resource given or not known');
					break;
			}
			
			stack[resource] = controller;
			this.stack = stack;
		}
	},
	update : function(arguments) {
		if (arguments.protein) {
			var stack = this.stack;
			console.log('stack');
			for (var el in stack) {
				console.log(el);
				//dirty fix, because database insert causes update
				//even on dialog close, messages should be more precise
				if (el != 'protein-new')
					stack[el].update(arguments.protein);
			}
		}
	},
	unload : function(resource) {
		if (stack['resource'])
			stack['resource'].unload();
	}
});