ProtView.Structure.Controller.PeptideController = ProtView.Core.Controller.extend( {
	init: function() {		
		var model = new ProtView.Structure.Model.Peptide();
		this._super(model);
	}
});
