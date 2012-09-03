ProtView.Core.Controller = Class.extend( {
	model : null,
	view : null,
	views: {},
	stack : {},
	previous : {},
	init: function(model) {
		var stack = {};
		var helper = new ProtView.Core.BackboneHelper(model);
		
		stack.model = model;
		stack.helper = helper;
		
		this.helper = helper;
		this.model = model;
		
		this.stack = stack;
	},
	addView: function(view) {
		var viewEL = view.el;
		view.setController(this);
		view.setModel(this.model);
		view.render();
		this.views[viewEL] = view;
	},
	getViews: function() {
		return this.views;
	},
	getModel : function() {
		return this.model;
	},
	fetch : function(id) {
		var ret = null,
		model = this.model;
		if (model != null) {
			if (id != null && id > 0 && model.get('id') != id) {
				model.set({id : id}, {silent: true});
				this.model = model;
				
				ret = this.helper.fetch(function(r){
					ret = r;
				});
			}
			else {
				console.log('Controller:fetch: no id for model');
			}
		}
		
		return ret;
	},
	unload : function() {
		var stack = view;
		for (var el in stack) {
			   var obj = stack[el];
			   obj.unload();
			   stack[el] = null;
			   delete stack[el];
		}
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
	},
	update : function(id) {
		if (this.model != null) {
			this.fetch(id);
		}
	}
});
