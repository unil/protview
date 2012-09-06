/**
 * 
 * Peptide model
 * 
 * 
 * @module Structure
 * @namespace Structure.Model
 * @class Peptide
 * @extends Backbone.Model
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Structure.Model.Peptide = Backbone.RelationalModel.extend({
	defaults : {
		/**
		* Peptide id
		*
		* @property id
		* @type int
		* @default null
		**/
		id: null,
		/**
		* Peptide sequence
		*
		* @property sequence
		* @type String
		* @default null
		**/
		sequence: null,
		/**
		* N-Terminus
		* 
		* Accepted values: intra|extra
		*
		* @property terminusN
		* @type String
		* @default null
		**/
		terminusN: null,
		/**
		* C-Terminus
		* 
		* Accepted values: intra|extra
		*
		* @property terminusC
		* @type String
		* @default null
		**/
		terminusC: null,
		/**
		* Peptide regions
		* 
		* @example
		* 
		* [
		* 	{id : int, start : int, end : int}
		* ]
		*
		* @property regions
		* @type Array
		* @default {}
		**/
		regions : {},
		/**
		* Foreign key to protein id
		*
		* @property protein_id
		* @type int
		* @default null
		**/
		protein_id : null
	},
	initialize : function Peptide() {
	},
	/**
	 * Gets the URL of related server resource able to handle requests
	 * 
	 * @method url
	 * @return {String} url
	 */
	url : function() {
		var root = Application.ROOTPATH;
		var url = root + 'api/peptides';
		/*if (this.id != null)
			url += '/' + this.id;*/

		return url + '?protein_id=' + this.attributes.protein_id + '&regions=membrane';
	},
	/**
	 * Validates model properties
	 * 
	 * @method validaton
	 */
	validation : {
		regions: function(regions) {
			var valid = true;
			//var isNumber = this.isNumber();
			_.each(regions, function(val, key) {
				var id = val.id;
				var start = val.start;
				var end = val.end;

				if (valid)
					valid = this.isNumber(start);
				
				if (valid)
					valid = this.isNumber(end) && end > start;
				
				if (valid)
					valid = this.isNumber(id) && id >= 0;
							
			}, this);
			if (!valid)
				return 'invalid';
		},
		/*sequence : {
			required: true,
			minLength: 1
		},
		terminusN : function(value) {
			if(value == null)
				return 'invalid';
		},
		terminusC : function(value) {
			if(value == null)
				return 'invalid';
		}*/
	},
	//basic check if the value is a number
	isNumber : function (n) {
		  return !isNaN(parseFloat(n)) && isFinite(n);
	}
});