ProtView.Core.MainController = Class.extend( {
	controller : null,
	stack : {},
	currentResource : null,
	init: function() {
	},
	getController : function() {
		return this.controller;
	},
	load : function(resource) {
	},
	unload: function (resource) {
	},
	unloadAll : function() {
		var stack = this.stack;
		for (var el in stack) {
			   /*var obj = stack[el];
			   obj.unload();*/
			   stack[el] = null;
			   delete stack[el];
		}
	}
});