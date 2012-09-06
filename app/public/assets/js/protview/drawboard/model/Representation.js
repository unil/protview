/**
 * 
 * Representation model
 * 
 * 
 * @module DrawBoard
 * @namespace DrawBoard.Model
 * @class Representation
 * @extends Backbone.RelationalModel
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.DrawBoard.Model.Representation = Backbone.RelationalModel.extend({
	/**
	* Contains all model relations
	* 
	* @example
	* see https://github.com/PaulUithol/Backbone-relational
	* 
	* @property relations
	* @type Array
	* @default null
	**/
	relations: [{
        type: Backbone.HasMany,
        key: 'structuralGeometries',
        relatedModel: 'ProtView.DrawBoard.Model.StructuralGeometry',
        collectionType: 'ProtView.DrawBoard.Model.StructuralGeometryCollection',
        reverseRelation: {
            key: 'representation',
            // includeInJSON: 'id'
        }
    }],
	defaults : {
		/**
		* Representation id
		*
		* @property id
		* @type int
		* @default null
		**/
		id: null,
		/**
		* Representation title
		*
		* @property title
		* @type String
		* @default null
		**/
		title: null,
		/**
		* Representation description
		*
		* @property description
		* @type String
		* @default null
		**/
		description: null,
		/**
		* Params
		* 
		* @example
		* {
		*  dimension:	{minX: float, maxX: float, minY: float, maxY: float},
		*  membrane:	{minY: float, maxY : float}
		* }
		*
		* @property params
		* @type Object
		* @default {}
		**/
		params : {},
		/**
		* Contributors
		* 
		* @example
		* [
		* 	{lastName: String, firstName: String, pos: int}
		* ]
		* 
		* pos indicates the importance of contribution
		*
		* @property contributors
		* @type Array
		* @default {}
		**/
		contributors : {}
	},
	/**
	 * Gets the URL of related server resource able to handle requests
	 * 
	 * @method url
	 * @return {String} url
	 */
	url : function() {
		var root = Application.ROOTPATH;
		return this.id ? root + 'api/representations/' + this.id + '?details=all' : root + 'api/representations/';
	},
});