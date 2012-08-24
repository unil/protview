ProtView.Structure.Model.Peptide = Backbone.RelationalModel.extend({
	defaults : {
		id: null,
		sequence: null,
		terminusN: null,
		terminusC: null,
		regions : {},
		protein_id : null
	},
	initialize : function Peptide() {
	},
	url : function() {
		var root = Application.ROOTPATH;
		var url = root + 'api/peptides';
		/*if (this.id != null)
			url += '/' + this.id;*/

		return url + '?protein_id=' + this.attributes.protein_id + '&regions=membrane';
	},
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
		sequence : {
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
		}
	},
	//basic check if the value is a number
	isNumber : function (n) {
		  return !isNaN(parseFloat(n)) && isFinite(n);
	}
});