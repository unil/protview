ProtView.View.DrawBoard = Backbone.View.extend({
	el : '#drawBoard',
	initialize : function(args) {
		var setSVG = this.setSVG;
		var self = this;
		this.$el.svg({
			onLoad : function(svg) {
				//hack to overcome the this problem in callback as
				//context cannot be specified for onLoad
				setSVG(svg, self);
			},
			settings: {
				width : "100%",
				height : "800px", 
				xmlns : "http://www.w3.org/2000/svg",
				style : "display:inline; float: left; z-index: 1;"
			}
		});
	},
	setSVG : function(svg, obj) {
		obj.drawing = new ProtView.Utils.Drawing(svg);
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
		this.drawing.draw(this.model);
		var json = this.model.toJSON();
		var jsonString = JSON.stringify(json);
		this.$el.html(jsonString);
		return this;
	},
});