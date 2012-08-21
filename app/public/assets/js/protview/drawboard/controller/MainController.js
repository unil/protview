ProtView.DrawBoard.Controller.MainController = ProtView.Core.MainController.extend( {
	load : function(resource) {
		var controller = null,
		stack = this.stack,
		currentResource = this.currentResource;

		if (resource != currentResource) {
			//unload current resource to free memory space
			this.unload(currentResource);
			switch(resource) {
				case 'drawboard' :
					controller = new ProtView.Structure.Controller.DrawBoardController();
					currentResource = 'drawboard';
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