ProtView.Structure.Controller.MainController = ProtView.Core.MainController.extend( {
	load : function(resource) {
		var controller = null,
		stack = this.stack,
		currentResource = this.currentResource;

		if (resource != currentResource) {
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
			
			stack.controller = controller;
			this.controller = controller;
			this.stack = stack;
			this.currentResource = resource;
		}
	}
});