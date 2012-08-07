ProtView.View.DrawBoard = Backbone.View.extend({
	el : '#drawBoard',
	initialize : function(args) {
		this.$el.svg({
			onLoad : this.setSVG,
			settings: {
				width : "100%",
				height : "800px", 
				xmlns : "http://www.w3.org/2000/svg",
				style : "display:inline; float: left; z-index: 1;"
			}
		});
	},
	setSVG : function(svg) {
		this.drawing = new ProtView.Utils.Drawing(svg);
		console.log('this');
		console.log(this);
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
		console.log(this.drawing);
		//this.drawing.draw(this.model);
		var json = this.model.toJSON();
		var jsonString = JSON.stringify(json);
		this.$el.html(jsonString);
		return this;
	},
});