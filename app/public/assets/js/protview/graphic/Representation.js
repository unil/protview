ProtView.Model.Representation = Backbone.RelationalModel.extend({
	relations: [{
        type: Backbone.HasMany,
        key: 'regions',
        relatedModel: 'ProtView.Model.Region',
        collectionType: 'ProtView.Model.RegionCollection',
        reverseRelation: {
            key: 'livesIn',
            includeInJSON: 'id'
        }
    }],
	defaults : {
	},
	initialize : function Representation() {
	},
	url : function() {
		return this.id ? 'api/representations/' + this.id : 'api/representation';
	},
});