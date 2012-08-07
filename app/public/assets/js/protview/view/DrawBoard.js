ProtView.View.DrawBoard = Backbone.View.extend({
	el : '#drawBoard',
	initialize : function(args) {
		console.log('init');		
	},
	events: { 
	},
	setController: function(controller) {
		this.controller = controller;
	},
	update : function(object, arguments) {
		this.output = 'update ' + arguments;
		this.render();
	},
	render : function() {
		this.$el.html(this.output);
		return this;
	},
});