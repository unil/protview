ProtView.Structure.Controller.MainController = Class.extend( {
	model: null,
	controller : null,
	view : null,
	stack : {},
	currentResource : null,
	init: function() {
	},
	getModel : function() {
		return this.model;
	},
	getController : function() {
		return this.controller;
	},
	getView : function() {
		return this.view;
	},
	load : function(resource) {
		var model = null,
		controller = null,
		view = null,
		stack = this.stack,
		currentResource = this.currentResource;

		if (resource != currentResource) {
			//unload current resource to free memory space
			this.unloadResource(currentResource);
			switch(resource) {
				case 'structure' :
					console.log('structure');
					break;
				case 'protein' :
					model = new ProtView.Structure.Model.ProteinCollection();
					view = new ProtView.Structure.View.ProteinView();
					controller = new ProtView.Structure.Controller.ProteinController();
					controller.setModel(model);
					view.setModel(model);
					view.setController(controller);
					controller.update(1);
					currentResource = 'protein';
					break;	
				default :
					console.log('error no resource give or not known');
					break;
			}
			stack.model = model;
			stack.view = view;
			stack.controller = controller;
			this.model = model;
			this.view = view;
			this.controller = controller;
			this.stack = stack;
			this.currentResource = resource;
		}
	},
	undload: function (resource) {
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