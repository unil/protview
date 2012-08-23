ProtView.Structure.Controller.MainController = ProtView.Core.MainController.extend( {
	load : function(resource) {
		var controller = null,
		stack = this.stack;

		if (!stack[resource]) {
			switch(resource) {
				case 'peptide' :
					controller = new ProtView.Structure.Controller.PeptideController();
					currentResource = 'structure';
					break;
				case 'protein' :
					controller = new ProtView.Structure.Controller.ProteinController();
					currentResource = 'protein';
					break;	
				case 'protein-new' :
					controller = new ProtView.Structure.Controller.NewProteinController();
					currentResource = 'protein-new';
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
			for (var el in stack) {
				stack[el].update(arguments.protein);
			}
		}
	}
});