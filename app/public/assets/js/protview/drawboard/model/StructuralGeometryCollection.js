ProtView.DrawBoard.Model.StructuralGeometryCollection = Backbone.Collection.extend({
	model : ProtView.DrawBoard.Model.StructuralGeometry,
	comparator : function(model) {
		  return model.get('pos');
	},
	url : function() {
		var root = Application.ROOTPATH;
		return this.id ? root + 'api/representations/' + this.id : root + 'api/representations';
	},
});