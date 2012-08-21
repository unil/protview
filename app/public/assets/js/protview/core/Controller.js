ProtView.Core.Controller = Class.extend( {
	model : null,
	view: null,
	stack : {},
	init: function(args) {
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
