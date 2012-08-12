ProtView.Core.Router = Backbone.Router.extend({
	  routes: {
	    'test':  'test'    
	  },
	  test : function() {
		  console.log('test clicked');
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
					ProtView.DrawBoard.load();
				}
		  });
	  }
});