ProtView.Structure.ProteinView = Backbone.View.extend({
	el : '#proteinForm',
	initialize : function(args) {
		this.template = _.template($('#proteinFormTemplate').html());
	},
	events: { 
	},
	setController : function(controller) {
		this.controller = controller;
	},
	setModel : function(model) {
		model.on('change', this.render, this);	
		model.on('reset', this.render, this);	
		this.model = model;
	},
	render : function() {
		/*var renderedContent = this.template(this.model.toJSON());
        $(this.el).html(renderedContent);*/
		
		return this;
	},
});