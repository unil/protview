ProtView.Model.ProteinCollection = Backbone.Collection.extend({
	model : ProtView.Model.Protein,
	url : function() {
		var root = Application.ROOTPATH;
		return this.id ? root + 'api/proteins/' + this.id : root + 'api/proteins';
	}
});