ProtView.Application.Context = Class.extend( {
	sandbox: null,
	store : {
		protein : 0,
		representation : 0
	},
	init: function(sandbox) {
		if (sandbox == null)
			console.log('ProtView.Application.Context.init: sandbox is null');
		else {
			this.sandbox = sandbox;
		}
		//ProtView.Application.Sandbox.subscribe('/application/context/set', this.set);
	},
	//fixme: send only one message if two updates
	set : function(event, arguments) {
		if (arguments.protein) {
			this.setProtein(arguments.protein);
		}
		if (arguments.representation) {
			this.setRepresentation(arguments.representation);
		}
	},
	setProtein : function(protein) {
		this.store.protein = protein;
		this.sandbox.publish('/application/context/', [{protein : protein}]);
	},
	setRepresentation : function(representation) {
		this.store.representation = representation;
		this.sandbox.publish('/application/context/', [{representation : representation}]);
	},
	getProtein : function() {
		return this.protein;
	},
	getRepresentation: function() {
		return this.representation;
	}
});
