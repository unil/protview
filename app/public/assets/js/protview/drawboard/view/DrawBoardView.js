ProtView.DrawBoard.View.DrawBoardView = ProtView.Core.View.extend({
	//el : '#drawBoard',
	initialize : function(args) {
		var self = this;
		self.$el.svg({
			onLoad : function(svg) {
				//hack to overcome the 'this problem' in callback as
				//context cannot be specified for onLoad
				self.drawing = new ProtView.DrawBoard.Utils.Drawing(svg);
			},
			settings: {
				xmlns : "http://www.w3.org/2000/svg",
				width : "100%",
				height : "800px", 
				preserveAspectRatio : "xMinYMin meet",
				viewBox : "0 0 1000 800",
				style : "display:inline; float: left; z-index: 1;",
				id : 'svg-representation'
			}
		});
	},
	events: { 
	},
	setModel : function(model) {
		model.on('change', this.render, this);	
		model.on('reset', this.render, this);	
		this.model = model;
	},
	render : function() {
		var model = this.model;
		console.log('drawboard view');
		console.log(model);
		this.drawing.paint(this.model);
		/*var json = this.model.toJSON();
		var jsonString = JSON.stringify(json);
		this.$el.html(jsonString);*/
		return this;
	},
	clear : function() {
		this.drawing.clearAll();
	}
});