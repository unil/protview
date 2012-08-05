ProtView.Model.Sequence = Backbone.Model.extend({
	defaults : {
		id: null,
		aa: null,
		mod: null,
		link: null,
		geomRef: {
			geometrie_id: null,
			pos: null
		}
	},
	initialize : function Region() {
	},
	url : function() {
		return this.id ? 'api/sequence/' + this.id : 'api/sequence';
	},
});