ProtView.Structure.Model.ProteinCollection = Backbone.Collection.extend({
	model : ProtView.Structure.Model.Protein,
	url : function() {
		var root = Application.ROOTPATH;
		return this.id ? root + 'api/proteins/' + this.id : root + 'api/proteins';
	}
});