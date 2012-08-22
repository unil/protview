ProtView.Application.Router = Backbone.Router.extend({
	  routes: {
		  "view/:protein": "view",
		  "view/:protein/:representation": "view"
	  },
	  view: function(protein, representation) {
		  Application.CONTEXT.set(null, {protein: protein, representation: representation});
	  }
});