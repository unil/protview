ProtView.Model.OtherGeometryCollection = Backbone.Collection.extend({
	model : ProtView.Model.OtherGeometry,
	url : function() {
		return this.id ? 'api/other-geometries/' + this.id : 'api/other-geometries';
	},
});