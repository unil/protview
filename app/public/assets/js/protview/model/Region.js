ProtView.Model.Region = Backbone.Model.extend({
	defaults : {
		id: null,
		label: '',
		type: null,
		start: null,
		end : null,
		sequence: new ProtView.Model.Sequences(),
		geometries: new ProtView.Model.Geometries()
	},
	initialize : function Region() {
	},
	url : function() {
		return this.id ? 'api/region/' + this.id : 'api/region';
	},
});