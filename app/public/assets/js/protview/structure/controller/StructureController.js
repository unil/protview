ProtView.Structure.Controller.StructureController = Class.extend( {
	model : null,
	init: function() {
		stack = {};
		
		model = new ProtView.Structure.Model.Structure();
		view = new ProtView.Structure.View.StructureView({
			el : '#structure-form',
			templateEl : '#structure-form-template',
			bindings : {
					sequence: '#structure-sequence',
					terminusN : '#structure-terminus-n',
					terminusC: '#structure-terminus-c',
					membraneRegion: [
					    {selector: '#structure-region-1-start'}, 
					    {selector: '#structure-region-1-end'}]
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
	setModel : function(model) {
		this.model = model;
		this.helper = new ProtView.Core.BackboneHelper(this.model);
	},
	update : function(id) {
		var ret = null;
		if (this.model != null) {
			ret = this.helper.fetch(function(r){
				ret = r;
			},{id: id});
		}
		return ret;
	}
});
