ProtView.DrawBoard.Controller.DrawBoardController = ProtView.Core.Controller.extend( {
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
	}
});