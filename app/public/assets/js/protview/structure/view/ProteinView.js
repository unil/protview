ProtView.Structure.View.ProteinView = Backbone.View.extend({
	el : '#protein-form',
	initialize : function(args) {
		this.template = _.template($('#protein-form-template').html());
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
		var renderedContent = this.template(this.model.get(1).toJSON());
        $(this.el).html(renderedContent);
		return this;
	},
});