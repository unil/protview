ProtView.DrawBoard.Model.StructuralGeometryCollection = Backbone.Collection.extend({
	model : ProtView.DrawBoard.Model.StructuralGeometry,
	comparator : function(model) {
		  return model.get('pos');
	},
	url : function() {
		var root = Application.ROOTPATH;
		return this.id ? root + 'api/structural-geometries?representation_id=' + this.id : root + 'api/structural-geometries/';
	},
	set : function(obj) {
		if (obj.id > 0)
			this.id = obj.id;
	}
});