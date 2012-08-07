ProtView.Controller.DrawBoardController = Class.extend( {
	models : {},
	view : null,
	init: function(view) {
		this.view = view;
		var sgc = new ProtView.Model.StructuralGeometryCollection();
		this.models.sgc = sgc;
		this.mediator = new ProtView.Utils.BackboneMediator(this.models.sgc);
		sgc.on('add', this.update('sgc'), this);
	},
	setView : function(view) {
		this.view = view;
	},
	update : function(obj) {
		if (obj == 'sgc') {
			var retFonct = this.getAA;
			this.mediator.fetch(retFonct);
		}
		//this.notify('model changed ' + obj);
	},
	notify : function(arguments) {
		this.view.update(this, arguments);
	},
	getAA : function(collection) {
	    for (var i = 0, len = collection.length; i < len; i++) {
	        var geometry = collection.at(i);

	        var coordinates = geometry.get('coordinates');
			var labels = geometry.get('labels');
			

			for (var j = 0, lenC = coordinates.length; j < lenC; j++) {
				var coordinate = coordinates[j];
				var label = labels[j].split("-");
				var x = coordinate.x;
				var y = coordinate.y;
				
				var type = label[0];
				var pos = label[1];
					
				console.log('x: ' + x);
				console.log('y: ' + y);
				console.log('type: ' + type);
				console.log('pos: ' + pos);
			}
		}
	}
});
