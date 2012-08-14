ProtView.Structure.View.StructureView = ProtView.Core.View.extend({
	events: { 
		'click #structure-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
        e.preventDefault();
        console.log('model: ' + this.model.isValid());

        this.controller.save();
    },
    renderRegion : function(regions) {
    	var ret ='<div class="control-group"> '
    		ret += '<label for="structure-region-1" id="structure-region-label" ';
    		ret += 'class="control-label">Membrane regions</label> ';
    		ret += '<div class="controls"> ';
    		ret += '<ol>';
    	_.each(regions, function(val, key){ 
    		console.log(val);
    		ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
    		ret += 'From : <input type="text" class="input-xmini inline"';
			ret += 'name="structure-region-from-' + val.region_id + '" ';
			ret += 'id="structure-region-from-' + val.region_id + '" ';
			ret += 'value="' + val.start + '"> ';
			ret += 'To : <input type="text" class="input-xmini inline" ';
			ret += 'name="structure-region-to-' + val.region_id + '" ';
			ret += 'id="structure-region-to-' + val.region_id + '" ';
			ret += 'value="' + val.end + '">';
			ret += '<i class="icon-minus"></i>';
			ret += '</li>';
    		}
    	);
    	ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
		ret += 'From : <input type="text" class="input-xmini inline"';
		ret += 'name="structure-region-from-0" ';
		ret += 'id="structure-region-from-0" ';
		ret += 'value=""> ';
		ret += 'To : <input type="text" class="input-xmini inline" ';
		ret += 'name="structure-region-to-0" ';
		ret += 'id="structure-region-to-0" ';
		ret += 'value="">';
		ret += '<i class="icon-plus"></i>';
		ret += '</li>';
    	ret += '</ol></div></div>';
    	return ret;
    },
	render : function() {
		var renderedContent = this.template(this.model.toJSON());

		var renderedRegions = this.renderRegion(this.model.get('membraneRegions'));

        $('#structure-form-insert').html(renderedContent + renderedRegions);
        this.modelBinder.bind(this.model, this.el, this.bindings);
        Backbone.Validation.bind(this);


		return this;
	},
});