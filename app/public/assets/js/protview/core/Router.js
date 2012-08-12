ProtView.Core.Router = Backbone.Router.extend({
	  routes: {
	    'show-drawboard':  'drawboard',
	    'show-sidebar': 'sidebar',
	    'file-new-protein' : 'newProtein'
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