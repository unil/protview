ProtView.Core.Controller = Class.extend( {
	model : null,
	view : null,
	views: {},
	stack : {},
	previous : {},
	init: function(args) {
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
			console.log('fetch');
			
			console.log('id: ' + id);
			console.log('previous: ' + this.previous.id);
			if (id != null && id > 0 && this.previous.id != id) {
				model.set({id : id}, {silent: true});
				this.model = model;
				console.log(model);
				
				ret = this.helper.fetch(function(r){
					ret = r;
				});
			}
			else {
				console.log('Controller:fetch: no id for model');
			}
		}
		this.previous.id = id;
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
	},
	update : function(id) {
		if (this.model != null) {
			this.fetch(id);
		}
	}
});
