ProtView.Structure.View.PeptideView = ProtView.Core.View.extend({
	events : {
		'click #peptide-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
		e.preventDefault();
		var model = this.model;
		var terminusN = $('#peptide-terminus-n').val();
		model.set({
			terminusN : terminusN
		}, {
			silent : true
		});

		var terminusC = $('#peptide-terminus-c').val();
		model.set({
			terminusC : terminusC
		}, {
			silent : true
		});

		var regions = this.evaluateRegions();
		model.set({
			regions : regions
		}, {
			silent : true
		});

		var valid = model.isValid(true);

		if (valid) {
			this.model = model;
			console.log(model);
			this.controller.save();
		}
	},
	valid: function(view, attr) {
        // do something
    },
    invalid: function(view, attr, error) {
       console.log(attr);
       console.log(error);

    },
	evaluateRegions : function() {
		var regions = [];
		var region = {};
		$('#peptide-regions-values li').each(
				function() {
					var child = $(this).children();
					child.each(function(k, v) {
						var el = $(v).get(0);

						if (el.tagName.toLowerCase() == 'input') {
							// peptide-region_from-1
							var input = $(el);

							var inputId = input.attr('id');

							// pos = before _
							var posUnderscore = inputId.indexOf('_');
							var posLastDash = inputId.lastIndexOf('-');
							// from, to
							var pos = inputId.substring(posUnderscore + 1,
									posLastDash);
							var id = inputId.substring(posLastDash + 1);
							region.id = Number(id);

							var inputVal = input.val();

							if (inputVal != '') {
								// {id: 0, start: 0, end: 0}
								if (pos == 'from') {
									region.start = Number(inputVal);
								} else if (pos == 'to') {
									region.end = Number(inputVal);
									regions.push(region);
									region = {};
								}
							}
						}

					});
				});
		return regions;
	},
	renderRegion : function(regions) {
		var ret = '<div class="control-group"> ';
		ret += '<label for="peptide-region-1" id="peptide-region-label" ';
		ret += 'class="control-label">Membrane regions</label> ';
		ret += '<div class="controls"> ';
		ret += '<ol id="peptide-regions-values">';
		_.each(regions, function(val, key) {
			ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
			ret += 'From : <input type="text" class="input-xmini inline"';
			ret += 'name="peptide-region_from-' + val.id + '" ';
			ret += 'id="peptide-region_from-' + val.id + '" ';
			ret += 'value="' + val.start + '"> ';
			ret += 'To : <input type="text" class="input-xmini inline" ';
			ret += 'name="peptide-region_to-' + val.id + '" ';
			ret += 'id="peptide-region_to-' + val.id + '" ';
			ret += 'value="' + val.end + '">';
			ret += ' <i class="icon-minus remove_row"></i>';
			ret += '</li>';
		});
		ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
		ret += '<i class="icon-plus add_row"></i>';
		ret += '</li>';
		ret += '</ol></div></div>';
		return ret;
	},
	newRow : function() {
		ret = '';
		ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
		ret += 'From : <input type="text" class="input-xmini inline"';
		ret += 'name="peptide-region_from-0" ';
		ret += 'id="peptide-region_from-0" ';
		ret += 'value=""> ';
		ret += 'To : <input type="text" class="input-xmini inline" ';
		ret += 'name="peptide-region_to-0" ';
		ret += 'id="peptide-region_to-0" ';
		ret += 'value=""> ';
		ret += '<i class="icon-minus remove_row"></i>';
		ret += '</li>';
		ret += '</ol></div></div>';
		return ret;
	},
	bindRemoveRowEvent: function() {
		$('.remove_row').click(function() {
			var currentRow = $(this).parent();
			currentRow.remove();
		});
	},
	render : function() {
		var self = this;
		var renderedContent = self.template(self.model.toJSON()),
		renderedRegions = this.renderRegion(self.model
				.get('regions'));

		$('#peptide-form-insert').html(renderedContent + renderedRegions);
		self.modelBinder.bind(self.model, self.el, self.bindings);
		Backbone.Validation.bind(self);
		
		self.bindRemoveRowEvent();
		
		$('.add_row').click(function() {
			var currentRow =  $(this).parent();
			var newRow = self.newRow();
			currentRow.before(newRow);
			
			self.bindRemoveRowEvent();
		});

		return self;
	},
});