ProtView.View.DrawBoard = Backbone.View.extend({
	el : '#drawBoard',
	initialize : function(args) {
		//this.collection = new ProtView.Model.StructuralGeometryCollection();
		
	},

	events: { 
	},
	
	/*fetchStructuralGeometries : function () {
		collection.fetch({success: function(){

		}});
	},*/

	render : function() {
		console.log('render');
		return this;
	},
});