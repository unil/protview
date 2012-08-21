ProtView.Application.Router = Backbone.Router.extend({
	  routes: {
		  "view/:proteinId": "view",
		  "view/:proteinId/:representationId": "view"
	  },
	  view: function(proteinId, representationId) {
		  Application.PROTEIN = proteinId;
		  Application.REPRESENTATION = representationId;
		  ProtView.Application.Sandbox.start('sidebar', '#sidebar');
		  ProtView.Application.Sandbox.start('drawboard', '#drawingboard');
	  }
});