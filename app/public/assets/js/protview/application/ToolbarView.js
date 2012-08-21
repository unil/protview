ProtView.Application.ToolbarView = Backbone.View.extend({
	el : '#toolbar',
	events : {
		'click #export-png' : 'exportPNG'
	},
	exportPNG : function() {
		var svg_data = $('#svg-representation').contents();
		var svgContent = '';
		svg_data.each(function(key, val) {
			svgContent += $("<div/>").html($(val).clone()[0]).html();
		});

		/*
		 * var svg = $('#drawBoard').svg('get'); var svgContent = svg.toSVG();
		 */

		var url = Application.ROOTPATH + 'raw/drawingboard/do/export';
		$.ajax({
			type : 'post',
			url : url,
			dataType : 'html',
			data : {
				svg : svgContent,
				css : 'protein.css'
			},
			success : function(msg) {
				// document.write(msg);
			}
		});
	}
});