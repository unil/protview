ProtView.Model.Region = Backbone.Model.extend({
	defaults : {
		id: null,
		label: null,
		type: null,
		start: null,
		end : null,
		sequence: new ProtView.Model.Sequences(),
		geometry: new ProtView.Model.Geometries()
	},
	initialize : function Region() {
	},
	addSequence : function(sequence) {
		this.get('sequence').add(sequence);
		this.trigger('sequenceChanged');
	},
	addGeometry: function(geometry) {
		this.get('geometry').add(geometry);
		this.trigger('geometryChanged');
	},
	url : function() {
		return this.id ? 'api/region/' + this.id : 'api/region';
	},
});