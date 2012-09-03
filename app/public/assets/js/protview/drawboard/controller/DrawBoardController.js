ProtView.DrawBoard.Controller.DrawBoardController = ProtView.Core.Controller.extend( {
	updatedElements : {},
	init: function(args) {
		var model = new ProtView.DrawBoard.Model.Representation();
		this._super(model);
	},
	clear : function() {
		console.log('ProtView.DrawBoard.Controller.DrawBoardController.clear does not work for now');
		//this.view.clear();
	},
	show : function(representation) {
		this.fetch(representation);
	},
	updateElement : function(id, settings) {
		//store in local updatedElements
		//saving directly is to havy
		this.updatedElements[id] = settings;
	},
	save : function() {
		var updatedElements = this.updatedElements;
		var model = this.model;
		var structuralGeometries = model.get('structuralGeometries');
		
		_.each(updatedElements, function(v, k){ 
			//aa-69-2674v
			var t = k.split("-");
			var geoId = t[1];
			var coordId = t[2];
			
			var structuralGeometry = structuralGeometries.get(geoId);
			
			var coordinates = structuralGeometry.get('coordinates');
			
			_.each(coordinates, function(vc, kc) {
				if (vc.id == coordId) {
					_.each(v, function(ic, ik) {
						vc[ik] = ic;
					});
				}
			});
		});
		
		this.model = model;
		this._super();
	}
});