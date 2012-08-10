ProtView.Structure.Model.StructureCollection = Backbone.Collection.extend({
	model : ProtView.Structure.Model.Protein,
	url : function() {
		var root = Application.ROOTPATH;
		return this.id ? root + 'api/structures/' + this.id : root + 'api/structures';
	}
});