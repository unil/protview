ProtView.Structure.Controller.MainController = Class.extend( {
	controller : null,
	stack : {},
	currentResource : null,
	init: function() {
	},
	getController : function() {
		return this.controller;
	},
	load : function(resource) {
		var controller = null,
		stack = this.stack,
		currentResource = this.currentResource;

		if (resource != currentResource) {
			//unload current resource to free memory space
			this.unload(currentResource);
			switch(resource) {
				case 'structure' :
					console.log('structure');
					break;
				case 'protein' :
					controller = new ProtView.Structure.Controller.ProteinController();
					currentResource = 'protein';
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
	},
	unload: function (resource) {
	},
	unloadAll : function() {
		var stack = this.stack;
		for (var el in stack) {
			   /*var obj = stack[el];
			   obj.unload();*/
			   stack[el] = null;
			   delete stack[el];
		}
	}
});