ProtView.Structure.Controller.ProteinController = ProtView.Core.Controller.extend( {
	init: function() {
		var model = new ProtView.Structure.Model.Protein();
		this._super(model);
	}
});
