ProtView.Application.Router = Backbone.Router.extend({
	  routes: {
		  "view/:proteinId": "view",
		  "view/:proteinId/:representationId": "view"
	  },
	  view: function(proteinId, representationId) {
		  ProtView.Application.Sandbox.start('sidebar', '#sidebar');
	  }
});