ProtView.Model.Region = Backbone.RelationalModel.extend({
	relations: [
	    {
        type: Backbone.HasMany,
        key: 'geometries',
        relatedModel: 'ProtView.Model.Geometry',
        collectionType: 'ProtView.Model.GeometryCollection',
        reverseRelation: {
            key: 'livesIn',
            includeInJSON: 'id'
        	}
        },
        {
            type: Backbone.HasMany,
            key: 'sequences',
            relatedModel: 'ProtView.Model.Sequence',
            collectionType: 'ProtView.Model.SequenceCollection',
            reverseRelation: {
                key: 'livesIn',
                includeInJSON: 'id'
            }
        }
        ],
	defaults : {
		id: null,
		label: null,
		type: null,
		start: null,
		end : null,
	},
	initialize : function Region() {
	},
	addSequence : function(sequence) {
		this.get('sequences').add(sequence);
		this.trigger('sequencesChanged');
	},
	addGeometry: function(geometry) {
		this.get('geometries').add(geometry);
		this.trigger('geometriesChanged');
	},
	url : function() {
		return this.id ? 'api/region/' + this.id : 'api/region';
	},
});