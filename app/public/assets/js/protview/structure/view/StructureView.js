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
    	var ret ='';
    	_.each(regions, function(val, key){ 
    		ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
    		ret += 'From : <input type="text" class="input-xmini inline"';
			ret += 'name="structure-region-from-1" id="from-1">';
			ret += 'To : <input type="text" class="input-xmini inline"';
			ret += 'name="structure-region-form-' + val.id + '"';
			ret += 'id="structure-region-form-' + val.id + '"';
			ret += 'value="' + val.end + '">';
			ret += '<i class="icon-minus"></i>';
			ret += '</li>';
    		}
    	);
    	console.log(ret);
    },
	render : function() {
		var renderedContent = this.template(this.model.toJSON());

		var renderedRegions = this.renderRegion(this.model.get('membraneRegions'));

        $('#structure-form-insert').html(renderedContent);
        this.modelBinder.bind(this.model, this.el, this.bindings);
        Backbone.Validation.bind(this);


		return this;
	},
});