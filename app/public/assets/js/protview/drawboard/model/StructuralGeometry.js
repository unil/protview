/**
 * 
 * StructuralGeometry model
 * 
 * 
 * @module DrawBoard
 * @namespace DrawBoard.Model
 * @class StructuralGeometry
 * @extends Backbone.RelationalModel
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.DrawBoard.Model.StructuralGeometry = Backbone.RelationalModel.extend({
	defaults : {
		/**
		* StructuralGeometry id
		*
		* @property id
		* @type int
		* @default null
		**/
		id: null,
		/**
		* Representation id (foreign key)
		*
		* @property representation_id
		* @type int
		* @default null
		**/
		representation_id: null,
		/**
		* StructuralGeometry type
		* 
		* @example
		* extendLoop, basicLoop, Cercle, Line
		*
		* @property type
		* @type String
		* @default null
		**/
		type: null,
		/**
		* StructuralGeometry pos
		* 
		* Position relative to other forms
		*
		* @property pos
		* @type int
		* @default null
		**/
		pos: null,
		/**
		* StructuralGeometry params
		* 
		* @example
		* {
		* 	rotation: int,
		* 	sens : int
		* }
		*
		* @property params
		* @type Object
		* @default null
		**/
		params : null,
		/**
		* StructuralGeometry labels
		* 
		* @example
		* [
		* 	String
		* 	String
		* ]
		* 
		* for example : A-101
		*
		* @property labels
		* @type Array
		* @default null
		**/
		labels : null,
		/**
		* StructuralGeometry coordinates
		* 
		* @example
		* [
		* 	{id : int, x: float, y: float , amino_acid_id : int}
		* ]
		* 
		*
		* @property coordinates
		* @type Array
		* @default null
		**/
		coordinates : null
	}
});