ProtView.Structure.Controller.NewProteinController = Class.extend( {
	model : null,
	view: null,
	stack : {},
	init: function() {
		stack = {};
		
		model = new ProtView.Structure.Model.Protein();
		view = new ProtView.Structure.View.NewProteinView({
			el : '#new-protein-form',
			templateEl : '#new-rotein-form-template',
			bindings : {
					name: '#protein-name',
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
	},
	getView: function() {
		return this.view;
	},
	getModel : function() {
		return this.model;
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
		this.model.save(null,{
			error: function(err){
				console.log(err);
			}, 
			success: function(succ) {
				console.log('model');
				console.log(this.model);
				console.log('succ');
				console.log(succ);
			}
			});
	}
});
