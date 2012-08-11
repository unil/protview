ProtView.Structure.View.ProteinView = Backbone.View.extend({
	el : '#protein-form',
	initialize : function(args) {
		this.modelBinder = new Backbone.ModelBinder();
		this.template = _.template($('#protein-form-template').html());
		this.bindings = {
				name: '#protein-name',
				species: '#protein-species',
				note: '#protein-note'
			};
	},
	events: { 
		'click #protein-form-submit' : 'submitForm'
	},
	setController : function(controller) {
		this.controller = controller;
	},
	setModel : function(model) {
		model.on('change', this.render, this);	
		model.on('reset', this.render, this);

		this.model = model;
	},
	submitForm : function(e) {
        e.preventDefault();
        this.controller.save();
    },
	render : function() {
		console.log('model');
		console.log(model);
		var renderedContent = this.template(this.model.toJSON());
        $(this.el).html(renderedContent);
        this.modelBinder.bind(this.model, this.el, this.bindings);
		return this;
	},
});