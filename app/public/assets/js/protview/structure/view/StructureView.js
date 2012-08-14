ProtView.Structure.View.StructureView = ProtView.Core.View.extend({
	events: { 
		'click #structure-form-submit' : 'submitForm'
	},
	submitForm : function(e) {
        e.preventDefault();
        console.log('model: ' + this.model.isValid());

        this.controller.save();
    },
    renderRegion : function() {
    	_.each({one : 1, two : 2, three : 3}, function(num, key){ console.log(num); });
    },
	render : function() {
		var renderedContent = this.template(this.model.toJSON());
		var renderedRegions = this.renderRegion();
		console.log('model');
		console.log(this.model);
		console.log(this._super('get', 'templateEl'));
        $(this.templateEl).html(renderedContent);
        this.modelBinder.bind(this.model, this.el, this.bindings);
        Backbone.Validation.bind(this);


		return this;
	},
});