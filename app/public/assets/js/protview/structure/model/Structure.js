ProtView.Structure.Model.Structure = Backbone.RelationalModel.extend({
	defaults : {
		id: null,
		sequence: null,
		terminusN: null,
		terminusC: null,
		membraneRegions : {}
	},
	initialize : function Structure() {
	},
	url : function() {
		var root = Application.ROOTPATH;
		return root + 'api/structure/' + this.id;
	},
	validation : {
		membraneRegions: function(regions) {
			var valid = true;
			console.log('regions');
			console.log(regions);
			//var isNumber = this.isNumber();
			_.each(regions, function(val, key) {
				var id = val.id;
				var start = val.start;
				var end = val.end;
				
				console.log('id: ' + id + ' start: ' + start + 'end: ' + end);
				
				var valid = true;
				
				valid = this.isNumber(start);
				
				if (valid)
					valid = this.isNumber(end) && end > start;
				
				if (valid)
					valid = this.isNumber(id) && id >= 0;
					
				console.log('valid ' + valid);
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