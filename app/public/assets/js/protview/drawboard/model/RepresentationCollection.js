ProtView.DrawBoard.Model.RepresentationCollection = Backbone.Collection.extend({
	model : ProtView.DrawBoard.Model.Representation,
	comparator : function(model) {
		  return model.get('id');
	},
	url : function() {
		var root = Application.ROOTPATH;
		return this.id ? root + 'api/representations/' + this.id : root + 'api/representations';
	},
});