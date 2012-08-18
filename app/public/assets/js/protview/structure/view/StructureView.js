ProtView.Structure.View.StructureView = ProtView.Core.View.extend({
	events : {
		'click #structure-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
		e.preventDefault();
		var model = this.model;
		var terminusN = $('#structure-terminus-n').val();
		model.set({
			terminusN : terminusN
		}, {
			silent : true
		});

		var terminusC = $('#structure-terminus-c').val();
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
		$('#structure-regions-values li').each(
				function() {
					var child = $(this).children();
					child.each(function(k, v) {
						var el = $(v).get(0);

						if (el.tagName.toLowerCase() == 'input') {
							// structure-region_from-1
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
		ret += '<label for="structure-region-1" id="structure-region-label" ';
		ret += 'class="control-label">Membrane regions</label> ';
		ret += '<div class="controls"> ';
		ret += '<ol id="structure-regions-values">';
		_.each(regions, function(val, key) {
			ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
			ret += 'From : <input type="text" class="input-xmini inline"';
			ret += 'name="structure-region_from-' + val.id + '" ';
			ret += 'id="structure-region_from-' + val.id + '" ';
			ret += 'value="' + val.start + '"> ';
			ret += 'To : <input type="text" class="input-xmini inline" ';
			ret += 'name="structure-region_to-' + val.id + '" ';
			ret += 'id="structure-region_to-' + val.id + '" ';
			ret += 'value="' + val.end + '">';
			ret += ' <i class="icon-minus"></i>';
			ret += '</li>';
		});
		ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
		ret += 'From : <input type="text" class="input-xmini inline"';
		ret += 'name="structure-region_from-0" ';
		ret += 'id="structure-region_from-0" ';
		ret += 'value=""> ';
		ret += 'To : <input type="text" class="input-xmini inline" ';
		ret += 'name="structure-region_to-0" ';
		ret += 'id="structure-region_to-0" ';
		ret += 'value=""> ';
		ret += '<i class="icon-plus"></i>';
		ret += '</li>';
		ret += '</ol></div></div>';
		return ret;
	},
	render : function() {
		var renderedContent = this.template(this.model.toJSON());

		var renderedRegions = this.renderRegion(this.model
				.get('regions'));

		$('#structure-form-insert').html(renderedContent + renderedRegions);
		this.modelBinder.bind(this.model, this.el, this.bindings);
		Backbone.Validation.bind(this);

		return this;
	},
});