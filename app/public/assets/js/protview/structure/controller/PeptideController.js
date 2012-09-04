ProtView.Structure.Controller.PeptideController = ProtView.Core.Controller.extend( {
	init: function() {		
		var model = new ProtView.Structure.Model.Peptide();
		this._super(model);
	},
	fetch : function(protein_id) {
		var ret = null,
		model = this.model;
		if (model != null) {
			if (protein_id != null && protein_id > 0 && model.get('protein_id') != protein_id) {
				model.set({protein_id : protein_id}, {silent: true});
				this.model = model;
				ret = this.helper.fetch(function(r){
					ret = r;
				});
			}
			else {
				console.log('Controller:fetch: no id for model');
			}
		}
		
		return ret;
	},
});
