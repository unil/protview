/**
 * 
 * Handles and shows peptide form
 * 
 * 
 * @module Structure
 * @namespace Structure.View
 * @class PeptideView
 * @extends Core.View
 * 
 * @author Stefan Meier
 * @version 20120903
 * 
 */
ProtView.Structure.View.PeptideView = ProtView.Core.View.extend({
	events : {
		/**
		 * @event click #peptide-form-submit
		 */
		'click #peptide-form-submit' : 'submitForm'
	},
	/**
	 * Handles form submit
	 * 
	 * @method submitForm
	 * @param {Object} event
	 */
	submitForm : function(e) {
		e.preventDefault();
		var model = this.model;
		//reads current n-terminus value and updates model
		var terminusN = $('#peptide-terminus-n').val();
		model.set({
			terminusN : terminusN
		}, {
			silent : true
		});

		//reads current c-terminus value and updates model
		var terminusC = $('#peptide-terminus-c').val();
		model.set({
			terminusC : terminusC
		}, {
			silent : true
		});
		
		var sequence = $('#peptide-sequence').val();
		
		model.set({
			sequence : sequence
		}, {
			silent : true
		});

		//reads current membrane regions and updates model
		var regions = this.evaluateRegions();
		model.set({
			regions : regions
		}, {
			silent : true
		});

		//validates model manually
		var valid = model.isValid(true);

		//if model is valid, content is saved
		if (valid) {
			this.model = model;
			this.controller.save();
		}
	},
	/**
	 * Gets membrane regions from form
	 * 
	 * @method evaluateRegions
	 * @return {Object} regions
	 */
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
	/**
	 * Converts regions to HTML
	 * 
	 * @method {Object} regions
	 * @return {string} htmlRegions
	 */
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
	/**
	 * Creates a new membrane region form row
	 * 
	 * @method newRow
	 * @return {string} htmlRegionRow
	 */
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
	/**
	 * Binds the remove row event to the minus button after each region row
	 *
	 * @method bindRemoveRowEvent
	 * @return {string} htmlRegionRow
	 */
	bindRemoveRowEvent: function() {
		$('.remove_row').click(function() {
			var currentRow = $(this).parent();
			currentRow.remove();
		});
	},
	/**
	 * Renders peptide view
	 *
	 * @method render
	 * @chainable
	 */
	render : function() {
		var self = this;
		var renderedContent = self.template(self.model.toJSON()),
		renderedRegions = this.renderRegion(self.model
				.get('regions'));

		$('#peptide-form-insert').html(renderedContent + renderedRegions);

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