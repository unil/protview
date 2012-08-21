ProtView.Application.Router = Backbone.Router.extend({
	  routes: {
		  "view/:proteinId": "view",
		  "view/:proteinId/:representationId": "view"
	  },
	  view: function(proteinId, representationId) {
		  console.log('proteinId: ' + proteinId + ' representationId: ' + representationId);
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