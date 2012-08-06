ProtView.Model.StructuralGeometryCollection = Backbone.Collection.extend({
	model : ProtView.Model.StructuralGeometry,
	comparator : function(model) {
		  return model.get('pos');
	},
	url : function() {
		return this.id ? 'api/structural-geometries/' + this.id : 'api/structural-geometries';
	},
});