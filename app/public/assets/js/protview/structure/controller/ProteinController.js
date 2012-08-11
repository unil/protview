ProtView.Structure.Controller.ProteinController = Class.extend( {
	model : null,
	stack : {},
	init: function() {
		stack = {};
		
		model = new ProtView.Structure.Model.Protein();
		view = new ProtView.Structure.View.ProteinView();
		view.setModel(model);
		view.setController(this);
		helper = new ProtView.Core.BackboneHelper(model);
		
		stack.model = model;
		stack.view = view;
		stack.helper = helper;
		
		this.helper = helper;
		this.model = model;
		this.view = view;
		this.stack = stack;
	},
	fetch : function(id) {
		var ret = null,
		model = this.model;
		if (model != null) {
			if (id > 0) {
				model.set({id : id});
				this.model = model;
				ret = this.helper.fetch(function(r){
					ret = r;
				});
			}
			else {
				console.log('ProteinController:fetch: no id for model');
			}
		}
		return ret;
	},
	
	save : function() {
		this.model.save();
	}
});
