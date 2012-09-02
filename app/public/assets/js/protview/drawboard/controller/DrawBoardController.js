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
		console.log('save in controller');
		var updatedElements = this.updatedElements;
		var model = this.model;
		var structuralGeometries = model.get('structuralGeometries');
		
		_.each(updatedElements, function(v, k){ 
			//aa-69-2674v
			var t = k.split("-")
			var geoId = t[1];
			var coordId = t[2];
			
			var structuralGeometry = structuralGeometries.get(geoId);
			
			console.log('structuralGeometry');
			console.log(structuralGeometry);
		});
		//console.log(context.model.get('structuralGeometries').get(67).get('coordinates'));*/
	}
});