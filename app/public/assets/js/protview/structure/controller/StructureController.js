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
					    {selector: ',structure-regions', converter: this.regionConverter}]
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
    regionConverter : function(direction, value, attribName){
    	var model_regions = this.model.get('regions'),
    	view_regions = 
    	label = 'start',
    	pos = 0;
	    if (direction == 'ModelToView') {
	    	console.log('ModelToView');
	    	
	    }
	    else if (direction == 'ViewToModel') {
	    	console.log('ViewToModel');
	    	.hasClass('foo')
	    }
    	return value;
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
