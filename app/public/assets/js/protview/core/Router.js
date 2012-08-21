ProtView.Core.Router = Backbone.Router.extend({
	  routes: {
	    'show-drawboard':  'drawboard',
	    'show-sidebar': 'sidebar',
	    //'file-new-protein' : 'newProtein',
	    'export' : 'exportpng'
	  },
	  drawboard: function() {
		  var url = Application.ROOTPATH + 'raw/drawingboard/do/';
		  this.load(url, '#drawingBoard');
	  },
	  sidebar : function () {
		  var url = Application.ROOTPATH + 'raw/sidebar/do/';
		  this.load(url, '#sidebar');
	  },
	  newProtein : function() {
		  var url = Application.ROOTPATH + 'raw/menubar/do/newprotein';
		  this.load(url, '#menubar-items');
	  },
	  exportpng : function() {
		  var svg_data = $('#svg-representation').contents();
		  var svgContent = '';
		  svg_data.each(function(key, val) {
			  svgContent += $("<div/>").html($(val).clone()[0]).html();
		  });
		  
		  /*var svg = $('#drawBoard').svg('get'); 
		  var svgContent = svg.toSVG();*/

		  var url = Application.ROOTPATH + 'raw/drawingboard/do/export';
		  $.ajax({
				type : 'post',
				url : url,
				dataType: 'html',
				data : {
					svg : svgContent,
					css : 'protein.css'
					},
				success : function(msg) {
					//document.write(msg);
				}
		  });
	  },
	  load : function(url, el) {
		  var method = 'get';
		  $.ajax({
				type : method,
				url : url,
				dataType: 'html',
				data : {

				},
				success : function(msg) {
					$(el).append(msg);
				}
		  });
	  }
});