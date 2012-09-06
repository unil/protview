/**
 * 
 * Protein model
 * 
 * 
 * @module Structure
 * @namespace Structure.Model
 * @class Protein
 * @extends Backbone.Model
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Structure.Model.Protein = Backbone.Model.extend({
	defaults : {
		/**
		* Protein id
		*
		* @property id
		* @type int
		* @default null
		**/
		id: null,
		/**
		* Protein name
		*
		* @property name
		* @type String
		* @default null
		**/
		name: null,
		/**
		* Protein species
		* 
		* Accepted values are : Homo sapiens, duck, mice
		*
		* @property species
		* @type String
		* @default null
		**/
		species: null,
		/**
		* @property note
		* @type String
		* @default null
		**/
		note: null,
	},
	/**
	 * Gets the URL of related server resource able to handle requests
	 * 
	 * @method url
	 * @return {String} url
	 */
	url : function() {
		var root = Application.ROOTPATH;
		return this.id == null ? root + 'api/proteins/0': root + 'api/proteins/' + this.id;
	},
	/**
	 * Validates model properties
	 * 
	 * @method validaton
	 */
	validation: {
	    name: {
	      required: true,
	      msg: 'Please enter a valid email'
	    }
	}
});