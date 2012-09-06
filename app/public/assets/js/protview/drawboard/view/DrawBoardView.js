/**
 * 
 * Handles and shows drawboard
 * 
 * 
 * @module DrawBoard
 * @namespace DrawBoard.View
 * @class DrawBoardView
 * @extends Core.View
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.DrawBoard.View.DrawBoardView = ProtView.Core.View.extend({
	/**
	* Initalizes svg element and settings
	* @method initialize
	* @constructor
	**/
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
	/**
	 * Callback function used to update elements position
	 * 
	 * @param {Object} DOMElement
	 * @param {int} x-coordinate
	 * @param {int} y-coordinate
	 * @param {Object) context
	 * @method updateCoord
	 */
	updateCoord : function(element, x, y, context) {
		var el = $(element);
		var elId = el.attr('id');

		context.controller.updateElement(elId, {x : x, y : y});	
	},
	/**
	 * Sets the model
	 * 
	 * @param {DrawBoard.Model.Representation} model
	 * @method setModel
	 */
	setModel : function(model) {
		model.on('change', this.render, this);
		model.on('reset', this.render, this);	
		this.model = model;
	},
	/**
	 * Resizes drawboard in function of the screen dimension
	 * 
	 * @method resize
	 */
	resize: function() {
		var h = $(window).height();
	    var w = $(window).width();
	    $("#svg-representation").attr('height', (h-120) + 'px').attr('width', (w-200) + 'px');
	},
	/**
	 * Renders view
	 *
	 * @method render
	 * @chainable
	 */
	render : function() {
		var model = this.model,
		self = this;
	
		this.drawing.paint(model.get('structuralGeometries'), model.get('params'), this.updateCoord, self);


		$(window).resize(this.resize).resize();
		return this;
	},
	/**
	 * Clears the drawboard
	 * 
	 * @method clear
	 */
	clear : function() {
		this.drawing.clearAll();
	}
});