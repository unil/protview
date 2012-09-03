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
				preserveAspectRatio : "xMinYMin meet",
				style : "display:inline; float: left; z-index: 1;",
				id : 'svg-representation'
			}
		});
	},
	events: { 
	},
	updateCoord : function(element, x, y, context) {
		var el = $(element);
		var elId = el.attr('id');

		context.controller.updateElement(elId, {x : x, y : y});	
	},
	setModel : function(model) {
		model.on('change', this.render, this);
		model.on('reset', this.render, this);	
		this.model = model;
	},
	resize: function() {
		var h = $(window).height();
	    var w = $(window).width();
	    $("#svg-representation").attr('height', (h-120) + 'px').attr('width', (w-200) + 'px');
	},
	render : function() {
		var model = this.model,
		self = this;
		
		console.log('model');
		console.log(model);
		this.drawing.paint(model.get('structuralGeometries'), model.get('params'), this.updateCoord, self);


		$(window).resize(this.resize).resize();
		return this;
	},
	clear : function() {
		this.drawing.clearAll();
	}
});