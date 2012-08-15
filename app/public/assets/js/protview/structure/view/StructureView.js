ProtView.Structure.View.StructureView = ProtView.Core.View.extend({
	events: { 
		'click #structure-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
		e.preventDefault();
		var model = this.model;
		var terminusN = $('#structure-terminus-n').val();
        model.set({terminusN : terminusN}, {silent: true});

        var terminusC = $('#structure-terminus-c').val();
        model.set({terminusC : terminusC}, {silent: true});
        //console.log('model: ' + this.model.isValid());
        var regions = this.evaluateRegions();
        model.set({membraneRegions : regions}, {silent: true});
        
        
        
        
        //this.controller.save();
    },
    evaluateRegions: function() {
    	var regions = [];
        var region = {};
        $('#structure-regions-values li').each(function() {
        	var child = $(this).children();
        	child.each(function(k,v) {
        		var el = $(v).get(0);
        		
        		if (el.tagName.toLowerCase() == 'input') {
        			//structure-region_from-1
        			var input = $(el);
        			
        			var inputId = input.attr('id');
        				
        			//pos = before _
        			var posUnderscore = inputId.indexOf('_');
        			var posLastDash = inputId.lastIndexOf('-');
        			//from, to
        			var pos = inputId.substring(posUnderscore + 1, posLastDash);
        			var id = inputId.substring(posLastDash + 1);
        			region.id = id;
        			
        			//{id: 0, start: 0, end: 0}
        			if (pos == 'from') {
        				region.start = input.val();;
        			}
        			else if (pos == 'to') {
        				region.end = input.val();
        				regions.push(region);
        				region = {};
        			}
        		}
        	});
        });
        return regions;
    },
    renderRegion : function(regions) {
    	var ret ='<div class="control-group"> ';
    		ret += '<label for="structure-region-1" id="structure-region-label" ';
    		ret += 'class="control-label">Membrane regions</label> ';
    		ret += '<div class="controls"> ';
    		ret += '<ol id="structure-regions-values">';
    	_.each(regions, function(val, key){ 
    		ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
    		ret += 'From : <input type="text" class="input-xmini inline"';
			ret += 'name="structure-region_from-' + val.region_id + '" ';
			ret += 'id="structure-region_from-' + val.region_id + '" ';
			ret += 'value="' + val.start + '"> ';
			ret += 'To : <input type="text" class="input-xmini inline" ';
			ret += 'name="structure-region_to-' + val.region_id + '" ';
			ret += 'id="structure-region_to-' + val.region_id + '" ';
			ret += 'value="' + val.end + '">';
			ret += '<i class="icon-minus"></i>';
			ret += '</li>';
    		}
    	);
    	ret += '<li style="margin-left: 20px; margin-bottom: 9px;">';
		ret += 'From : <input type="text" class="input-xmini inline"';
		ret += 'name="structure-region_from-0" ';
		ret += 'id="structure-region_from-0" ';
		ret += 'value=""> ';
		ret += 'To : <input type="text" class="input-xmini inline" ';
		ret += 'name="structure-region_to-0" ';
		ret += 'id="structure-region_to-0" ';
		ret += 'value="">';
		ret += '<i class="icon-plus"></i>';
		ret += '</li>';
    	ret += '</ol></div></div>';
    	return ret;
    },
	render : function() {
		console.log('render');
		var renderedContent = this.template(this.model.toJSON());

		var renderedRegions = this.renderRegion(this.model.get('membraneRegions'));

        $('#structure-form-insert').html(renderedContent + renderedRegions);
        this.modelBinder.bind(this.model, this.el, this.bindings);
        Backbone.Validation.bind(this);


		return this;
	},
});