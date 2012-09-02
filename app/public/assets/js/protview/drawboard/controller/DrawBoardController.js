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
		
		_.each(updatedElements, function(v, k){ 
			console.log('k: ' + k + 'v: ' + v);
		});
		//console.log(context.model.get('structuralGeometries').get(67).get('coordinates'));*/
	}
});