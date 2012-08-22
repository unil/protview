ProtView.Application.Context = Class.extend( {
	sandbox: null,
	store : {
		protein : 0,
		representation : 0,
		router : null
	},
	init: function(sandbox, router) {
		if (sandbox == null)
			console.log('ProtView.Application.Context.init: sandbox is null');
		else {
			this.sandbox = sandbox;
		}
		if (router == null) {
			console.log('ProtView.Application.Context.init: router is null');
		}
		else {
			this.store.router = router;
		}
		//ProtView.Application.Sandbox.subscribe('/application/context/set', this.set);
	},
	//fixme: send only one message if two updates
	set : function(event, arguments) {
		console.log('context update');
		console.log(arguments);
		if (arguments.protein) {
			this.setProtein(arguments.protein);
		}
		if (arguments.representation) {
			this.setRepresentation(arguments.representation);
		}
	},
	setProtein : function(protein) {
		this.store.protein = protein;
		this.sandbox.publish('/application/context', [{protein : protein}]);
	},
	setRepresentation : function(representation) {
		this.store.representation = representation;
		this.sandbox.publish('/application/context', [{representation : representation}]);
	},
	getProtein : function() {
		return this.store.protein;
	},
	getRepresentation: function() {
		return this.store.representation;
	},
	navigate : function(url) {
		this.store.router.navigate(url, {trigger: true, replace: true});
	}
});
