ProtView.Core.Router = Backbone.Router.extend({
	  routes: {
	    'show-drawboard':  'drawboard',
	    'show-sidebar': 'sidebar'
	  },
	  drawboard: function() {
		  var url = Application.ROOTPATH + 'raw/drawingboard/do/';
			var method = 'get';
			$.ajax({
				type : method,
				url : url,
				dataType: 'html',
				data : {
					
				},
				success : function(msg) {
					$('#drawingBoard').html(msg);
					ProtView.DrawBoard.Module.start();
				}
			});
	  },
	  sidebar : function () {
		  var url = Application.ROOTPATH + 'raw/sidebar/do/';
			var method = 'get';
			$.ajax({
				type : method,
				url : url,
				dataType: 'html',
				data : {
					
				},
				success : function(msg) {
					$('#sidebar').html(msg);
				}
			});
	  }
});