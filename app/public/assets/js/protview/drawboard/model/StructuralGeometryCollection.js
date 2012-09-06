 /** 
 * Colleciton of StructuralGeometry models
 * 
 * 
 * @module DrawBoard
 * @namespace DrawBoard.Model
 * @class StructuralGeometryCollection
 * @extends Backbone.Collection
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.DrawBoard.Model.StructuralGeometryCollection = Backbone.Collection.extend({
	/**
	* Model type
	*
	* @property model
	* @type ProtView.DrawBoard.Model.StructuralGeometry
	* @default ProtView.DrawBoard.Model.StructuralGeometry
	**/
	model : ProtView.DrawBoard.Model.StructuralGeometry,
	/**
	 * Comparator of models in order to order them
	 * 
	 * @method comparator
	 * @return {int} pos
	 */
	comparator : function(model) {
		  return model.get('pos');
	},
	/**
	 * Gets the URL of related server resource able to handle requests
	 * 
	 * @method url
	 * @return {String} url
	 */
	url : function() {
		var root = Application.ROOTPATH;
		return this.id ? root + 'api/structural-geometries?representation_id=' + this.id : root + 'api/structural-geometries/';
	},
	/**
	 * Overrides default set method to define collection id
	 * 
	 * @method set
	 * @return {Object} id
	 */
	set : function(obj) {
		if (obj.id > 0)
			this.id = obj.id;
	}
});