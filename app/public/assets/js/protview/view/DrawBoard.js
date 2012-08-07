ProtView.View.DrawBoard = Backbone.View.extend({
	el : '#drawBoard',
	initialize : function(args) {
		this.self = this;
	},
	events: { 
	},
	setController : function(controller) {
		this.controller = controller;
	},
	setModel : function(model) {
		this.model = model;
		this.model.on('change', this.render, this);	
		this.model.on('reset', this.render, this);	

	},
	render : function() {
		var json = this.model.toJSON();
		var jsonString = JSON.stringify(json);
		this.$el.html(jsonString);
		return this;
	},
});